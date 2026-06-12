<?php // About.php - SkillPro Institute Full Page ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillPro Institute | About</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

/* ================= ROOT ================= */
:root{
  --primary:#c94a00;
  --dark:#0f0e0d;
  --bg:#faf9f7;
  --text:#1a1815;
  --white:#fff;
  --accent:#f5a623;
  --border:#e5e2dc;
}

/* ================= RESET ================= */
*{margin:0;padding:0;box-sizing:border-box;font-family:Inter,sans-serif;}
body{background:var(--bg);color:var(--text);}

/* ================= NAV ================= */
header{
  background:var(--dark);
  position:sticky;
  top:0;
  z-index:1000;
}
.nav{
  max-width:1200px;
  margin:auto;
  display:flex;
  justify-content:space-between;
  padding:15px 20px;
  align-items:center;
}
.logo{color:#fff;font-weight:800;}
nav a{color:#ccc;margin:0 10px;text-decoration:none;}
nav a:hover{color:var(--accent);}

/* ================= HERO ================= */
.hero{
  background:linear-gradient(120deg,#0f0e0d,#c94a00);
  color:white;
  text-align:center;
  padding:120px 20px;
}
.hero h1{
  font-size:48px;
  font-family:"Playfair Display";
}
.hero p{margin-top:10px;color:#ddd;}

/* ================= SECTION ================= */
.section{
  max-width:1200px;
  margin:auto;
  padding:70px 20px;
}
.title{
  text-align:center;
  font-size:32px;
  margin-bottom:20px;
  font-family:"Playfair Display";
}

/* ================= GRID ================= */
.grid{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:20px;
}
.box{
  background:#fff;
  padding:20px;
  border-radius:10px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

/* ================= VALUES ================= */
.values{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
  gap:15px;
}
.card{
  background:#fff;
  padding:20px;
  border-radius:10px;
  text-align:center;
}

/* ================= TIMELINE ================= */
.timeline{
  border-left:3px solid var(--primary);
  padding-left:20px;
}
.tl{
  margin-bottom:20px;
}

/* ================= TEAM ================= */
.team{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
  gap:20px;
}
.member{
  background:#fff;
  padding:20px;
  text-align:center;
  border-radius:10px;
}

/* ================= FOOTER ================= */
footer{
  background:var(--dark);
  color:#aaa;
  text-align:center;
  padding:20px;
  margin-top:40px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
  .grid{grid-template-columns:1fr;}
  .hero h1{font-size:30px;}
}
.topbar{
  background:var(--primary);
  color:white;
  padding:8px 0;
  font-size:13px;
}
.topbar-inner{
  max-width:1200px;
  margin:auto;
  display:flex;
  justify-content:space-between;
  padding:0 20px;
}


</style>
</head>

<body>
<div class="topbar">
  <div class="topbar-inner">
    <div>📞 +94 11 754 4801 | ✉ info@skillpro.lk</div>
    <div>Colombo | Kandy | Matara</div>
  </div>
</div>
<!-- NAV -->
<header>
<div class="nav">
  <div class="logo">SkillPro</div>
  <nav>
    <a href="home.php">Home</a>
      <a href="About.php">About</a>
      <a href="courses.php">Courses</a>
      <a href="events.php">Events</a>
      <a href="contact.php">Contact</a>
      <a href="login.php">Login</a>
  </nav>
</div>
</header>

<!-- HERO -->
<section class="hero">
  <h1>About SkillPro Institute</h1>
  <p>We build skilled professionals for Sri Lanka</p>
</section>

<!-- WHO WE ARE -->
<section class="section">
<h2 class="title">Who We Are</h2>
<div class="grid">
  <div class="box">
    <h3>Our Story</h3>
    <p>SkillPro Institute started with a mission to provide practical vocational education.</p>
  </div>
  <div class="box">
    <h3>Our Vision</h3>
    <p>To become Sri Lanka’s #1 vocational training institute.</p>
  </div>
</div>
</section>

<!-- VALUES -->
<section class="section">
<h2 class="title">Core Values</h2>
<div class="values">
  <div class="card">Quality</div>
  <div class="card">Innovation</div>
  <div class="card">Discipline</div>
  <div class="card">Success</div>
</div>
</section>

<!-- MISSION -->
<section class="section">
<h2 class="title">Mission</h2>
<div class="box">
<p>
We deliver high-quality training to improve employability and skills in Sri Lanka.
</p>
</div>
</section>

<!-- VISION -->
<section class="section">
<h2 class="title">Vision</h2>
<div class="box">
<p>
To produce world-class skilled professionals.
</p>
</div>
</section>

<!-- TIMELINE -->
<section class="section">
<h2 class="title">Our Journey</h2>
<div class="timeline">

<div class="tl">2013 - Institute Founded</div>
<div class="tl">2016 - Kandy Branch Opened</div>
<div class="tl">2019 - Matara Branch Opened</div>
<div class="tl">2022 - Online Learning Started</div>
<div class="tl">2025 - Full Digital System</div>

</div>
</section>

<!-- TEAM -->
<section class="section">
<h2 class="title">Our Team</h2>
<div class="team">

<div class="member">Director</div>
<div class="member">ICT Head</div>
<div class="member">Engineering Head</div>
<div class="member">Hospitality Head</div>

</div>
</section>

<!-- EXTRA CONTENT (to expand page length) -->
<section class="section">
<h2 class="title">Why Choose Us</h2>

<div class="grid">
  <div class="box">Industry Based Training</div>
  <div class="box">Certified Programs</div>
  <div class="box">Job Placement Support</div>
  <div class="box">Modern Facilities</div>
</div>
</section>

<!-- FAQ -->
<section class="section">
<h2 class="title">FAQ</h2>

<div class="box">
<h4>Do you provide certificates?</h4>
<p>Yes, TVEC approved certificates.</p>
</div>

<div class="box">
<h4>Are courses practical?</h4>
<p>Yes, 80% practical training.</p>
</div>

<div class="box">
<h4>Do you have job support?</h4>
<p>Yes, job placement assistance available.</p>
</div>

</section>

<!-- CONTACT CTA -->
<section class="section">
<h2 class="title">Join With Us</h2>
<div class="box" style="text-align:center;">
<p>Start your career today with SkillPro Institute</p>
<button style="padding:10px 20px;background:#c94a00;color:#fff;border:none;margin-top:10px;">
Apply Now
</button>
</div>
</section>

<!-- FOOTER -->
<footer>
<p>© 2026 SkillPro Institute | All Rights Reserved</p>
</footer>

</body>
</html>
