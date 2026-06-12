<?php // events.php - SkillPro Institute Events Page ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Events | SkillPro Institute</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* ================= ROOT ================= */
:root{
  --primary:#c94a00;
  --primary-dark:#a33a00;
  --dark:#0f0e0d;
  --bg:#faf9f7;
  --text:#1a1815;
  --white:#fff;
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
  gap:25px;
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
  height:380px;
  background:linear-gradient(120deg,var(--dark),var(--primary)),
  url('https://images.unsplash.com/photo-1505373877841-8d25f7d46678');
  background-size:cover;
  background-position:center;
  display:flex;
  justify-content:center;
  align-items:center;
  text-align:center;
  color:white;
}

.hero h1{font-size:52px;}
.hero p{font-size:18px;margin-top:10px;}

/* ================= FILTER ================= */
.filter-section{
  width:90%;
  max-width:1200px;
  margin:-40px auto 40px;
  background:white;
  padding:25px;
  border-radius:12px;
  box-shadow:0 8px 20px rgba(0,0,0,0.1);
  border-top:4px solid var(--primary);
}

.filter-box{
  display:flex;
  flex-wrap:wrap;
  gap:15px;
}

.filter-box input,
.filter-box select{
  flex:1;
  min-width:180px;
  padding:12px;
  border:1px solid var(--border);
  border-radius:8px;
}

.filter-box button{
  padding:12px 20px;
  border:none;
  border-radius:8px;
  cursor:pointer;
  font-weight:600;
}

.btn-search{background:var(--primary);color:white;}
.btn-reset{background:#ddd;}

/* ================= EVENTS ================= */
.events{
  width:90%;
  max-width:1200px;
  margin:auto;
}

.section-title{
  text-align:center;
  margin:40px 0;
}

.section-title h2{
  font-size:34px;
}

.event-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
  gap:25px;
}

/* CARD */
.event-card{
  background:white;
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 6px 18px rgba(0,0,0,0.08);
  transition:.3s;
}

.event-card:hover{
  transform:translateY(-6px);
}

.event-card img{
  width:100%;
  height:200px;
  object-fit:cover;
}

.event-info{
  padding:18px;
}

.event-date{
  color:var(--primary);
  font-weight:600;
}

.event-info h3{
  margin:8px 0;
}

.event-info p{
  color:#555;
  font-size:14px;
}

.event-btn{
  display:inline-block;
  margin-top:10px;
  padding:10px 15px;
  background:var(--primary);
  color:white;
  border-radius:8px;
  text-decoration:none;
}

/* ================= STATS ================= */
.stats{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
  gap:15px;
  width:90%;
  max-width:1200px;
  margin:40px auto;
}

.stat-box{
  background:white;
  padding:20px;
  text-align:center;
  border-radius:10px;
  box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

.stat-box span{
  display:block;
  font-size:24px;
  color:var(--primary);
  font-weight:700;
}

/* ================= COUNTDOWN ================= */
.countdown{
  text-align:center;
  padding:30px;
  background:var(--primary);
  color:white;
  margin-top:40px;
}

/* ================= NEWSLETTER ================= */
.newsletter{
  background:var(--dark);
  color:white;
  text-align:center;
  padding:40px;
}

.newsletter input{
  padding:10px;
  width:250px;
  border:none;
  border-radius:6px;
}

.newsletter button{
  padding:10px 20px;
  background:var(--primary);
  border:none;
  color:white;
  border-radius:6px;
}

/* ================= MODAL ================= */
.modal{
  display:none;
  position:fixed;
  top:0;left:0;
  width:100%;height:100%;
  background:rgba(0,0,0,0.6);
}

.modal-content{
  background:white;
  padding:20px;
  width:300px;
  margin:15% auto;
  border-radius:10px;
}

.close{
  float:right;
  cursor:pointer;
  font-size:20px;
}

/* FOOTER */
footer{
  background:var(--dark);
  color:#aaa;
  text-align:center;
  padding:20px;
  margin-top:40px;
}

@media(max-width:768px){
  .hero h1{font-size:32px;}
  nav ul{display:none;}
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
<div>
<h1>Upcoming Events</h1>
<p>Workshops | Seminars | Career Fairs</p>
</div>
</section>

<!-- FILTER -->
<section class="filter-section">
<div class="filter-box">

<input type="text" id="search" placeholder="Search Events...">

<select id="type">
<option>All Types</option>
<option>Workshop</option>
<option>Seminar</option>
<option>Career Fair</option>
</select>

<select id="location">
<option>All Locations</option>
<option>Colombo</option>
<option>Kandy</option>
<option>Matara</option>
</select>

<button class="btn-search" onclick="filterEvents()">Search</button>
<button class="btn-reset" onclick="resetFilter()">Reset</button>

</div>
</section>

<!-- EVENTS -->
<section class="events">

<div class="section-title">
<h2>Latest Events</h2>
</div>

<div class="event-grid">

<!-- EVENT 1 -->
<div class="event-card" data-type="Workshop" data-location="Colombo">
<img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d">
<div class="event-info">
<div class="event-date">20 June 2026</div>
<h3>ICT Skills Workshop</h3>
<p>Learn ICT skills with experts.</p>
<a class="event-btn" onclick="openModal('ICT Workshop')">Details</a>
</div>
</div>

<!-- EVENT 2 -->
<div class="event-card" data-type="Seminar" data-location="Kandy">
<img src="https://images.unsplash.com/photo-1551836022-deb4988cc6c0">
<div class="event-info">
<div class="event-date">25 June 2026</div>
<h3>Career Seminar</h3>
<p>Professional career guidance.</p>
<a class="event-btn" onclick="openModal('Career Seminar')">Details</a>
</div>
</div>

<!-- EVENT 3 -->
<div class="event-card" data-type="Career Fair" data-location="Matara">
<img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f">
<div class="event-info">
<div class="event-date">30 June 2026</div>
<h3>Job Fair</h3>
<p>Meet top companies.</p>
<a class="event-btn" onclick="openModal('Job Fair')">Details</a>
</div>
</div>

</div>
</section>

<!-- STATS -->
<section class="stats">
<div class="stat-box">Workshops<span>12+</span></div>
<div class="stat-box">Seminars<span>8+</span></div>
<div class="stat-box">Career Fairs<span>5+</span></div>
<div class="stat-box">Students<span>1500+</span></div>
</section>

<!-- COUNTDOWN -->
<div class="countdown">
<h2>Next Event Starts In</h2>
<h1 id="timer"></h1>
</div>

<!-- NEWSLETTER -->
<div class="newsletter">
<h2>Subscribe for Updates</h2><br>
<input type="email" placeholder="Email">
<button>Subscribe</button>
</div>

<!-- MODAL -->
<div id="modal" class="modal">
<div class="modal-content">
<span class="close" onclick="closeModal()">&times;</span>
<h3 id="modalTitle"></h3>
<p>Event details coming soon.</p>
</div>
</div>

<!-- FOOTER -->
<footer>
<p>© 2026 SkillPro Institute</p>
</footer>

<script>

/* FILTER */
function filterEvents(){
let search=document.getElementById("search").value.toLowerCase();
let type=document.getElementById("type").value;
let location=document.getElementById("location").value;

document.querySelectorAll(".event-card").forEach(card=>{
let title=card.querySelector("h3").innerText.toLowerCase();
let t=card.getAttribute("data-type");
let l=card.getAttribute("data-location");

card.style.display =
(title.includes(search) && (type==="All Types"||type===t) && (location==="All Locations"||location===l))
?"block":"none";
});
}

/* RESET */
function resetFilter(){
document.querySelectorAll(".event-card").forEach(c=>c.style.display="block");
}

/* MODAL */
function openModal(title){
document.getElementById("modal").style.display="block";
document.getElementById("modalTitle").innerText=title;
}

function closeModal(){
document.getElementById("modal").style.display="none";
}

/* COUNTDOWN */
let count=new Date("July 20, 2026 10:00:00").getTime();
setInterval(()=>{
let now=new Date().getTime();
let d=count-now;
document.getElementById("timer").innerHTML=Math.floor(d/(1000*60*60*24))+" Days Left";
},1000);

</script>

</body>
</html>