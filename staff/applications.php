<?php
session_start();

// Login check - staff, instructor, admin විතරයි access කරන්න ඕනේ
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['staff', 'instructor', 'admin'])) {
    header('Location: login.php');
    exit();
}

$is_admin = $_SESSION['role'] === 'admin';
$is_staff_or_above = in_array($_SESSION['role'], ['staff', 'admin']);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "skillpro";

try {
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die('<div class="error">Connection failed: ' . $conn->connect_error . '</div>');
    }
    $conn->set_charset("utf8mb4");

    // Handle status update (Approve / Reject)
    if (isset($_POST['update_status']) && $is_staff_or_above) {
        $app_id = (int)$_POST['app_id'];
        $new_status = $_POST['status']; // approved or rejected

        if (in_array($new_status, ['approved', 'rejected'])) {
            $stmt = $conn->prepare("UPDATE course_applications SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $new_status, $app_id);
            if ($stmt->execute()) {
                echo '<div class="success-msg">Application status updated to <strong>' . ucfirst($new_status) . '</strong>!</div>';
            } else {
                echo '<div class="error">Update failed.</div>';
            }
            $stmt->close();
        }
    }

    // Fetch applications
    $filter = $_GET['filter'] ?? 'all';
    $search = trim($_GET['search'] ?? '');

    $sql = "SELECT * FROM course_applications";
    $where = [];
    $params = [];
    $types = "";

    if ($filter !== 'all') {
        $where[] = "status = ?";
        $params[] = $filter;
        $types .= "s";
    }

    if (!empty($search)) {
        $where[] = "(full_name LIKE ? OR email LIKE ? OR phone LIKE ? OR nic LIKE ?)";
        $search_term = "%$search%";
        $params = array_merge($params, [$search_term, $search_term, $search_term, $search_term]);
        $types .= "ssss";
    }

    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    $sql .= " ORDER BY applied_at DESC";

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Counts
    $counts = [];
    $status_options = ['pending', 'approved', 'rejected'];
    foreach ($status_options as $status) {
        $count = $conn->query("SELECT COUNT(*) FROM course_applications WHERE status='$status'")->fetch_row()[0];
        $counts[$status] = $count;
    }
    $counts['all'] = array_sum($counts);

} catch (Exception $e) {
    echo '<div class="error">Database error: ' . $e->getMessage() . '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro - Course Applications</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --accent: #f59e0b;
            --accent-hover: #d97706;
            --bg: #f0fdf4;
            --card: #ffffff;
            --text: #1f2937;
            --text-light: #6b7280;
            --border: #d1d5db;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --pending: #6366f1;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .flex-container { display: flex; min-height: 100vh; }
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #064e3b, #065f46);
            color: white;
            padding: 2rem 1rem;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .logo img {
            width: 100px;
            display: block;
            margin: 0 auto 1rem;
            border-radius: 50%;
            border: 4px solid var(--accent);
        }

        .sidebar h1 {
            text-align: center;
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .nav-link {
            display: block;
            padding: 1rem;
            color: #e6f4ea;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent);
            color: #1f2937;
            transform: translateX(8px);
        }

        .btn-logout {
            width: 100%;
            padding: 1rem;
            background: var(--danger);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 2rem;
            transition: 0.3s;
        }

        .btn-logout:hover { background: #dc2626; }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-x: auto;
        }

        .header h2 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
        }

        .container {
            background: var(--card);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #d4f4dd;
        }

        .container h1 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            font-size: 2.2rem;
        }

        /* Filters & Search */
        .controls {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            align-items: center;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
        }

        .filter-tab {
            padding: 0.8rem 1.2rem;
            background: #e6f4ea;
            color: var(--text);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .filter-tab.active, .filter-tab:hover {
            background: var(--primary);
            color: white;
        }

        .filter-tab .count {
            margin-left: 0.5rem;
            background: rgba(255,255,255,0.3);
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 1rem;
        }

        th {
            background: var(--primary);
            color: white;
            padding: 1rem;
            text-align: left;
        }

        td {
            background: #f8fafc;
            padding: 1rem;
            border-bottom: 1px solid var(--border);
        }

        tr:hover td { background: #ecfdf5; }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-pending { background: #eef2ff; color: var(--pending); }
        .status-approved { background: #d4f4dd; color: var(--success); }
        .status-rejected { background: #fee2e2; color: var(--danger); }

        .action-form {
            display: inline-block;
            margin: 0 0.3rem;
        }

        .btn-small {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .btn-approve {
            background: var(--success);
            color: white;
        }

        .btn-approve:hover { background: #059669; }

        .btn-reject {
            background: var(--danger);
            color: white;
        }

        .btn-reject:hover { background: #dc2626; }

        .success-msg {
            background: #d4f4dd;
            color: var(--success);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
            font-weight: 600;
            border: 1px solid var(--success);
        }

        .error {
            background: #fee2e2;
            color: var(--danger);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid var(--danger);
            margin: 1rem 0;
        }

        @media (max-width: 768px) {
            .flex-container { flex-direction: column; }
            .sidebar { width: 100%; padding: 1rem; }
            .controls { flex-direction: column; }
            table, thead, tbody, th, td, tr { display: block; }
            th { display: none; }
            td { border: none; padding: 0.8rem; position: relative; padding-left: 50%; }
            td:before {
                content: attr(data-label);
                position: absolute;
                left: 1rem;
                width: 45%;
                font-weight: 600;
                color: var(--primary);
            }
        }
    </style>
</head>
<body>
<div class="flex-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo"><img src="../photo/logo.jpeg" alt="SkillPro Logo"></div>
        <h1>SkillPro</h1>
        <nav>
            <a href="applications.php" class="nav-link active">Course Applications</a>
            <a href="timetable.php" class="nav-link">Timetable</a>
            <a href="users.php" class="nav-link">Manage Users</a>
            <a href="feedback.php" class="nav-link">Feedback</a>
            <button id="logoutBtn" class="btn-logout">Logout</button>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2>Staff Dashboard - <?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? '')); ?></h2>
        </div>

        <div class="container">
            <h1>Course Applications</h1>

            <!-- Controls -->
            <div class="controls">
                <div class="search-box">
                    <form method="GET">
                        <input type="text" name="search" placeholder="Search by name, email, phone or NIC..." value="<?php echo htmlspecialchars($search); ?>">
                        <input type="hidden" name="filter" value="<?php echo htmlspecialchars($filter); ?>">
                    </form>
                </div>

                <div class="filter-tabs">
                    <a href="?filter=all" class="filter-tab <?php echo $filter === 'all' ? 'active' : ''; ?>">
                        All <span class="count"><?php echo $counts['all']; ?></span>
                    </a>
                    <a href="?filter=pending" class="filter-tab <?php echo $filter === 'pending' ? 'active' : ''; ?>">
                        Pending <span class="count"><?php echo $counts['pending']; ?></span>
                    </a>
                    <a href="?filter=approved" class="filter-tab <?php echo $filter === 'approved' ? 'active' : ''; ?>">
                        Approved <span class="count"><?php echo $counts['approved']; ?></span>
                    </a>
                    <a href="?filter=rejected" class="filter-tab <?php echo $filter === 'rejected' ? 'active' : ''; ?>">
                        Rejected <span class="count"><?php echo $counts['rejected']; ?></span>
                    </a>
                </div>
            </div>

            <!-- Applications Table -->
            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course</th>
                            <th>Applicant</th>
                            <th>Contact</th>
                            <th>NIC</th>
                            <th>Branch</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td data-label="ID"><?php echo $row['id']; ?></td>
                                <td data-label="Course"><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td data-label="Applicant"><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td data-label="Contact">
                                    <?php echo htmlspecialchars($row['email']); ?><br>
                                    <?php echo htmlspecialchars($row['phone']); ?>
                                </td>
                                <td data-label="NIC"><?php echo htmlspecialchars($row['nic']); ?></td>
                                <td data-label="Branch"><?php echo htmlspecialchars($row['branch']); ?></td>
                                <td data-label="Applied"><?php echo date('d M Y', strtotime($row['applied_at'])); ?></td>
                                <td data-label="Status">
                                    <span class="status-badge status-<?php echo $row['status']; ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td data-label="Actions">
                                    <?php if ($row['status'] === 'pending' && $is_staff_or_above): ?>
                                        <form class="action-form" method="POST" style="display:inline;">
                                            <input type="hidden" name="app_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" name="update_status" class="btn-small btn-approve">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form class="action-form" method="POST" style="display:inline;">
                                            <input type="hidden" name="app_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" name="update_status" class="btn-small btn-reject">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <em>No action</em>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center; padding:2rem; color:var(--text-light);">
                    <?php echo empty($search) ? 'No applications found.' : 'No applications match your search.'; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Auto-submit search on input
    document.querySelector('.search-box input').addEventListener('input', function(e) {
        if (this.value.length >= 3 || this.value === '') {
            this.form.submit();
        }
    });

    document.getElementById('logoutBtn').addEventListener('click', () => {
        if (confirm('Are you sure you want to logout?')) {
            location.href = 'logout.php';
        }
    });
</script>
</body>
</html>
<?php if (isset($conn)) $conn->close(); ?>