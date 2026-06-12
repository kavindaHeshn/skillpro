<?php // Courses.php - SkillPro Institute (Brand Theme Version) ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Courses | SkillPro Institute</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* ================= ROOT COLORS (SAME AS HOME) ================= */
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

/* RESET */
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
    color:white;
}

nav ul{
    display:flex;
    list-style:none;
    gap:25px;
}

/* ADD THIS */
nav ul a{
    text-decoration:none;
    color:white;   /* 👈 white color */
    font-weight:500;
    transition:.3s;
}

nav ul a:hover{
    color:var(--accent);
}

/* ================= HERO ================= */
.hero{
    height:380px;
    background:linear-gradient(120deg,var(--dark),var(--primary)),
    url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f');
    background-size:cover;
    background-position:center;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:white;
}

.hero h1{
    font-size:52px;
    font-weight:700;
}

.hero p{
    font-size:18px;
    color:#eee;
    margin-top:10px;
}

/* ================= SEARCH ================= */
.search-section{
    width:90%;
    max-width:1200px;
    margin:-40px auto 40px;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
    border-top:4px solid var(--primary);
}

.search-box{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.search-box input,
.search-box select{
    flex:1;
    min-width:180px;
    padding:12px;
    border:1px solid var(--border);
    border-radius:8px;
    outline:none;
}

.search-box input:focus,
.search-box select:focus{
    border-color:var(--primary);
}

/* BUTTONS */
.search-box button{
    background:var(--primary);
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    transition:.3s;
}

.search-box button:hover{
    background:var(--primary-dark);
}

/* ================= TITLE ================= */
.section-title{
    text-align:center;
    margin:40px 0 30px;
}

.section-title h2{
    font-size:34px;
    color:var(--dark);
    font-weight:700;
}

/* ================= COURSES ================= */
.courses{
    width:90%;
    max-width:1200px;
    margin:auto;
}

.course-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
}

/* CARD */
.course-card{
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    transition:.3s;
    border-bottom:3px solid transparent;
}

.course-card:hover{
    transform:translateY(-8px);
    border-bottom:3px solid var(--primary);
}

.course-card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

.course-info{
    padding:18px;
}

.course-info h3{
    color:var(--dark);
    margin-bottom:8px;
}

.course-info p{
    margin:5px 0;
    color:#555;
}

.course-info span{
    color:var(--primary);
    font-weight:600;
}

/* BUTTON GROUP */
.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.btn{
    flex:1;
    text-align:center;
    padding:10px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    transition:.3s;
}

.details{
    background:#eee;
    color:var(--dark);
}

.details:hover{
    background:#ddd;
}

.enroll{
    background:var(--primary);
    color:white;
}

.enroll:hover{
    background:var(--primary-dark);
}

/* ================= FEATURES ================= */
.features{
    background:white;
    padding:70px 10%;
    margin-top:60px;
    border-top:3px solid var(--primary);
}

.feature-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.feature{
    background:var(--bg);
    padding:25px;
    text-align:center;
    border-radius:10px;
    border:1px solid var(--border);
}

.feature h4{
    color:var(--primary);
    margin-bottom:8px;
}

/* ================= FOOTER ================= */
footer{
    background:var(--dark);
    color:#aaa;
    text-align:center;
    padding:20px;
    margin-top:50px;
    border-top:3px solid var(--primary);
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
.hero h1{font-size:32px;}
nav ul{display:none;}
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
<!-- HEADER -->
<header>
<div class="logo">SkillPro Institute</div>

<nav>
<ul>
<a href="home.php">Home</a>
      <a href="About.php">About</a>
      <a href="courses.php">Courses</a>
      <a href="events.php">Events</a>
      <a href="contact.php">Contact</a>
      <a href="login.php">Login</a>
</ul>
</nav>
</header>

<!-- HERO -->
<section class="hero">
<div>
<h1>Our Courses</h1>
<p>Build your future with professional skills training</p>
</div>
</section>

<!-- SEARCH -->
<section class="search-section">

<div class="search-box">

<input type="text" id="searchInput" placeholder="Search Course...">

<select id="category">
<option>All Categories</option>
<option>ICT</option>
<option>Engineering</option>
<option>Hospitality</option>
</select>

<select id="branch">
<option>All Branches</option>
<option>Colombo</option>
<option>Kandy</option>
<option>Matara</option>
</select>

<button onclick="filterCourses()">Search</button>
<button onclick="resetFilter()">Reset</button>

</div>

</section>

<!-- COURSES -->
<section class="courses">

<div class="section-title">
<h2>Popular Courses</h2>
</div>

<div class="course-grid">

<!-- COURSE 1 -->
<div class="course-card" data-category="ICT" data-branch="Colombo">
<img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3">
<div class="course-info">
<h3>ICT Technician</h3>
<p><span>Duration:</span> 6 Months</p>
<p><span>Fee:</span> Rs. 45,000</p>
<p><span>Branch:</span> Colombo</p>

<div class="btn-group">
<a href="#" class="btn details">Details</a>
<a href="#" class="btn enroll">Enroll</a>
</div>
</div>
</div>

<!-- COURSE 2 -->
<div class="course-card" data-category="Hospitality" data-branch="Kandy">
<img src="https://images.unsplash.com/photo-1552664730-d307ca884978">
<div class="course-info">
<h3>Hotel Management</h3>
<p><span>Duration:</span> 12 Months</p>
<p><span>Fee:</span> Rs. 75,000</p>
<p><span>Branch:</span> Kandy</p>

<div class="btn-group">
<a href="#" class="btn details">Details</a>
<a href="#" class="btn enroll">Enroll</a>
</div>
</div>
</div>

<!-- COURSE 3 -->
<div class="course-card" data-category="Engineering" data-branch="Matara">
<img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd">
<div class="course-info">
<h3>Welding Technology</h3>
<p><span>Duration:</span> 10 Months</p>
<p><span>Fee:</span> Rs. 60,000</p>
<p><span>Branch:</span> Matara</p>

<div class="btn-group">
<a href="#" class="btn details">Details</a>
<a href="#" class="btn enroll">Enroll</a>
</div>
</div>
</div>

</div>
</section>

<!-- FEATURES -->
<section class="features">
<div class="section-title">
<h2>Why Choose SkillPro?</h2>
</div>

<div class="feature-grid">
<div class="feature"><h4>TVEC Registered</h4><p>Certified training</p></div>
<div class="feature"><h4>Expert Trainers</h4><p>Industry professionals</p></div>
<div class="feature"><h4>Job Support</h4><p>Career guidance</p></div>
<div class="feature"><h4>Modern Labs</h4><p>Practical learning</p></div>
</div>

</section>

<!-- FOOTER -->
<footer>
<p>© 2026 SkillPro Institute | Colombo | Kandy | Matara</p>
</footer>

<!-- JS -->
<script>

function filterCourses(){

let input = document.getElementById("searchInput").value.toLowerCase();
let category = document.getElementById("category").value;
let branch = document.getElementById("branch").value;

let cards = document.querySelectorAll(".course-card");

cards.forEach(card=>{

let title = card.querySelector("h3").innerText.toLowerCase();
let cat = card.getAttribute("data-category");
let br = card.getAttribute("data-branch");

let matchText = title.includes(input);
let matchCat = (category==="All Categories" || category===cat);
let matchBr = (branch==="All Branches" || branch===br);

card.style.display = (matchText && matchCat && matchBr) ? "block" : "none";

});

}

function resetFilter(){
document.getElementById("searchInput").value="";
document.getElementById("category").value="All Categories";
document.getElementById("branch").value="All Branches";

document.querySelectorAll(".course-card").forEach(c=>{
c.style.display="block";
});
}

</script>

</body>
</html>