<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - SkillPro Institute</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
   
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', 'Arial', sans-serif;
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
        .career-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)),
                        url('../photo/skill.png');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 180px 20px 100px;
        }
        .career-hero h1 { font-size: 3em; margin-bottom: 10px; }
        .career-hero p { font-size: 1.4em; }

        /* Career Content */
        #career-content {
            padding: 80px 0;
            background-color: #231e0c37;
        }
        .section-title {
            text-align: center;
            font-size: 2.5em;
            color: #e55a00;
            margin-bottom: 50px;
        }

        /* Job Vacancies */
        .jobs-section {
            margin-bottom: 80px;
        }
        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        .job-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s;
        }
        .job-card:hover {
            transform: translateY(-10px);
        }
        .job-title {
            font-size: 1.6em;
            color: #e55a00;
            margin-bottom: 15px;
        }
        .job-meta {
            color: #666;
            margin-bottom: 20px;
            font-size: 0.95em;
        }
        .job-meta span {
            margin-right: 20px;
        }
        .job-desc {
            margin-bottom: 25px;
            color: #555;
        }
        .apply-btn {
            background: #e55a00;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .apply-btn:hover {
            background: #ff6b00;
        }

        /* External Job Links */
        .external-jobs {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .external-jobs h3 {
            font-size: 2em;
            color: #e55a00;
            margin-bottom: 20px;
        }
        .external-jobs p {
            font-size: 1.1em;
            max-width: 800px;
            margin: 0 auto 40px;
            color: #666;
        }
        .job-portal-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }
        .portal-link {
            background: #f9f9f9;
            padding: 20px 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            min-width: 200px;
        }
        .portal-link:hover {
            transform: translateY(-8px);
        }
        .portal-link i {
            font-size: 3em;
            color: #e55a00;
            margin-bottom: 15px;
        }
        .portal-link h4 {
            font-size: 1.3em;
            margin-bottom: 10px;
        }
        .portal-link a {
            color: #e55a00;
            font-weight: bold;
            text-decoration: none;
        }
        .portal-link a:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.41)),
                        url('../photo/footer.png');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0 30px;
            margin-top: 80px;
        }
        footer a { color: #ffffff; text-decoration: none; transition: color 0.3s; }
        footer a:hover { color: #ff6b00; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 50px; }
        .footer-column h3 { font-size: 1.4em; margin-bottom: 20px; position: relative; padding-bottom: 10px; }
        .footer-column h3::after { content: ''; position: absolute; width: 60px; height: 3px; background: #ff6b00; bottom: 0; left: 0; }
        .social-icons a { font-size: 1.8em; margin: 0 10px; transition: transform 0.3s; }
        .social-icons a:hover { transform: translateY(-5px); }
        .footer-bottom { border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 20px; text-align: center; font-size: 0.95em; }

        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; }
            nav ul.active { display: flex; }
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
                    <li><a href="events.php">News & Events</a></li>
                    <li><a href="career.php"class="active">Job Opportunities – Optional</a></li>
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
    <section class="career-hero">
        <div class="container">
            <h1>Career Opportunities</h1>
            <p>Join our team or find your dream job through our industry partnerships and alumni network.</p>
        </div>
    </section>

    <!-- Career Content -->
    <section id="career-content">
        <div class="container">

            <!-- Current Openings at SkillPro -->
            <div class="jobs-section">
                <h2 class="section-title">Current Openings at SkillPro Institute</h2>
                <div class="jobs-grid">
                    <!-- Job 1 -->
                    <div class="job-card">
                        <h3 class="job-title">ICT Instructor (Full-Time)</h3>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> Colombo</span>
                            <span><i class="fas fa-clock"></i> Full Time</span>
                            <span><i class="fas fa-calendar"></i> Posted: Dec 2025</span>
                        </div>
                        <p class="job-desc">We are seeking an experienced ICT instructor with expertise in programming, networking, and cybersecurity to join our Colombo branch.</p>
                        <button class="apply-btn">Apply Now</button>
                    </div>

                    <!-- Job 2 -->
                    <div class="job-card">
                        <h3 class="job-title">Automobile Technology Trainer</h3>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> Kandy</span>
                            <span><i class="fas fa-clock"></i> Part Time</span>
                            <span><i class="fas fa-calendar"></i> Posted: Jan 2026</span>
                        </div>
                        <p class="job-desc">Looking for a qualified trainer with industry experience in vehicle diagnostics and modern automotive systems.</p>
                        <button class="apply-btn">Apply Now</button>
                    </div>

                    <!-- Job 3 -->
                    <div class="job-card">
                        <h3 class="job-title">Administrative Assistant</h3>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> Matara</span>
                            <span><i class="fas fa-clock"></i> Full Time</span>
                            <span><i class="fas fa-calendar"></i> Posted: Jan 2026</span>
                        </div>
                        <p class="job-desc">Support role in student services, admissions, and general administration at our Matara campus.</p>
                        <button class="apply-btn">Apply Now</button>
                    </div>
                </div>
            </div>

            <!-- External Job Portals -->
            <div class="external-jobs">
                <h3>Explore More Job Opportunities</h3>
                <p>Our graduates and partners frequently post vacancies on leading Sri Lankan job portals. Check these sites regularly for the latest opportunities in technical and vocational fields.</p>
                <div class="job-portal-links">
                    <div class="portal-link">
                        <i class="fas fa-briefcase"></i>
                        <h4>TopJobs.lk</h4>
                        <a href="https://www.topjobs.lk" target="_blank">Visit TopJobs →</a>
                    </div>
                    <div class="portal-link">
                        <i class="fas fa-search"></i>
                        <h4>Job.lk</h4>
                        <a href="https://www.job.lk" target="_blank">Visit Job.lk →</a>
                    </div>
                    <div class="portal-link">
                        <i class="fas fa-building"></i>
                        <h4>CareerFirst.lk</h4>
                        <a href="https://www.careerfirst.lk" target="_blank">Visit CareerFirst →</a>
                    </div>
                    <div class="portal-link">
                        <i class="fab fa-linkedin"></i>
                        <h4>LinkedIn Jobs</h4>
                        <a href="https://www.linkedin.com/jobs" target="_blank">Search on LinkedIn →</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>🏫 About SkillPro Institute</h3>
                    <p>SkillPro Institute is a recognized Technical and Vocational Education and Training (TVET) institute registered under the Tertiary and Vocational Education Commission (TVEC) of Sri Lanka...</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <!-- Other columns -->
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 SkillPro Institute. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Hamburger Menu
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>