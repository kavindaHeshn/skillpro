<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'skillpro';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_role = $_SESSION['role'] ?? 'student';
$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$full_name = $user ? $user['first_name'] . ' ' . $user['last_name'] : 'Student';

// Generate Student ID (SP + current year + padded ID)
$student_id_display = "SP" . date('Y') . "-" . str_pad($user_id, 3, '0', STR_PAD_LEFT);

// Handle staff actions
$message = '';
if ($user_role === 'staff' || $user_role === 'admin') {
    if (isset($_GET['delete'])) {
        $del = $pdo->prepare("DELETE FROM timetable WHERE id = ?");
        $del->execute([$_GET['delete']]);
        $message = "Schedule deleted successfully!";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $day = trim($_POST['day']);
        $time_slot = trim($_POST['time_slot']);
        $course = trim($_POST['course']);
        $instructor = trim($_POST['instructor']);
        $location = trim($_POST['location']);

        if (!empty($day) && !empty($time_slot) && !empty($course)) {
            if ($id) {
                $upd = $pdo->prepare("UPDATE timetable SET day=?, time_slot=?, course=?, instructor=?, location=? WHERE id=?");
                $upd->execute([$day, $time_slot, $course, $instructor, $location, $id]);
                $message = "Schedule updated successfully!";
            } else {
                $ins = $pdo->prepare("INSERT INTO timetable (day, time_slot, course, instructor, location) VALUES (?, ?, ?, ?, ?)");
                $ins->execute([$day, $time_slot, $course, $instructor, $location]);
                $message = "New schedule added successfully!";
            }
        } else {
            $message = "Please fill all required fields.";
        }
    }
}

// Fetch timetable data
$stmt = $pdo->query("
    SELECT * FROM timetable 
    ORDER BY FIELD(day, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'), time_slot
");
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert to FullCalendar events format
$calendar_events = [];
$day_map = [
    'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4,
    'Friday' => 5, 'Saturday' => 6, 'Sunday' => 0
];

foreach ($schedules as $row) {
    $start_time = explode(' - ', $row['time_slot'])[0] ?? '08:00';
    $end_time = explode(' - ', $row['time_slot'])[1] ?? '11:00';

    $calendar_events[] = [
        'title' => $row['course'] . "\n" . $row['instructor'] . " • " . $row['location'],
        'daysOfWeek' => [$day_map[$row['day']]],
        'startTime' => $start_time,
        'endTime' => $end_time,
        'color' => '#e55a00'
    ];
}
$calendar_events_json = json_encode($calendar_events);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
            background: #231e0c37;
            color: #333;
            min-height: 100vh;
        }
        .container { width: 90%; max-width: 1400px; margin: 0 auto; }

        header {
            background:#0f0101ff;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(187, 16, 16, 0.94);
        }
        .nav-container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .logo { display: flex; align-items: center; color: white; font-size: 1.8em; font-weight: 700; text-decoration: none; }
        .logo img { height: 60px; margin-right: 10px; border-radius: 8px; }
        nav ul { list-style: none; display: flex; gap: 25px; flex-wrap: wrap; }
        nav ul li a { color: white; text-decoration: none; font-weight: 500; font-size: 1.1em; padding: 8px 0; position: relative; transition: color 0.3s; }
        nav ul li a::after { content: ''; position: absolute; width: 0; height: 3px; bottom: 0; left: 50%; background: #bc3f0aff; transition: all 0.3s; transform: translateX(-50%); }
        nav ul li a:hover::after, nav ul li a.active::after { width: 100%; }
        nav ul li a:hover, nav ul li a.active { color: #e35909ff; }
        .login-btn { background: #e35909ff; color: white; padding: 10px 20px; border-radius: 50px; font-weight: 600; }
        .hamburger { display: none; flex-direction: column; cursor: pointer; }
        .hamburger span { width: 25px; height: 3px; background: white; margin: 4px 0; }

        .contact-bar {
            background: #004d99;
            color: white;
            padding: 12px 0;
            text-align: center;
            margin-top: 80px;
        }
        .contact-bar .container { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }

        .timetable-hero {
            background: linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.5)), url('../photo/skill.png');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 180px 20px 100px;
        }
        .timetable-hero h1 { font-size: 3.5em; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.7); }
        .timetable-hero p { font-size: 1.5em; opacity: 0.95; }

        #timetable-content { padding: 80px 0; }

        .timetable-header {
            text-align: center;
            margin-bottom: 50px;
            color: white;
        }
        .timetable-header h2 { font-size: 2.8em; margin-bottom: 10px; }
        .timetable-header p { font-size: 1.3em; opacity: 0.9; }

        .timetable-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }
        .calendar-section, .table-section {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .calendar-section h3, .table-section h3 {
            font-size: 2em;
            color: #e55a00;
            text-align: center;
            margin-bottom: 25px;
        }

        #calendar { max-width: 100%; margin: 0 auto; }
        .fc-button-primary { background: #e55a00 !important; border-color: #e55a00 !important; }
        .fc-button-primary:hover { background: #ff6b00 !important; }
        .fc-event { background: #e55a00; border: none; color: white; font-size: 0.9em; white-space: pre-wrap; }

        .timetable-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.05em;
        }
        .timetable-table th {
            background: #e55a00;
            color: white;
            padding: 18px;
            text-align: left;
        }
        .timetable-table td {
            padding: 18px;
            border-bottom: 1px solid #eee;
        }
        .timetable-table tr:hover { background: #f8f9fa; }
        .day { font-weight: bold; color: #e55a00; }
        .time { color: #666; }
        .course { font-weight: 600; }
        .instructor { color: #888; font-size: 0.95em; }
        .location { color: #e55a00; }

        .action-btn {
            padding: 8px 14px;
            margin: 0 5px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
        }
        .edit-btn { background: #ffc107; color: white; }
        .delete-btn { background: #dc3545; color: white; }

        .message {
            padding: 15px;
            border-radius: 10px;
            margin: 30px 0;
            text-align: center;
            font-weight: bold;
            font-size: 1.1em;
        }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }

        @media (max-width: 1024px) {
            .timetable-layout { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; padding: 20px; }
            nav ul.active { display: flex; }
            .timetable-hero h1 { font-size: 2.8em; }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container nav-container">
            <a href="home.php" class="logo">
                <img src="../photo/logo.jpeg" alt="SkillPro Logo">
                SkillPro Institute
            </a>
            <nav>
                <ul id="navMenu">
                    <li><a href="home.php" >Home</a></li>
                    <li><a href="instructors.php">Faculty Page</a></li>
                    <li><a href="Studentprofile.php">Student Profile</a></li>
                    <li><a href="Timetable.php"class="active">Timetable</a></li>
                    <li><a href="events.php">News & Events</a></li>
                    <li><a href="career.php">Job Opportunities</a></li>
                </ul>
            </nav>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </header>

    <!-- Contact Bar -->
    <div class="contact-bar">
        <div class="container">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="tel:+94117544801"><i class="fas fa-phone-alt"></i></a>
            <span>INQUIRIES? CALL: +94 11 754 4801</span>
        </div>
    </div>

    <!-- Hero -->
    <section class="timetable-hero">
        <div class="container">
            <h1>My Timetable</h1>
            <p>View your weekly schedule in calendar or table format</p>
        </div>
    </section>

    <!-- Main Content -->
    <section id="timetable-content">
        <div class="container">

            <div class="timetable-header">
                <h2>Academic Schedule 2026</h2>
                <p>Branch: Colombo | Student: <?php echo htmlspecialchars($full_name); ?> (<?php echo $student_id_display; ?>)</p>
            </div>

            <?php if ($message): ?>
                <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Calendar + Table -->
            <div class="timetable-layout">
                <!-- Calendar View -->
                <div class="calendar-section">
                    <h3>Calendar View</h3>
                    <div id="calendar"></div>
                </div>

                <!-- Table View -->
                <div class="table-section">
                    <h3>Weekly Table View</h3>
                    <table class="timetable-table">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Course</th>
                                <th>Instructor</th>
                                <th>Location</th>
                                <?php if ($user_role === 'staff' || $user_role === 'admin'): ?>
                                    <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($schedules)): ?>
                                <tr><td colspan="6" style="text-align:center; padding:40px;">No classes scheduled yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($schedules as $row): ?>
                                <tr>
                                    <td class="day"><?php echo htmlspecialchars($row['day']); ?></td>
                                    <td class="time"><?php echo htmlspecialchars($row['time_slot']); ?></td>
                                    <td class="course"><?php echo htmlspecialchars($row['course']); ?></td>
                                    <td class="instructor"><?php echo htmlspecialchars($row['instructor']); ?></td>
                                    <td class="location"><?php echo htmlspecialchars($row['location']); ?></td>
                                    <?php if ($user_role === 'staff' || $user_role === 'admin'): ?>
                                        <td>
                                            <button class="action-btn edit-btn" onclick="editSchedule(<?php echo $row['id']; ?>, '<?php echo addslashes($row['day']); ?>', '<?php echo addslashes($row['time_slot']); ?>', '<?php echo addslashes($row['course']); ?>', '<?php echo addslashes($row['instructor']); ?>', '<?php echo addslashes($row['location']); ?>')">Edit</button>
                                            <a href="?delete=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete this class?')">Delete</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Staff Form -->
            <?php if ($user_role === 'staff' || $user_role === 'admin'): ?>
            <div class="table-section" style="margin-top: 40px;">
                <h3 id="form-title">Add New Class Schedule</h3>
                <form method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <input type="hidden" name="id" id="edit-id">
                    <div>
                        <label style="font-weight:600; display:block; margin-bottom:8px;">Day</label>
                        <select name="day" id="day" required style="width:100%; padding:12px; border:2px solid #ddd; border-radius:8px;">
                            <option value="">Select Day</option>
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
                        <label style="font-weight:600; display:block; margin-bottom:8px;">Time Slot</label>
                        <input type="text" name="time_slot" id="time_slot" placeholder="e.g., 08:00 - 11:00" required style="width:100%; padding:12px; border:2px solid #ddd; border-radius:8px;">
                    </div>
                    <div>
                        <label style="font-weight:600; display:block; margin-bottom:8px;">Course</label>
                        <input type="text" name="course" id="course" required style="width:100%; padding:12px; border:2px solid #ddd; border-radius:8px;">
                    </div>
                    <div>
                        <label style="font-weight:600; display:block; margin-bottom:8px;">Instructor</label>
                        <input type="text" name="instructor" id="instructor" required style="width:100%; padding:12px; border:2px solid #ddd; border-radius:8px;">
                    </div>
                    <div>
                        <label style="font-weight:600; display:block; margin-bottom:8px;">Location</label>
                        <input type="text" name="location" id="location" required style="width:100%; padding:12px; border:2px solid #ddd; border-radius:8px;">
                    </div>
                    <div style="grid-column: span 5; text-align:center; margin-top:20px;">
                        <button type="submit" style="background:#e55a00; color:white; padding:15px 40px; border:none; border-radius:50px; font-size:1.1em; cursor:pointer;">Save Schedule</button>
                        <button type="button" onclick="resetForm()" style="background:#666; color:white; padding:15px 30px; border:none; border-radius:50px; margin-left:15px; cursor:pointer;">Cancel</button>
                    </div>
                </form>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        // Hamburger
        document.getElementById('hamburger').addEventListener('click', () => {
            document.getElementById('navMenu').classList.toggle('active');
        });

        // FullCalendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                events: <?php echo $calendar_events_json; ?>,
                height: 'auto',
                eventDisplay: 'block'
            });
            calendar.render();
        });

        // Edit function
        function editSchedule(id, day, time, course, instructor, location) {
            document.getElementById('edit-id').value = id;
            document.getElementById('day').value = day;
            document.getElementById('time_slot').value = time;
            document.getElementById('course').value = course;
            document.getElementById('instructor').value = instructor;
            document.getElementById('location').value = location;
            document.getElementById('form-title').textContent = "Edit Class Schedule";
            window.scrollTo({ top: document.querySelector('.table-section:last-of-type').offsetTop - 100, behavior: 'smooth' });
        }

        function resetForm() {
            document.querySelector('form').reset();
            document.getElementById('edit-id').value = '';
            document.getElementById('form-title').textContent = "Add New Class Schedule";
        }
    </script>
</body>
</html>