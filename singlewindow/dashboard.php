<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<title>SWA Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

/* RESET */
*{margin:0;padding:0;box-sizing:border-box;font-family:"Segoe UI", Arial;}

/* BODY */
body{background:#f1f5f9;}

/* HEADER */
.top-header{background:#2374ad;padding:15px 0;color:white;}

.container{
width:95%;margin:auto;display:flex;
justify-content:space-between;align-items:center;
}

.logo{display:flex;align-items:center;}
.logo img{width:60px;margin-right:10px;}

.tamil-text{font-size:14px;}
.english-text{font-size:18px;font-weight:bold;}

.nav a{color:white;text-decoration:none;margin-left:15px;}

/* LAYOUT */
.wrapper{display:flex;}

/* SIDEBAR */
.sidebar{
width:230px;height:100vh;background:#1e293b;
color:white;padding-top:20px;
}

.sidebar a{
display:block;padding:12px 20px;
color:white;text-decoration:none;
}

.sidebar a:hover{background:#334155;}

/* MAIN */
.main{flex:1;padding:20px;}

.header-box{
background:white;padding:15px;border-radius:8px;
margin-bottom:20px;
}

/* CARDS */
.cards{
display:grid;
grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
gap:20px;
}

.card{
padding:25px;
border-radius:12px;
color:white;
text-align:center;
transition:0.3s;
cursor:pointer;
}

.card:hover{
transform:translateY(-5px);
}

.card i{
font-size:30px;
margin-bottom:10px;
}

.blue{ background:#2563eb; }
.green{ background:#16a34a; }
.orange{ background:#f59e0b; }
.purple{ background:#7c3aed; }

/* FOOTER */
.footer{
text-align:center;margin-top:30px;color:gray;
}

</style>
</head>

<body>

<!-- HEADER -->
<header class="top-header">
<div class="container">

<div class="logo">
<img src="image/Univ.png">
<div>
<div class="tamil-text">சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்</div>
<div class="english-text">University of Madras – IDE</div>
</div>
</div>

<nav class="nav">
<a href="dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>
</nav>

</div>
</header>

<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
<a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
<a href="staff_entry.php"><i class="fa fa-plus"></i> New Application</a>
<a href="reintimation.php"><i class="fa fa-refresh"></i> Reintimation</a>
<a href="payment.php"><i class="fa fa-credit-card"></i> Payment</a>
<a href="list.php"><i class="fa fa-list"></i> Application List</a>
<a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="header-box">
<h2>Welcome <?php echo $username; ?></h2>
<p>SWA Staff Dashboard</p>
</div>

<!-- CARDS -->
<div class="cards">

<a href="new_application1.php" style="text-decoration:none;">
<div class="card blue">
<i class="fa fa-user-plus"></i>
<h3>New Application</h3>
<p>Create new SWA admission</p>
</div>
</a>

<a href="reintimation.php" style="text-decoration:none;">
<div class="card orange">
<i class="fa fa-refresh"></i>
<h3>Reintimation</h3>
<p>Update existing application</p>
</div>
</a>

<a href="payment.php" style="text-decoration:none;">
<div class="card green">
<i class="fa fa-credit-card"></i>
<h3>Payment</h3>
<p>Manage fee payments</p>
</div>
</a>

<a href="list.php" style="text-decoration:none;">
<div class="card purple">
<i class="fa fa-list"></i>
<h3>Application List</h3>
<p>View all SWA applications</p>
</div>
</a>

</div>

<div class="footer">
© 2026 University Admission System
</div>

</div>

</div>

</body>
</html>