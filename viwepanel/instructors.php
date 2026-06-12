<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Instructors - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
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
            transition: color 0.3s;
            text-decoration: none;
        }
        .contact-bar a:hover { color: #0a1113ff; }
        .contact-bar .phone-text { font-weight: bold; }

        /* Hero Section */
        .page-hero {
            background: linear-gradient(rgba(229, 90, 0, 0.9), rgba(229, 90, 0, 0.8)), url('../photo/hero-instructors.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 160px 20px 100px; /* Adjusted for fixed header */
        }
        .page-hero h2 { font-size: 3rem; margin: 0; }
        .page-hero p { font-size: 1.3rem; opacity: 0.95; }

        /* Search Bar */
        .search-section {
            padding: 60px 0 40px;
            background: #231e0c37;
        }
        .search-bar {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        .search-bar input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            font-size: 1.1rem;
            border: 2px solid #eee;
            border-radius: 50px;
            outline: none;
            transition: all 0.3s;
            background: white;
        }
        .search-bar input:focus {
            border-color: #e55a00;
            box-shadow: 0 0 0 4px rgba(229,90,0,0.15);
        }
        .search-bar i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #e55a00;
            font-size: 1.3rem;
        }

        /* Instructors Grid */
        .instructors-grid {
            padding: 20px 0 80px;
            background: #231e0c37;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        .instructor-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            text-align: center;
        }
        .instructor-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .instructor-img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            margin: 30px auto 20px;
            border: 5px solid #e55a00;
        }
        .instructor-card h3 {
            color: #e55a00;
            font-size: 1.5rem;
            margin: 0 0 10px;
        }
        .instructor-card p {
            margin: 8px 20px;
            color: #666;
            line-height: 1.6;
        }
        .expertise {
            font-weight: 500;
            color: #e55a00;
        }

        /* Footer */
        footer {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.41)),
                        url('../photo/footer.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 80px 0 30px;
            margin-top: 80px;
        }
        footer a { color: #ffffff; text-decoration: none; transition: color 0.3s; }
        footer a:hover { color: #ff6b00; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 50px; }
        .footer-column h3 { font-size: 1.4em; margin-bottom: 20px; position: relative; padding-bottom: 10px; }
        .footer-column h3::after { content: ''; position: absolute; width: 60px; height: 3px; background: #ff6b00; bottom: 0; left: 0; }
        .footer-column ul li i { margin-right: 8px; color: #ff6b00; }
        .newsletter-form { display: flex; margin-top: 15px; }
        .newsletter-form input { flex: 1; padding: 12px 15px; border: none; border-radius: 4px 0 0 4px; }
        .newsletter-form button { background: #ff6b00; color: white; border: none; padding: 0 20px; border-radius: 0 4px 4px 0; cursor: pointer; font-weight: bold; }
        .newsletter-form button:hover { background: #e55a00; }
        .social-icons a { font-size: 1.8em; margin: 0 10px; transition: transform 0.3s; }
        .social-icons a:hover { transform: translateY(-5px); }
        .footer-bottom { border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 20px; text-align: center; font-size: 0.95em; }

        /* Responsive */
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
                    <li><a href="instructors.php" class="active">Faculty Page</a></li>
                    <li><a href="Studentprofile.php">Student Profile</a></li>
                    <li><a href="Timetable.php">Timetable</a></li>
                    <li><a href="events.php">News & Events</a></li>
                    <li><a href="career.php">Job Opportunities – Optional</a></li>
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

    <!-- Hero -->
    <section class="page-hero">
        <div class="container">
            <h2>Our Expert Instructors</h2>
            <p>Learn from industry professionals with years of real-world experience</p>
        </div>
    </section>

    <!-- Search -->
    <section class="search-section">
        <div class="container">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by name, department or expertise..." onkeyup="searchInstructors()">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </section>

    <!-- Instructors Grid -->
    <section class="instructors-grid">
        <div class="container">
            <div class="grid" id="instructorsGrid">
                <!-- All your instructor cards here (unchanged) -->
                <div class="instructor-card">
                    <img src="../photo/instructor1.png" alt="Eng. K.A. Perera" class="instructor-img">
                    <h3>Eng. K.A. Perera</h3>
                    <p>BSc. Eng (Hons), MSc in Cybersecurity</p>
                    <p class="expertise">Networking & Cybersecurity Expert</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor2.png" alt="Mr. Kavinda Fernando" class="instructor-img">
                    <h3>Mr. Kavinda Fernando</h3>
                    <p>BSc in Information Technology, Cisco CCNA, CompTIA Security+</p>
                    <p class="expertise">Web Development & Full-Stack Programming</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor3.png" alt="Eng. Nisansala Kumari" class="instructor-img">
                    <h3>Eng. Nisansala Kumari</h3>
                    <p>BSc. Eng (Hons) in Electrical Engineering, MSc in Automation</p>
                    <p class="expertise">Electrical Systems & PLC Programming</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor4.png" alt="Mr. Chamara Silva" class="instructor-img">
                    <h3>Mr. Chamara Silva</h3>
                    <p>NVQ Level 6 in Welding, City & Guilds Advanced Welding</p>
                    <p class="expertise">MIG/TIG Welding & Metal Fabrication</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor5.png" alt="Mr. Ruwan Gunasekara" class="instructor-img">
                    <h3>Mr. Ruwan Gunasekara</h3>
                    <p>Diploma in Automobile Engineering, 15+ Years Experience</p>
                    <p class="expertise">Automobile Diagnostics & Engine Repair</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor6.png" alt="Ms. Thilini Jayasinghe" class="instructor-img">
                    <h3>Ms. Thilini Jayasinghe</h3>
                    <p>BSc in Hospitality Management, IHRA Certified</p>
                    <p class="expertise">Hotel Operations & Customer Service</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor7.png" alt="Eng. Sajith Bandara" class="instructor-img">
                    <h3>Eng. Sajith Bandara</h3>
                    <p>BSc. Eng (Hons) in Mechanical Engineering</p>
                    <p class="expertise">Machinery Maintenance & Thermodynamics</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor8.png" alt="Mr. Lasantha Perera" class="instructor-img">
                    <h3>Mr. Lasantha Perera</h3>
                    <p>NVQ Level 6 in Plumbing, City & Guilds Certified</p>
                    <p class="expertise">Plumbing & Pipe Fitting Specialist</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor9.png" alt="Ms. Anuradha Wickramasinghe" class="instructor-img">
                    <h3>Ms. Anuradha Wickramasinghe</h3>
                    <p>BSc in Computer Science, Microsoft Certified Trainer</p>
                    <p class="expertise">Software Applications & Office Automation</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor10.png" alt="Mr. Dilshan Mendis" class="instructor-img">
                    <h3>Mr. Dilshan Mendis</h3>
                    <p>Diploma in Graphic Design, Adobe Certified Expert</p>
                    <p class="expertise">Graphic Design & Digital Media</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor11.png" alt="Eng. Prasanna Rajapaksha" class="instructor-img">
                    <h3>Eng. Prasanna Rajapaksha</h3>
                    <p>BSc. Eng in Electronics, Embedded Systems Specialist</p>
                    <p class="expertise">IoT & Embedded Systems</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor12.png" alt="Ms. Sanduni Rathnayake" class="instructor-img">
                    <h3>Ms. Sanduni Rathnayake</h3>
                    <p>BSc in Tourism Management, Tour Guide License</p>
                    <p class="expertise">Tourism & Event Management</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor13.png" alt="Mr. Janaka Weerasinghe" class="instructor-img">
                    <h3>Mr. Janaka Weerasinghe</h3>
                    <p>NVQ Level 6 in Refrigeration & Air Conditioning</p>
                    <p class="expertise">HVAC & Refrigeration Systems</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor14.png" alt="Mr. Tharindu Lakmal" class="instructor-img">
                    <h3>Mr. Tharindu Lakmal</h3>
                    <p>BSc in Software Engineering, AWS Certified Developer</p>
                    <p class="expertise">Cloud Computing & DevOps</p>
                </div>

                <div class="instructor-card">
                    <img src="../photo/instructor15.png" alt="Ms. Nadeeka Dissanayake" class="instructor-img">
                    <h3>Ms. Nadeeka Dissanayake</h3>
                    <p>Diploma in Culinary Arts, 10+ Years in Hospitality</p>
                    <p class="expertise">Food Production & Kitchen Management</p>
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

        // Search Function
        function searchInstructors() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.querySelectorAll('.instructor-card');
            cards.forEach(card => {
                let text = card.textContent.toLowerCase();
                card.style.display = text.includes(input) ? 'block' : 'none';
            });
        }
    </script>
</body>
</html>