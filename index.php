<?php

$response = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>University of Madras - IDE</title>
<link rel="stylesheet" href="stylee.css">

<style>

.chatbot-box{
position:fixed;
bottom:20px;
right:20px;
width:300px;
background:#ffffff;
border:1px solid #ccc;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
font-family:Arial;
}

.chatbot-header{
background:#0a6ea8;
color:white;
padding:10px;
text-align:center;
border-radius:10px 10px 0 0;
}

.chatbot-body{
padding:10px;
max-height:200px;
overflow-y:auto;
font-size:14px;
}

.chatbot-body p{
margin:5px 0;
}

.chatbot-input{
padding:10px;
border-top:1px solid #ddd;
}

.chatbot-input input[type=text]{
width:100%;
padding:6px;
margin-bottom:5px;
}

.chatbot-input input[type=submit]{
width:100%;
padding:6px;
background:#0a6ea8;
color:white;
border:none;
cursor:pointer;
}

</style>

</head>
<body>

<!-- HEADER -->
<header class="top-header">
<div class="container">

<div class="logo">
<img src="image/Univ.png" alt="University Logo">

<div class="logo-text">
<div class="tamil-text">
சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்
</div>

<div class="english-text">
University of Madras – Institute of Distance Education
</div>
</div>
</div>

<nav class="nav">
<a class="active" href="#">Home</a>
<a href="#">About Us</a>
<a href="#">Contact Us</a>
<a href="admin/login.php">Admin Panel</a>
</nav>

</div>
</header>


<!-- BANNER -->
<section class="banner">

<div class="white-wrapper">

<div class="portal">

<h2>Institute of Distance Education</h2>
<h3>Online Application Portal</h3>

<div class="buttons">
<a href="login.php" class="btn btn-outline">Login</a>
<a href="form.php" class="btn btn-outline">Register Here</a>
</div>

<div class="notice-box">
<h4>📢 Important Notices</h4>

<ul>
<li>Admissions open for Academic Year 2025–2026</li>
<li>Last date for UG applications: <strong>30 June 2025</strong></li>
<li>Online payment facility available for all programmes</li>
<li>Hall ticket download notification will be announced shortly</li>
</ul>

</div>
</div>

</div>

</section>


<!-- FOOTER -->
<footer>

<div class="about-ide">

<h2>About the Institute of Distance Education</h2>

<p>
The Institute of Correspondence Education (ICE), now called the
Institute of Distance Education (IDE), was established in 1981.
</p>

<p>
Having completed 43 years, IDE today is a mega institute with more than
one lakh learners.
</p>

<p>
IDE offers <strong>73 Programmes</strong> including UG, PG, Diploma and Certificate courses.
</p>

<p>
Admissions are open throughout the year in both Academic Year (July–June)
and Calendar Year (January–December).
</p>

<p>
69 Learner Support Centres have been established and online admission
facility has been introduced.
</p>

<p>© 2025 University of Madras. All Rights Reserved.</p>

</div>

</footer>

</body>
</html>