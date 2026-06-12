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

    // Handle Add / Edit / Delete
    if ($is_staff_or_above) {
        // Add new slot
        if (isset($_POST['add_slot'])) {
            $day = $_POST['day'];
            $time_slot = trim($_POST['time_slot']);
            $course = trim($_POST['course']);
            $instructor = trim($_POST['instructor']);
            $location = trim($_POST['location']);

            $stmt = $conn->prepare("INSERT INTO timetable (day, time_slot, course, instructor, location) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $day, $time_slot, $course, $instructor, $location);
            if ($stmt->execute()) {
                echo '<div class="success-msg">New timetable slot added successfully!</div>';
            } else {
                echo '<div class="error">Add failed: ' . $stmt->error . '</div>';
            }
            $stmt->close();
        }

        // Edit slot
        if (isset($_POST['edit_slot'])) {
            $id = (int)$_POST['id'];
            $day = $_POST['day'];
            $time_slot = trim($_POST['time_slot']);
            $course = trim($_POST['course']);
            $instructor = trim($_POST['instructor']);
            $location = trim($_POST['location']);

            $stmt = $conn->prepare("UPDATE timetable SET day=?, time_slot=?, course=?, instructor=?, location=? WHERE id=?");
            $stmt->bind_param("sssssi", $day, $time_slot, $course, $instructor, $location, $id);
            if ($stmt->execute()) {
                echo '<div class="success-msg">Timetable slot updated successfully!</div>';
            } else {
                echo '<div class="error">Update failed: ' . $stmt->error . '</div>';
            }
            $stmt->close();
        }

        // Delete slot
        if (isset($_GET['delete']) && $is_admin) {
            $id = (int)$_GET['delete'];
            $stmt = $conn->prepare("DELETE FROM timetable WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo '<div class="success-msg">Timetable slot deleted!</div>';
            }
            $stmt->close();
        }
    }

    // Fetch all slots grouped by day
    $days_order = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $timetable = [];
    $result = $conn->query("SELECT * FROM timetable ORDER BY FIELD(day, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'), time_slot");
    while ($row = $result->fetch_assoc()) {
        $timetable[$row['day']][] = $row;
    }

    // For current day highlight (today is Friday, January 02, 2026)
    $today = 'Friday';

} catch (Exception $e) {
    echo '<div class="error">Database error: ' . $e->getMessage() . '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro - Timetable</title>
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
            --today: #fef3c7;
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

        /* Timetable Grid */
        .timetable-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .day-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            border: 2px solid var(--border);
        }
        .day-card.today { border-color: var(--accent); background: var(--today); }
        .day-header {
            background: var(--primary);
            color: white;
            padding: 1rem;
            text-align: center;
            font-size: 1.3rem;
            font-weight: 600;
        }
        .day-header.today { background: var(--accent); color: #1f2937; }
        .slots-list {
            padding: 1rem;
        }
        .slot {
            background: #f8fafc;
            border-left: 4px solid var(--primary);
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0 8px 8px 0;
            transition: 0.3s;
        }
        .slot:hover { background: #ecfdf5; transform: translateX(5px); }
        .slot-time { font-weight: 600; color: var(--primary-dark); font-size: 1.1rem; }
        .slot-course { font-weight: 600; margin: 0.5rem 0; }
        .slot-info { color: var(--text-light); font-size: 0.95rem; }

        .actions { text-align: center; margin-top: 0.5rem; }
        .action-btn { padding: 0.5rem 1rem; border: none; border-radius: 6px; cursor: pointer; margin: 0 0.3rem; font-size: 0.9rem; transition: 0.3s; }
        .edit-btn { background: var(--accent); color: #1f2937; }
        .edit-btn:hover { background: var(--accent-hover); }
        .delete-btn { background: var(--danger); color: white; }
        .delete-btn:hover { background: #dc2626; }

        /* Add Form */
        .add-form {
            background: #f0fdf4;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 2px dashed var(--primary);
        }
        .add-form h3 { text-align: center; color: var(--primary-dark); margin-bottom: 1rem; }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        .form-grid label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .form-grid input, .form-grid select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--border);
            border-radius: 8px;
        }
        .form-grid button {
            grid-column: span 2;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
        }
        .form-grid button:hover { background: var(--primary-dark); }

        .success-msg, .error { padding: 1rem; border-radius: 8px; text-align: center; margin: 1rem 0; font-weight: 600; }
        .success-msg { background: #d4f4dd; color: var(--success); border: 1px solid var(--success); }
        .error { background: #fee2e2; color: var(--danger); border: 1px solid var(--danger); }

        /* Modal for Edit */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; z-index: 1000; }
        .modal-content { background: white; padding: 2rem; border-radius: 16px; width: 90%; max-width: 600px; box-shadow: 0 20px 50px rgba(0,0,0,0.2); border: 3px solid var(--accent); }
        .modal-content h3 { text-align: center; color: var(--primary-dark); margin-bottom: 1.5rem; }

        @media (max-width: 768px) {
            .flex-container { flex-direction: column; }
            .sidebar { width: 100%; padding: 1rem; }
            .timetable-grid { grid-template-columns: 1fr; }
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
            <a href="timetable.php" class="nav-link active">Timetable</a>
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
            <h1>Course Timetable</h1>
            <p style="text-align:center; color:var(--text-light); margin-bottom:2rem;">
                Today is <strong>Friday, January 02, 2026</strong> – Today's schedule is highlighted in gold.
            </p>

            <?php if ($is_staff_or_above): ?>
            <!-- Add New Slot Form -->
            <div class="add-form">
                <h3>Add New Class Slot</h3>
                <form method="POST">
                    <div class="form-grid">
                        <div>
                            <label>Day</label>
                            <select name="day" required>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                        <div>
                            <label>Time Slot</label>
                            <input type="text" name="time_slot" placeholder="e.g., 08:00 - 11:00" required>
                        </div>
                        <div>
                            <label>Course</label>
                            <input type="text" name="course" placeholder="Course Name" required>
                        </div>
                        <div>
                            <label>Instructor</label>
                            <input type="text" name="instructor" placeholder="Instructor Name" required>
                        </div>
                        <div>
                            <label>Location</label>
                            <input type="text" name="location" placeholder="Room / Lab" required>
                        </div>
                        <div>
                            <button type="submit" name="add_slot">Add Slot</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif; ?>

            <!-- Timetable Display -->
            <div class="timetable-grid">
                <?php foreach ($days_order as $day): ?>
                    <div class="day-card <?php echo $day === $today ? 'today' : ''; ?>">
                        <div class="day-header <?php echo $day === $today ? 'today' : ''; ?>">
                            <?php echo $day; ?>
                            <?php if ($day === $today): ?><i class="fas fa-star" style="margin-left:0.5rem;"></i> Today<?php endif; ?>
                        </div>
                        <div class="slots-list">
                            <?php if (!empty($timetable[$day])): ?>
                                <?php foreach ($timetable[$day] as $slot): ?>
                                    <div class="slot">
                                        <div class="slot-time"><?php echo htmlspecialchars($slot['time_slot']); ?></div>
                                        <div class="slot-course"><?php echo htmlspecialchars($slot['course']); ?></div>
                                        <div class="slot-info">
                                            <strong>Instructor:</strong> <?php echo htmlspecialchars($slot['instructor']); ?><br>
                                            <strong>Location:</strong> <?php echo htmlspecialchars($slot['location']); ?>
                                        </div>
                                        <?php if ($is_staff_or_above): ?>
                                        <div class="actions">
                                            <button class="action-btn edit-btn" onclick='openEditModal(<?php echo json_encode($slot); ?>)'>
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <?php if ($is_admin): ?>
                                            <a href="?delete=<?php echo $slot['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete this slot permanently?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p style="text-align:center; color:var(--text-light); padding:1rem;">No classes scheduled</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Class Slot</h3>
        <form method="POST">
            <input type="hidden" name="id" id="editId">
            <div class="form-grid">
                <div>
                    <label>Day</label>
                    <select name="day" id="editDay" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>
                <div>
                    <label>Time Slot</label>
                    <input type="text" name="time_slot" id="editTimeSlot" required>
                </div>
                <div>
                    <label>Course</label>
                    <input type="text" name="course" id="editCourse" required>
                </div>
                <div>
                    <label>Instructor</label>
                    <input type="text" name="instructor" id="editInstructor" required>
                </div>
                <div>
                    <label>Location</label>
                    <input type="text" name="location" id="editLocation" required>
                </div>
                <div>
                    <button type="submit" name="edit_slot">Save Changes</button>
                    <button type="button" onclick="closeEditModal()" style="background:#6b7280; grid-column:span 1;">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(slot) {
        document.getElementById('editId').value = slot.id;
        document.getElementById('editDay').value = slot.day;
        document.getElementById('editTimeSlot').value = slot.time_slot;
        document.getElementById('editCourse').value = slot.course;
        document.getElementById('editInstructor').value = slot.instructor;
        document.getElementById('editLocation').value = slot.location;
        document.getElementById('editModal').style.display = 'flex';
    }
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
    document.getElementById('logoutBtn').addEventListener('click', () => {
        if (confirm('Are you sure you want to logout?')) location.href = 'logout.php';
    });
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) closeEditModal();
    }
</script>
</body>
</html>
<?php if (isset($conn)) $conn->close(); ?>