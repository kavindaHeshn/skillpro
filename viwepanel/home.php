<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
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
            background: #231e0c37;
            color: var(--theme-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
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

        /* Main Dashboard */
        .main-wrapper {
            flex: 1;
            padding-top: 100px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        .app {
            background: var(--theme-bg-color);
            width: 100%;
            max-width: 1300px;
            min-height: calc(100vh - 160px);
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        /* Main Content - Courses Grid */
        .main-content {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 50px;
            transition: all 0.4s ease;
        }
        @media (max-width: 1024px) {
            .main-content { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .main-content { grid-template-columns: 1fr; padding: 30px 20px; gap: 20px; }
        }

        .main-content.expanded {
            grid-template-columns: 1fr;
        }
        .main-content.expanded .card:not(.active) {
            opacity: 0.3;
            pointer-events: none;
            transform: scale(0.9);
        }

        .card {
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            aspect-ratio: 1/1;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            view-transition-name: none;
        }
        .card:nth-child(1) { view-transition-name: c1; }
        .card:nth-child(2) { view-transition-name: c2; }
        .card:nth-child(3) { view-transition-name: c3; }
        .card:nth-child(4) { view-transition-name: c4; }
        .card:nth-child(5) { view-transition-name: c5; }
        .card:nth-child(6) { view-transition-name: c6; }

        .card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(229, 90, 0, 0.4);
        }

        .card.active {
            grid-column: 1 / -1;
            aspect-ratio: 2.2 / 1;
            z-index: 10;
        }

        .card-img {
            width: 100%;
            height: 60%;
            background-size: cover;
            background-position: center;
            transition: transform 0.6s ease;
        }
        .card.active .card-img {
            height: 70%;
        }

        .card-content {
            padding: 20px;
            background: rgba(19, 26, 26, 0.98);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-title {
            font-size: 1.4em;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 12px;
        }
        .card-text {
            font-size: 1em;
            color: #ddd;
            margin-bottom: 20px;
            line-height: 1.6;
            opacity: 0.9;
        }
        .card-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .card-btn {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.95em;
            transition: all 0.3s;
        }
        .card-btn:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
        }
        .go-btn {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }
        .go-btn:hover {
            background: var(--accent-color);
            color: white;
        }

        /* Footer */
        footer {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.17)), url('../photo/footer.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 80px 0 30px;
            margin-top: auto;
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
        .newsletter-form { display: flex; margin-top: 15px; }
        .newsletter-form input { flex: 1; padding: 12px 15px; border: none; border-radius: 4px 0 0 4px; }
        .newsletter-form button { background: #ff6b00; color: white; border: none; padding: 0 20px; border-radius: 0 4px 4px 0; cursor: pointer; font-weight: bold; }
        .newsletter-form button:hover { background: #e55a00; }
        .social-icons a { font-size: 1.8em; margin: 0 10px; transition: transform 0.3s; }
        .social-icons a:hover { transform: translateY(-5px); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px; text-align: center; font-size: 0.95em; }

        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,0,0,0.95); position: absolute; top: 100%; left: 0; width: 100%; padding: 20px; }
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
                    <li><a href="home.php" class="active">Home</a></li>
                    <li><a href="instructors.php">Faculty Page</a></li>
                    <li><a href="Studentprofile.php">Student Profile</a></li>
                    <li><a href="Timetable.php">Timetable</a></li>
                    <li><a href="events.php">News & Events</a></li>
                    <li><a href="career.php">Job Opportunities</a></li>
                </ul>
            </nav>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </header>

    <!-- Main Dashboard -->
    <div class="main-wrapper">
        <div class="app">
            <div class="main-content" id="mainContent">
                <!-- Course Cards -->
                <div class="card">
                    <div class="card-img" style="background-image: url('../photo/INFORMATION.png');"></div>
                    <div class="card-content">
                        <div class="card-title">Information & Communication Technology (ICT)</div>
                        <p class="card-text">Master programming, networking, cybersecurity, web development, software applications, and more.</p>
                        <div class="card-buttons">
                            <a href="course-detail.php?id=ict" class="card-btn go-btn">Go to Page</a>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img" style="background-image: url('../photo/ELECTRICAL.png');"></div>
                    <div class="card-content">
                        <div class="card-title">Electrical & Mechanical</div>
                        <p class="card-text">Hands-on training in electrical systems, machinery maintenance, automation, and mechanical engineering.</p>
                        <div class="card-buttons">
                            <a href="course-detail.php?id=electrical" class="card-btn go-btn">Go to Page</a>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img" style="background-image: url('../photo/WELDING.png');"></div>
                    <div class="card-content">
                        <div class="card-title">Welding & Fabrication</div>
                        <p class="card-text">Professional techniques including MIG, TIG, arc welding, and metal fabrication to industry standards.</p>
                        <div class="card-buttons">
                            <a href="course-detail.php?id=welding" class="card-btn go-btn">Go to Page</a>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img" style="background-image: url('../photo/PLUMBING.png');"></div>
                    <div class="card-content">
                        <div class="card-title">Plumbing & Pipe Fitting</div>
                        <p class="card-text">Complete training in installation, repair, drainage systems, and water supply management.</p>
                        <div class="card-buttons">
                            <a href="course-detail.php?id=plumbing" class="card-btn go-btn">Go to Page</a>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img" style="background-image: url('../photo/HOSPITALITY.png');"></div>
                    <div class="card-content">
                        <div class="card-title">Hospitality & Tourism Management</div>
                        <p class="card-text">Expertise in hotel operations, customer service, event management, and tourism practices.</p>
                        <div class="card-buttons">
                            <a href="course-detail.php?id=hospitality" class="card-btn go-btn">Go to Page</a>
                            <button class="card-btn">Learn More</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img" style="background-image: url('../photo/AUTOMOBILE.png');"></div>
                    <div class="card-content">
                        <div class="card-title">Automobile & Motor Technology</div>
                        <p class="card-text">Vehicle repair, diagnostics, engine systems, and latest automotive technology.</p>
                        <div class="card-buttons">
                            <a href="course-detail.php?id=automobile" class="card-btn go-btn">Go to Page</a>
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
                    <p>SkillPro Institute is a recognized Technical and Vocational Education and Training (TVET) institute registered under the Tertiary and Vocational Education Commission (TVEC) of Sri Lanka...</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <!-- Other footer columns -->
            </div>
            <div class="footer-bottom">
                <p>© 2026 SkillPro Institute. All Rights Reserved.</p>
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

        // Card Expand Animation with View Transitions API
        const cards = document.querySelectorAll('.card');
        const mainContent = document.getElementById('mainContent');

        cards.forEach(card => {
            card.addEventListener('click', (e) => {
                // Prevent navigation if clicking buttons
                if (e.target.closest('.card-btn')) return;

                const isActive = card.classList.contains('active');

                if (!document.startViewTransition) {
                    // Fallback for browsers without View Transitions
                    card.classList.toggle('active');
                    mainContent.classList.toggle('expanded');
                    return;
                }

                document.startViewTransition(() => {
                    if (!isActive) {
                        cards.forEach(c => c.classList.remove('active'));
                        card.classList.add('active');
                        mainContent.classList.add('expanded');
                    } else {
                        card.classList.remove('active');
                        mainContent.classList.remove('expanded');
                    }
                });
            });
        });

        // Optional: Click outside expanded card to close
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.card') && mainContent.classList.contains('expanded')) {
                document.startViewTransition?.(() => {
                    document.querySelector('.card.active')?.classList.remove('active');
                    mainContent.classList.remove('expanded');
                }) || mainContent.classList.remove('expanded');
            }
        });
    </script>
</body>
</html>