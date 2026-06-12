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

// Fetch student name
$stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE id = ? AND role = 'student'");
$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$full_name = $student['first_name'] . ' ' . $student['last_name'];

// Dummy certificates data - Real project එකේ certificates table එකකින් fetch කරන්න
$certificates = [
    [
        'title' => 'NVQ Level 3 - Basic IT Skills',
        'issue_date' => 'December 15, 2025',
        'status' => 'Completed',
        'pdf_link' => 'certificates/nvq3_it.pdf'  // real PDF path එක දාන්න
    ],
    [
        'title' => 'Certificate in Professional Communication',
        'issue_date' => 'November 20, 2025',
        'status' => 'Completed',
        'pdf_link' => 'certificates/professional_communication.pdf'
    ],
    [
        'title' => 'NVQ Level 4 - Information & Communication Technology',
        'issue_date' => '-',
        'status' => 'In Progress',
        'pdf_link' => null
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Certificates - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
            background: #231e0c37;
            color: #333;
            min-height: 100vh;
        }
        .container { width: 90%; max-width: 1000px; margin: 0 auto; }

        header {
            background: #0f0101ff;
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
        .logo img { height: 60px; margin-right: 10px; border-radius: 8px; }
        nav ul {
            list-style: none;
            display: flex;
            gap: 25px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 0;
            position: relative;
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
        nav ul li a:hover::after, nav ul li a.active::after { width: 100%; }
        nav ul li a:hover, nav ul li a.active { color: #e35909ff; }
        .login-btn {
            background: #e35909ff;
            color: white !important;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
        }
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

        .main-content {
            padding: 120px 20px 100px;
        }
        .page-title {
            text-align: center;
            color: white;
            font-size: 3em;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.7);
        }
        .page-subtitle {
            text-align: center;
            color: white;
            font-size: 1.5em;
            margin-bottom: 50px;
            opacity: 0.9;
        }
        .certificates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }
        .certificate-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .certificate-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 6px;
            background: linear-gradient(90deg, #e55a00, #ff6b00);
        }
        .certificate-card:hover {
            transform: translateY(-10px);
        }
        .certificate-icon {
            font-size: 4em;
            color: #e55a00;
            margin-bottom: 20px;
        }
        .certificate-card h3 {
            font-size: 1.4em;
            color: #333;
            margin-bottom: 15px;
        }
        .certificate-card p {
            color: #666;
            margin-bottom: 10px;
        }
        .status {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 0.9em;
        }
        .status.completed {
            background: #d4edda;
            color: #155724;
        }
        .status.progress {
            background: #fff3cd;
            color: #856404;
        }
        .download-btn {
            display: inline-block;
            margin-top: 20px;
            background: #e55a00;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(229, 90, 0, 0.3);
        }
        .download-btn:hover {
            background: #ff6b00;
            transform: translateY(-3px);
        }
        .download-btn.disabled {
            background: #ccc;
            cursor: not-allowed;
            box-shadow: none;
        }
        .download-btn.disabled:hover {
            background: #ccc;
            transform: none;
        }

        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; padding: 20px; }
            nav ul.active { display: flex; }
            .page-title { font-size: 2.5em; }
            .certificates-grid { grid-template-columns: 1fr; }
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
                    <li><a href="home.php">Home</a></li>
                    <li><a href="Studentprofile.php">Student Profile</a></li>
                    <li><a href="Timetable.php">Timetable</a></li>
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
            <a href="tel:+94117544801"><i class="fas fa-phone-alt"></i></a>
            <span>INQUIRIES? CALL: +94 11 754 4801</span>
        </div>
    </div>

    <!-- Main Content -->
    <section class="main-content" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('../photo/skill.png'); background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="page-title">My Certificates</h1>
            <p class="page-subtitle">Download your completed course certificates, <?php echo htmlspecialchars($full_name); ?>!</p>

            <div class="certificates-grid">
                <?php foreach ($certificates as $cert): ?>
                <div class="certificate-card">
                    <div class="certificate-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($cert['title']); ?></h3>
                    <p><strong>Issue Date:</strong> <?php echo $cert['issue_date']; ?></p>
                    <p class="status <?php echo strtolower(str_replace(' ', '', $cert['status'])); ?>">
                        <?php echo $cert['status']; ?>
                    </p>

                    <?php if ($cert['pdf_link'] && $cert['status'] === 'Completed'): ?>
                        <a href="<?php echo $cert['pdf_link']; ?>" class="download-btn" download>
                            <i class="fas fa-download"></i> Download PDF
                        </a>
                    <?php else: ?>
                        <a href="#" class="download-btn disabled" onclick="return false;">
                            <i class="fas fa-lock"></i> Not Available Yet
                        </a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <div style="text-align: center; margin-top: 50px;">
                <a href="Studentprofile.php" style="color: white; font-size: 1.2em; text-decoration: none;">
                    ← Back to Profile
                </a>
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