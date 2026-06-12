<?php // home.php - SkillPro Institute ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SkillPro Institute | Sri Lanka</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

<style>

/* ================= ROOT ================= */
:root{
  --primary:#c94a00;
  --primary-dark:#a33a00;
  --accent:#f5a623;
  --dark:#0f0e0d;
  --text:#1a1815;
  --bg:#faf9f7;
  --white:#fff;
  --border:#e5e2dc;
}

/* ================= RESET ================= */
*{margin:0;padding:0;box-sizing:border-box;font-family:Inter,sans-serif;}
body{background:var(--bg);color:var(--text);line-height:1.6;}
.footer{
  background:#0f0e0d;
  color:#ccc;
  margin-top:50px;
  padding:50px 20px 20px;
}

.footer-container{
  max-width:1200px;
  margin:auto;
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:30px;
}

.footer h3,
.footer h4{
  color:#fff;
  margin-bottom:10px;
}

.footer a{
  display:block;
  color:#bbb;
  text-decoration:none;
  margin:5px 0;
  font-size:14px;
}

.footer a:hover{
  color:#f5a623;
}

.footer input{
  width:100%;
  padding:10px;
  margin-top:10px;
  border:none;
  border-radius:5px;
}

.footer button{
  margin-top:10px;
  padding:10px;
  width:100%;
  border:none;
  background:#f5a623;
  font-weight:bold;
  cursor:pointer;
  border-radius:5px;
}

.social{
  margin-top:10px;
  display:flex;
  gap:10px;
}

.social span{
  background:#1c1a18;
  padding:6px 10px;
  border-radius:5px;
  font-size:12px;
  cursor:pointer;
}

.footer-bottom{
  text-align:center;
  margin-top:30px;
  padding-top:15px;
  border-top:1px solid #333;
  font-size:13px;
  color:#777;
}
/* ================= TOPBAR ================= */
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

/* ================= NAV ================= */
header{
  background:#0f0e0d;
  position:sticky;
  top:0;
  z-index:1000;
}
.nav{
  max-width:1200px;
  margin:auto;
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:15px 20px;
}
.logo{
  color:white;
  font-weight:800;
  font-size:18px;
}
nav a{
  color:#ddd;
  text-decoration:none;
  margin:0 10px;
  font-size:14px;
}
nav a:hover{color:var(--accent);}

/* ================= HERO ================= */
.hero{
  background:linear-gradient(120deg,#0f0e0d,#c94a00);
  color:white;
  padding:120px 20px;
  text-align:center;
}
.hero h1{
  font-size:48px;
  font-family:"Playfair Display";
}
.hero p{margin-top:10px;color:#eee;}
.hero button{
  margin-top:20px;
  padding:12px 25px;
  border:none;
  background:var(--accent);
  color:#000;
  font-weight:bold;
  cursor:pointer;
  border-radius:6px;
}

/* ================= SECTIONS ================= */
.section{
  padding:70px 20px;
  max-width:1200px;
  margin:auto;
}
.title{
  font-size:28px;
  text-align:center;
  margin-bottom:30px;
  font-family:"Playfair Display";
}

/* ================= ABOUT ================= */
.about{
  text-align:center;
}

/* ================= FEATURES ================= */
.features{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:20px;
}
.card{
  background:white;
  padding:20px;
  border-radius:10px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
  text-align:center;
}

/* ================= COURSES ================= */
.courses{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:20px;
}
.course{
  background:white;
  padding:20px;
  border-radius:10px;
}

/* ================= EVENTS ================= */
.events{
  display:grid;
  gap:15px;
}
.event{
  background:white;
  padding:15px;
  border-left:4px solid var(--primary);
  border-radius:6px;
}

/* ================= FOOTER ================= */
footer{
  background:#0f0e0d;
  color:#aaa;
  text-align:center;
  padding:20px;
  margin-top:40px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
  .hero h1{font-size:32px;}
  nav{display:none;}
}

</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
  <div class="topbar-inner">
    <div>📞 +94 11 754 4801 | ✉ info@skillpro.lk</div>
    <div>Colombo | Kandy | Matara</div>
  </div>
</div>

<!-- NAV -->
<header>
  <div class="nav">
    <div class="logo">SkillPro Institute</div>
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
  <h1>Build Skills That Build Your Future</h1>
  <p>TVEC Registered Vocational Training Institute in Sri Lanka</p>
  <button onclick="explore()">Explore Courses</button>
</section>

<!-- ABOUT -->
<section class="section about">
  <h2 class="title">About SkillPro</h2>
  <p>
    SkillPro Institute is a leading vocational training institute in Sri Lanka
    offering ICT, Engineering, Hospitality and Trade courses.
  </p>
</section>

<!-- FEATURES -->
<section class="section">
  <h2 class="title">Why Choose Us</h2>
  <div class="features">

    <div class="card">
      <h3>Expert Trainers</h3>
      <p>Qualified industry professionals</p>
    </div>

    <div class="card">
      <h3>Job Ready Skills</h3>
      <p>Practical training programs</p>
    </div>

    <div class="card">
      <h3>Certification</h3>
      <p>TVEC recognized certificates</p>
    </div>

  </div>
</section>

<!-- COURSES -->
<section class="section">
  <h2 class="title">Popular Courses</h2>
  <div class="courses">

    <div class="course">ICT & Software Engineering</div>
    <div class="course">Electrical Engineering</div>
    <div class="course">Welding & Fabrication</div>
    <div class="course">Hospitality Management</div>

  </div>
</section>

<!-- EVENTS -->
<section class="section">
  <h2 class="title">Upcoming Events</h2>

  <div class="events">
    <div class="event">ICT Workshop - July 2026</div>
    <div class="event">Job Fair - August 2026</div>
    <div class="event">New Intake - September 2026</div>
  </div>

</section>
<!-- FOOTER -->
<footer class="footer">
  <div class="footer-container">

    <div class="footer-col">
      <h3>SkillPro Institute</h3>
      <p>
        Leading TVEC registered vocational training institute in Sri Lanka.
        We provide ICT, Engineering, Hospitality and Trade courses.
      </p>
    </div>

    <div class="footer-col">
      <h4>Quick Links</h4>
      <a href="#">Home</a>
      <a href="#">Courses</a>
      <a href="#">Events</a>
      <a href="#">Contact</a>
    </div>

    <div class="footer-col">
      <h4>Contact</h4>
      <p>📞 +94 11 754 4801</p>
      <p>✉ info@skillpro.lk</p>
      <p>📍 Colombo | Kandy | Matara</p>
    </div>

    <div class="footer-col">
      <h4>Newsletter</h4>
      <input type="email" placeholder="Your Email">
      <button>Subscribe</button>

      <div class="social">
        <span>FB</span>
        <span>IG</span>
        <span>YT</span>
        <span>LI</span>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    © 2026 SkillPro Institute | All Rights Reserved
  </div>
</footer>
<!-- FOOTER -->
<footer>
  © 2026 SkillPro Institute | All Rights Reserved
</footer>

<script>
function explore(){
  alert("Opening Courses...");
}
</script>

</body>
</html>