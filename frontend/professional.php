<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Programmes - SkillPro Institute</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
   
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', 'Arial', sans-serif;
            line-height: 1.6;
            color: #0f0101ff;
            background: #231e0c37;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        /* Header & Navigation */
        header {
            background:#0f0101ff;
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(187, 16, 16, 0.94);
        }
        header.scrolled {
            background: rgba(229, 104, 15, 1);
            padding: 10px 0;
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
            justify-content: center;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1em;
            padding: 8px 0;
            position: relative;
            transition: color 0.3s ease;
            white-space: nowrap;
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
            transition: background 0.3s;
        }
        .login-btn:hover {
            background: #e55a00;
        }
        .login-btn::after { display: none; }
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
        }
        .contact-bar .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .contact-bar a {
            color: white;
            font-size: 1.6em;
            margin: 0 10px;
            transition: color 0.3s;
            text-decoration: none;
        }
        .contact-bar a:hover { color: #0a1113ff; }
        .contact-bar .phone-text { font-weight: bold; }

        /* Hero Section */
        .page-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.26), rgba(0, 0, 0, 0.33)),
                        url('../photo/skill.png');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 160px 20px 100px;
        }
        .page-hero h2 { font-size: 3.2em; margin-bottom: 20px; }

        /* Professional Programmes Content */
        #professional {
            padding: 80px 0;
            background-color: #231e0c37;
        }
        #professional .header {
            background-color: #e55a00;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 40px;
        }
        .intro-text {
            text-align: center;
            max-width: 900px;
            margin: 0 auto 60px;
            font-size: 1.1em;
        }
        .programmes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        .programme-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .programme-card:hover {
            transform: translateY(-10px);
        }
        .programme-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .programme-card .content {
            padding: 25px;
        }
        .programme-card h3 {
            color: #e55a00;
            margin-bottom: 15px;
            font-size: 1.5em;
        }
        .programme-card ul {
            list-style: none;
            margin: 15px 0;
        }
        .programme-card ul li {
            padding: 8px 0;
            position: relative;
            padding-left: 25px;
        }
        .programme-card ul li::before {
            content: "✓";
            color: #e55a00;
            font-weight: bold;
            position: absolute;
            left: 0;
        }
        .enroll-btn {
            display: inline-block;
            background: #e55a00;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
            transition: background 0.3s;
        }
        .enroll-btn:hover {
            background: #d27913;
        }

        /* Benefits Section */
        .benefits {
            background: white;
            padding: 60px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .benefits h2 {
            color: #e55a00;
            margin-bottom: 30px;
            font-size: 2.2em;
        }
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        .benefit-item i {
            font-size: 3em;
            color: #e55a00;
            margin-bottom: 20px;
        }
        .benefit-item h3 {
            margin-bottom: 15px;
        }

        /* Footer Styles - Updated with better background */
        footer {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.3)),
                        url('../photo/footer.png'); /* Replace with your actual footer background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 80px 0 30px;
            margin-top: 80px;
            position: relative;
        }
        footer a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
        }
        footer a:hover {
            color: #ff6b00;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }
        .footer-column h3 {
            font-size: 1.4em;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer-column h3::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: #ff6b00;
            bottom: 0;
            left: 0;
        }
        .footer-column ul {
            list-style: none;
        }
        .footer-column ul li {
            margin-bottom: 10px;
        }
        .footer-column ul li i {
            margin-right: 8px;
            color: #ff6b00;
        }
        .newsletter-form {
            display: flex;
            margin-top: 15px;
        }
        .newsletter-form input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 1em;
        }
        .newsletter-form button {
            background: #ff6b00;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        .newsletter-form button:hover {
            background: #e55a00;
        }
        .social-icons {
            margin-top: 20px;
        }
        .social-icons a {
            font-size: 1.8em;
            margin: 0 10px;
            transition: transform 0.3s;
        }
        .social-icons a:hover {
            transform: translateY(-5px);
        }
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
            text-align: center;
            font-size: 0.95em;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; }
            nav ul.active { display: flex; }
        }
        @media (max-width: 480px) {
            .newsletter-form { flex-direction: column; }
            .newsletter-form input { border-radius: 4px; margin-bottom: 10px; }
            .newsletter-form button { border-radius: 4px; }
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
                   <li><a href="home.php" >Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="prospective.php">Prospective Students</a></li>
                    <li><a href="faculties.php">Courses</a></li>
                    <li><a href="international.php">International</a></li>
                    <li><a href="research.php">Research</a></li>
                    <li><a href="studentlife.php">Student life</a></li>
                    <li><a href="professional.php"class="active">Professional Programmes</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="login.php" class="login-btn">Login</a></li>
                </ul>
            </nav>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
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

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="container">
            <h2>Professional Programmes</h2>
        </div>
    </section>

    <!-- Professional Programmes Content -->
    <section id="professional">
        <div class="container">
            <div class="header">
                <h1>Advance Your Career with Professional Programmes</h1>
            </div>
            
            <p class="intro-text">
                SkillPro Institute offers specialized professional development programmes designed for working professionals, 
                supervisors, managers, and entrepreneurs who wish to upgrade their skills, earn industry-recognized certifications, 
                and accelerate career growth. These short-term, intensive courses focus on practical application and immediate workplace impact.
            </p>

            <div class="programmes-grid">
                <!-- Programme 1 -->
                <div class="programme-card">
                    <img src="../photo/professional1.png" alt="Supervisory Management">
                    <div class="content">
                        <h3>Certificate in Supervisory Management</h3>
                        <p>Ideal for team leaders and new supervisors. Covers leadership, team management, communication, and performance evaluation.</p>
                        <ul>
                            <li>Duration: 3 Months (Weekends)</li>
                            <li>NVQ Level 5 Equivalent</li>
                            <li>Practical case studies & projects</li>
                        </ul>
                        <a href="#enroll" class="enroll-btn">Enroll Now</a>
                    </div>
                </div>

                <!-- Programme 2 -->
                <div class="programme-card">
                    <img src="../photo/professional2.png" alt="Project Management">
                    <div class="content">
                        <h3>Professional Certificate in Project Management</h3>
                        <p>Master modern project planning, execution, risk management, and agile methodologies used in industry.</p>
                        <ul>
                            <li>Duration: 4 Months</li>
                            <li>Includes PM tools training</li>
                            <li>Capstone project included</li>
                        </ul>
                        <a href="#enroll" class="enroll-btn">Enroll Now</a>
                    </div>
                </div>

                <!-- Programme 3 -->
                <div class="programme-card">
                    <img src="../photo/professional3.png" alt="Digital Marketing">
                    <div class="content">
                        <h3>Advanced Digital Marketing & E-Commerce</h3>
                        <p>Learn SEO, social media marketing, Google Ads, analytics, and online sales strategies.</p>
                        <ul>
                            <li>Duration: 3 Months</li>
                            <li>Live campaign management</li>
                            <li>Google & Facebook certifications</li>
                        </ul>
                        <a href="#enroll" class="enroll-btn">Enroll Now</a>
                    </div>
                </div>

                <!-- Programme 4 -->
                <div class="programme-card">
                    <img src="../photo/professional4.png" alt="HR Management">
                    <div class="content">
                        <h3>Professional Diploma in Human Resource Management</h3>
                        <p>For HR professionals and managers. Covers recruitment, training, labour laws, and performance systems.</p>
                        <ul>
                            <li>Duration: 6 Months (Part-time)</li>
                            <li>Aligned with CIPM standards</li>
                            <li>Industry guest lectures</li>
                        </ul>
                        <a href="#enroll" class="enroll-btn">Enroll Now</a>
                    </div>
                </div>

                <!-- Programme 5 -->
                <div class="programme-card">
                    <img src="../photo/professional5.png" alt="Entrepreneurship">
                    <div class="content">
                        <h3>Entrepreneurship & Small Business Management</h3>
                        <p>Start or grow your own business with training in business planning, finance, marketing, and operations.</p>
                        <ul>
                            <li>Duration: 4 Months</li>
                            <li>Business plan development</li>
                            <li>Mentorship from entrepreneurs</li>
                        </ul>
                        <a href="#enroll" class="enroll-btn">Enroll Now</a>
                    </div>
                </div>

                <!-- Programme 6 -->
                <div class="programme-card">
                    <img src="../photo/professional6.png" alt="Advanced ICT">
                    <div class="content">
                        <h3>Advanced ICT for Professionals</h3>
                        <p>Specialized modules in Cloud Computing, Cybersecurity Awareness, Data Analytics, and AI basics.</p>
                        <ul>
                            <li>Duration: 3-6 Months (Modular)</li>
                            <li>International certifications</li>
                            <li>Hands-on lab sessions</li>
                        </ul>
                        <a href="#enroll" class="enroll-btn">Enroll Now</a>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="benefits">
                <h2>Why Choose Our Professional Programmes?</h2>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <i class="fas fa-clock"></i>
                        <h3>Flexible Scheduling</h3>
                        <p>Evening & weekend classes designed for working professionals</p>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-certificate"></i>
                        <h3>Recognized Certifications</h3>
                        <p>NVQ-aligned and industry-recognized qualifications</p>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-users"></i>
                        <h3>Expert Faculty</h3>
                        <p>Trainers with real-world industry experience</p>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-briefcase"></i>
                        <h3>Career Advancement</h3>
                        <p>Immediate application in workplace & better job opportunities</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <!-- About -->
                <div class="footer-column">
                    <h3>🏫 About SkillPro Institute</h3>
                    <p>SkillPro Institute is a recognized Technical and Vocational Education and Training (TVET) institute registered under the Tertiary and Vocational Education Commission (TVEC) of Sri Lanka. We are committed to delivering industry-oriented training programs that empower individuals with practical skills, professional competence, and career readiness.</p>
                    <p>Our training programs are designed in alignment with national vocational standards and industry requirements, ensuring high employability and career progression opportunities for our students. SkillPro Institute offers both online and on-site learning modes through its branches in Colombo, Kandy, and Matara.</p>
                    
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Programmes -->
                <div class="footer-column">
                    <h3>📚 Programmes</h3>
                    <ul>
                        <li><i class="fas fa-chevron-right"></i> Information & Communication Technology (ICT)</li>
                        <li><i class="fas fa-chevron-right"></i> Plumbing & Pipe Fitting</li>
                        <li><i class="fas fa-chevron-right"></i> Welding & Fabrication Technology</li>
                        <li><i class="fas fa-chevron-right"></i> Electrical Installation</li>
                        <li><i class="fas fa-chevron-right"></i> Hotel & Hospitality Management</li>
                        <li><i class="fas fa-chevron-right"></i> Automobile Technology</li>
                        <li><i class="fas fa-chevron-right"></i> Business & Office Management</li>
                        <li><i class="fas fa-chevron-right"></i> Soft Skills & Professional Development</li>
                    </ul>
                </div>

                <!-- Facilities & Events -->
                <div class="footer-column">
                    <h3>🏢 Facilities</h3>
                    <ul>
                        <li><i class="fas fa-chevron-right"></i> Modern Training Labs & Workshops</li>
                        <li><i class="fas fa-chevron-right"></i> Online Learning Platform</li>
                        <li><i class="fas fa-chevron-right"></i> Qualified & Industry-Experienced Instructors</li>
                        <li><i class="fas fa-chevron-right"></i> Student Support & Career Guidance</li>
                        <li><i class="fas fa-chevron-right"></i> Certification Assistance (TVEC / NVQ)</li>
                    </ul>

                    <h3 style="margin-top: 30px;">📅 Main Events</h3>
                    <ul>
                        <li><i class="fas fa-star"></i> SkillFest</li>
                        <li><i class="fas fa-star"></i> TechExpo</li>
                        <li><i class="fas fa-star"></i> Trade Skills Championship</li>
                        <li><i class="fas fa-star"></i> Career Development Week</li>
                    </ul>
                </div>

                <!-- Student Life & Quick Links & Newsletter -->
                <div class="footer-column">
                    <h3>🎓 Student Life</h3>
                    <ul>
                        <li><i class="fas fa-chevron-right"></i> Career Guidance & Counseling</li>
                        <li><i class="fas fa-chevron-right"></i> Clubs & Skill Societies</li>
                        <li><i class="fas fa-chevron-right"></i> Student Workshops & Competitions</li>
                        <li><i class="fas fa-chevron-right"></i> Student Accommodation Support</li>
                        <li><i class="fas fa-chevron-right"></i> Sports & Recreational Activities</li>
                    </ul>

                    <h3 style="margin-top: 30px;">🔗 Quick Links</h3>
                    <ul>
                        <li><a href="#"><i class="fas fa-link"></i> Guidelines for Visitors</a></li>
                        <li><a href="#"><i class="fas fa-link"></i> Instructor Login</a></li>
                        <li><a href="#"><i class="fas fa-link"></i> Student Login</a></li>
                        <li><a href="#"><i class="fas fa-link"></i> Careers at SkillPro</a></li>
                        <li><a href="#"><i class="fas fa-link"></i> Virtual Tour</a></li>
                        <li><a href="#"><i class="fas fa-link"></i> Sitemap</a></li>
                    </ul>

                    <h3 style="margin-top: 30px;">📩 Subscribe Our Newsletter</h3>
                    <p>Stay updated with upcoming courses, new batches, workshops, and events.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Enter Your Email" required>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 SkillPro Institute. All Rights Reserved.</p>
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