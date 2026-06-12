<?php
session_start();

// Login check - staff, instructor, admin විතරයි access කරන්නේ
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

    // Handle Delete Feedback (Admin only)
    if (isset($_GET['delete']) && $is_admin) {
        $id = (int)$_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo '<div class="success-msg">Feedback deleted successfully!</div>';
        } else {
            echo '<div class="error">Delete failed.</div>';
        }
        $stmt->close();
    }

    // Fetch all feedback
    $search = trim($_GET['search'] ?? '');
    $sql = "SELECT * FROM feedback";
    $params = [];
    $types = "";

    if (!empty($search)) {
        $sql .= " WHERE name LIKE ? OR email LIKE ? OR message LIKE ?";
        $search_term = "%$search%";
        $params = [$search_term, $search_term, $search_term];
        $types = "sss";
    }

    $sql .= " ORDER BY submitted_at DESC";

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Calculate average rating & counts
    $stats = $conn->query("SELECT 
        COUNT(*) AS total,
        AVG(rating) AS avg_rating,
        SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) AS five_star,
        SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) AS four_star,
        SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) AS three_star,
        SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) AS two_star,
        SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) AS one_star
        FROM feedback")->fetch_assoc();

    $avg_rating = round($stats['avg_rating'] ?? 0, 1);
    $total = $stats['total'] ?? 0;

} catch (Exception $e) {
    echo '<div class="error">Database error: ' . $e->getMessage() . '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro - Feedback</title>
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
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        .flex-container { display: flex; min-height: 100vh; }
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #064e3b, #065f46);
            color: white;
            padding: 2rem 1rem;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }
        .logo img { width: 100px; display: block; margin: 0 auto 1rem; border-radius: 50%; border: 4px solid var(--accent); }
        .sidebar h1 { text-align: center; font-size: 2rem; color: var(--accent); margin-bottom: 2rem; font-weight: 700; }
        .nav-link { display: block; padding: 1rem; color: #e6f4ea; text-decoration: none; border-radius: 8px; margin-bottom: 0.5rem; transition: all 0.3s; font-weight: 500; }
        .nav-link:hover, .nav-link.active { background: var(--accent); color: #1f2937; transform: translateX(8px); }
        .btn-logout { width: 100%; padding: 1rem; background: var(--danger); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1rem; margin-top: 2rem; transition: 0.3s; }
        .btn-logout:hover { background: #dc2626; }

        .main-content { flex: 1; padding: 2rem; overflow-x: auto; }
        .header h2 { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 1.5rem; }
        .container { background: var(--card); border-radius: 16px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: 1px solid #d4f4dd; }
        .container h1 { text-align: center; color: var(--primary-dark); margin-bottom: 2rem; font-size: 2.2rem; }

        /* Stats Summary */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .stat-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(5,150,105,0.3);
        }
        .stat-card.accent {
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        }
        .stat-value {
            font-size: 2.8rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        .stat-label { font-size: 1.1rem; opacity: 0.9; }

        /* Rating Stars */
        .stars {
            font-size: 1.4rem;
            color: #fbbf24;
        }
        .stars .filled { color: #f59e0b; }

        /* Search */
        .search-box {
            max-width: 500px;
            margin: 0 auto 2rem;
        }
        .search-box input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 1.1rem;
            background: #f8fafc;
        }

        /* Feedback Cards */
        .feedback-list {
            display: grid;
            gap: 1.5rem;
        }
        .feedback-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-left: 5px solid var(--primary);
            transition: 0.3s;
        }
        .feedback-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .feedback-name { font-weight: 600; font-size: 1.2rem; }
        .feedback-date { color: var(--text-light); font-size: 0.9rem; }
        .feedback-email { color: var(--text-light); margin-bottom: 1rem; }
        .feedback-message {
            line-height: 1.6;
            margin: 1rem 0;
            color: var(--text);
        }
        .feedback-actions {
            text-align: right;
            margin-top: 1rem;
        }
        .delete-btn {
            background: var(--danger);
            color: white;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .delete-btn:hover { background: #dc2626; }

        .success-msg, .error {
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
            font-weight: 600;
        }
        .success-msg { background: #d4f4dd; color: var(--success); border: 1px solid var(--success); }
        .error { background: #fee2e2; color: var(--danger); border: 1px solid var(--danger); }

        .no-feedback {
            text-align: center;
            padding: 3rem;
            color: var(--text-light);
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .flex-container { flex-direction: column; }
            .sidebar { width: 100%; padding: 1rem; }
            .stats-grid { grid-template-columns: 1fr; }
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
            <a href="applications.php" class="nav-link">Course Applications</a>
            <a href="timetable.php" class="nav-link">Timetable</a>
            <a href="users.php" class="nav-link">Manage Users</a>
            <a href="feedback.php" class="nav-link active">Feedback</a>
            <button id="logoutBtn" class="btn-logout">Logout</button>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2>Staff Dashboard - <?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? '')); ?></h2>
        </div>

        <div class="container">
            <h1>Student & Visitor Feedback</h1>

            <!-- Stats Summary -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value"><?php echo $total; ?></div>
                    <div class="stat-label">Total Feedback</div>
                </div>
                <div class="stat-card accent">
                    <div class="stat-value">
                        <?php echo $avg_rating; ?> 
                        <span class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo $i <= round($avg_rating) ? 'filled' : ''; ?>"></i>
                            <?php endfor; ?>
                        </span>
                    </div>
                    <div class="stat-label">Average Rating</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?php echo $stats['five_star'] ?? 0; ?></div>
                    <div class="stat-label">5-Star Reviews</div>
                </div>
            </div>

            <!-- Search -->
            <div class="search-box">
                <form method="GET">
                    <input type="text" name="search" placeholder="Search by name, email or message..." value="<?php echo htmlspecialchars($search); ?>">
                </form>
            </div>

            <!-- Feedback List -->
            <?php if ($result && $result->num_rows > 0): ?>
                <div class="feedback-list">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="feedback-card">
                            <div class="feedback-header">
                                <div>
                                    <div class="feedback-name"><?php echo htmlspecialchars($row['name']); ?></div>
                                    <div class="feedback-email"><?php echo htmlspecialchars($row['email']); ?></div>
                                </div>
                                <div class="feedback-date">
                                    <?php echo date('d M Y', strtotime($row['submitted_at'])); ?>
                                </div>
                            </div>

                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $row['rating'] ? 'filled' : ''; ?>"></i>
                                <?php endfor; ?>
                                <span style="margin-left:0.5rem; font-weight:600; color:var(--primary-dark);">
                                    <?php echo $row['rating']; ?>.0
                                </span>
                            </div>

                            <?php if (!empty($row['message'])): ?>
                                <div class="feedback-message">
                                    "<?php echo nl2br(htmlspecialchars($row['message'])); ?>"
                                </div>
                            <?php else: ?>
                                <div class="feedback-message" style="color:var(--text-light); font-style:italic;">
                                    No written message.
                                </div>
                            <?php endif; ?>

                            <?php if ($is_admin): ?>
                                <div class="feedback-actions">
                                    <a href="?delete=<?php echo $row['id']; ?>" 
                                       class="delete-btn" 
                                       onclick="return confirm('Delete this feedback permanently?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="no-feedback">
                    <?php echo empty($search) ? 'No feedback received yet.' : 'No feedback matches your search.'; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Auto-submit search when typing
    document.querySelector('.search-box input').addEventListener('input', function() {
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