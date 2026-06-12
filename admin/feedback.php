<?php
session_start();

// Login check
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
    if (isset($_POST['delete_feedback']) && $is_admin) {
        $id = (int)$_POST['feedback_id'];
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
    $sql = "SELECT * FROM feedback ORDER BY submitted_at DESC";
    $result = $conn->query($sql);

    // Statistics
    $total = $conn->query("SELECT COUNT(*) AS c FROM feedback")->fetch_assoc()['c'];
    $avg_rating_result = $conn->query("SELECT AVG(rating) AS avg FROM feedback")->fetch_assoc();
    $avg_rating = $avg_rating_result['avg'] ? round($avg_rating_result['avg'], 1) : 0;

    $rating_counts = [];
    for ($i = 1; $i <= 5; $i++) {
        $count = $conn->query("SELECT COUNT(*) AS c FROM feedback WHERE rating = $i")->fetch_assoc()['c'];
        $rating_counts[$i] = $count;
    }

} catch (Exception $e) {
    echo '<div class="error">Database error: '.$e->getMessage().'</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro - Feedback Management</title>
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

        .nav-link {
            display: block; padding: 1rem; color: #e6f4ea; text-decoration: none; border-radius: 8px; margin-bottom: 0.5rem;
            transition: all 0.3s; font-weight: 500;
        }
        .nav-link:hover, .nav-link.active { background: var(--accent); color: #1f2937; transform: translateX(8px); }

        .btn-logout { width: 100%; padding: 1rem; background: var(--danger); color: white; border: none; border-radius: 8px;
            cursor: pointer; font-size: 1rem; margin-top: 2rem; transition: 0.3s; }
        .btn-logout:hover { background: #dc2626; }

        .main-content { flex: 1; padding: 2rem; overflow-x: auto; }
        .header h2 { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 1.5rem; }

        .container {
            background: var(--card); border-radius: 16px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #d4f4dd;
        }
        .container h1 { text-align: center; color: var(--primary-dark); margin-bottom: 2rem; font-size: 2.2rem; }

        .summary-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin: 2rem 0;
        }
        .summary-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white;
            padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 6px 15px rgba(5,150,105,0.3);
        }
        .summary-card h3 { font-size: 1.1rem; margin-bottom: 0.5rem; opacity: 0.9; }
        .summary-card .count { font-size: 2.5rem; font-weight: 700; }

        .rating-stars {
            color: #fbbf24;
            font-size: 1.2rem;
        }
        .rating-stars .filled { color: #f59e0b; }

        .feedback-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-left: 5px solid var(--primary);
        }
        .feedback-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;
        }
        .feedback-meta {
            color: var(--text-light); font-size: 0.9rem;
        }
        .feedback-message {
            line-height: 1.6; margin-top: 1rem; color: var(--text);
        }

        .delete-btn {
            background: var(--danger); color: white; border: none; padding: 0.6rem 1rem;
            border-radius: 8px; cursor: pointer; font-size: 0.9rem;
        }
        .delete-btn:hover { background: #dc2626; }

        .success-msg, .error {
            padding: 1rem; border-radius: 8px; text-align: center; margin: 1rem 0; font-weight: 600;
        }
        .success-msg { background: #d4f4dd; color: var(--success); border: 1px solid var(--success); }
        .error { background: #fee2e2; color: var(--danger); border: 1px solid var(--danger); }

        @media (max-width: 768px) {
            .flex-container { flex-direction: column; }
            .sidebar { width: 100%; padding: 1rem; }
            .summary-grid { grid-template-columns: 1fr; }
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
            <h2>Admin Dashboard - <?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? '')); ?></h2>
        </div>

        <div class="container">
            <h1>Customer Feedback</h1>

            <!-- Summary Cards -->
            <div class="summary-grid">
                <div class="summary-card">
                    <h3>Total Feedback</h3>
                    <div class="count"><?php echo $total; ?></div>
                </div>
                <div class="summary-card">
                    <h3>Average Rating</h3>
                    <div class="count"><?php echo $avg_rating; ?> <i class="fas fa-star" style="color:#fbbf24;"></i></div>
                </div>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                <div class="summary-card">
                    <h3><?php echo $i; ?> <i class="fas fa-star" style="color:#fbbf24;"></i></h3>
                    <div class="count"><?php echo $rating_counts[$i]; ?></div>
                </div>
                <?php endfor; ?>
            </div>

            <!-- Feedback List -->
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="feedback-card">
                        <div class="feedback-header">
                            <div>
                                <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                                <span class="feedback-meta"> — <?php echo htmlspecialchars($row['email']); ?></span>
                            </div>
                            <div>
                                <div class="rating-stars">
                                    <?php for ($j = 1; $j <= 5; $j++): ?>
                                        <i class="fas fa-star <?php echo $j <= $row['rating'] ? 'filled' : ''; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="feedback-meta"><?php echo date('d M Y, h:i A', strtotime($row['submitted_at'])); ?></span>
                            </div>
                        </div>
                        <?php if (!empty($row['message'])): ?>
                            <div class="feedback-message">
                                "<?php echo nl2br(htmlspecialchars($row['message'])); ?>"
                            </div>
                        <?php else: ?>
                            <div class="feedback-message"><em>No message provided.</em></div>
                        <?php endif; ?>

                        <?php if ($is_admin): ?>
                            <div style="text-align:right; margin-top:1rem;">
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this feedback permanently?');">
                                    <input type="hidden" name="feedback_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete_feedback" class="delete-btn">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align:center; padding:3rem; color:var(--text-light); font-size:1.1rem;">
                    No feedback submitted yet.
                </p>
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