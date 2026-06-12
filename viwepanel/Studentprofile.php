<?php
session_start();

// Check if student is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

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

// Fetch student details
$stmt = $pdo->prepare("SELECT first_name, last_name, email, phone, created_at FROM users WHERE id = ? AND role = 'student'");
$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Prepare data for display
$full_name = $student['first_name'] . ' ' . $student['last_name'];
$email = $student['email'];
$phone = $student['phone'] ? $student['phone'] : 'Not provided';
$joined_date = date('F Y', strtotime($student['created_at']));
$student_id_display = "SP" . date('Y') . "-" . str_pad($student_id, 3, '0', STR_PAD_LEFT);

// Dummy data (real project එකේ මේවා database එකෙන් fetch කරන්න)
$enrolled_courses = [
    [
        'name' => 'Information & Communication Technology',
        'instructor' => 'Ms. Kumari Silva',
        'progress' => 75
    ],
    [
        'name' => 'Automobile Technology',
        'instructor' => 'Mr. Sunil Fernando',
        'progress' => 45
    ],
    [
        'name' => 'English & Soft Skills',
        'instructor' => 'Mrs. Anoma Jayasinghe',
        'progress' => 90
    ]
];

$achievements = [
    "NVQ Level 3 - Basic IT Skills (Completed)",
    "Certificate in Professional Communication",
    "NVQ Level 4 - ICT (In Progress)"
];

$completed_certificates = 2;
$completed_modules = 3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #231e0c37;
            min-height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        header {
            background:#0f0101ff;
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(187, 16, 16, 0.94);
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-size: 1.8em;
            font-weight: 700;
            text-decoration: none;
        }
        .logo img {
            height: 60px;
            margin-right: 10px;
            border-radius: 8px;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1em;
            padding: 8px 0;
            position: relative;
            transition: color 0.3s ease;
        }
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            background: #bc3f0aff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        nav ul li a:hover::after,
        nav ul li a.active::after {
            width: 100%;
        }
        nav ul li a:hover,
        nav ul li a.active {
            color: #e35909ff;
        }
        .login-btn {
            background: #e35909ff;
            color: white !important;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
        }
        .login-btn:hover { background: #e55a00; }
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }
        .hamburger span {
            width: 25px;
            height: 3px;
            background: white;
            margin: 4px 0;
            transition: 0.3s;
        }

        .contact-bar {
            background: #004d99;
            color: white;
            padding: 12px 0;
            text-align: center;
            font-size: 1.1em;
            z-index: 999;
            margin-top: 80px; /* Fixed header height එකට adjust කරලා */
        }

        .contact-bar .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .contact-bar a { color: white; font-size: 1.6em; transition: color 0.3s; }
        .contact-bar a:hover { color: #0a1113ff; }

        /* Profile Hero */
        .profile-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.5)),
                        url('../photo/skill.png');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 180px 20px 100px;
        }
        .profile-hero h1 { 
            font-size: 3.5em; 
            margin-bottom: 15px; 
            text-shadow: 0 2px 10px rgba(0,0,0,0.7);
        }
        .profile-hero p { 
            font-size: 1.5em; 
            opacity: 0.95;
        }

        /* Profile Content */
        #profile-content {
            padding: 100px 0;
            background-color: #231e0c37;
        }
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 2.5fr;
            gap: 50px;
            align-items: start;
        }

        /* Sidebar */
        .profile-sidebar {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }
        .profile-sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 6px;
            background: linear-gradient(90deg, #e55a00, #ff6b00);
        }
        .profile-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid #e55a00;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(229, 90, 0, 0.3);
        }
        .profile-name {
            font-size: 2.2em;
            color: #e55a00;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .profile-id {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .profile-info h3 {
            font-size: 1.5em;
            color: #e55a00;
            margin: 30px 0 20px;
            position: relative;
            padding-bottom: 10px;
        }
        .profile-info h3::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: #e55a00;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .profile-info ul {
            list-style: none;
            text-align: left;
        }
        .profile-info ul li {
            padding: 12px 0;
            border-bottom: 1px dashed #eee;
            font-size: 1.05em;
        }
        .profile-info ul li:last-child { border-bottom: none; }
        .profile-info ul li strong {
            color: #333;
            width: 120px;
            display: inline-block;
            font-weight: 600;
        }

        /* Main Content */
        .profile-main {
            display: flex;
            flex-direction: column;
            gap: 50px;
        }
        .profile-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
        }
        .profile-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(90deg, #e55a00, #ff6b00);
            border-radius: 20px 20px 0 0;
        }
        .profile-section h2 {
            font-size: 2.2em;
            color: #e55a00;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        .profile-section h2::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background: #ff6b00;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        /* Enrolled Courses */
        .enrolled-courses {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .course-item {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            padding: 25px;
            border-radius: 15px;
            border-left: 6px solid #e55a00;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .course-item:hover {
            transform: translateY(-8px);
        }
        .course-item h4 {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 10px;
        }
        .course-item p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95em;
        }
        .progress-bar {
            background: #eee;
            height: 12px;
            border-radius: 6px;
            overflow: hidden;
            margin: 12px 0;
        }
        .progress {
            height: 100%;
            background: linear-gradient(90deg, #e55a00, #ff6b00);
            border-radius: 6px;
            transition: width 0.8s ease;
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .quick-actions button {
            background: #e55a00;
            color: white;
            padding: 15px 35px;
            border: none;
            border-radius: 50px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(229, 90, 0, 0.3);
        }
        .quick-actions button:hover {
            background: #ff6b00;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(229, 90, 0, 0.4);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .profile-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; padding: 20px; }
            nav ul.active { display: flex; }
            .profile-hero h1 { font-size: 2.8em; }
            .enrolled-courses { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="container nav-container">
            <a href="home.php" class="logo">
                <img src="../photo/logo.jpeg" alt="SkillPro Logo">
                SkillPro Institute
            </a>
            <nav>
                <ul id="navMenu">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="instructors.php">Faculty Page</a></li>
                    <li><a href="Studentprofile.php" class="active">Student Profile</a></li>
                    <li><a href="Timetable.php">Timetable</a></li>
                    <li><a href="events.php">News & Events</a></li>
                    <li><a href="career.php">Job Opportunities</a></li>
                    <li><a href="logout.php" class="login-btn">Logout</a></li>
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
            <a href="tel:+94117544801" aria-label="Phone"><i class="fas fa-phone-alt"></i></a>
            <span class="phone-text">INQUIRIES? CALL: +94 11 754 4801</span>
        </div>
    </div>

    <!-- Profile Hero -->
    <section class="profile-hero">
        <div class="container">
            <h1>Student Dashboard</h1>
            <p>Welcome back, <?php echo htmlspecialchars($full_name); ?>! Track your progress, view courses, and manage your learning journey.</p>
        </div>
    </section>

    <!-- Profile Content -->
    <section id="profile-content">
        <div class="container profile-grid">
            <!-- Sidebar -->
            <aside class="profile-sidebar">
                <img src="../photo/student-avatar.jpg" alt="Student Avatar" class="profile-avatar">
                <h2 class="profile-name"><?php echo htmlspecialchars($full_name); ?></h2>
                <p class="profile-id">Student ID: <?php echo $student_id_display; ?></p>

                <div class="profile-info">
                    <h3>Personal Information</h3>
                    <ul>
                        <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
                        <li><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></li>
                        <li><strong>Branch:</strong> Colombo</li>
                        <li><strong>Joined:</strong> <?php echo $joined_date; ?></li>
                        <li><strong>Status:</strong> Active</li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="profile-main">
                <!-- Enrolled Courses -->
                <div class="profile-section">
                    <h2>My Enrolled Courses</h2>
                    <div class="enrolled-courses">
                        <?php foreach ($enrolled_courses as $course): ?>
                        <div class="course-item">
                            <h4><?php echo htmlspecialchars($course['name']); ?></h4>
                            <p>Instructor: <?php echo htmlspecialchars($course['instructor']); ?></p>
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $course['progress']; ?>%;"></div>
                            </div>
                            <small><?php echo $course['progress']; ?>% Complete</small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Achievements -->
                <div class="profile-section">
                    <h2>Achievements & Certifications</h2>
                    <p>You have completed <?php echo $completed_modules; ?> modules and earned <?php echo $completed_certificates; ?> certificates.</p>
                    <ul style="margin-top:20px; font-size:1.1em;">
                        <?php foreach ($achievements as $achievement): ?>
                        <li style="padding:10px 0;">
                            <?php echo strpos($achievement, 'In Progress') !== false ? '⏳' : '✔'; ?> 
                            <?php echo htmlspecialchars($achievement); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Quick Actions -->
                <div class="profile-section">
                    <h2>Quick Actions</h2>
                    <div class="quick-actions">
                        <a href="Timetable.php"><button>View Timetable</button></a>
                        <a href="certificates.php"><button>Download Certificates</button></a>
                        <a href="edit_profile.php"><button>Edit Profile</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>