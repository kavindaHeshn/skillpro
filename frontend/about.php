<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us – SkillPro Institute</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --navy:   #0D2137;
      --gold:   #C9932A;
      --cream:  #FAF7F2;
      --slate:  #4A5C6E;
      --light:  #E8EFF5;
      --white:  #FFFFFF;
      --text:   #1A2B3C;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--cream);
      color: var(--text);
      overflow-x: hidden;
    }

    /* ── NAV ── */
    nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 100;
      background: var(--navy);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 5%;
      height: 64px;
    }
    .nav-logo {
      font-family: 'Playfair Display', serif;
      color: var(--white);
      font-size: 1.35rem;
      letter-spacing: .5px;
    }
    .nav-logo span { color: var(--gold); }
    .nav-links { display: flex; gap: 2rem; list-style: none; }
    .nav-links a {
      color: rgba(255,255,255,.75);
      text-decoration: none;
      font-size: .875rem;
      font-weight: 500;
      transition: color .2s;
    }
    .nav-links a:hover, .nav-links a.active { color: var(--gold); }
    .nav-cta {
      background: var(--gold); color: var(--white);
      padding: .5rem 1.25rem; border-radius: 4px;
      font-size: .875rem; font-weight: 600;
      text-decoration: none; transition: opacity .2s;
    }
    .nav-cta:hover { opacity: .85; }
    .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
    .hamburger span { display: block; width: 24px; height: 2px; background: var(--white); transition: .3s; }

    /* ── HERO ── */
    .hero {
      margin-top: 64px;
      background: linear-gradient(135deg, var(--navy) 55%, #1A3A5C 100%);
      padding: 100px 5% 80px;
      position: relative; overflow: hidden;
    }
    .hero::after {
      content: '';
      position: absolute; right: -80px; top: -80px;
      width: 420px; height: 420px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(201,147,42,.18) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero-inner { max-width: 760px; position: relative; }
    .eyebrow {
      display: inline-block;
      color: var(--gold);
      font-size: .78rem; font-weight: 600;
      letter-spacing: 2.5px; text-transform: uppercase;
      margin-bottom: 1.2rem;
    }
    .hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2.4rem, 5vw, 3.8rem);
      color: var(--white);
      line-height: 1.18;
      margin-bottom: 1.4rem;
    }
    .hero h1 em { color: var(--gold); font-style: normal; }
    .hero p {
      color: rgba(255,255,255,.72);
      font-size: 1.05rem; line-height: 1.75;
      max-width: 580px;
      margin-bottom: 2.4rem;
    }
    .hero-btns { display: flex; gap: 1rem; flex-wrap: wrap; }
    .btn-primary {
      background: var(--gold); color: var(--white);
      padding: .75rem 1.8rem; border-radius: 4px;
      font-weight: 600; font-size: .925rem;
      text-decoration: none; transition: opacity .2s;
    }
    .btn-primary:hover { opacity: .85; }
    .btn-outline {
      border: 1.5px solid rgba(255,255,255,.45); color: var(--white);
      padding: .75rem 1.8rem; border-radius: 4px;
      font-weight: 500; font-size: .925rem;
      text-decoration: none; transition: border-color .2s, color .2s;
    }
    .btn-outline:hover { border-color: var(--gold); color: var(--gold); }

    /* ── STATS BAR ── */
    .stats-bar {
      background: var(--white);
      display: flex; flex-wrap: wrap;
      border-bottom: 3px solid var(--light);
    }
    .stat-item {
      flex: 1 1 200px;
      padding: 2rem 5%;
      border-right: 1px solid var(--light);
      text-align: center;
    }
    .stat-item:last-child { border-right: none; }
    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2.4rem; color: var(--navy);
      line-height: 1;
    }
    .stat-num span { color: var(--gold); }
    .stat-label { font-size: .82rem; color: var(--slate); margin-top: .4rem; text-transform: uppercase; letter-spacing: 1px; }

    /* ── SECTIONS ── */
    section { padding: 80px 5%; }
    .section-label {
      font-size: .75rem; color: var(--gold);
      letter-spacing: 2.5px; text-transform: uppercase;
      font-weight: 600; margin-bottom: .9rem;
    }
    h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.7rem, 3vw, 2.5rem);
      color: var(--navy); line-height: 1.25;
      margin-bottom: 1.2rem;
    }
    .lead {
      color: var(--slate); font-size: 1.05rem;
      line-height: 1.8; max-width: 640px;
    }

    /* ── MISSION / VISION ── */
    .mv-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 2px; margin-top: 3rem;
      border: 2px solid var(--light);
    }
    .mv-card {
      background: var(--white);
      padding: 2.5rem 2rem;
      position: relative; overflow: hidden;
    }
    .mv-card::before {
      content: '';
      position: absolute; top: 0; left: 0;
      width: 4px; height: 100%;
      background: var(--gold);
    }
    .mv-card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem; color: var(--navy);
      margin-bottom: .9rem;
    }
    .mv-card p { color: var(--slate); font-size: .96rem; line-height: 1.75; }
    .mv-icon { font-size: 2rem; margin-bottom: 1rem; }

    /* ── VALUES ── */
    .values-section { background: var(--navy); }
    .values-section h2, .values-section .section-label { color: var(--white); }
    .values-section .section-label { color: var(--gold); }
    .values-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem; margin-top: 3rem;
    }
    .value-card {
      background: rgba(255,255,255,.06);
      border: 1px solid rgba(255,255,255,.1);
      border-radius: 6px;
      padding: 2rem 1.5rem;
      transition: background .25s, transform .25s;
    }
    .value-card:hover {
      background: rgba(201,147,42,.12);
      transform: translateY(-4px);
    }
    .value-icon { font-size: 2rem; margin-bottom: 1rem; }
    .value-card h3 {
      font-size: 1rem; font-weight: 600;
      color: var(--gold); margin-bottom: .6rem;
    }
    .value-card p { color: rgba(255,255,255,.65); font-size: .88rem; line-height: 1.65; }

    /* ── BRANCHES ── */
    .branches-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 1.5rem; margin-top: 3rem;
    }
    .branch-card {
      background: var(--white);
      border: 1px solid var(--light);
      border-radius: 6px;
      overflow: hidden;
      transition: box-shadow .25s, transform .25s;
    }
    .branch-card:hover { box-shadow: 0 12px 32px rgba(13,33,55,.1); transform: translateY(-4px); }
    .branch-header {
      background: var(--navy);
      padding: 1.5rem 1.5rem 1.2rem;
      display: flex; align-items: center; gap: 1rem;
    }
    .branch-badge {
      width: 44px; height: 44px;
      background: var(--gold); border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem; flex-shrink: 0;
    }
    .branch-header h3 { color: var(--white); font-size: 1.1rem; font-weight: 600; }
    .branch-header span { color: rgba(255,255,255,.55); font-size: .8rem; }
    .branch-body { padding: 1.4rem 1.5rem; }
    .branch-body p { color: var(--slate); font-size: .9rem; line-height: 1.65; margin-bottom: 1rem; }
    .branch-tag {
      display: inline-block;
      background: var(--light); color: var(--navy);
      font-size: .75rem; font-weight: 600;
      padding: .2rem .65rem; border-radius: 20px;
      margin: .2rem .2rem 0 0;
    }

    /* ── TEAM ── */
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem; margin-top: 3rem;
    }
    .team-card { text-align: center; }
    .avatar {
      width: 96px; height: 96px;
      border-radius: 50%;
      background: var(--light);
      margin: 0 auto 1rem;
      display: flex; align-items: center; justify-content: center;
      font-size: 2rem;
      border: 3px solid var(--gold);
      position: relative;
      overflow: hidden;
    }
    .team-card h4 { font-size: 1rem; font-weight: 600; color: var(--navy); }
    .team-card .role { font-size: .82rem; color: var(--gold); margin-top: .25rem; }
    .team-card .bio { font-size: .85rem; color: var(--slate); margin-top: .6rem; line-height: 1.6; }

    /* ── ACCREDITATION ── */
    .accred-section { background: var(--white); }
    .accred-strip {
      display: flex; flex-wrap: wrap; gap: 1rem;
      margin-top: 2.5rem;
    }
    .accred-badge {
      display: flex; align-items: center; gap: .75rem;
      padding: 1rem 1.5rem;
      border: 1.5px solid var(--light);
      border-radius: 6px;
      background: var(--cream);
      flex: 1 1 220px;
      transition: border-color .2s;
    }
    .accred-badge:hover { border-color: var(--gold); }
    .accred-badge .badge-icon { font-size: 1.8rem; }
    .accred-badge h4 { font-size: .9rem; font-weight: 600; color: var(--navy); }
    .accred-badge p { font-size: .78rem; color: var(--slate); margin-top: .15rem; }

    /* ── TIMELINE ── */
    .timeline { margin-top: 3rem; position: relative; padding-left: 2rem; }
    .timeline::before {
      content: '';
      position: absolute; left: 0; top: 8px; bottom: 8px;
      width: 2px; background: var(--light);
    }
    .tl-item { position: relative; padding-bottom: 2.5rem; }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-dot {
      position: absolute; left: -2rem;
      width: 14px; height: 14px;
      border-radius: 50%;
      background: var(--gold);
      border: 3px solid var(--cream);
      top: 4px;
    }
    .tl-year { font-size: .75rem; font-weight: 700; color: var(--gold); letter-spacing: 1px; margin-bottom: .3rem; }
    .tl-item h4 { font-size: 1rem; color: var(--navy); font-weight: 600; margin-bottom: .3rem; }
    .tl-item p { font-size: .88rem; color: var(--slate); line-height: 1.65; }

    /* ── CTA ── */
    .cta-section {
      background: linear-gradient(135deg, var(--gold) 0%, #A67320 100%);
      text-align: center; padding: 80px 5%;
    }
    .cta-section h2 { color: var(--white); margin-bottom: 1rem; }
    .cta-section p { color: rgba(255,255,255,.85); font-size: 1.05rem; max-width: 540px; margin: 0 auto 2rem; line-height: 1.75; }
    .btn-white {
      display: inline-block;
      background: var(--white); color: var(--gold);
      padding: .85rem 2.2rem; border-radius: 4px;
      font-weight: 700; font-size: .95rem;
      text-decoration: none; transition: opacity .2s;
    }
    .btn-white:hover { opacity: .9; }

    /* ── FOOTER ── */
    footer {
      background: var(--navy); color: rgba(255,255,255,.55);
      text-align: center; padding: 2rem 5%;
      font-size: .82rem;
    }
    footer a { color: var(--gold); text-decoration: none; }

    /* ── SCROLL REVEAL ── */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity .6s ease, transform .6s ease; }
    .reveal.visible { opacity: 1; transform: none; }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
      .nav-links, .nav-cta { display: none; }
      .hamburger { display: flex; }
      .nav-links.open {
        display: flex; flex-direction: column;
        position: absolute; top: 64px; left: 0; right: 0;
        background: var(--navy);
        padding: 1rem 5% 1.5rem;
        gap: 1.2rem;
      }
      .mv-grid { grid-template-columns: 1fr; }
      .hero-btns { flex-direction: column; }
    }

    @media (prefers-reduced-motion: reduce) {
      .reveal { opacity: 1; transform: none; transition: none; }
    }
  </style>
</head>
<body>

<!-- NAV -->
<nav>
  <div class="nav-logo">Skill<span>Pro</span> Institute</div>
  <ul class="nav-links" id="navLinks">
    <li><a href="Home.php">Home</a></li>
    <li><a href="About.php" class="active">About</a></li>
    <li><a href="Courses.php">Courses</a></li>
    <li><a href="Instructors.php">Instructors</a></li>
    <li><a href="Contact.php">Contact</a></li>
  </ul>
  <a href="#" class="nav-cta">Enroll Now</a>
  <div class="hamburger" id="hamburger" aria-label="Toggle menu">
    <span></span><span></span><span></span>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-inner">
    <span class="eyebrow">About SkillPro Institute</span>
    <h1>Empowering Sri Lanka<br>Through <em>Skilled Futures</em></h1>
    <p>Registered under TVEC, SkillPro Institute has been bridging the skills gap across Sri Lanka — equipping thousands of students with job-ready competencies in IT, engineering, hospitality, and more.</p>
    <div class="hero-btns">
      <a href="#courses" class="btn-primary">Explore Courses</a>
      <a href="#branches" class="btn-outline">Our Branches</a>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-bar">
  <div class="stat-item reveal">
    <div class="stat-num" data-target="8500">0<span>+</span></div>
    <div class="stat-label">Graduates</div>
  </div>
  <div class="stat-item reveal">
    <div class="stat-num" data-target="40">0<span>+</span></div>
    <div class="stat-label">Training Programs</div>
  </div>
  <div class="stat-item reveal">
    <div class="stat-num" data-target="3">0</div>
    <div class="stat-label">Branches Island-wide</div>
  </div>
  <div class="stat-item reveal">
    <div class="stat-num" data-target="95">0<span>%</span></div>
    <div class="stat-label">Employment Rate</div>
  </div>
</div>

<!-- MISSION / VISION -->
<section>
  <div class="section-label reveal">Who We Are</div>
  <h2 class="reveal">Our Mission &amp; Vision</h2>
  <p class="lead reveal">We believe practical skills unlock opportunities. SkillPro Institute exists to make quality vocational education accessible to every Sri Lankan — from school leavers to working professionals seeking upskilling.</p>
  <div class="mv-grid reveal">
    <div class="mv-card">
      <div class="mv-icon">🎯</div>
      <h3>Our Mission</h3>
      <p>To deliver high-quality, industry-aligned vocational training that enhances employability, supports national economic growth, and fosters lifelong learning across Sri Lanka.</p>
    </div>
    <div class="mv-card">
      <div class="mv-icon">🔭</div>
      <h3>Our Vision</h3>
      <p>To be Sri Lanka's most trusted vocational training provider — recognized for our graduate outcomes, innovative programs, and commitment to inclusive, accessible education.</p>
    </div>
  </div>
</section>

<!-- VALUES -->
<section class="values-section">
  <div class="section-label">What Drives Us</div>
  <h2>Our Core Values</h2>
  <div class="values-grid">
    <div class="value-card reveal">
      <div class="value-icon">⚡</div>
      <h3>Industry Relevance</h3>
      <p>Every curriculum is co-designed with employers to ensure what students learn is what the market actually needs.</p>
    </div>
    <div class="value-card reveal">
      <div class="value-icon">🤝</div>
      <h3>Inclusivity</h3>
      <p>We open doors regardless of background — offering flexible learning modes and financial support options.</p>
    </div>
    <div class="value-card reveal">
      <div class="value-icon">📐</div>
      <h3>Practical Excellence</h3>
      <p>Hands-on labs, industry projects, and real-world case studies sit at the heart of every program.</p>
    </div>
    <div class="value-card reveal">
      <div class="value-icon">🌱</div>
      <h3>Continuous Growth</h3>
      <p>We invest constantly in faculty development and curriculum updates to stay ahead of industry change.</p>
    </div>
    <div class="value-card reveal">
      <div class="value-icon">🏅</div>
      <h3>Integrity</h3>
      <p>Transparent processes, honest communication, and ethical practice in everything we do.</p>
    </div>
    <div class="value-card reveal">
      <div class="value-icon">🌐</div>
      <h3>National Impact</h3>
      <p>Our graduates contribute directly to Sri Lanka's workforce, economy, and communities.</p>
    </div>
  </div>
</section>

<!-- BRANCHES -->
<section id="branches">
  <div class="section-label reveal">Where We Are</div>
  <h2 class="reveal">Three Branches, One Standard</h2>
  <p class="lead reveal">Strategically located in Sri Lanka's key cities, each branch delivers the same quality programs with locally relevant industry connections.</p>
  <div class="branches-grid">
    <div class="branch-card reveal">
      <div class="branch-header">
        <div class="branch-badge">🏙️</div>
        <div>
          <h3>Colombo</h3>
          <span>Western Province — Main Campus</span>
        </div>
      </div>
      <div class="branch-body">
        <p>Our flagship campus in the commercial capital, equipped with advanced IT labs, a simulation kitchen, and dedicated workshop spaces for engineering trades.</p>
        <span class="branch-tag">ICT</span>
        <span class="branch-tag">Hotel Management</span>
        <span class="branch-tag">Plumbing</span>
        <span class="branch-tag">Welding</span>
      </div>
    </div>
    <div class="branch-card reveal">
      <div class="branch-header">
        <div class="branch-badge">🏔️</div>
        <div>
          <h3>Kandy</h3>
          <span>Central Province</span>
        </div>
      </div>
      <div class="branch-body">
        <p>Serving the central highlands, our Kandy branch focuses on tourism and hospitality alongside technical trades, supporting the region's thriving visitor economy.</p>
        <span class="branch-tag">Tourism</span>
        <span class="branch-tag">Hospitality</span>
        <span class="branch-tag">Engineering</span>
        <span class="branch-tag">ICT</span>
      </div>
    </div>
    <div class="branch-card reveal">
      <div class="branch-header">
        <div class="branch-badge">🌊</div>
        <div>
          <h3>Matara</h3>
          <span>Southern Province</span>
        </div>
      </div>
      <div class="branch-body">
        <p>Our southern campus connects graduates with the region's growing port-adjacent industries and tourism sector, creating pathways to meaningful local employment.</p>
        <span class="branch-tag">Marine Engineering</span>
        <span class="branch-tag">ICT</span>
        <span class="branch-tag">Welding</span>
      </div>
    </div>
  </div>
</section>

<!-- TEAM -->
<section style="background:var(--white);">
  <div class="section-label reveal">The People Behind It</div>
  <h2 class="reveal">Meet Our Leadership</h2>
  <div class="team-grid">
    <div class="team-card reveal">
      <div class="avatar">👩‍💼</div>
      <h4>Dr. Priya Jayawardena</h4>
      <div class="role">Director General</div>
      <p class="bio">20+ years in vocational education policy. Former TVEC board member passionate about closing Sri Lanka's skills gap.</p>
    </div>
    <div class="team-card reveal">
      <div class="avatar">👨‍🏫</div>
      <h4>Mr. Rohan Perera</h4>
      <div class="role">Head of ICT Programs</div>
      <p class="bio">MSc Computer Science, University of Moratuwa. Industry practitioner with ties to the Colombo tech ecosystem.</p>
    </div>
    <div class="team-card reveal">
      <div class="avatar">👩‍🍳</div>
      <h4>Ms. Niluka Fernando</h4>
      <div class="role">Head of Hospitality</div>
      <p class="bio">Certified by the Sri Lanka Tourism Development Authority with 15 years in five-star hotel operations.</p>
    </div>
    <div class="team-card reveal">
      <div class="avatar">👨‍🔧</div>
      <h4>Mr. Chamara Silva</h4>
      <div class="role">Head of Engineering Trades</div>
      <p class="bio">Chartered Engineer and former NAITA instructor dedicated to hands-on, industry-standard technical training.</p>
    </div>
  </div>
</section>

<!-- ACCREDITATION -->
<section class="accred-section">
  <div class="section-label reveal">Recognition</div>
  <h2 class="reveal">Accreditation &amp; Partnerships</h2>
  <p class="lead reveal">Our programs are nationally recognized and industry-validated, giving graduates credentials that employers trust.</p>
  <div class="accred-strip">
    <div class="accred-badge reveal">
      <div class="badge-icon">🏛️</div>
      <div>
        <h4>TVEC Registered</h4>
        <p>Tertiary &amp; Vocational Education Commission</p>
      </div>
    </div>
    <div class="accred-badge reveal">
      <div class="badge-icon">🎓</div>
      <div>
        <h4>NVQ Certified</h4>
        <p>National Vocational Qualifications Framework</p>
      </div>
    </div>
    <div class="accred-badge reveal">
      <div class="badge-icon">🏭</div>
      <div>
        <h4>Industry Partners</h4>
        <p>Collaborations with 30+ leading employers</p>
      </div>
    </div>
    <div class="accred-badge reveal">
      <div class="badge-icon">🌍</div>
      <div>
        <h4>International Recognition</h4>
        <p>City &amp; Guilds affiliated programs</p>
      </div>
    </div>
  </div>
</section>

<!-- TIMELINE -->
<section>
  <div class="section-label reveal">Our Journey</div>
  <h2 class="reveal">A Decade of Skill Building</h2>
  <div class="timeline">
    <div class="tl-item reveal">
      <div class="tl-dot"></div>
      <div class="tl-year">2013</div>
      <h4>Founded in Colombo</h4>
      <p>SkillPro Institute opened its doors with 3 programs and 120 students, registered under TVEC.</p>
    </div>
    <div class="tl-item reveal">
      <div class="tl-dot"></div>
      <div class="tl-year">2016</div>
      <h4>Kandy Branch Launch</h4>
      <p>Expanded to the Central Province, introducing tourism and hospitality programs tailored to the region.</p>
    </div>
    <div class="tl-item reveal">
      <div class="tl-dot"></div>
      <div class="tl-year">2019</div>
      <h4>Matara Campus &amp; NVQ Partnership</h4>
      <p>Opened our southern campus and secured full NVQ certification across all engineering programs.</p>
    </div>
    <div class="tl-item reveal">
      <div class="tl-dot"></div>
      <div class="tl-year">2022</div>
      <h4>Online Learning Platform</h4>
      <p>Launched hybrid learning options, enabling students across the island to access SkillPro programs remotely.</p>
    </div>
    <div class="tl-item reveal">
      <div class="tl-dot"></div>
      <div class="tl-year">2025</div>
      <h4>Digital Transformation</h4>
      <p>Launched our full web application — enabling online registration, student portals, and digital course management.</p>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <h2 class="reveal">Ready to Build Your Future?</h2>
  <p class="reveal">Join over 8,500 SkillPro graduates who have transformed their careers with nationally recognised qualifications.</p>
  <a href="#" class="btn-white reveal">Browse All Courses</a>
</section>

<!-- FOOTER -->
<footer>
  <p>© 2025 SkillPro Institute. Registered under TVEC, Sri Lanka. | Colombo · Kandy · Matara</p>
  <p style="margin-top:.5rem;">Developed for CSE5009 Web Application Development — <a href="#">ICBT Campus</a></p>
</footer>

<script>
  // Hamburger menu
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('navLinks');
  hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });

  // Scroll reveal
  const revealEls = document.querySelectorAll('.reveal');
  const observer  = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  revealEls.forEach(el => observer.observe(el));

  // Animated counters
  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const suffix = el.querySelector('span') ? el.querySelector('span').outerHTML : '';
    const duration = 1400;
    const start = performance.now();
    function step(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.round(eased * target);
      el.innerHTML = current.toLocaleString() + suffix;
      if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  const statNums = document.querySelectorAll('.stat-num[data-target]');
  const statObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        statObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  statNums.forEach(el => statObserver.observe(el));
</script>
</body>
</html>