<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillPro Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:linear-gradient(135deg,#0f4c81,#1e88e5);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.container{
    background:#fff;
    padding:40px;
    border-radius:15px;
    width:400px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.container h2{
    text-align:center;
    color:#0f4c81;
    margin-bottom:25px;
}

.input-box{
    margin-bottom:15px;
}

.input-box input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
}

.btn{
    width:100%;
    padding:12px;
    background:#0f4c81;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

.btn:hover{
    background:#1565c0;
}

.link{
    text-align:center;
    margin-top:15px;
}

.link a{
    color:#0f4c81;
    text-decoration:none;
}
</style>
</head>
<body>

<div class="container">
    <h2>Student Login</h2>

    <form action="" method="POST">

        <div class="input-box">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="link">
            Don't have an account?
            <a href="sign.php">Sign Up</a>
        </div>

    </form>
</div>

</body>
</html>