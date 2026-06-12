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

// Handle feedback submission
$feedback_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $rating = (int)$_POST['rating'];
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && $rating >= 1 && $rating <= 5) {
        $stmt = $pdo->prepare("INSERT INTO feedback (name, email, rating, message) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $rating, $message])) {
            $feedback_message = "<div style='background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin:20px 0; text-align:center; font-weight:bold;'>Thank you! Your feedback has been submitted successfully.</div>";
        } else {
            $feedback_message = "<div style='background:#f8d7da; color:#721c24; padding:15px; border-radius:10px; margin:20px 0; text-align:center; font-weight:bold;'>Sorry, something went wrong. Please try again.</div>";
        }
    } else {
        $feedback_message = "<div style='background:#f8d7da; color:#721c24; padding:15px; border-radius:10px; margin:20px 0; text-align:center; font-weight:bold;'>Please fill all required fields correctly.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Events - SkillPro Institute</title>
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
        }

        .contact-bar {
            background: #004d99;
            color: white;
            padding: 12px 0;
            text-align: center;
            font-size: 1.1em;
            z-index: 999;
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

        /* Hero */
        .events-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)),
                        url('../photo/skill.png');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 180px 20px 100px;
        }
        .events-hero h1 { font-size: 3em; margin-bottom: 10px; }
        .events-hero p { font-size: 1.4em; }

        /* Events Content */
        #events-content {
            padding: 80px 0;
            background-color: #231e0c37;
        }
        .section-title {
            text-align: center;
            font-size: 2.5em;
            color: #e55a00;
            margin-bottom: 50px;
        }

        /* Events Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        .event-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s;
        }
        .event-card:hover { transform: translateY(-10px); }
        .event-card img { width: 100%; height: 220px; object-fit: cover; }
        .event-info { padding: 20px; }
        .event-date { font-size: 0.9em; color: #e55a00; font-weight: bold; margin-bottom: 10px; }
        .event-title { font-size: 1.4em; color: #333; margin-bottom: 15px; }
        .event-desc { color: #666; margin-bottom: 15px; }
        .event-link { color: #e55a00; font-weight: bold; text-decoration: none; }
        .event-link:hover { text-decoration: underline; }

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .gallery-item:hover { transform: scale(1.05); }
        .gallery-item img { width: 100%; height: 250px; object-fit: cover; }

        /* Feedback Form */
        .feedback-section {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin: 80px 0;
            position: relative;
            overflow: hidden;
        }
        .feedback-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 6px;
            background: linear-gradient(90deg, #e55a00, #ff6b00);
        }
        .feedback-section h2 {
            text-align: center;
            font-size: 2.5em;
            color: #e55a00;
            margin-bottom: 20px;
        }
        .feedback-section p {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 1.1em;
        }
        .feedback-form {
            max-width: 800px;
            margin: 0 auto;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1em;
            font-family: 'Roboto', sans-serif;
            transition: border 0.3s;
        }
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #e55a00;
        }
        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }
        .rating-stars {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            justify-content: center;
        }
        .rating-stars input {
            display: none;
        }
        .rating-stars label {
            font-size: 2.5em;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }
        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #ff6b00;
        }
        .submit-btn {
            background: #e55a00;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(229, 90, 0, 0.3);
        }
        .submit-btn:hover {
            background: #ff6b00;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; }
            nav ul.active { display: flex; }
            .form-row { grid-template-columns: 1fr; }
            .rating-stars label { font-size: 2em; }
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
                    <li><a href="Studentprofile.php">Student Profile</a></li>
                    <li><a href="Timetable.php">Timetable</a></li>
                    <li><a href="events.php" class="active">News & Events</a></li>
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
            <a href="tel:+94117544801" aria-label="Phone"><i class="fas fa-phone-alt"></i></a>
            <span class="phone-text">INQUIRIES? CALL: +94 11 754 4801</span>
        </div>
    </div>

    <!-- Hero -->
    <section class="events-hero">
        <div class="container">
            <h1>News & Events</h1>
            <p>Stay updated with the latest happenings, workshops, competitions, and celebrations at SkillPro Institute.</p>
        </div>
    </section>

    <!-- Events Content -->
    <section id="events-content">
        <div class="container">

            <!-- Upcoming Events & News -->
            <div class="events-section">
                <h2 class="section-title">Upcoming Events & News</h2>
                <div class="events-grid">
                    <div class="event-card">
                        <img src="../photo/event111.png" alt="SkillFest 2026">
                        <div class="event-info">
                            <div class="event-date">15 February 2026</div>
                            <h3 class="event-title">SkillFest 2026 - Annual Skills Championship</h3>
                            <p class="event-desc">Join us for the biggest vocational skills competition with participants from all branches!</p>
                            <a href="#" class="event-link">Read More →</a>
                        </div>
                    </div>
                    <div class="event-card">
                        <img src="../photo/event2.png" alt="TechExpo">
                        <div class="event-info">
                            <div class="event-date">20 March 2026</div>
                            <h3 class="event-title">TechExpo 2026</h3>
                            <p class="event-desc">Showcase of student projects in ICT, Automobile, and Engineering fields.</p>
                            <a href="#" class="event-link">Read More →</a>
                        </div>
                    </div>
                    <div class="event-card">
                        <img src="../photo/event3.png" alt="Career Week">
                        <div class="event-info">
                            <div class="event-date">10-14 April 2026</div>
                            <h3 class="event-title">Career Development Week</h3>
                            <p class="event-desc">Guest lectures, industry visits, and job fair for final-year students.</p>
                            <a href="#" class="event-link">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photo Gallery -->
            <div class="gallery-section">
                <h2 class="section-title">Photo Gallery</h2>
                <div class="gallery-grid">
                    <div class="gallery-item"><img src="../photo/gallery1.png" alt="SkillFest Winners"></div>
                    <div class="gallery-item"><img src="../photo/gallery2.png" alt="Workshop Session"></div>
                    <div class="gallery-item"><img src="../photo/gallery3.png" alt="Graduation Ceremony"></div>
                    <div class="gallery-item"><img src="../photo/gallery4.png" alt="Student Projects"></div>
                    <div class="gallery-item"><img src="../photo/gallery5.png" alt="Industry Visit"></div>
                    <div class="gallery-item"><img src="../photo/gallery6.png" alt="Cultural Event"></div>
                    <div class="gallery-item"><img src="../photo/gallery7.png" alt="Cultural Event"></div>
                </div>
            </div>

            <!-- Feedback Form -->
            <div class="feedback-section">
                <h2>We Value Your Feedback</h2>
                <p>Help us improve by sharing your thoughts about our institute, events, or website.</p>

                <?php echo $feedback_message; ?>

                <form method="POST" class="feedback-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email *</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Rate Your Experience *</label>
                        <div class="rating-stars">
                            <input type="radio" name="rating" value="5" id="star5" required><label for="star5">★</label>
                            <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
                            <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
                            <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
                            <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message (Optional)</label>
                        <textarea name="message" id="message" placeholder="Tell us what you liked or how we can improve..."></textarea>
                    </div>

                    <button type="submit" name="submit_feedback" class="submit-btn">Submit Feedback</button>
                </form>
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