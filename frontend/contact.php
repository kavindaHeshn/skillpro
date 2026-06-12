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
  --border:#e5e2dc;
  --accent:#f5a623;
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
}

nav ul a:hover{
  color:var(--accent);
}

/* HERO */
.hero{
  height:250px;
  background:linear-gradient(120deg,var(--dark),var(--primary));
  display:flex;
  justify-content:center;
  align-items:center;
  color:white;
  text-align:center;
}

.hero h1{font-size:40px;}

/* CONTACT GRID */
.contact-section{
  width:90%;
  max-width:1200px;
  margin:50px auto;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:30px;
}

.form-box, .info-box{
  background:white;
  padding:25px;
  border-radius:10px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.form-box input,
.form-box textarea{
  width:100%;
  padding:12px;
  margin:10px 0;
  border:1px solid var(--border);
  border-radius:8px;
}

.form-box button{
  background:var(--primary);
  color:white;
  padding:12px;
  border:none;
  width:100%;
  border-radius:8px;
  cursor:pointer;
}

/* STAFF BUTTON */
.staff-btn{
  display:inline-block;
  margin-top:15px;
  background:var(--accent);
  color:black;
  padding:10px 15px;
  border-radius:8px;
  text-decoration:none;
  font-weight:600;
}

/* FOOTER */
footer{
  background:var(--dark);
  color:#aaa;
  text-align:center;
  padding:20px;
  margin-top:50px;
}

/* RESPONSIVE */
@media(max-width:768px){
  .contact-section{
    grid-template-columns:1fr;
  }
}

</style>
</head>

<body>

<header>
<div class="logo">SkillPro Institute</div>

<nav>
<ul>
<li><a href="home.php">Home</a></li>
<li><a href="courses.php">Courses</a></li>
<li><a href="events.php">Events</a></li>
<li><a href="contact.php">Contact</a></li>
<li><a href="staff.php">Staff</a></li>
</ul>
</nav>
</header>

<section class="hero">
<h1>Contact Us</h1>
</section>

<section class="contact-section">

<!-- FORM -->
<div class="form-box">
<h2>Send Message</h2>

<form>
<input type="text" placeholder="Your Name">
<input type="email" placeholder="Email">
<input type="text" placeholder="Subject">
<textarea rows="5" placeholder="Message"></textarea>
<button type="submit">Send</button>
</form>
</div>

<!-- INFO -->
<div class="info-box">
<h2>Get In Touch</h2>
<p>📞 +94 11 754 4801</p>
<p>✉ info@skillpro.lk</p>
<p>📍 Colombo | Kandy | Matara</p>

<a href="staff.php" class="staff-btn">Meet Our Staff</a>
</div>

</section>

<footer>
<p>© 2026 SkillPro Institute</p>
</footer>

</body>
</html>