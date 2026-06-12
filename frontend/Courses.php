<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Courses – SkillPro Institute</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --navy:  #0D2137;
      --gold:  #C9932A;
      --cream: #FAF7F2;
      --slate: #4A5C6E;
      --light: #E8EFF5;
      --white: #FFFFFF;
      --text:  #1A2B3C;
      --green: #1E7C4B;
      --red:   #C0392B;
    }

    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; background: var(--cream); color: var(--text); overflow-x: hidden; }

    /* ── NAV ── */
    nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 200;
      background: var(--navy);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 5%; height: 64px;
    }
    .nav-logo { font-family: 'Playfair Display', serif; color: var(--white); font-size: 1.35rem; letter-spacing: .5px; text-decoration: none; }
    .nav-logo span { color: var(--gold); }
    .nav-links { display: flex; gap: 2rem; list-style: none; }
    .nav-links a { color: rgba(255,255,255,.75); text-decoration: none; font-size: .875rem; font-weight: 500; transition: color .2s; }
    .nav-links a:hover, .nav-links a.active { color: var(--gold); }
    .nav-cta { background: var(--gold); color: var(--white); padding: .5rem 1.25rem; border-radius: 4px; font-size: .875rem; font-weight: 600; text-decoration: none; transition: opacity .2s; }
    .nav-cta:hover { opacity: .85; }
    .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
    .hamburger span { display: block; width: 24px; height: 2px; background: var(--white); transition: .3s; }

    /* ── HERO ── */
    .hero {
      margin-top: 64px;
      background: linear-gradient(135deg, var(--navy) 55%, #1A3A5C 100%);
      padding: 72px 5% 60px;
      position: relative; overflow: hidden;
    }
    .hero::after {
      content: ''; position: absolute; right: -60px; top: -60px;
      width: 380px; height: 380px; border-radius: 50%;
      background: radial-gradient(circle, rgba(201,147,42,.2) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero-inner { max-width: 680px; position: relative; }
    .eyebrow { display: inline-block; color: var(--gold); font-size: .78rem; font-weight: 600; letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 1rem; }
    .hero h1 { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4.5vw, 3.2rem); color: var(--white); line-height: 1.2; margin-bottom: 1rem; }
    .hero h1 em { color: var(--gold); font-style: normal; }
    .hero p { color: rgba(255,255,255,.72); font-size: 1rem; line-height: 1.75; max-width: 520px; }

    /* ── SEARCH & FILTER BAR ── */
    .filter-bar {
      background: var(--white);
      border-bottom: 2px solid var(--light);
      padding: 1.4rem 5%;
      position: sticky; top: 64px; z-index: 100;
      display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;
    }
    .search-wrap { position: relative; flex: 1 1 280px; }
    .search-wrap input {
      width: 100%; padding: .65rem 1rem .65rem 2.8rem;
      border: 1.5px solid var(--light); border-radius: 4px;
      font-size: .9rem; font-family: inherit; color: var(--text);
      background: var(--cream); outline: none; transition: border-color .2s;
    }
    .search-wrap input:focus { border-color: var(--gold); }
    .search-icon { position: absolute; left: .85rem; top: 50%; transform: translateY(-50%); font-size: 1rem; pointer-events: none; }
    .filter-group { display: flex; flex-wrap: wrap; gap: .6rem; }
    .filter-btn {
      padding: .5rem 1rem; border-radius: 20px; font-size: .82rem; font-weight: 500; cursor: pointer;
      border: 1.5px solid var(--light); background: transparent; color: var(--slate);
      transition: all .2s; font-family: inherit;
    }
    .filter-btn:hover, .filter-btn.active { background: var(--navy); color: var(--white); border-color: var(--navy); }
    .filter-btn.gold.active { background: var(--gold); border-color: var(--gold); }
    .results-count { margin-left: auto; font-size: .83rem; color: var(--slate); white-space: nowrap; }

    /* ── MAIN LAYOUT ── */
    .page-body { display: flex; gap: 0; min-height: 600px; }

    /* SIDEBAR */
    .sidebar {
      width: 260px; flex-shrink: 0;
      background: var(--white);
      border-right: 1px solid var(--light);
      padding: 2rem 1.5rem;
      position: sticky; top: calc(64px + 65px);
      height: calc(100vh - 129px); overflow-y: auto;
    }
    .sidebar h3 { font-size: .7rem; font-weight: 700; color: var(--gold); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 1rem; }
    .sidebar-section { margin-bottom: 2rem; }
    .check-item { display: flex; align-items: center; gap: .6rem; margin-bottom: .6rem; cursor: pointer; }
    .check-item input[type=checkbox] { accent-color: var(--gold); width: 15px; height: 15px; cursor: pointer; }
    .check-item label { font-size: .875rem; color: var(--slate); cursor: pointer; }
    .check-item label span { float: right; font-size: .75rem; color: var(--light); background: var(--navy); padding: .1rem .45rem; border-radius: 10px; }
    .duration-range { width: 100%; accent-color: var(--gold); margin-top: .5rem; }
    .duration-label { font-size: .82rem; color: var(--slate); margin-top: .4rem; }
    .sidebar-divider { border: none; border-top: 1px solid var(--light); margin: 1.2rem 0; }
    .clear-btn { width: 100%; padding: .5rem; background: transparent; border: 1.5px solid var(--light); border-radius: 4px; font-size: .82rem; color: var(--slate); cursor: pointer; font-family: inherit; transition: all .2s; }
    .clear-btn:hover { border-color: var(--red); color: var(--red); }

    /* COURSE GRID */
    .course-area { flex: 1; padding: 2.5rem 5% 4rem; }
    .course-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    /* COURSE CARD */
    .course-card {
      background: var(--white);
      border: 1px solid var(--light);
      border-radius: 8px; overflow: hidden;
      transition: box-shadow .25s, transform .25s;
      display: flex; flex-direction: column;
      position: relative;
    }
    .course-card:hover { box-shadow: 0 14px 40px rgba(13,33,55,.1); transform: translateY(-5px); }
    .card-thumb {
      height: 140px;
      display: flex; align-items: center; justify-content: center;
      font-size: 3.5rem;
      position: relative;
    }
    .badge-mode {
      position: absolute; top: .75rem; right: .75rem;
      font-size: .7rem; font-weight: 700; padding: .2rem .6rem;
      border-radius: 20px; letter-spacing: .5px;
    }
    .badge-mode.online   { background: #E8F5E9; color: var(--green); }
    .badge-mode.onsite   { background: #E3F2FD; color: #1565C0; }
    .badge-mode.hybrid   { background: #FFF3E0; color: #E65100; }
    .badge-new {
      position: absolute; top: .75rem; left: .75rem;
      background: var(--gold); color: var(--white);
      font-size: .65rem; font-weight: 700; padding: .2rem .55rem;
      border-radius: 20px; letter-spacing: .5px;
    }
    .card-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
    .card-cat { font-size: .72rem; font-weight: 700; color: var(--gold); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: .4rem; }
    .card-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--navy); margin-bottom: .5rem; line-height: 1.3; }
    .card-desc { font-size: .85rem; color: var(--slate); line-height: 1.65; flex: 1; margin-bottom: 1rem; }
    .card-meta { display: flex; flex-wrap: wrap; gap: .5rem; margin-bottom: 1rem; }
    .meta-chip {
      font-size: .75rem; color: var(--slate);
      background: var(--light); padding: .22rem .65rem; border-radius: 20px;
      display: flex; align-items: center; gap: .3rem;
    }
    .card-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--light); padding-top: 1rem; }
    .card-fee { font-family: 'Playfair Display', serif; font-size: 1.15rem; color: var(--navy); }
    .card-fee small { font-family: 'Inter', sans-serif; font-size: .72rem; color: var(--slate); font-weight: 400; display: block; }
    .btn-enroll {
      background: var(--navy); color: var(--white);
      padding: .5rem 1.1rem; border-radius: 4px;
      font-size: .8rem; font-weight: 600; cursor: pointer;
      border: none; font-family: inherit; transition: background .2s;
    }
    .btn-enroll:hover { background: var(--gold); }
    .no-results { grid-column: 1/-1; text-align: center; padding: 4rem 2rem; color: var(--slate); }
    .no-results .icon { font-size: 3rem; margin-bottom: 1rem; }
    .no-results h3 { font-size: 1.2rem; color: var(--navy); margin-bottom: .5rem; }

    /* ── MODAL ── */
    .modal-overlay {
      position: fixed; inset: 0; z-index: 500;
      background: rgba(13,33,55,.65);
      display: flex; align-items: center; justify-content: center;
      padding: 1rem;
      opacity: 0; pointer-events: none; transition: opacity .25s;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal {
      background: var(--white); border-radius: 10px;
      width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto;
      transform: translateY(24px); transition: transform .25s;
    }
    .modal-overlay.open .modal { transform: none; }
    .modal-header {
      background: var(--navy); padding: 1.5rem 2rem;
      display: flex; justify-content: space-between; align-items: flex-start;
      border-radius: 10px 10px 0 0;
    }
    .modal-header h2 { font-family: 'Playfair Display', serif; color: var(--white); font-size: 1.3rem; line-height: 1.3; }
    .modal-header .course-cat { color: var(--gold); font-size: .75rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: .3rem; }
    .modal-close { background: none; border: none; color: rgba(255,255,255,.6); font-size: 1.5rem; cursor: pointer; line-height: 1; padding: 0; transition: color .2s; flex-shrink: 0; }
    .modal-close:hover { color: var(--white); }
    .modal-body { padding: 2rem; }
    .modal-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; }
    .info-block { background: var(--cream); border-radius: 6px; padding: .9rem 1rem; }
    .info-block .label { font-size: .7rem; font-weight: 700; color: var(--gold); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: .25rem; }
    .info-block .value { font-size: .92rem; color: var(--navy); font-weight: 500; }
    .modal-section-title { font-size: .75rem; font-weight: 700; color: var(--gold); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: .75rem; }
    .outcome-list { list-style: none; margin-bottom: 1.5rem; }
    .outcome-list li { font-size: .88rem; color: var(--slate); padding: .4rem 0; border-bottom: 1px solid var(--light); display: flex; align-items: flex-start; gap: .6rem; }
    .outcome-list li::before { content: '✓'; color: var(--green); font-weight: 700; flex-shrink: 0; }
    .enroll-form { border-top: 1px solid var(--light); padding-top: 1.5rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
    .form-group { display: flex; flex-direction: column; gap: .4rem; margin-bottom: 1rem; }
    .form-group label { font-size: .8rem; font-weight: 600; color: var(--navy); }
    .form-group input, .form-group select {
      padding: .65rem .9rem; border: 1.5px solid var(--light); border-radius: 4px;
      font-size: .88rem; font-family: inherit; color: var(--text);
      background: var(--cream); outline: none; transition: border-color .2s;
    }
    .form-group input:focus, .form-group select:focus { border-color: var(--gold); }
    .form-group .error-msg { font-size: .75rem; color: var(--red); display: none; }
    .form-group.has-error input, .form-group.has-error select { border-color: var(--red); }
    .form-group.has-error .error-msg { display: block; }
    .btn-submit {
      width: 100%; background: var(--gold); color: var(--white);
      padding: .85rem; border: none; border-radius: 4px;
      font-size: .95rem; font-weight: 600; cursor: pointer; font-family: inherit;
      transition: opacity .2s;
    }
    .btn-submit:hover { opacity: .88; }
    .success-state { text-align: center; padding: 2rem 1rem; display: none; }
    .success-state .tick { font-size: 3rem; margin-bottom: 1rem; }
    .success-state h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--navy); margin-bottom: .75rem; }
    .success-state p { color: var(--slate); font-size: .92rem; line-height: 1.65; }

    /* ── SCROLL REVEAL ── */
    .reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
    .reveal.visible { opacity: 1; transform: none; }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
      .sidebar { display: none; }
    }
    @media (max-width: 768px) {
      .nav-links, .nav-cta { display: none; }
      .hamburger { display: flex; }
      .nav-links.open {
        display: flex; flex-direction: column;
        position: absolute; top: 64px; left: 0; right: 0;
        background: var(--navy); padding: 1rem 5% 1.5rem; gap: 1.2rem;
      }
      .form-row { grid-template-columns: 1fr; }
      .modal-info-grid { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) {
      .reveal { opacity: 1; transform: none; transition: none; }
    }
  </style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="about.html" class="nav-logo">Skill<span>Pro</span> Institute</a>
  <ul class="nav-links" id="navLinks">
    <li><a href="#">Home</a></li>
    <li><a href="about.html">About</a></li>
    <li><a href="courses.html" class="active">Courses</a></li>
    <li><a href="#">Instructors</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
  <a href="#" class="nav-cta">Student Portal</a>
  <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-inner">
    <span class="eyebrow">Training Programs</span>
    <h1>Find Your <em>Perfect Course</em><br>and Build a Career</h1>
    <p>Explore 40+ nationally recognized programs across IT, engineering, hospitality, and more — offered online, on-site, or hybrid across our three branches.</p>
  </div>
</section>

<!-- FILTER BAR -->
<div class="filter-bar">
  <div class="search-wrap">
    <span class="search-icon">🔍</span>
    <input type="text" id="searchInput" placeholder="Search courses, skills, instructors…" autocomplete="off"/>
  </div>
  <div class="filter-group" id="catFilters">
    <button class="filter-btn active" data-cat="all">All</button>
    <button class="filter-btn" data-cat="ict">ICT</button>
    <button class="filter-btn" data-cat="engineering">Engineering</button>
    <button class="filter-btn" data-cat="hospitality">Hospitality</button>
    <button class="filter-btn" data-cat="tourism">Tourism</button>
    <button class="filter-btn" data-cat="management">Management</button>
  </div>
  <div class="results-count" id="resultsCount">Showing 12 courses</div>
</div>

<!-- PAGE BODY -->
<div class="page-body">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-section">
      <h3>Delivery Mode</h3>
      <div class="check-item"><input type="checkbox" id="f-online" data-filter="mode" value="online" checked><label for="f-online">Online <span>8</span></label></div>
      <div class="check-item"><input type="checkbox" id="f-onsite" data-filter="mode" value="onsite" checked><label for="f-onsite">On-site <span>6</span></label></div>
      <div class="check-item"><input type="checkbox" id="f-hybrid" data-filter="mode" value="hybrid" checked><label for="f-hybrid">Hybrid <span>4</span></label></div>
    </div>
    <hr class="sidebar-divider"/>
    <div class="sidebar-section">
      <h3>Branch</h3>
      <div class="check-item"><input type="checkbox" id="f-colombo" data-filter="branch" value="colombo" checked><label for="f-colombo">Colombo <span>10</span></label></div>
      <div class="check-item"><input type="checkbox" id="f-kandy" data-filter="branch" value="kandy" checked><label for="f-kandy">Kandy <span>8</span></label></div>
      <div class="check-item"><input type="checkbox" id="f-matara" data-filter="branch" value="matara" checked><label for="f-matara">Matara <span>6</span></label></div>
    </div>
    <hr class="sidebar-divider"/>
    <div class="sidebar-section">
      <h3>NVQ Level</h3>
      <div class="check-item"><input type="checkbox" id="f-l3" data-filter="nvq" value="3" checked><label for="f-l3">Level 3 <span>4</span></label></div>
      <div class="check-item"><input type="checkbox" id="f-l4" data-filter="nvq" value="4" checked><label for="f-l4">Level 4 <span>5</span></label></div>
      <div class="check-item"><input type="checkbox" id="f-l5" data-filter="nvq" value="5" checked><label for="f-l5">Level 5 <span>3</span></label></div>
    </div>
    <hr class="sidebar-divider"/>
    <button class="clear-btn" id="clearFilters">✕ Clear Filters</button>
  </aside>

  <!-- COURSE GRID -->
  <div class="course-area">
    <div class="course-grid" id="courseGrid"></div>
  </div>
</div>

<!-- ENROLLMENT MODAL -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-header">
      <div>
        <div class="course-cat" id="modalCat"></div>
        <h2 id="modalTitle"></h2>
      </div>
      <button class="modal-close" id="modalClose" aria-label="Close">✕</button>
    </div>
    <div class="modal-body">
      <div class="modal-info-grid" id="modalInfoGrid"></div>

      <div class="modal-section-title">What You'll Learn</div>
      <ul class="outcome-list" id="modalOutcomes"></ul>

      <!-- ENROLLMENT FORM -->
      <div class="enroll-form" id="enrollForm">
        <div class="modal-section-title">Register for This Course</div>
        <div class="form-row">
          <div class="form-group" id="fg-fname">
            <label for="inp-fname">First Name</label>
            <input type="text" id="inp-fname" placeholder="Kasun"/>
            <span class="error-msg">Please enter your first name.</span>
          </div>
          <div class="form-group" id="fg-lname">
            <label for="inp-lname">Last Name</label>
            <input type="text" id="inp-lname" placeholder="Perera"/>
            <span class="error-msg">Please enter your last name.</span>
          </div>
        </div>
        <div class="form-group" id="fg-email">
          <label for="inp-email">Email Address</label>
          <input type="email" id="inp-email" placeholder="kasun@email.com"/>
          <span class="error-msg">Please enter a valid email address.</span>
        </div>
        <div class="form-group" id="fg-phone">
          <label for="inp-phone">Mobile Number</label>
          <input type="tel" id="inp-phone" placeholder="07X XXX XXXX"/>
          <span class="error-msg">Please enter a valid Sri Lanka phone number.</span>
        </div>
        <div class="form-row">
          <div class="form-group" id="fg-mode">
            <label for="inp-mode">Learning Mode</label>
            <select id="inp-mode">
              <option value="">Select mode…</option>
              <option value="online">Online</option>
              <option value="onsite">On-site</option>
              <option value="hybrid">Hybrid</option>
            </select>
            <span class="error-msg">Please select a learning mode.</span>
          </div>
          <div class="form-group" id="fg-branch">
            <label for="inp-branch">Preferred Branch</label>
            <select id="inp-branch">
              <option value="">Select branch…</option>
              <option value="colombo">Colombo</option>
              <option value="kandy">Kandy</option>
              <option value="matara">Matara</option>
            </select>
            <span class="error-msg">Please select a branch.</span>
          </div>
        </div>
        <button class="btn-submit" id="submitEnroll">Submit Enrollment Request</button>
      </div>

      <!-- SUCCESS -->
      <div class="success-state" id="successState">
        <div class="tick">🎉</div>
        <h3>Enrollment Request Received!</h3>
        <p>Thank you, <strong id="successName"></strong>. Our admissions team will contact you within 2 working days at <strong id="successEmail"></strong> to confirm your place and share payment details.</p>
      </div>
    </div>
  </div>
</div>

<script>
// ── COURSE DATA ──────────────────────────────────────────────────
const courses = [
  {
    id: 1, cat: 'ict', catLabel: 'ICT',
    title: 'Diploma in Software Engineering',
    desc: 'Comprehensive program covering full-stack web development, databases, and software project management.',
    icon: '💻', thumb: '#1A3A5C',
    duration: '12 Months', mode: 'hybrid', nvq: '5',
    branch: ['colombo', 'kandy'],
    fee: 'Rs. 48,000', intake: 'Aug 2025',
    instructor: 'Mr. Rohan Perera',
    isNew: true,
    outcomes: ['Build full-stack web applications', 'Design relational databases', 'Apply Agile project methodologies', 'Deploy apps to cloud platforms', 'Write clean, documented code']
  },
  {
    id: 2, cat: 'ict', catLabel: 'ICT',
    title: 'Certificate in Networking & Cybersecurity',
    desc: 'Industry-aligned program covering network infrastructure, security protocols, and ethical hacking fundamentals.',
    icon: '🔐', thumb: '#0D3349',
    duration: '6 Months', mode: 'onsite', nvq: '4',
    branch: ['colombo'],
    fee: 'Rs. 32,000', intake: 'Sep 2025',
    instructor: 'Ms. Dilrukshi Rathnayake',
    isNew: false,
    outcomes: ['Configure routers and switches', 'Implement firewall security policies', 'Conduct basic penetration tests', 'Monitor network performance', 'Obtain CompTIA Network+ readiness']
  },
  {
    id: 3, cat: 'ict', catLabel: 'ICT',
    title: 'Web Design & UI/UX',
    desc: 'Learn modern web design principles, HTML/CSS/JS, and user experience design using industry tools.',
    icon: '🎨', thumb: '#1B4F72',
    duration: '4 Months', mode: 'online', nvq: '3',
    branch: ['colombo', 'kandy', 'matara'],
    fee: 'Rs. 22,000', intake: 'Jul 2025',
    instructor: 'Ms. Hiruni Wijesinghe',
    isNew: true,
    outcomes: ['Design responsive web layouts', 'Use Figma for UI prototyping', 'Apply UX research methods', 'Implement CSS animations', 'Build a professional portfolio']
  },
  {
    id: 4, cat: 'engineering', catLabel: 'Engineering',
    title: 'NVQ Plumbing (Level 4)',
    desc: 'Hands-on technical training in residential and commercial plumbing systems, pipework, and installations.',
    icon: '🔧', thumb: '#1E3A2F',
    duration: '6 Months', mode: 'onsite', nvq: '4',
    branch: ['colombo', 'matara'],
    fee: 'Rs. 28,000', intake: 'Aug 2025',
    instructor: 'Mr. Chamara Silva',
    isNew: false,
    outcomes: ['Install domestic plumbing systems', 'Read and interpret technical drawings', 'Test and commission water systems', 'Apply health and safety regulations', 'Maintain and repair pipework']
  },
  {
    id: 5, cat: 'engineering', catLabel: 'Engineering',
    title: 'NVQ Welding & Fabrication',
    desc: 'Professional welding training covering MIG, TIG, and arc welding techniques to industry standards.',
    icon: '⚙️', thumb: '#2C1810',
    duration: '6 Months', mode: 'onsite', nvq: '4',
    branch: ['colombo', 'matara'],
    fee: 'Rs. 26,000', intake: 'Sep 2025',
    instructor: 'Mr. Pradeep Bandara',
    isNew: false,
    outcomes: ['Perform MIG and TIG welding', 'Read engineering drawings', 'Fabricate metal structures', 'Apply welding safety protocols', 'Inspect weld quality to standards']
  },
  {
    id: 6, cat: 'engineering', catLabel: 'Engineering',
    title: 'Electrical Installation (NVQ 3)',
    desc: 'Foundational training in domestic and industrial electrical installations, wiring, and safety compliance.',
    icon: '⚡', thumb: '#1A1A2E',
    duration: '4 Months', mode: 'hybrid', nvq: '3',
    branch: ['colombo', 'kandy'],
    fee: 'Rs. 20,000', intake: 'Oct 2025',
    instructor: 'Mr. Nimal Gunawardena',
    isNew: false,
    outcomes: ['Install domestic wiring systems', 'Test electrical circuits safely', 'Read wiring diagrams', 'Apply IEE Wiring Regulations', 'Troubleshoot common faults']
  },
  {
    id: 7, cat: 'hospitality', catLabel: 'Hospitality',
    title: 'Diploma in Hotel Management',
    desc: 'Comprehensive program covering front office operations, food & beverage service, and housekeeping management.',
    icon: '🏨', thumb: '#4A2040',
    duration: '12 Months', mode: 'onsite', nvq: '5',
    branch: ['colombo', 'kandy'],
    fee: 'Rs. 55,000', intake: 'Aug 2025',
    instructor: 'Ms. Niluka Fernando',
    isNew: false,
    outcomes: ['Manage front office operations', 'Lead food & beverage teams', 'Apply housekeeping standards', 'Handle guest relations professionally', 'Understand hotel financial management']
  },
  {
    id: 8, cat: 'hospitality', catLabel: 'Hospitality',
    title: 'Professional Culinary Arts',
    desc: 'Develop professional cooking skills, kitchen management, and international cuisine techniques.',
    icon: '👨‍🍳', thumb: '#3D2B1F',
    duration: '8 Months', mode: 'onsite', nvq: '4',
    branch: ['colombo'],
    fee: 'Rs. 38,000', intake: 'Sep 2025',
    instructor: 'Chef Anusha Mendis',
    isNew: true,
    outcomes: ['Master classical and Asian cooking techniques', 'Plan and cost menus', 'Apply food safety and hygiene', 'Manage kitchen operations', 'Plate and present dishes professionally']
  },
  {
    id: 9, cat: 'tourism', catLabel: 'Tourism',
    title: 'Certificate in Tourism & Travel',
    desc: 'Explore Sri Lanka's tourism industry, tour guiding, travel operations, and sustainable tourism practices.',
    icon: '✈️', thumb: '#0D3349',
    duration: '6 Months', mode: 'hybrid', nvq: '4',
    branch: ['kandy', 'matara'],
    fee: 'Rs. 25,000', intake: 'Jul 2025',
    instructor: 'Mr. Saman Weerasekara',
    isNew: false,
    outcomes: ['Guide cultural and heritage tours', 'Operate travel booking systems', 'Apply sustainable tourism principles', 'Communicate with international visitors', 'Manage tour logistics and itineraries']
  },
  {
    id: 10, cat: 'tourism', catLabel: 'Tourism',
    title: 'Event Planning & Management',
    desc: 'Plan, organize, and manage corporate events, weddings, and festivals from concept to execution.',
    icon: '🎪', thumb: '#2D1B69',
    duration: '4 Months', mode: 'online', nvq: '3',
    branch: ['colombo', 'kandy'],
    fee: 'Rs. 18,000', intake: 'Aug 2025',
    instructor: 'Ms. Thilini Jayakody',
    isNew: true,
    outcomes: ['Plan event budgets and timelines', 'Manage vendors and suppliers', 'Design event marketing materials', 'Coordinate on-site logistics', 'Evaluate event success metrics']
  },
  {
    id: 11, cat: 'management', catLabel: 'Management',
    title: 'Business Management (NVQ 5)',
    desc: 'Advanced management program covering leadership, strategy, human resources, and business operations.',
    icon: '📊', thumb: '#1B2A4A',
    duration: '12 Months', mode: 'hybrid', nvq: '5',
    branch: ['colombo'],
    fee: 'Rs. 52,000', intake: 'Aug 2025',
    instructor: 'Dr. Priya Jayawardena',
    isNew: false,
    outcomes: ['Develop business strategies', 'Lead and motivate teams', 'Analyse financial statements', 'Apply HR management principles', 'Create operational improvement plans']
  },
  {
    id: 12, cat: 'management', catLabel: 'Management',
    title: 'Retail & Sales Management',
    desc: 'Practical training in sales techniques, customer service excellence, and retail store operations.',
    icon: '🛍️', thumb: '#2E4057',
    duration: '4 Months', mode: 'online', nvq: '3',
    branch: ['colombo', 'kandy', 'matara'],
    fee: 'Rs. 16,000', intake: 'Sep 2025',
    instructor: 'Mr. Akila Rajapaksa',
    isNew: false,
    outcomes: ['Apply sales psychology techniques', 'Manage retail inventory systems', 'Handle customer complaints', 'Achieve sales targets', 'Build customer loyalty programs']
  }
];

// ── STATE ───────────────────────────────────────────────────────
let activeCat  = 'all';
let searchTerm = '';
let activeCourse = null;

// ── RENDER ──────────────────────────────────────────────────────
function modeLabel(m) {
  return { online: 'Online', onsite: 'On-site', hybrid: 'Hybrid' }[m] || m;
}

function renderCards() {
  const grid = document.getElementById('courseGrid');
  const count = document.getElementById('resultsCount');
  const checkedModes   = [...document.querySelectorAll('[data-filter="mode"]:checked')].map(i => i.value);
  const checkedBranches = [...document.querySelectorAll('[data-filter="branch"]:checked')].map(i => i.value);
  const checkedNvq     = [...document.querySelectorAll('[data-filter="nvq"]:checked')].map(i => i.value);

  const filtered = courses.filter(c => {
    if (activeCat !== 'all' && c.cat !== activeCat) return false;
    if (!checkedModes.includes(c.mode)) return false;
    if (!c.branch.some(b => checkedBranches.includes(b))) return false;
    if (!checkedNvq.includes(c.nvq)) return false;
    if (searchTerm) {
      const hay = (c.title + c.desc + c.catLabel + c.instructor).toLowerCase();
      if (!hay.includes(searchTerm.toLowerCase())) return false;
    }
    return true;
  });

  count.textContent = `Showing ${filtered.length} course${filtered.length !== 1 ? 's' : ''}`;

  if (!filtered.length) {
    grid.innerHTML = `<div class="no-results"><div class="icon">🔍</div><h3>No courses found</h3><p>Try adjusting your filters or search term.</p></div>`;
    return;
  }

  grid.innerHTML = filtered.map(c => `
    <div class="course-card reveal" data-id="${c.id}" style="cursor:pointer;" onclick="window.location='course-detail.html?id=${c.id}'">
      <div class="card-thumb" style="background:${c.thumb}">
        <span>${c.icon}</span>
        ${c.isNew ? '<span class="badge-new">NEW</span>' : ''}
        <span class="badge-mode ${c.mode}">${modeLabel(c.mode)}</span>
      </div>
      <div class="card-body">
        <div class="card-cat">${c.catLabel}</div>
        <div class="card-title">${c.title}</div>
        <div class="card-desc">${c.desc}</div>
        <div class="card-meta">
          <span class="meta-chip">⏱ ${c.duration}</span>
          <span class="meta-chip">🎓 NVQ ${c.nvq}</span>
          <span class="meta-chip">📅 ${c.intake}</span>
        </div>
        <div class="card-footer">
          <div class="card-fee">${c.fee}<small>per program</small></div>
          <div style="display:flex;gap:.5rem;">
            <a href="course-detail.html?id=${c.id}" class="btn-details" onclick="event.stopPropagation()">Details</a>
            <button class="btn-enroll" data-id="${c.id}" onclick="event.stopPropagation()">Enroll Now</button>
          </div>
        </div>
      </div>
    </div>
  `).join('');

  // Reveal animation
  setTimeout(() => {
    document.querySelectorAll('.course-card.reveal').forEach(el => el.classList.add('visible'));
  }, 60);

  // Attach enroll handlers
  document.querySelectorAll('.btn-enroll').forEach(btn => {
    btn.addEventListener('click', e => { e.stopPropagation(); openModal(+btn.dataset.id); });
  });
}

// ── MODAL ───────────────────────────────────────────────────────
function openModal(id) {
  const c = courses.find(x => x.id === id);
  if (!c) return;
  activeCourse = c;

  document.getElementById('modalCat').textContent   = c.catLabel;
  document.getElementById('modalTitle').textContent = c.title;
  document.getElementById('modalInfoGrid').innerHTML = [
    { label: 'Duration',    value: c.duration },
    { label: 'Mode',        value: modeLabel(c.mode) },
    { label: 'NVQ Level',   value: 'Level ' + c.nvq },
    { label: 'Program Fee', value: c.fee },
    { label: 'Next Intake', value: c.intake },
    { label: 'Instructor',  value: c.instructor },
    { label: 'Branches',    value: c.branch.map(b => b[0].toUpperCase()+b.slice(1)).join(', ') },
    { label: 'Accreditation', value: 'TVEC / NVQ Certified' }
  ].map(i => `<div class="info-block"><div class="label">${i.label}</div><div class="value">${i.value}</div></div>`).join('');

  document.getElementById('modalOutcomes').innerHTML = c.outcomes.map(o => `<li>${o}</li>`).join('');

  // Reset form
  document.getElementById('enrollForm').style.display = '';
  document.getElementById('successState').style.display = 'none';
  ['fname','lname','email','phone','mode','branch'].forEach(f => {
    const fg = document.getElementById('fg-' + f);
    const inp = document.getElementById('inp-' + f);
    fg.classList.remove('has-error');
    if (inp) inp.value = '';
  });

  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

// ── FORM VALIDATION ─────────────────────────────────────────────
function validate() {
  let ok = true;

  const fname = document.getElementById('inp-fname').value.trim();
  const lname  = document.getElementById('inp-lname').value.trim();
  const email  = document.getElementById('inp-email').value.trim();
  const phone  = document.getElementById('inp-phone').value.trim();
  const mode   = document.getElementById('inp-mode').value;
  const branch = document.getElementById('inp-branch').value;

  const setErr = (id, bad) => {
    document.getElementById('fg-' + id).classList.toggle('has-error', bad);
    if (bad) ok = false;
  };

  setErr('fname',  !fname);
  setErr('lname',  !lname);
  setErr('email',  !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email));
  setErr('phone',  !/^(07\d{8}|\+947\d{8})$/.test(phone.replace(/\s/g, '')));
  setErr('mode',   !mode);
  setErr('branch', !branch);

  return ok ? { fname, lname, email, phone, mode, branch } : null;
}

// ── EVENT WIRING ─────────────────────────────────────────────────
document.getElementById('modalClose').addEventListener('click', closeModal);
document.getElementById('modalOverlay').addEventListener('click', e => {
  if (e.target === document.getElementById('modalOverlay')) closeModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

document.getElementById('submitEnroll').addEventListener('click', () => {
  const data = validate();
  if (!data) return;
  // Simulate submission
  document.getElementById('enrollForm').style.display  = 'none';
  document.getElementById('successState').style.display = '';
  document.getElementById('successName').textContent   = data.fname + ' ' + data.lname;
  document.getElementById('successEmail').textContent  = data.email;
});

// Category filter buttons
document.getElementById('catFilters').addEventListener('click', e => {
  const btn = e.target.closest('.filter-btn');
  if (!btn) return;
  document.querySelectorAll('#catFilters .filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  activeCat = btn.dataset.cat;
  renderCards();
});

// Sidebar checkboxes
document.querySelectorAll('.check-item input').forEach(inp => inp.addEventListener('change', renderCards));

// Clear filters
document.getElementById('clearFilters').addEventListener('click', () => {
  document.querySelectorAll('.check-item input').forEach(i => i.checked = true);
  document.querySelectorAll('#catFilters .filter-btn').forEach(b => b.classList.remove('active'));
  document.querySelector('#catFilters .filter-btn[data-cat="all"]').classList.add('active');
  activeCat  = 'all';
  searchTerm = '';
  document.getElementById('searchInput').value = '';
  renderCards();
});

// Search
document.getElementById('searchInput').addEventListener('input', e => {
  searchTerm = e.target.value;
  renderCards();
});

// Hamburger
document.getElementById('hamburger').addEventListener('click', () => {
  document.getElementById('navLinks').classList.toggle('open');
});

// ── INIT ─────────────────────────────────────────────────────────
renderCards();
</script>
</body>
</html>