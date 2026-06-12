<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro Institute</title>
   
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
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.26), rgba(0, 0, 0, 0.33)),
                        url('../photo/skill.png');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 160px 20px 100px;
        }
        .hero h2 { font-size: 3.2em; margin-bottom: 20px; }
        .hero p { font-size: 1.4em; margin-bottom: 40px; max-width: 800px; margin-left: auto; margin-right: auto; }

        /* Welcome Section */
        #welcome {
            padding: 80px 0;
            background-color: #231e0c37;
        }
        #welcome .header {
            background-color: #e55a00;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        #welcome .main-content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        #welcome .image-section {
            flex: 1 1 350px;
        }
        #welcome .image-section img {
            width: 100%;
            border-radius: 8px;
        }
        #welcome .text-section {
            flex: 1 1 400px;
        }
        #welcome .quote {
            background-color: #f0bc41ff;
            color: white;
            padding: 30px;
            margin-top: 30px;
            border-radius: 8px;
            position: relative;
        }
        #welcome .quote::before {
            content: "“";
            font-size: 80px;
            opacity: 0.3;
            position: absolute;
            top: 10px;
            left: 20px;
        }
        #welcome .glance {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 60px;
        }
        #welcome .glance-item {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            flex: 1 1 180px;
            min-width: 180px;
        }
        #welcome .glance-number {
            font-size: 3em;
            font-weight: bold;
            color: rgb(19, 210, 48);
        }

        /* Courses Section */
        #faculties {
            padding: 80px 0;
            background-color: #231e0c37;
        }
        #faculties h2 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 50px;
            color: #161515ff;
        }
        .carousel-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }
        .carousel {
            display: flex;
            transition: transform 0.5s ease;
        }
        .slide {
            min-width: 20%;
            box-sizing: border-box;
            padding: 10px;
        }
        .card {
            background-color: #ffffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }
        .card-title {
            font-size: 17px;
            font-weight: bold;
            color: white;
            padding: 12px;
            margin: 0;
        }
        /* Unique colors */
        .slide:nth-child(1) .card-title { background-color: #1e88e5; }
        .slide:nth-child(2) .card-title { background-color: #fb8c00; }
        .slide:nth-child(3) .card-title { background-color: #e53935; }
        .slide:nth-child(4) .card-title { background-color: #43a047; }
        .slide:nth-child(5) .card-title { background-color: #f9a825; }
        .slide:nth-child(6) .card-title { background-color: #7b1fa2; }
        .slide:nth-child(7) .card-title { background-color: #00897b; }
        .slide:nth-child(8) .card-title { background-color: #d81b60; }
        .slide:nth-child(9) .card-title { background-color: #3949ab; }
        .slide:nth-child(10) .card-title { background-color: #6d4c41; }
        .card-content {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card p {
            font-size: 14px;
            color: #0b8434ff;
            flex-grow: 1;
            margin-bottom: 15px;
        }
        .more-btn {
            background-color: #d35907ff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 auto 10px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .more-btn:hover {
            background-color: #0033663b;
        }
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0,0,0,0.6);
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
            font-size: 28px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }
        .prev { left: 10px; }
        .next { right: 10px; }

        /* Footer Styles */
        footer {
            background: linear-gradient(rgba(0, 77, 153, 0.01), rgba(19, 20, 21, 0.73)),
                        url('../photo/footer.png');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0 30px;
            margin-top: 80px;
        }
        footer a {
            color: #0d0f0fff;
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
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.14);
            padding-top: 20px;
            text-align: center;
            font-size: 0.95em;
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

        /* Responsive */
        @media (max-width: 1024px) { .slide { min-width: 33.33%; } }
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; }
            nav ul.active { display: flex; }
            .slide { min-width: 50%; }
        }
        @media (max-width: 480px) {
            .slide { min-width: 100%; }
            .hero h2 { font-size: 2.5em; }
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
            <a href="#home" class="logo">
                <img src="../photo/logo.png" alt="SkillPro Logo">
                SkillPro Institute
            </a>
            <nav>
                <ul id="navMenu">
                    <li><a href="home.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="prospective.php">Prospective Students</a></li>
                    <li><a href="faculties.php">Courses</a></li>
                    <li><a href="international.php">International</a></li>
                    <li><a href="research.php">Research</a></li>
                    <li><a href="studentlife.php">Student life</a></li>
                    <li><a href="professional.php">Professional Programmes</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="signup.php" class="login-btn">Login</a></li>
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
    <section id="home" class="hero">
        <div class="container">
            <h2>Welcome to SkillPro Institute</h2>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>

           
        </div>
    </section>

    <!-- Welcome / About Section -->
    <section id="welcome">
        <div class="container">
            <div class="header">
                <h1>Welcome to SkillPro Institute</h1>
            </div>
            
            <div class="main-content">
                <div class="image-section">
                    <img src="../photo/image.png" alt="Professional person">
                    
                    <div class="quote">
                        <p>"The skills I gained at SkillPro encouraged me to become a successful professional."</p>
                        <p><strong>- Your Name, Qualification / Position</strong></p>
                    </div>
                </div>
                
                <div class="text-section">
                    <p>SkillPro Institute is a leading Technical and Vocational Education and Training (TVET) 
                        institute in Sri Lanka, committed to empowering youth and professionals with industry-relevant,
                         job-oriented skills. Registered under the Tertiary and Vocational Education Commission (TVEC) 
                         of Sri Lanka, SkillPro Institute plays a vital role in supporting national workforce development
                          and sustainable economic growth.</p>
                    
                    <p>Since its establishment, SkillPro Institute has focused on delivering high-quality vocational education
                         in areas such as Information Technology, Engineering Trades, Hospitality, and Technical Skills. Our 
                         programs are designed to bridge the gap between education and employment by combining theoretical 
                         knowledge with hands-on practical training.</p>
                    
                    <p>At SkillPro Institute, we promote a culture of skill excellence and lifelong learning. Our 
                        experienced instructors, modern training facilities, and industry-aligned curricula ensure that 
                        students gain the competencies required to succeed in today’s competitive job market.</p>
                    
                    <p>With three fully equipped branches located in Colombo, Kandy, and Matara, 
                        SkillPro Institute provides accessible and flexible learning opportunities through 
                        online and on-site training modes. We are dedicated to nurturing skilled professionals who 
                        can contribute effectively to Sri Lanka’s socio-economic development.</p>
                </div>
            </div>
            
            <h2 style="text-align: center; margin-top: 60px;">📊 SkillPro at a Glance</h2>
            <div class="glance">
                <div class="glance-item">
                    <div class="glance-number">10+</div>
                    <p>Years<br>Of Vocational Training Excellence</p>
                </div>
                <div class="glance-item">
                    <div class="glance-number">60+</div>
                    <p>Qualified Instructors & Trainers</p>
                </div>
                <div class="glance-item">
                    <div class="glance-number">120+</div>
                    <p>Years<br>Of Combined Industry Experience</p>
                </div>
                <div class="glance-item">
                    <div class="glance-number">8,000+</div>
                    <p>Successful Graduates Nationwide</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Carousel Section -->
    <section id="faculties">
        <div class="container">
            <h2>Our Courses</h2>
           
            <div class="carousel-container">
                <button class="prev">&lt;</button>
                <div class="carousel">
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/INFORMATION.png" alt="ICT Courses">
                            <div class="card-title">INFORMATION & COMMUNICATION TECHNOLOGY (ICT) COURSES</div>
                            <div class="card-content">
                                <p>Master modern IT skills including programming, networking, cybersecurity, web development and software applications.</p>
                               <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/ELECTRICAL.png" alt="Electrical & Mechanical">
                            <div class="card-title">ELECTRICAL & MECHANICAL</div>
                            <div class="card-content">
                                <p>Hands-on training in electrical systems, machinery maintenance, automation and mechanical engineering principles.</p>
                               <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/WELDING1.png" alt="Welding">
                            <div class="card-title">WELDING</div>
                            <div class="card-content">
                                <p>Professional welding techniques including MIG, TIG, arc welding and fabrication for industry standards.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/PLUMBING.png" alt="Plumbing">
                            <div class="card-title">PLUMBING</div>
                            <div class="card-content">
                                <p>Comprehensive plumbing skills from installation to repair, drainage systems and water supply management.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/HOSPITALITY.png" alt="Hospitality & Tourism">
                            <div class="card-title">HOSPITALITY & TOURISM MANAGEMENT</div>
                            <div class="card-content">
                                <p>Develop expertise in hotel operations, customer service, event management and tourism industry practices.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/CONSTRUCTION.png" alt="Construction">
                            <div class="card-title">CONSTRUCTION & BUILDING TECHNOLOGY</div>
                            <div class="card-content">
                                <p>Learn modern construction methods, building materials, project management and safety standards.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/AUTOMOBILE.png" alt="Automobile">
                            <div class="card-title">AUTOMOBILE & MOTOR TECHNOLOGY</div>
                            <div class="card-content">
                                <p>Expert training in vehicle repair, diagnostics, engine systems and modern automotive technology.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/BEAUTY.png" alt="Beauty & Wellness">
                            <div class="card-title">BEAUTY, WELLNESS & PERSONAL CARE</div>
                            <div class="card-content">
                                <p>Professional courses in cosmetology, spa therapy, makeup artistry and salon management.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/BUSINESS.png" alt="Business & Management">
                            <div class="card-title">BUSINESS & MANAGEMENT STUDIES</div>
                            <div class="card-content">
                                <p>Gain skills in entrepreneurship, accounting, marketing, HR and business administration.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="card">
                            <img src="../photo/LANGUAGE.png" alt="Language & Soft Skills">
                            <div class="card-title">LANGUAGE & SOFT SKILLS DEVELOPMENT</div>
                            <div class="card-content">
                                <p>Improve English proficiency, communication, leadership, teamwork and presentation skills.</p>
                                <a href="login.php" class="more-btn">MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="next">&gt;</button>
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

            
        </div>
    </footer>

    <script>
        // Hamburger Menu
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Carousel
        const carousel = document.querySelector('.carousel');
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        let currentIndex = 0;

        function updateCarousel() {
            const containerWidth = document.querySelector('.carousel-container').offsetWidth;
            const slideWidth = slides[0].getBoundingClientRect().width + 20;
            const visibleSlides = Math.round(containerWidth / slideWidth);
            const maxIndex = Math.max(0, slides.length - visibleSlides);
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            if (currentIndex < 0) currentIndex = 0;
            carousel.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }

        nextBtn.addEventListener('click', () => {
            const containerWidth = document.querySelector('.carousel-container').offsetWidth;
            const slideWidth = slides[0].getBoundingClientRect().width + 20;
            const visibleSlides = Math.round(containerWidth / slideWidth);
            if (currentIndex < slides.length - visibleSlides) {
                currentIndex++;
                updateCarousel();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        window.addEventListener('resize', updateCarousel);
        updateCarousel();
    </script>
</body>
</html>