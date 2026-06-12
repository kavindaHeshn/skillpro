<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
            background: #231e0c37;
            color: #333;
        }
        .container { width: 90%; max-width: 1200px; margin: 0 auto; }

        header { background:#0f0101ff; position: fixed; top: 0; width: 100%; z-index: 1000; padding: 15px 0; box-shadow: 0 2px 10px rgba(187,16,16,0.94); }
        .nav-container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .logo { display: flex; align-items: center; color: white; font-size: 1.8em; font-weight: 700; text-decoration: none; }
        .logo img { height: 60px; margin-right: 10px; border-radius: 8px; }
        nav ul { list-style: none; display: flex; gap: 25px; }
        nav ul li a { color: white; text-decoration: none; font-weight: 500; font-size: 1.1em; position: relative; }
        nav ul li a::after { content: ''; position: absolute; width: 0; height: 3px; bottom: 0; left: 50%; background: #bc3f0aff; transition: all 0.3s; transform: translateX(-50%); }
        nav ul li a:hover::after, nav ul li a.active::after { width: 100%; }
        nav ul li a:hover, nav ul li a.active { color: #e35909ff; }
        .hamburger { display: none; flex-direction: column; cursor: pointer; }
        .hamburger span { width: 25px; height: 3px; background: white; margin: 4px 0; }

        .contact-bar { background: #004d99; color: white; padding: 12px 0; text-align: center; }
        .contact-bar .container { display: flex; justify-content: center; align-items: center; gap: 20px; flex-wrap: wrap; }

        .course-hero {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4)), url('../photo/skill.png');
            background-size: cover; background-position: center;
            color: white; text-align: center; padding: 180px 20px 100px;
        }
        .course-content { padding: 80px 0; }
        .course-detail {
            background: white; border-radius: 12px; padding: 40px; box-shadow: 0 6px 20px rgba(0,0,0,0.15); margin-bottom: 50px;
            display: flex; gap: 40px; flex-wrap: wrap; align-items: center;
        }
        .course-img { flex: 1; min-width: 300px; }
        .course-img img { width: 100%; border-radius: 12px; }
        .course-info { flex: 2; min-width: 300px; }
        .course-info h1 { font-size: 2.8em; color: #e55a00; margin-bottom: 20px; }
        .course-info p { font-size: 1.1em; margin-bottom: 20px; line-height: 1.8; }
        .course-features { list-style: none; }
        .course-features li { padding: 10px 0; font-size: 1.1em; }
        .course-features li i { color: #e55a00; margin-right: 10px; }

        /* Application Form */
        .application-form {
            background: white; border-radius: 12px; padding: 40px; box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .application-form h2 { font-size: 2.2em; color: #e55a00; text-align: center; margin-bottom: 30px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1em;
        }
        .apply-btn {
            background: #e55a00; color: white; padding: 15px 40px; border: none; border-radius: 50px;
            font-size: 1.2em; font-weight: bold; cursor: pointer; display: block; margin: 30px auto 0;
        }
        .apply-btn:hover { background: #ff6b00; }

        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav ul { display: none; flex-direction: column; background: rgba(0,77,153,0.95); position: absolute; top: 100%; left: 0; width: 100%; }
            nav ul.active { display: flex; }
            .course-detail { flex-direction: column; }
        }
    </style>
</head>
<body>

    <!-- Header (same as your other pages) -->
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
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="tel:+94117544801"><i class="fas fa-phone-alt"></i></a>
            <span class="phone-text">INQUIRIES? CALL: +94 11 754 4801</span>
        </div>
    </div>

    <!-- Hero -->
    <section class="course-hero">
        <div class="container">
            <h1 id="course-title">Course Details</h1>
            <p>Explore in-depth information about this program and apply today.</p>
        </div>
    </section>

    <!-- Course Content -->
    <section class="course-content">
        <div class="container">

            <?php
            // Get course ID from URL
            $course_id = isset($_GET['id']) ? $_GET['id'] : 'ict';

            // Course data array
            $courses = [
                'ict' => [
                    'title' => 'Information & Communication Technology (ICT)',
                    'image' => '../photo/INFORMATION.png',
                    'desc' => 'Master modern IT skills including programming (Python, Java, Web), networking (CCNA), cybersecurity, database management, software development, and cloud computing. NVQ Level 4 certified.',
                    'duration' => '12 Months',
                    'mode' => 'Full-Time / Part-Time',
                    'fee' => 'LKR 150,000',
                    'features' => ['NVQ Level 4 Certification', 'Industry Projects', 'Job Placement Assistance', 'Modern Labs', 'Experienced Instructors']
                ],
                'electrical' => [
                    'title' => 'Electrical & Mechanical',
                    'image' => '../photo/ELECTRICAL.png',
                    'desc' => 'Comprehensive training in electrical installations, motor winding, PLC programming, mechanical maintenance, and automation systems.',
                    'duration' => '12 Months',
                    'mode' => 'Full-Time',
                    'fee' => 'LKR 140,000',
                    'features' => ['NVQ Level 4', 'Hands-on Workshop Training', 'Industrial Safety', 'PLC & Automation', 'Electrical Design']
                ],
                'welding' => [
                    'title' => 'Welding & Fabrication',
                    'image' => '../photo/WELDING.png',
                    'desc' => 'Professional training in MIG, TIG, Arc welding, pipe welding, structural fabrication, and safety standards.',
                    'duration' => '6-9 Months',
                    'mode' => 'Full-Time',
                    'fee' => 'LKR 120,000',
                    'features' => ['International Welding Standards', 'Safety Certification', 'Advanced Fabrication', 'Job-Ready Skills']
                ],
                'plumbing' => [
                    'title' => 'Plumbing & Pipe Fitting',
                    'image' => '../photo/PLUMBING.png',
                    'desc' => 'Complete plumbing systems, pipe installation, drainage, water supply, sanitary fittings, and maintenance.',
                    'duration' => '9 Months',
                    'mode' => 'Full-Time',
                    'fee' => 'LKR 110,000',
                    'features' => ['NVQ Level 3-4', 'Practical Installation', 'Modern Tools Training', 'Building Code Compliance']
                ],
                'hospitality' => [
                    'title' => 'Hospitality & Tourism Management',
                    'image' => '../photo/HOSPITALITY.png',
                    'desc' => 'Professional training in hotel operations, front office, housekeeping, food & beverage service, event management, and tourism.',
                    'duration' => '12 Months',
                    'mode' => 'Full-Time / Part-Time',
                    'fee' => 'LKR 130,000',
                    'features' => ['International Standards', 'Internship Placement', 'Customer Service Excellence', 'Event Planning']
                ],
                'automobile' => [
                    'title' => 'Automobile & Motor Technology',
                    'image' => '../photo/AUTOMOBILE.png',
                    'desc' => 'Advanced training in engine repair, electrical systems, diagnostics, transmission, suspension, and modern hybrid vehicles.',
                    'duration' => '12 Months',
                    'mode' => 'Full-Time',
                    'fee' => 'LKR 160,000',
                    'features' => ['NVQ Level 4', 'Modern Diagnostic Tools', 'Hybrid & EV Training', 'Workshop Practice']
                ]
            ];

            // Get current course
            $course = $courses[$course_id] ?? $courses['ict'];
            ?>

            <!-- Course Details -->
            <div class="course-detail">
                <div class="course-img">
                    <img src="<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
                </div>
                <div class="course-info">
                    <h1><?php echo $course['title']; ?></h1>
                    <p><?php echo $course['desc']; ?></p>
                    <ul class="course-features">
                        <li><i class="fas fa-clock"></i> Duration: <?php echo $course['duration']; ?></li>
                        <li><i class="fas fa-user-clock"></i> Mode: <?php echo $course['mode']; ?></li>
                        <li><i class="fas fa-money-bill"></i> Course Fee: <?php echo $course['fee']; ?></li>
                        <?php foreach($course['features'] as $feature): ?>
                            <li><i class="fas fa-check-circle"></i> <?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Application Form -->
            <div class="application-form">
                <h2>Apply for <?php echo $course['title']; ?></h2>
                <form action="../backend/submit-application.php" method="POST">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <input type="hidden" name="course_name" value="<?php echo $course['title']; ?>">

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number *</label>
                            <input type="tel" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>NIC Number *</label>
                            <input type="text" name="nic" required>
                        </div>
                        <div class="form-group">
                            <label>Preferred Branch *</label>
                            <select name="branch" required>
                                <option value="">Select Branch</option>
                                <option value="colombo">Colombo</option>
                                <option value="kandy">Kandy</option>
                                <option value="matara">Matara</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message (Optional)</label>
                            <textarea name="message" rows="4" placeholder="Why do you want to join this course?"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="apply-btn">Submit Application</button>
                </form>
            </div>

        </div>
    </section>

    <!-- Footer (your existing footer) -->
    <footer>
        <!-- Paste your footer code here -->
    </footer>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>