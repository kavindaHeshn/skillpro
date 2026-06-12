<?php
session_start();

// Login check - staff, instructor (optional), admin only
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

    // Handle status update
    if (isset($_POST['update_status']) && $is_staff_or_above) {
        $app_id = (int)$_POST['app_id'];
        $new_status = $_POST['status']; // pending, approved, rejected

        if (in_array($new_status, ['pending', 'approved', 'rejected'])) {
            $stmt = $conn->prepare("UPDATE course_applications SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $new_status, $app_id);
            if ($stmt->execute()) {
                echo '<div class="success-msg">Application status updated successfully!</div>';
            } else {
                echo '<div class="error">Update failed.</div>';
            }
            $stmt->close();
        }
    }

    // Fetch all applications
    $sql = "SELECT * FROM course_applications ORDER BY applied_at DESC";
    $result = $conn->query($sql);

    // Counts
    $count_pending = $conn->query("SELECT COUNT(*) AS c FROM course_applications WHERE status='pending'")->fetch_assoc()['c'];
    $count_approved = $conn->query("SELECT COUNT(*) AS c FROM course_applications WHERE status='approved'")->fetch_assoc()['c'];
    $count_rejected = $conn->query("SELECT COUNT(*) AS c FROM course_applications WHERE status='rejected'")->fetch_assoc()['c'];
    $count_total = $count_pending + $count_approved + $count_rejected;

} catch (Exception $e) {
    echo '<div class="error">Database error: '.$e->getMessage().'</div>';
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
            --danger: #ef4444;
            --warning: #f59e0b;
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

        .main-content { flex: 1; padding: 2rem; overflow-x: auto; }

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

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .summary-card {
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            color: white;
        }

        .card-pending { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .card-approved { background: linear-gradient(135deg, #10b981, #059669); }
        .card-rejected { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .card-total { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); }

        .summary-card h3 { font-size: 1.1rem; margin-bottom: 0.5rem; opacity: 0.9; }
        .summary-card .count { font-size: 2.5rem; font-weight: 700; }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        th {
            background: var(--primary);
            color: white;
            padding: 1rem;
            text-align: left;
        }

        td { padding: 1rem; border-bottom: 1px solid var(--border); }

        tr:hover { background: #f0fdf4; }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pending { background: #fff3cd; color: #997404; }
        .status-approved { background: #d4f4dd; color: #059669; }
        .status-rejected { background: #fee2e2; color: #dc2626; }

        .action-select {
            padding: 0.5rem;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

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
            .summary-grid { grid-template-columns: 1fr; }
            table, thead, tbody, th, td, tr { display: block; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }
            tr { border: 1px solid #ccc; margin-bottom: 1rem; border-radius: 8px; }
            td { border: none; position: relative; padding-left: 50%; }
            td:before { content: attr(data-label); position: absolute; left: 1rem; width: 45%; font-weight: bold; }
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
            <h2>Admin Dashboard - <?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? '')); ?></h2>
        </div>

        <div class="container">
            <h1>Course Applications</h1>

            <!-- Summary Cards -->
            <div class="summary-grid">
                <div class="summary-card card-total">
                    <h3>Total Applications</h3>
                    <div class="count"><?php echo $count_total; ?></div>
                </div>
                <div class="summary-card card-pending">
                    <h3>Pending</h3>
                    <div class="count"><?php echo $count_pending; ?></div>
                </div>
                <div class="summary-card card-approved">
                    <h3>Approved</h3>
                    <div class="count"><?php echo $count_approved; ?></div>
                </div>
                <div class="summary-card card-rejected">
                    <h3>Rejected</h3>
                    <div class="count"><?php echo $count_rejected; ?></div>
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>NIC</th>
                            <th>Branch</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td data-label="ID"><?php echo $row['id']; ?></td>
                                <td data-label="Course"><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td data-label="Applicant"><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td data-label="Email"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td data-label="Phone"><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td data-label="NIC"><?php echo htmlspecialchars($row['nic']); ?></td>
                                <td data-label="Branch"><?php echo htmlspecialchars($row['branch']); ?></td>
                                <td data-label="Applied"><?php echo date('d M Y', strtotime($row['applied_at'])); ?></td>
                                <td data-label="Status">
                                    <span class="status-badge status-<?php echo $row['status']; ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td data-label="Action">
                                    <?php if ($is_staff_or_above): ?>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="app_id" value="<?php echo $row['id']; ?>">
                                            <select name="status" class="action-select" onchange="this.form.submit()">
                                                <option value="pending" <?php echo $row['status']=='pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="approved" <?php echo $row['status']=='approved' ? 'selected' : ''; ?>>Approved</option>
                                                <option value="rejected" <?php echo $row['status']=='rejected' ? 'selected' : ''; ?>>Rejected</option>
                                            </select>
                                            <input type="hidden" name="update_status" value="1">
                                        </form>
                                    <?php else: ?>
                                        <em>No permission</em>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center; padding:2rem; color:var(--text-light);">No course applications found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('logoutBtn').addEventListener('click', () => {
        if (confirm('Are you sure you want to logout?')) {
            location.href = 'logout.php';
        }
    });
</script>
</body>
</html>
<?php if (isset($conn)) $conn->close(); ?>