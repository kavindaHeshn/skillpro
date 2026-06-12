<?php // home.php - SkillPro Institute Home Page ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro Institute | Empowering Sri Lanka's Workforce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:#c94a00;--primary-dark:#a33a00;--primary-light:#ff6b2b;
            --accent:#f5a623;--dark:#0f0e0d;--dark-2:#1c1a18;--dark-3:#2a2724;
            --text:#1a1815;--text-muted:#6b6560;--text-light:#9c9590;
            --bg:#faf9f7;--bg-2:#f2f0ec;--white:#ffffff;--border:#e5e2dc;--nav-h:72px;
        }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        html{scroll-behavior:smooth;}
        body{font-family:'Inter',sans-serif;color:var(--text);background:var(--bg);line-height:1.6;overflow-x:hidden;}

        /* TOPBAR */
        .topbar{background:var(--primary);position:fixed;top:0;left:0;right:0;z-index:1001;}
        .topbar-inner{max-width:1280px;margin:0 auto;padding:7px 32px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
        .topbar-contact{display:flex;align-items:center;gap:20px;}
        .topbar-contact a{color:rgba(255,255,255,0.9);text-decoration:none;font-size:0.78rem;display:flex;align-items:center;gap:6px;transition:color 0.2s;}
        .topbar-contact a:hover{color:#fff;}
        .topbar-social{display:flex;gap:12px;}
        .topbar-social a{color:rgba(255,255,255,0.8);text-decoration:none;font-size:0.75rem;font-weight:700;transition:color 0.2s;}
        .topbar-social a:hover{color:#fff;}

        /* HEADER */
        header{position:fixed;top:34px;left:0;right:0;z-index:1000;background:rgba(15,14,13,0.97);backdrop-filter:blur(12px);border-bottom:1px solid rgba(255,255,255,0.07);transition:all 0.3s;}
        header.scrolled{top:0;box-shadow:0 4px 24px rgba(0,0,0,0.4);}
        .nav-wrap{max-width:1280px;margin:0 auto;padding:0 32px;height:var(--nav-h);display:flex;align-items:center;justify-content:space-between;gap:16px;}
        .logo{display:flex;align-items:center;gap:12px;text-decoration:none;flex-shrink:0;}
        .logo-icon{width:44px;height:44px;background:var(--primary);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:800;color:#fff;letter-spacing:-1px;}
        .logo-text strong{display:block;font-size:1rem;font-weight:700;color:#fff;line-height:1.1;}
        .logo-text span{font-size:0.6rem;letter-spacing:2px;text-transform:uppercase;color:var(--accent);}
        nav{display:flex;align-items:center;gap:2px;flex-wrap:wrap;}
        nav a{color:rgba(255,255,255,0.7);text-decoration:none;font-size:0.8rem;font-weight:500;padding:6px 9px;border-radius:6px;transition:all 0.2s;white-space:nowrap;}
        nav a:hover,nav a.active{color:#fff;background:rgba(255,255,255,0.08);}
        nav a.active{color:var(--accent);}
        .nav-cta{background:var(--primary)!important;color:#fff!important;padding:8px 16px!important;border-radius:8px!important;font-weight:600!important;margin-left:6px;}
        .nav-cta:hover{background:var(--primary-dark)!important;}
        .hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:8px;}
        .hamburger span{width:22px;height:2px;background:#fff;border-radius:2px;display:block;transition:0.3s;}

        /* HERO */
        .hero{min-height:100vh;background:var(--dark);display:flex;flex-direction:column;justify-content:center;padding-top:calc(var(--nav-h) + 34px);position:relative;overflow:hidden;}
        .hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 70% 50%,rgba(201,74,0,0.18) 0%,transparent 60%),radial-gradient(ellipse 50% 80% at 10% 80%,rgba(245,166,35,0.08) 0%,transparent 50%);}
        .hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px;}
        .hero-inner{max-width:1280px;margin:0 auto;padding:80px 32px 100px;display:grid;grid-template-columns:1fr 400px;gap:70px;align-items:center;position:relative;z-index:2;}
        .hero-eyebrow{display:inline-flex;align-items:center;gap:8px;background:rgba(201,74,0,0.15);border:1px solid rgba(201,74,0,0.3);border-radius:50px;padding:6px 16px;margin-bottom:28px;}
        .hero-eyebrow span{font-size:0.7rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:var(--primary-light);}
        .eyebrow-dot{width:6px;height:6px;background:var(--primary-light);border-radius:50%;animation:pulse 2s infinite;}
        @keyframes pulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:0.5;transform:scale(0.8);}}
        .hero h1{font-family:'Playfair Display',serif;font-size:clamp(2.8rem,5vw,4rem);font-weight:800;line-height:1.1;color:#fff;margin-bottom:22px;letter-spacing:-1px;}
        .hero h1 em{font-style:normal;color:var(--primary-light);display:block;}
        .hero-desc{font-size:1rem;color:rgba(255,255,255,0.6);line-height:1.7;max-width:520px;margin-bottom:36px;}
        .hero-actions{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:56px;}
        .btn-primary{background:var(--primary);color:#fff;padding:13px 26px;border-radius:10px;font-weight:600;font-size:0.88rem;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;border:none;cursor:pointer;}
        .btn-primary:hover{background:var(--primary-dark);transform:translateY(-1px);}
        .btn-outline{background:transparent;color:rgba(255,255,255,0.8);padding:13px 26px;border-radius:10px;font-weight:500;font-size:0.88rem;text-decoration:none;border:1px solid rgba(255,255,255,0.2);transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;}
        .btn-outline:hover{border-color:rgba(255,255,255,0.4);background:rgba(255,255,255,0.05);}
        .hero-stats{display:flex;gap:32px;flex-wrap:wrap;}
        .stat-num{font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:#fff;line-height:1;}
        .stat-num span{color:var(--accent);}
        .stat-label{font-size:0.7rem;color:rgba(255,255,255,0.4);letter-spacing:1px;text-transform:uppercase;margin-top:4px;}

        /* HERO CARD */
        .hero-card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:32px;backdrop-filter:blur(10px);}
        .hero-card-title{font-size:0.9rem;font-weight:600;color:#fff;margin-bottom:20px;}
        .branch-list{display:flex;flex-direction:column;gap:10px;margin-bottom:24px;}
        .branch-item{display:flex;align-items:center;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.04);border-radius:10px;border:1px solid rgba(255,255,255,0.06);}
        .branch-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;}
        .branch-name{font-size:0.85rem;font-weight:600;color:#fff;}
        .branch-mode{font-size:0.72rem;color:rgba(255,255,255,0.45);margin-top:2px;}
        .branch-tag{font-size:0.62rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;padding:3px 10px;border-radius:50px;}
        .quick-contact{border-top:1px solid rgba(255,255,255,0.08);padding-top:22px;}
        .quick-contact p{font-size:0.68rem;color:rgba(255,255,255,0.4);letter-spacing:1px;text-transform:uppercase;margin-bottom:10px;}
        .quick-contact a{display:flex;align-items:center;gap:10px;color:var(--accent);text-decoration:none;font-size:0.9rem;font-weight:600;}

        /* SECTIONS */
        .section{padding:100px 0;}
        .section-inner{max-width:1280px;margin:0 auto;padding:0 32px;}
        .section-label{display:inline-block;font-size:0.68rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--primary);margin-bottom:10px;}
        .section-title{font-family:'Playfair Display',serif;font-size:clamp(1.9rem,3.5vw,2.7rem);font-weight:700;color:var(--text);line-height:1.2;margin-bottom:14px;}
        .section-sub{font-size:0.95rem;color:var(--text-muted);line-height:1.7;max-width:580px;}
        .section-head{margin-bottom:55px;}
        .section-head.center{text-align:center;}
        .section-head.center .section-sub{margin:0 auto;}

        /* ABOUT */
        #about{background:var(--white);}
        .about-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}
        .about-img-wrap{position:relative;}
        .about-img-placeholder{width:100%;height:460px;background:linear-gradient(135deg,var(--bg-2) 0%,#e8e5df 100%);border-radius:16px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;color:var(--text-light);}
        .about-img-placeholder span:first-child{font-size:4rem;}
        .about-img-placeholder .label{font-size:0.78rem;letter-spacing:1px;}
        .about-img-placeholder .hint{font-size:0.7rem;opacity:0.6;}
        .about-badge{position:absolute;bottom:-20px;right:-20px;background:var(--primary);color:#fff;border-radius:14px;padding:20px 24px;box-shadow:0 12px 40px rgba(201,74,0,0.35);}
        .about-badge-num{font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;line-height:1;}
        .about-badge-text{font-size:0.7rem;opacity:0.85;margin-top:4px;}
        .about-text p{color:var(--text-muted);line-height:1.8;margin-bottom:16px;font-size:0.93rem;}
        .about-features{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:30px;}
        .about-feature{display:flex;align-items:flex-start;gap:12px;padding:14px;background:var(--bg);border-radius:10px;border:1px solid var(--border);}
        .feature-icon{width:36px;height:36px;background:rgba(201,74,0,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
        .feature-text strong{display:block;font-size:0.8rem;font-weight:600;color:var(--text);margin-bottom:2px;}
        .feature-text span{font-size:0.73rem;color:var(--text-muted);}

        /* GLANCE */
        #glance{background:var(--dark);}
        .glance-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:rgba(255,255,255,0.08);border-radius:16px;overflow:hidden;}
        .glance-item{background:var(--dark-2);padding:48px 32px;text-align:center;}
        .glance-num{font-family:'Playfair Display',serif;font-size:3.2rem;font-weight:700;color:var(--accent);line-height:1;margin-bottom:8px;}
        .glance-label{font-size:0.8rem;color:rgba(255,255,255,0.5);line-height:1.5;}

        /* COURSES */
        #courses{background:var(--bg);}
        .courses-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:22px;}
        .course-card{background:var(--white);border-radius:14px;overflow:hidden;border:1px solid var(--border);transition:all 0.25s;display:flex;flex-direction:column;}
        .course-card:hover{transform:translateY(-4px);box-shadow:0 20px 50px rgba(0,0,0,0.1);border-color:var(--primary);}
        .course-img{height:185px;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;}
        .course-img img{width:100%;height:100%;object-fit:cover;transition:transform 0.4s;}
        .course-card:hover .course-img img{transform:scale(1.05);}
        .course-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.8rem;}
        .course-badge{position:absolute;top:12px;left:12px;font-size:0.63rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;color:#fff;}
        .course-body{padding:20px;flex:1;display:flex;flex-direction:column;}
        .course-title{font-size:0.88rem;font-weight:700;color:var(--text);margin-bottom:8px;line-height:1.3;}
        .course-desc{font-size:0.78rem;color:var(--text-muted);line-height:1.6;flex:1;margin-bottom:16px;}
        .course-footer{display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid var(--border);}
        .course-meta span{font-size:0.68rem;color:var(--text-muted);display:block;}
        .course-meta strong{font-size:0.73rem;color:var(--text);}
        .course-btn{background:var(--primary);color:#fff;font-size:0.73rem;font-weight:600;padding:7px 14px;border-radius:7px;text-decoration:none;transition:background 0.2s;}
        .course-btn:hover{background:var(--primary-dark);}

        /* NOTICES */
        #notices{background:var(--white);}
        .notices-grid{display:grid;grid-template-columns:1fr 1fr;gap:28px;}
        .notice-panel{background:var(--bg);border-radius:14px;padding:30px;border:1px solid var(--border);}
        .notice-panel-title{font-size:0.68rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--primary);margin-bottom:18px;display:flex;align-items:center;gap:8px;}
        .notice-panel-title::after{content:'';flex:1;height:1px;background:var(--border);}
        .notice-list{display:flex;flex-direction:column;}
        .notice-item{display:flex;gap:14px;padding:14px 0;border-bottom:1px solid var(--border);align-items:flex-start;}
        .notice-item:last-child{border-bottom:none;}
        .notice-date{background:var(--primary);color:#fff;border-radius:8px;padding:5px 9px;text-align:center;min-width:42px;flex-shrink:0;}
        .notice-date .day{font-size:1.1rem;font-weight:700;line-height:1;display:block;}
        .notice-date .mon{font-size:0.58rem;text-transform:uppercase;letter-spacing:1px;opacity:0.85;}
        .notice-info strong{display:block;font-size:0.83rem;font-weight:600;color:var(--text);margin-bottom:4px;}
        .notice-info span{font-size:0.73rem;color:var(--text-muted);}
        .notice-tag{display:inline-block;font-size:0.58rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;padding:2px 8px;border-radius:50px;margin-top:6px;}

        /* TESTIMONIAL */
        #testimonial{background:var(--dark);}
        .testimonial-quote{max-width:780px;margin:0 auto;text-align:center;}
        .quote-mark{font-family:'Playfair Display',serif;font-size:6rem;line-height:0.5;color:var(--primary);opacity:0.4;margin-bottom:24px;display:block;}
        .quote-text{font-family:'Playfair Display',serif;font-size:1.55rem;font-weight:700;color:#fff;line-height:1.5;margin-bottom:30px;}
        .quote-author{display:flex;align-items:center;justify-content:center;gap:14px;}
        .quote-avatar{width:48px;height:48px;border-radius:50%;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;font-size:1.2rem;}
        .quote-name strong{display:block;color:#fff;font-size:0.88rem;}
        .quote-name span{color:rgba(255,255,255,0.45);font-size:0.75rem;}

        /* FOOTER */
        footer{background:var(--dark-2);padding:80px 0 0;border-top:1px solid rgba(255,255,255,0.06);}
        .footer-inner{max-width:1280px;margin:0 auto;padding:0 32px;}
        .footer-grid{display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:44px;padding-bottom:56px;border-bottom:1px solid rgba(255,255,255,0.07);}
        .footer-col h4{font-size:0.68rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:18px;}
        .footer-about p{font-size:0.83rem;color:rgba(255,255,255,0.45);line-height:1.8;margin-bottom:22px;}
        .footer-social{display:flex;gap:10px;}
        .footer-social a{width:36px;height:36px;background:rgba(255,255,255,0.06);border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.5);text-decoration:none;font-size:0.73rem;font-weight:700;transition:all 0.2s;}
        .footer-social a:hover{background:var(--primary);color:#fff;}
        .footer-links{list-style:none;display:flex;flex-direction:column;gap:9px;}
        .footer-links a{color:rgba(255,255,255,0.5);text-decoration:none;font-size:0.82rem;transition:color 0.2s;display:flex;align-items:center;gap:8px;}
        .footer-links a::before{content:'';width:4px;height:4px;background:var(--primary);border-radius:50%;flex-shrink:0;}
        .footer-links a:hover{color:rgba(255,255,255,0.9);}
        .newsletter-wrap{display:flex;margin-top:8px;}
        .newsletter-wrap input{flex:1;padding:10px 13px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);border-right:none;border-radius:8px 0 0 8px;color:#fff;font-size:0.8rem;outline:none;}
        .newsletter-wrap input::placeholder{color:rgba(255,255,255,0.3);}
        .newsletter-wrap input:focus{border-color:var(--primary);}
        .newsletter-wrap button{background:var(--primary);color:#fff;border:none;padding:10px 14px;border-radius:0 8px 8px 0;font-size:0.78rem;font-weight:600;cursor:pointer;white-space:nowrap;transition:background 0.2s;}
        .newsletter-wrap button:hover{background:var(--primary-dark);}
        .footer-bottom{padding:22px 0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
        .footer-bottom p{font-size:0.76rem;color:rgba(255,255,255,0.3);}
        .footer-bottom-links{display:flex;gap:18px;}
        .footer-bottom-links a{font-size:0.73rem;color:rgba(255,255,255,0.3);text-decoration:none;transition:color 0.2s;}
        .footer-bottom-links a:hover{color:rgba(255,255,255,0.7);}

        /* REVEAL */
        .reveal{opacity:0;transform:translateY(26px);transition:opacity 0.6s ease,transform 0.6s ease;}
        .reveal.visible{opacity:1;transform:none;}

        /* RESPONSIVE */
        @media(max-width:1100px){
            .hero-inner{grid-template-columns:1fr;}
            .hero-card{display:none;}
            .about-grid{grid-template-columns:1fr;}
            .footer-grid{grid-template-columns:1fr 1fr;}
        }
        @media(max-width:768px){
            :root{--nav-h:60px;}
            .nav-wrap{padding:0 20px;}
            nav{display:none;position:absolute;top:var(--nav-h);left:0;right:0;background:var(--dark);flex-direction:column;padding:14px;gap:4px;border-top:1px solid rgba(255,255,255,0.08);}
            nav.open{display:flex;}
            nav a{display:block;padding:10px 14px;font-size:0.88rem;}
            .hamburger{display:flex;}
            .hero-inner{padding:55px 20px 75px;}
            .section-inner{padding:0 20px;}
            .glance-grid{grid-template-columns:repeat(2,1fr);}
            .notices-grid{grid-template-columns:1fr;}
            .footer-grid{grid-template-columns:1fr;}
            .topbar-inner{padding:7px 20px;}
        }
        @media(max-width:480px){
            .about-features{grid-template-columns:1fr;}
            .hero-stats{gap:18px;}
            .footer-bottom{flex-direction:column;align-items:flex-start;}
            .courses-grid{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-inner">
        <div class="topbar-contact">
            <a href="tel:+94117544801">📞 +94 11 754 4801</a>
            <a href="mailto:info@skillpro.edu.lk">✉️ info@skillpro.edu.lk</a>
            <span style="font-size:0.76rem;color:rgba(255,255,255,0.75);">📍 Colombo | Kandy | Matara</span>
        </div>
        <div class="topbar-social">
            <a href="#">FB</a><a href="#">IG</a><a href="#">LI</a><a href="#">YT</a>
        </div>
    </div>
</div>

<!-- HEADER -->
<header id="header">
    <div class="nav-wrap">
        <a href="home.php" class="logo">
            <div class="logo-icon">SP</div>
            <div class="logo-text">
                <strong>SkillPro Institute</strong>
                <span>TVEC Registered · Sri Lanka</span>
            </div>
        </a>
        <nav id="mainNav">
            <a href="home.php" class="active">Home</a>
            <a href="about.php">About</a>
            <a href="prospective.php">Prospective</a>
            <a href="faculties.php">Courses</a>
            <a href="international.php">International</a>
            <a href="research.php">Research</a>
            <a href="studentlife.php">Student Life</a>
            <a href="professional.php">Professional</a>
            <a href="staff.php">Staff</a>
            <a href="login.php" class="nav-cta">Login →</a>
        </nav>
        <div class="hamburger" id="hamburger" role="button" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </div>
    </div>
</header>

<!-- HERO -->
<section class="hero" id="home" style="margin-top:34px;">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="hero-inner">
        <div class="hero-left">
            <div class="hero-eyebrow">
                <div class="eyebrow-dot"></div>
                <span>TVEC Registered Institute · Sri Lanka</span>
            </div>
            <h1>Build Skills That<em>Drive Careers</em></h1>
            <p class="hero-desc">SkillPro Institute offers industry-aligned vocational training in ICT, Engineering, Hospitality, and more — equipping Sri Lanka's youth with job-ready skills since 2014.</p>
            <div class="hero-actions">
                <a href="faculties.php" class="btn-primary">Explore Courses →</a>
                <a href="prospective.php" class="btn-outline">How to Enroll</a>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-num">8,000<span>+</span></div>
                    <div class="stat-label">Graduates</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">60<span>+</span></div>
                    <div class="stat-label">Instructors</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">10<span>+</span></div>
                    <div class="stat-label">Years Active</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">3</div>
                    <div class="stat-label">Branches</div>
                </div>
            </div>
        </div>
        <div class="hero-card">
            <p class="hero-card-title">Our Branches</p>
            <div class="branch-list">
                <div class="branch-item">
                    <div class="branch-dot" style="background:#22c55e;"></div>
                    <div style="flex:1;">
                        <div class="branch-name">Colombo Branch</div>
                        <div class="branch-mode">Online &amp; On-site</div>
                    </div>
                    <span class="branch-tag" style="background:rgba(34,197,94,0.15);color:#16a34a;">Main</span>
                </div>
                <div class="branch-item">
                    <div class="branch-dot" style="background:#3b82f6;"></div>
                    <div style="flex:1;">
                        <div class="branch-name">Kandy Branch</div>
                        <div class="branch-mode">Online &amp; On-site</div>
                    </div>
                    <span class="branch-tag" style="background:rgba(59,130,246,0.15);color:#2563eb;">Active</span>
                </div>
                <div class="branch-item">
                    <div class="branch-dot" style="background:#f59e0b;"></div>
                    <div style="flex:1;">
                        <div class="branch-name">Matara Branch</div>
                        <div class="branch-mode">On-site Training</div>
                    </div>
                    <span class="branch-tag" style="background:rgba(245,158,11,0.15);color:#d97706;">Active</span>
                </div>
            </div>
            <div class="quick-contact">
                <p>Quick Contact</p>
                <a href="tel:+94117544801">📞 +94 11 754 4801</a>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="section" id="about">
    <div class="section-inner">
        <div class="about-grid">
            <div class="about-img-wrap reveal">
                <div class="about-img-placeholder">
                    <span>🎓</span>
                    <span class="label">Institute Photo</span>
                    <span class="hint">Replace with: ../photo/image.png</span>
                </div>
                <!-- <img src="../photo/image.png" alt="SkillPro Institute" style="width:100%;height:460px;object-fit:cover;border-radius:16px;"> -->
                <div class="about-badge">
                    <div class="about-badge-num">10+</div>
                    <div class="about-badge-text">Years of Excellence</div>
                </div>
            </div>
            <div class="about-text reveal">
                <span class="section-label">Who We Are</span>
                <h2 class="section-title">Sri Lanka's Leading TVET Institute</h2>
                <p>SkillPro Institute is a recognized Technical and Vocational Education and Training (TVET) institute registered under the Tertiary and Vocational Education Commission (TVEC) of Sri Lanka, committed to empowering youth and professionals with industry-relevant, job-oriented skills.</p>
                <p>Since its establishment, SkillPro has delivered high-quality vocational education in IT, Engineering Trades, Hospitality, and Technical Skills — bridging the gap between education and employment through hands-on practical training.</p>
                <p>With three fully equipped branches in Colombo, Kandy, and Matara, we provide accessible, flexible learning through both online and on-site training modes.</p>
                <div class="about-features">
                    <div class="about-feature">
                        <div class="feature-icon">🏛️</div>
                        <div class="feature-text"><strong>TVEC Registered</strong><span>Nationally recognized</span></div>
                    </div>
                    <div class="about-feature">
                        <div class="feature-icon">💼</div>
                        <div class="feature-text"><strong>Job-Ready Training</strong><span>Industry-aligned</span></div>
                    </div>
                    <div class="about-feature">
                        <div class="feature-icon">🌐</div>
                        <div class="feature-text"><strong>Online &amp; On-site</strong><span>Flexible modes</span></div>
                    </div>
                    <div class="about-feature">
                        <div class="feature-icon">🏆</div>
                        <div class="feature-text"><strong>NVQ Certified</strong><span>Government-recognized</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GLANCE -->
<section class="section" id="glance" style="padding:80px 0;">
    <div class="section-inner">
        <div class="glance-grid reveal">
            <div class="glance-item">
                <div class="glance-num">10+</div>
                <div class="glance-label">Years of Vocational<br>Training Excellence</div>
            </div>
            <div class="glance-item">
                <div class="glance-num">60+</div>
                <div class="glance-label">Qualified Instructors<br>&amp; Trainers</div>
            </div>
            <div class="glance-item">
                <div class="glance-num">120+</div>
                <div class="glance-label">Years Combined<br>Industry Experience</div>
            </div>
            <div class="glance-item">
                <div class="glance-num">8,000+</div>
                <div class="glance-label">Successful Graduates<br>Nationwide</div>
            </div>
        </div>
    </div>
</section>

<!-- COURSES -->
<section class="section" id="courses">
    <div class="section-inner">
        <div class="section-head center reveal">
            <span class="section-label">What We Offer</span>
            <h2 class="section-title">Our Training Programmes</h2>
            <p class="section-sub">Choose from 10+ nationally recognized vocational programmes designed to prepare you for today's job market.</p>
        </div>
        <div class="courses-grid">
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#e8f0fe,#c7d8fc);">
                    <div class="course-placeholder">💻</div>
                    <!-- <img src="../photo/INFORMATION.png" alt="ICT"> -->
                    <span class="course-badge" style="background:#1e88e5;">ICT</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Information &amp; Communication Technology</h3>
                    <p class="course-desc">Master programming, networking, cybersecurity, web development and software applications for the modern IT industry.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>6–12 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#fff3e0,#ffe0b2);">
                    <div class="course-placeholder">⚡</div>
                    <!-- <img src="../photo/ELECTRICAL.png" alt="Electrical"> -->
                    <span class="course-badge" style="background:#fb8c00;">Engineering</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Electrical &amp; Mechanical Engineering</h3>
                    <p class="course-desc">Hands-on training in electrical systems, machinery maintenance, automation and mechanical engineering principles.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>6–12 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#fce4ec,#f8bbd0);">
                    <div class="course-placeholder">🔥</div>
                    <!-- <img src="../photo/WELDING1.png" alt="Welding"> -->
                    <span class="course-badge" style="background:#e53935;">Trade</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Welding &amp; Fabrication Technology</h3>
                    <p class="course-desc">Professional MIG, TIG, and arc welding techniques plus fabrication skills for construction and manufacturing industries.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>3–6 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#e8f5e9,#c8e6c9);">
                    <div class="course-placeholder">🔧</div>
                    <!-- <img src="../photo/PLUMBING.png" alt="Plumbing"> -->
                    <span class="course-badge" style="background:#43a047;">Trade</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Plumbing &amp; Pipe Fitting</h3>
                    <p class="course-desc">Comprehensive skills in installation, repair, drainage systems, and water supply management for residential and commercial work.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>3–6 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#fffde7,#fff9c4);">
                    <div class="course-placeholder">🏨</div>
                    <!-- <img src="../photo/HOSPITALITY.png" alt="Hospitality"> -->
                    <span class="course-badge" style="background:#f9a825;">Hospitality</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Hospitality &amp; Tourism Management</h3>
                    <p class="course-desc">Develop expertise in hotel operations, customer service, event management and tourism industry practices.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>6–12 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#f3e5f5,#e1bee7);">
                    <div class="course-placeholder">🚗</div>
                    <!-- <img src="../photo/AUTOMOBILE.png" alt="Automobile"> -->
                    <span class="course-badge" style="background:#7b1fa2;">Automobile</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Automobile &amp; Motor Technology</h3>
                    <p class="course-desc">Expert training in vehicle repair, diagnostics, engine systems and modern automotive technology for garages and dealers.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>6–12 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#e0f2f1,#b2dfdb);">
                    <div class="course-placeholder">💼</div>
                    <!-- <img src="../photo/BUSINESS.png" alt="Business"> -->
                    <span class="course-badge" style="background:#00897b;">Business</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Business &amp; Management Studies</h3>
                    <p class="course-desc">Gain skills in entrepreneurship, accounting, marketing, HR and business administration for corporate and SME sectors.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>6–12 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="course-card reveal">
                <div class="course-img" style="background:linear-gradient(135deg,#fce4ec,#fdd5e2);">
                    <div class="course-placeholder">💬</div>
                    <!-- <img src="../photo/LANGUAGE.png" alt="Language"> -->
                    <span class="course-badge" style="background:#d81b60;">Language</span>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Language &amp; Soft Skills Development</h3>
                    <p class="course-desc">Improve English proficiency, communication, leadership, teamwork and presentation skills for the modern workplace.</p>
                    <div class="course-footer">
                        <div class="course-meta"><span>Duration</span><strong>3–6 Months</strong></div>
                        <a href="login.php" class="course-btn">Enroll Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <a href="faculties.php" class="btn-primary" style="display:inline-flex;">View All Courses →</a>
        </div>
    </div>
</section>

<!-- NOTICES & EVENTS -->
<section class="section" id="notices">
    <div class="section-inner">
        <div class="section-head reveal">
            <span class="section-label">Stay Updated</span>
            <h2 class="section-title">Notices &amp; Upcoming Events</h2>
        </div>
        <div class="notices-grid">
            <div class="notice-panel reveal">
                <div class="notice-panel-title">📢 Latest Notices</div>
                <div class="notice-list">
                    <div class="notice-item">
                        <div class="notice-date"><span class="day">15</span><span class="mon">Jul</span></div>
                        <div class="notice-info">
                            <strong>New ICT Batch Starting – Colombo</strong>
                            <span>Registration open for July 2025 intake. Limited seats available.</span>
                            <br><span class="notice-tag" style="background:rgba(201,74,0,0.1);color:var(--primary);">New Batch</span>
                        </div>
                    </div>
                    <div class="notice-item">
                        <div class="notice-date"><span class="day">20</span><span class="mon">Jul</span></div>
                        <div class="notice-info">
                            <strong>Mid-Year Exam Schedule Released</strong>
                            <span>All students can view exam timetables via the Student Portal.</span>
                            <br><span class="notice-tag" style="background:rgba(59,130,246,0.1);color:#1d4ed8;">Exam</span>
                        </div>
                    </div>
                    <div class="notice-item">
                        <div class="notice-date"><span class="day">25</span><span class="mon">Jul</span></div>
                        <div class="notice-info">
                            <strong>Holiday Notice – National Day</strong>
                            <span>Institute will remain closed on July 25th for the public holiday.</span>
                            <br><span class="notice-tag" style="background:rgba(245,158,11,0.1);color:#d97706;">Holiday</span>
                        </div>
                    </div>
                    <div class="notice-item">
                        <div class="notice-date"><span class="day">02</span><span class="mon">Aug</span></div>
                        <div class="notice-info">
                            <strong>Job Fair 2025 – Colombo Campus</strong>
                            <span>Top employers visiting campus. All final-year students welcome.</span>
                            <br><span class="notice-tag" style="background:rgba(34,197,94,0.1);color:#16a34a;">Career</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="notice-panel reveal">
                <div class="notice-panel-title">📅 Upcoming Events</div>
                <div class="notice-list">
                    <div class="notice-item">
                        <div class="notice-date" style="background:#7b1fa2;"><span class="day">18</span><span class="mon">Jul</span></div>
                        <div class="notice-info">
                            <strong>SkillFest 2025</strong>
                            <span>Annual inter-branch skills competition. Register your team today!</span>
                            <br><span class="notice-tag" style="background:rgba(123,31,162,0.1);color:#7b1fa2;">Event</span>
                        </div>
                    </div>
                    <div class="notice-item">
                        <div class="notice-date" style="background:#00897b;"><span class="day">28</span><span class="mon">Jul</span></div>
                        <div class="notice-info">
                            <strong>TechExpo – ICT Showcase</strong>
                            <span>Students present final projects. Open to industry visitors and recruiters.</span>
                            <br><span class="notice-tag" style="background:rgba(0,137,123,0.1);color:#00897b;">Exhibition</span>
                        </div>
                    </div>
                    <div class="notice-item">
                        <div class="notice-date" style="background:#e53935;"><span class="day">05</span><span class="mon">Aug</span></div>
                        <div class="notice-info">
                            <strong>Trade Skills Championship</strong>
                            <span>Welding, Plumbing and Electrical competition at Kandy branch.</span>
                            <br><span class="notice-tag" style="background:rgba(229,57,53,0.1);color:#e53935;">Competition</span>
                        </div>
                    </div>
                    <div class="notice-item">
                        <div class="notice-date" style="background:#1e88e5;"><span class="day">12</span><span class="mon">Aug</span></div>
                        <div class="notice-info">
                            <strong>Career Development Week</strong>
                            <span>CV writing workshops, mock interviews, and industry talks across all branches.</span>
                            <br><span class="notice-tag" style="background:rgba(30,136,229,0.1);color:#1e88e5;">Workshop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIAL -->
<section class="section" id="testimonial">
    <div class="section-inner">
        <div class="testimonial-quote reveal">
            <span class="quote-mark">"</span>
            <p class="quote-text">The skills I gained at SkillPro transformed my career. Within six months of completing my ICT programme, I secured a position at a leading tech company in Colombo.</p>
            <div class="quote-author">
                <div class="quote-avatar">👤</div>
                <div class="quote-name">
                    <strong>Nimal Perera</strong>
                    <span>ICT Graduate, 2023 · Software Developer at TechCorp LK</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-inner">
        <div class="footer-grid">
            <div class="footer-col footer-about">
                <div class="logo" style="margin-bottom:18px;">
                    <div class="logo-icon">SP</div>
                    <div class="logo-text">
                        <strong>SkillPro Institute</strong>
                        <span>TVEC Registered · Sri Lanka</span>
                    </div>
                </div>
                <p>A leading TVET institute in Sri Lanka delivering industry-oriented training programmes. Registered under TVEC, we offer online and on-site learning across Colombo, Kandy, and Matara.</p>
                <div class="footer-social">
                    <a href="#">FB</a><a href="#">IG</a><a href="#">LI</a><a href="#">YT</a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Programmes</h4>
                <ul class="footer-links">
                    <li><a href="faculties.php">ICT &amp; Computing</a></li>
                    <li><a href="faculties.php">Electrical &amp; Mechanical</a></li>
                    <li><a href="faculties.php">Welding &amp; Fabrication</a></li>
                    <li><a href="faculties.php">Plumbing &amp; Pipe Fitting</a></li>
                    <li><a href="faculties.php">Hospitality &amp; Tourism</a></li>
                    <li><a href="faculties.php">Automobile Technology</a></li>
                    <li><a href="faculties.php">Business &amp; Management</a></li>
                    <li><a href="faculties.php">Language &amp; Soft Skills</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="prospective.php">Prospective Students</a></li>
                    <li><a href="studentlife.php">Student Life</a></li>
                    <li><a href="research.php">Research</a></li>
                    <li><a href="international.php">International</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="login.php">Student Login</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul class="footer-links" style="margin-bottom:22px;">
                    <li><a href="tel:+94117544801">📞 +94 11 754 4801</a></li>
                    <li><a href="mailto:info@skillpro.edu.lk">✉️ info@skillpro.edu.lk</a></li>
                    <li><a href="#">📍 Colombo Branch</a></li>
                    <li><a href="#">📍 Kandy Branch</a></li>
                    <li><a href="#">📍 Matara Branch</a></li>
                </ul>
                <h4>Newsletter</h4>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.4);margin-bottom:10px;">Stay updated on new batches and events.</p>
                <div class="newsletter-wrap">
                    <input type="email" placeholder="Your email address" id="nlEmail">
                    <button type="button" id="nlBtn">Subscribe</button>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 SkillPro Institute. All rights reserved. Registered under TVEC, Sri Lanka.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
                <a href="#">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Header scroll + topbar hide
    const header = document.getElementById('header');
    const topbar = document.querySelector('.topbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            header.classList.add('scrolled');
            topbar.style.transform = 'translateY(-100%)';
            topbar.style.transition = 'transform 0.3s';
        } else {
            header.classList.remove('scrolled');
            topbar.style.transform = '';
        }
    });

    // Hamburger
    document.getElementById('hamburger').addEventListener('click', () => {
        document.getElementById('mainNav').classList.toggle('open');
    });

    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 70);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Newsletter
    document.getElementById('nlBtn').addEventListener('click', function() {
        const input = document.getElementById('nlEmail');
        if (input.value && input.value.includes('@')) {
            this.textContent = '✓ Done!';
            this.style.background = '#16a34a';
            input.value = '';
            setTimeout(() => { this.textContent = 'Subscribe'; this.style.background = ''; }, 3000);
        } else {
            input.style.borderColor = '#e53935';
            setTimeout(() => input.style.borderColor = '', 2000);
        }
    });
</script>
</body>
</html>