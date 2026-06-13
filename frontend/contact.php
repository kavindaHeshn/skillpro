<?php // contact.php - SkillPro Institute ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Contact | SkillPro Institute</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* ================= ROOT ================= */
:root{
  --primary:#c94a00;
  --dark:#0f0e0d;
  --bg:#faf9f7;
  --text:#1a1815;
  --accent:#f5a623;
  --border:#e5e2dc;
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
}

body{
  background:var(--bg);
  color:var(--text);
}

/* ================= TOP BAR ================= */
.topbar{
  background:var(--primary);
  color:white;
  padding:8px;
  font-size:13px;
  text-align:center;
}

/* ================= HEADER ================= */
header{
  background:var(--dark);
  color:white;
  padding:15px 8%;
  display:flex;
  justify-content:space-between;
  align-items:center;
  border-bottom:3px solid var(--primary);
}

.logo{
  font-size:26px;
  font-weight:700;
}

nav ul{
  display:flex;
  gap:20px;
  list-style:none;
}

nav ul a{
  text-decoration:none;
  color:white;
  transition:.3s;
}

nav ul a:hover{
  color:var(--accent);
}

/* ================= HERO ================= */
.hero{
  height:300px;
  background:linear-gradient(120deg,var(--dark),var(--primary));
  display:flex;
  justify-content:center;
  align-items:center;
  color:white;
  text-align:center;
}

.hero h1{
  font-size:48px;
}

/* ================= CONTACT SECTION ================= */
.contact-section{
  width:90%;
  max-width:1200px;
  margin:40px auto;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:25px;
}

/* FORM */
.contact-form{
  background:white;
  padding:25px;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

.contact-form h2{
  margin-bottom:15px;
  color:var(--dark);
}

.contact-form input,
.contact-form textarea{
  width:100%;
  padding:12px;
  margin:10px 0;
  border:1px solid var(--border);
  border-radius:8px;
}

.contact-form button{
  background:var(--primary);
  color:white;
  padding:12px;
  border:none;
  border-radius:8px;
  width:100%;
  cursor:pointer;
}

/* INFO */
.contact-info{
  background:white;
  padding:25px;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

/* ================= STAFF SECTION ================= */
.staff-section{
  width:90%;
  max-width:1200px;
  margin:60px auto;
}

.staff-title{
  text-align:center;
  margin-bottom:30px;
}

.staff-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:20px;
}

.staff-card{
  background:white;
  padding:20px;
  text-align:center;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(0,0,0,0.08);
  transition:.3s;
}

.staff-card:hover{
  transform:translateY(-5px);
}

.staff-card img{
  width:100px;
  height:100px;
  border-radius:50%;
  object-fit:cover;
  margin-bottom:10px;
}

.staff-card h3{
  color:var(--dark);
}

.staff-card p{
  color:#555;
  font-size:14px;
}

/* ================= MAP ================= */
.map{
  width:90%;
  max-width:1200px;
  margin:40px auto;
}

iframe{
  width:100%;
  height:300px;
  border:0;
  border-radius:12px;
}

/* ================= FOOTER ================= */
footer{
  background:var(--dark);
  color:#aaa;
  text-align:center;
  padding:20px;
  margin-top:40px;
}

/* RESPONSIVE */
@media(max-width:768px){
  .contact-section{
    grid-template-columns:1fr;
  }
  nav ul{
    display:none;
  }
}

</style>
</head>

<body>

<!-- TOP BAR -->
<div class="topbar">
📞 +94 11 754 4801 | ✉ info@skillpro.lk
</div>

<!-- HEADER -->
<header>
<div class="logo">SkillPro Institute</div>

<nav>
<ul>
<li><a href="home.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="courses.php">Courses</a></li>
<li><a href="events.php">Events</a></li>
<li><a href="contact.php">Contact</a></li>
<li><a href="login.php">Login</a></li>
</ul>
</nav>
</header>

<!-- HERO -->
<section class="hero">
<h1>Contact Us</h1>
</section>

<!-- CONTACT -->
<section class="contact-section">

<!-- FORM -->
<div class="contact-form">
<h2>Send Message</h2>

<form>
<input type="text" placeholder="Your Name" required>
<input type="email" placeholder="Your Email" required>
<input type="text" placeholder="Subject">
<textarea rows="5" placeholder="Message"></textarea>
<button type="submit">Send Message</button>
</form>
</div>

<!-- INFO -->
<div class="contact-info">
<h2>Contact Info</h2>
<p>📍 Colombo, Sri Lanka</p>
<p>📞 +94 11 754 4801</p>
<p>✉ info@skillpro.lk</p>
<p>⏰ Mon - Fri: 8.00 AM - 5.00 PM</p>
</div>

</section>

<!-- STAFF SECTION -->
<section class="staff-section">

<div class="staff-title">
<h2>Our Staff Members</h2>
</div>

<div class="staff-grid">

<div class="staff-card">
<img src="https://i.pravatar.cc/100?img=1">
<h3>Mr. John Silva</h3>
<p>Director</p>
</div>

<div class="staff-card">
<img src="https://i.pravatar.cc/100?img=2">
<h3>Ms. Nuwanthi Perera</h3>
<p>Course Coordinator</p>
</div>

<div class="staff-card">
<img src="https://i.pravatar.cc/100?img=3">
<h3>Mr. Kavinda Fernando</h3>
<p>IT Lecturer</p>
</div>

<div class="staff-card">
<img src="https://i.pravatar.cc/100?img=4">
<h3>Ms. Hashini Kumari</h3>
<p>Admin Officer</p>
</div>

</div>

</section>

<!-- MAP -->
<section class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18..."></iframe>
</section>

<!-- FOOTER -->
<footer>
<p>© 2026 SkillPro Institute | All Rights Reserved</p>
</footer>

</body>
</html>