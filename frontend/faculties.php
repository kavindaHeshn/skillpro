<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * {
            outline: none;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        :root {
            --theme-bg-color: #ccbebeff;
            --theme-color: #fff;
            --theme-inactive-color: #5c5c5c;
            --body-font: "Poppins", sans-serif;
            --border-color: #a66060ff;
            --accent-color: #e55a00;
            --accent-hover: #ff6b00;
        }
        body {
            font-family: var(--body-font);
            background-color: #231e0c37;
            color: var(--theme-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header & Navigation */
        header {
            background: #131212ff;
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(187, 16, 16, 0.94);
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
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

        /* Main App Area */
        .main-wrapper {
            flex: 1;
            padding-top: 90px; /* Space for fixed header */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-bottom: 50px;
        }
        .app {
            background-color: var(--theme-bg-color);
            width: 100%;
            max-width: 1200px;
            min-height: calc(100vh - 140px);
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        /* Sidebar */
        .sidebar {
            flex-basis: 284px;
            display: flex;
            flex-direction: column;
            height: 100%;
            flex-shrink: 0;
            overflow-y: auto;
            padding: 50px;
        }
        @media (max-width: 480px) {
            .sidebar { display: none; }
        }
        .sidebar-menu {
            display: inline-flex;
            flex-direction: column;
            padding-top: 64px;
        }
        .sidebar-menu__link {
            color: var(--theme-inactive-color);
            text-decoration: none;
            font-size: 20px;
            font-weight: 500;
            transition: 0.3s;
            margin-top: 24px;
        }
        .sidebar-menu__link:hover,
        .sidebar-menu__link.active {
            color: var(--theme-color);
        }
        .user {
            display: flex;
            flex-direction: column;
            padding-bottom: 64px;
            border-bottom: 1px solid var(--border-color);
        }
        .user-photo {
            width: 54px;
            height: 54px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .toggle {
            margin-top: auto;
            width: 56px;
            height: 24px;
            position: relative;
        }
        input[type="checkbox"] { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #4649bd;
            transition: 0.3s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 6px;
            bottom: 4px;
            background-color: #fff;
            transition: 0.4s;
            border-radius: 50%;
        }
        input:checked + .slider { background-color: #489f8c; }
        input:checked + .slider:before { transform: translateX(28px); }

        /* Main Content */
        .main {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 50px 50px 50px 20px;
        }
        @media (max-width: 480px) {
            .main { padding: 40px 20px; }
        }
        .main-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .main-header__title {
            font-size: 28px;
            font-weight: 600;
        }
        .main-header__add {
            background-color: var(--accent-color);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            margin-left: auto;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-header__add:hover { background-color: var(--accent-hover); }
        .main-header-nav {
            display: flex;
            font-size: 15px;
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 30px;
        }
        .nav-item {
            color: var(--theme-inactive-color);
            text-decoration: none;
            padding-bottom: 6px;
            margin-right: 24px;
            border-bottom: 1px solid transparent;
        }
        .nav-item:hover, .nav-item.active {
            color: #fff;
            border-bottom: 1px solid #fff;
        }
        .main-content {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            overflow-y: auto;
        }
        @media (max-width: 480px) {
            .main-content { gap: 10px; }
        }
        .card {
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            aspect-ratio: 1/1;
            display: flex;
            flex-direction: column;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(237, 219, 219, 0.3);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(223, 206, 206, 0.41);
        }
        .card-img {
            width: 100%;
            height: 60%;
            background-size: cover;
            background-position: center;
        }
        .card-content {
            padding: 16px;
            background: rgba(19, 26, 26, 0.95);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .card-title {
            font-size: 1.3em;
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 0.95em;
            color: #ccc;
            flex-grow: 1;
            margin-bottom: 15px;
        }
        .card-btn {
            align-self: center;
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
        }
        .card-btn:hover { background: var(--accent-hover); }
        .card.active {
            grid-column: 1 / -1;
            aspect-ratio: 2/1;
            z-index: 999;
        }
        .main-content.expanded .card:not(.active) {
            opacity: 0.4;
            pointer-events: none;
        }

        /* Footer */
        footer {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.17)),
                        url('../photo/footer.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 80px 0 30px;
        }
        footer a { color: #ffffff; text-decoration: none; transition: color 0.3s; }
        footer a:hover { color: #ff6b00; }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }
        .footer-column h3 {
            font-size: 1.4em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            position: relative;
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
        .footer-column ul li i {
            margin-right: 8px;
            color: #ff6b00;
        }
        .newsletter-form {
            display: flex;
            margin-top: 10px;
        }
        .newsletter-form input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            border-radius: 4px 0 0 4px;
        }
        .newsletter-form button {
            background: #ff6b00;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: bold;
        }
        .newsletter-form button:hover { background: #e55a00; }
        .social-icons a {
            font-size: 1.8em;
            margin: 0 10px;
            transition: transform 0.3s;
        }
        .social-icons a:hover { transform: translateY(-5px); }

        /* Responsive */
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,0,0,0.95); position: absolute; top: 100%; left: 0; width: 100%; padding: 20px; }
            nav ul.active { display: flex; }
        }
        @media (max-width: 480px) {
            .newsletter-form { flex-direction: column; }
            .newsletter-form input, .newsletter-form button { border-radius: 4px; margin-bottom: 10px; }
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
                    <li><a href="about.php">About</a></li>
                    <li><a href="prospective.php">Prospective Students</a></li>
                    <li><a href="faculties.php" class="active">Courses</a></li>
                    <li><a href="international.php">International</a></li>
                    <li><a href="research.php">Research</a></li>
                    <li><a href="studentlife.php">Student life</a></li>
                    <li><a href="professional.php">Professional Programmes</a></li>
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

    <!-- Main Dashboard App -->
    <div class="main-wrapper">
        <div class="app">
            <div class="sidebar">
                <div class="user">
                </div>
                <div class="sidebar-menu">
                    
                </div>
                <label class="toggle">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="main">
                <div class="main-header">
                    <div class="main-header__title">Courses</div>
                    <button class="main-header__add">
                        
                    </button>
                </div>
                <div class="main-content" id="mainContent">
                    <div class="card" style="view-transition-name: c1;">
                        <div class="card-img" style="background-image: url('../photo/INFORMATION.png');"></div>
                        <div class="card-content">
                            <div class="card-title">Information & Communication Technology (ICT)</div>
                            <p class="card-text">Master programming, networking, cybersecurity, web development, software applications, and more.</p>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                    <div class="card" style="view-transition-name: c2;">
                        <div class="card-img" style="background-image: url('../photo/ELECTRICAL.png');"></div>
                        <div class="card-content">
                            <div class="card-title">Electrical & Mechanical</div>
                            <p class="card-text">Hands-on training in electrical systems, machinery maintenance, automation, and mechanical engineering.</p>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                    <div class="card" style="view-transition-name: c3;">
                        <div class="card-img" style="background-image: url('../photo/WELDING.png');"></div>
                        <div class="card-content">
                            <div class="card-title">Welding & Fabrication</div>
                            <p class="card-text">Professional techniques including MIG, TIG, arc welding, and metal fabrication to industry standards.</p>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                    <div class="card" style="view-transition-name: c4;">
                        <div class="card-img" style="background-image: url('../photo/PLUMBING.png');"></div>
                        <div class="card-content">
                            <div class="card-title">Plumbing & Pipe Fitting</div>
                            <p class="card-text">Complete training in installation, repair, drainage systems, and water supply management.</p>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                    <div class="card" style="view-transition-name: c5;">
                        <div class="card-img" style="background-image: url('../photo/HOSPITALITY.png');"></div>
                        <div class="card-content">
                            <div class="card-title">Hospitality & Tourism Management</div>
                            <p class="card-text">Expertise in hotel operations, customer service, event management, and tourism practices.</p>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                    <div class="card" style="view-transition-name: c6;">
                        <div class="card-img" style="background-image: url('../photo/AUTOMOBILE.png');"></div>
                        <div class="card-content">
                            <div class="card-title">Automobile & Motor Technology</div>
                            <p class="card-text">Vehicle repair, diagnostics, engine systems, and latest automotive technology.</p>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
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
        </div>
    </footer>

    <script>
        // Hamburger Menu
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Dashboard Interactions
        const cards = document.querySelectorAll(".card");
        const mainContent = document.getElementById("mainContent");

        cards.forEach((card) => {
            card.addEventListener("click", () => {
                if (document.startViewTransition) {
                    document.startViewTransition(() => {
                        if (!card.classList.contains('active')) {
                            mainContent.classList.add("expanded");
                            card.classList.add("active");
                        } else {
                            card.classList.remove("active");
                            mainContent.classList.remove("expanded");
                        }
                    });
                } else {
                    // Fallback without View Transitions
                    card.classList.toggle("active");
                    mainContent.classList.toggle("expanded");
                }
            });
        });
    </script>
</body>
</html>