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

    // Handle Add New Entry
    if (isset($_POST['add_entry']) && $is_staff_or_above) {
        $day = trim($_POST['day']);
        $time_slot = trim($_POST['time_slot']);
        $course = trim($_POST['course']);
        $instructor = trim($_POST['instructor']);
        $location = trim($_POST['location']);

        $stmt = $conn->prepare("INSERT INTO timetable (day, time_slot, course, instructor, location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $day, $time_slot, $course, $instructor, $location);
        if ($stmt->execute()) {
            echo '<div class="success-msg">New timetable entry added successfully!</div>';
        } else {
            echo '<div class="error">Add failed: '.$stmt->error.'</div>';
        }
        $stmt->close();
    }

    // Handle Edit Entry
    if (isset($_POST['edit_entry']) && $is_staff_or_above) {
        $id = (int)$_POST['id'];
        $day = trim($_POST['day']);
        $time_slot = trim($_POST['time_slot']);
        $course = trim($_POST['course']);
        $instructor = trim($_POST['instructor']);
        $location = trim($_POST['location']);

        $stmt = $conn->prepare("UPDATE timetable SET day=?, time_slot=?, course=?, instructor=?, location=? WHERE id=?");
        $stmt->bind_param("sssssi", $day, $time_slot, $course, $instructor, $location, $id);
        if ($stmt->execute()) {
            echo '<div class="success-msg">Timetable entry updated successfully!</div>';
        } else {
            echo '<div class="error">Update failed.</div>';
        }
        $stmt->close();
    }

    // Handle Delete
    if (isset($_POST['delete_entry']) && $is_admin) {
        $id = (int)$_POST['delete_id'];
        $stmt = $conn->prepare("DELETE FROM timetable WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo '<div class="success-msg">Entry deleted successfully!</div>';
        }
        $stmt->close();
    }

    // Fetch all entries
    $filter_day = isset($_GET['day']) && !empty($_GET['day']) ? $_GET['day'] : '';
    $sql = "SELECT * FROM timetable";
    if ($filter_day) {
        $sql .= " WHERE day = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $filter_day);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($sql);
    }

    // Counts
    $total_classes = $conn->query("SELECT COUNT(*) AS c FROM timetable")->fetch_assoc()['c'];
    $unique_days = $conn->query("SELECT COUNT(DISTINCT day) AS c FROM timetable")->fetch_assoc()['c'];
    $unique_courses = $conn->query("SELECT COUNT(DISTINCT course) AS c FROM timetable")->fetch_assoc()['c'];

} catch (Exception $e) {
    echo '<div class="error">Database error: '.$e->getMessage().'</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro - Timetable Management</title>
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

        .filter-bar {
            margin-bottom: 1.5rem; text-align: right;
        }
        .filter-bar select {
            padding: 0.6rem 1rem; border-radius: 8px; border: 2px solid var(--border); font-size: 1rem;
        }

        table {
            width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 1rem;
            background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        th { background: var(--primary); color: white; padding: 1rem; text-align: left; }
        td { padding: 1rem; border-bottom: 1px solid var(--border); }
        tr:hover { background: #f0fdf4; }

        .action-btn { padding: 0.6rem 1rem; border: none; border-radius: 8px; cursor: pointer; margin: 0 0.3rem; transition: 0.3s; }
        .edit-btn { background: var(--accent); color: #1f2937; }
        .edit-btn:hover { background: var(--accent-hover); }
        .delete-btn { background: var(--danger); color: white; }
        .delete-btn:hover { background: #dc2626; }

        .add-btn {
            display: inline-block; padding: 0.8rem 1.5rem; background: var(--primary); color: white;
            border: none; border-radius: 8px; cursor: pointer; font-size: 1rem; margin-bottom: 1.5rem;
        }
        .add-btn:hover { background: var(--primary-dark); }

        .success-msg, .error {
            padding: 1rem; border-radius: 8px; text-align: center; margin: 1rem 0; font-weight: 600;
        }
        .success-msg { background: #d4f4dd; color: var(--success); border: 1px solid var(--success); }
        .error { background: #fee2e2; color: var(--danger); border: 1px solid var(--danger); }

        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);
            justify-content: center; align-items: center; z-index: 1000; }
        .modal-content { background: white; padding: 2.5rem; border-radius: 16px; width: 90%; max-width: 600px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2); border: 3px solid var(--accent); }
        .modal-content h2 { text-align: center; color: var(--primary-dark); margin-bottom: 1.5rem; }

        .form-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;
        }
        @media (max-width: 768px) { .form-grid { grid-template-columns: 1fr; } }

        .modal-content label { display: block; margin: 1rem 0 0.5rem; font-weight: 500; }
        .modal-content input, .modal-content select {
            width: 100%; padding: 0.8rem; border: 2px solid var(--border); border-radius: 8px; font-size: 1rem;
        }
        .modal-content button { padding: 0.8rem 1.5rem; border: none; border-radius: 8px; cursor: pointer; margin-top: 1.5rem; margin-right: 1rem; }
        .save-btn { background: var(--primary); color: white; }
        .save-btn:hover { background: var(--primary-dark); }
        .cancel-btn { background: #6b7280; color: white; }

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
            <a href="timetable.php" class="nav-link active">Timetable</a>
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
            <h1>Timetable Management</h1>

            <!-- Summary Cards -->
            <div class="summary-grid">
                <div class="summary-card">
                    <h3>Total Classes</h3>
                    <div class="count"><?php echo $total_classes; ?></div>
                </div>
                <div class="summary-card">
                    <h3>Active Days</h3>
                    <div class="count"><?php echo $unique_days; ?></div>
                </div>
                <div class="summary-card">
                    <h3>Unique Courses</h3>
                    <div class="count"><?php echo $unique_courses; ?></div>
                </div>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <?php if ($is_staff_or_above): ?>
                    <button class="add-btn" onclick="openAddModal()">+ Add New Entry</button>
                <?php endif; ?>

                <div class="filter-bar">
                    <select onchange="if(this.value) window.location='timetable.php?day='+this.value">
                        <option value="">All Days</option>
                        <option value="Monday" <?php echo $filter_day=='Monday'?'selected':''; ?>>Monday</option>
                        <option value="Tuesday" <?php echo $filter_day=='Tuesday'?'selected':''; ?>>Tuesday</option>
                        <option value="Wednesday" <?php echo $filter_day=='Wednesday'?'selected':''; ?>>Wednesday</option>
                        <option value="Thursday" <?php echo $filter_day=='Thursday'?'selected':''; ?>>Thursday</option>
                        <option value="Friday" <?php echo $filter_day=='Friday'?'selected':''; ?>>Friday</option>
                        <option value="Saturday" <?php echo $filter_day=='Saturday'?'selected':''; ?>>Saturday</option>
                        <option value="Sunday" <?php echo $filter_day=='Sunday'?'selected':''; ?>>Sunday</option>
                    </select>
                </div>
            </div>

            <!-- Timetable Table -->
            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Day</th>
                            <th>Time Slot</th>
                            <th>Course</th>
                            <th>Instructor</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($row['day']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['time_slot']); ?></td>
                                <td><?php echo htmlspecialchars($row['course']); ?></td>
                                <td><?php echo htmlspecialchars($row['instructor']); ?></td>
                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                                <td>
                                    <?php if ($is_staff_or_above): ?>
                                        <button class="action-btn edit-btn" onclick='openEditModal(<?php echo json_encode($row); ?>)'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($is_admin): ?>
                                        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this entry?');">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_entry" class="action-btn delete-btn">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center; padding:2rem; color:var(--text-light);">No timetable entries found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Add New Timetable Entry</h2>
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
                    <input type="text" name="course" required>
                </div>
                <div>
                    <label>Instructor</label>
                    <input type="text" name="instructor" required>
                </div>
                <div>
                    <label>Location</label>
                    <input type="text" name="location" placeholder="e.g., Room A1" required>
                </div>
            </div>
            <div style="text-align:center;">
                <button type="submit" name="add_entry" class="save-btn">Add Entry</button>
                <button type="button" class="cancel-btn" onclick="closeAddModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Edit Timetable Entry</h2>
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
            </div>
            <div style="text-align:center;">
                <button type="submit" name="edit_entry" class="save-btn">Save Changes</button>
                <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').style.display = 'flex';
    }
    function closeAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }

    function openEditModal(entry) {
        document.getElementById('editId').value = entry.id;
        document.getElementById('editDay').value = entry.day;
        document.getElementById('editTimeSlot').value = entry.time_slot;
        document.getElementById('editCourse').value = entry.course;
        document.getElementById('editInstructor').value = entry.instructor;
        document.getElementById('editLocation').value = entry.location;
        document.getElementById('editModal').style.display = 'flex';
    }
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    document.getElementById('logoutBtn').addEventListener('click', () => {
        if (confirm('Are you sure you want to logout?')) {
            location.href = 'logout.php';
        }
    });

    // Close modals when clicking outside
    window.onclick = function(event) {
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        if (event.target == addModal) closeAddModal();
        if (event.target == editModal) closeEditModal();
    }
</script>
</body>
</html>
<?php if (isset($conn)) $conn->close(); ?>