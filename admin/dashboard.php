<?php
session_start();
require_once "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

/* Dashboard Statistics */
$total = $conn->query("SELECT COUNT(*) c FROM records")->fetch_assoc()['c'];
$pending = $conn->query("SELECT COUNT(*) c FROM records WHERE status='Pending'")->fetch_assoc()['c'];
$approved = $conn->query("SELECT COUNT(*) c FROM records WHERE status='Approved'")->fetch_assoc()['c'];
$rejected = $conn->query("SELECT COUNT(*) c FROM records WHERE status='Rejected'")->fetch_assoc()['c'];

$ug  = $conn->query("SELECT COUNT(*) c FROM records WHERE course_type='UG'")->fetch_assoc()['c'];
$pg  = $conn->query("SELECT COUNT(*) c FROM records WHERE course_type='PG'")->fetch_assoc()['c'];
$dip = $conn->query("SELECT COUNT(*) c FROM records WHERE course_type='DIP'")->fetch_assoc()['c'];
$cert= $conn->query("SELECT COUNT(*) c FROM records WHERE course_type='CERT'")->fetch_assoc()['c'];

$oc  = $conn->query("SELECT COUNT(*) c FROM records WHERE community='OC'")->fetch_assoc()['c'];
$bc  = $conn->query("SELECT COUNT(*) c FROM records WHERE community='BC'")->fetch_assoc()['c'];
$mbc = $conn->query("SELECT COUNT(*) c FROM records WHERE community='MBC'")->fetch_assoc()['c'];
$sc  = $conn->query("SELECT COUNT(*) c FROM records WHERE community='SC'")->fetch_assoc()['c'];
$st  = $conn->query("SELECT COUNT(*) c FROM records WHERE community='ST'")->fetch_assoc()['c'];

$male = $conn->query("SELECT COUNT(*) c FROM records WHERE gender='Male'")->fetch_assoc()['c'];
$female = $conn->query("SELECT COUNT(*) c FROM records WHERE gender='Female'")->fetch_assoc()['c'];
$transgender = $conn->query("SELECT COUNT(*) c FROM records WHERE gender='Transgender'")->fetch_assoc()['c'];

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style.css">
<title>Admin Dashboard</title>
</head>
<body>
    <header class="top-header">
  <div class="app">
    
    <div class="logo">
      <img src="../image/Univ.png" alt="University Logo">
      <div class="university-text">
        <strong>சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்</strong><br>
        University of Madras – Institute of Distance Education
      </div>
    </div>

    <div class="nav">
      <a href="#">Home</a>
      <a href="#">Contact</a>
    </div>

  </div>
</header>

<div class="sidebar">
<h2>Admin Panel</h2>
<a href="dashboard.php">Dashboard</a>
<a href="admission/list.php">Applications</a>
<a href="staff_management.php">staff Dashboard</a>
<a href="logout.php">Logout</a>
</div>



<div class="main">

<h1>Dashboard Overview</h1>

<div class="card-container">

<a href="admission/list.php" class="card blue">
<h3>Total Applications</h3>
<p><?php echo $total; ?></p>
</a>

<a href="admission/list.php?status=Pending" class="card orange">
<h3>Pending</h3>
<p><?php echo $pending; ?></p>
</a>

<a href="admission/list.php?status=Approved" class="card green">
<h3>Approved</h3>
<p><?php echo $approved; ?></p>
</a>

<a href="admission/list.php?status=Rejected" class="card red">
<h3>Rejected</h3>
<p><?php echo $rejected; ?></p>
</a>

<a href="admission/list.php?type=UG" class="card blue">
<h3>UG Applications</h3>
<p><?php echo $ug; ?></p>
</a>

<a href="admission/list.php?type=PG" class="card orange">
<h3>PG Applications</h3>
<p><?php echo $pg; ?></p>
</a>

<a href="admission/list.php?type=DIP" class="card green">
<h3>Diploma Applications</h3>
<p><?php echo $dip; ?></p>
</a>

<a href="admission/list.php?type=CERT" class="card red">
<h3>Certificate Applications</h3>
<p><?php echo $cert; ?></p>
</a>

<a href="admission/list.php?community=OC" class="card blue">
<h3>OC Applications</h3>
<p><?php echo $oc; ?></p>
</a>

<a href="admission/list.php?community=BC" class="card orange">
<h3>BC Applications</h3>
<p><?php echo $bc; ?></p>
</a>

<a href="admission/list.php?community=MBC" class="card green">
<h3>MBC Applications</h3>
<p><?php echo $mbc; ?></p>
</a>

<a href="admission/list.php?community=SC" class="card red">
<h3>SC Applications</h3>
<p><?php echo $sc; ?></p>
</a>

<a href="admission/list.php?community=ST" class="card purple">
<h3>ST Applications</h3>
<p><?php echo $st; ?></p>
</a>

<a href="admission/list.php?gender=Male" class="card orange">
<h3>Male Applicants</h3>
<p><?php echo $male; ?></p>
</a>

<a href="admission/list.php?gender=Female" class="card green">
<h3>Female Applicants</h3>
<p><?php echo $female; ?></p>
</a>

<a href="admission/list.php?gender=Transgender" class="card red">
<h3>Transgender Applicants</h3>
<p><?php echo $transgender; ?></p>
</a>

</div>
</div>

</body>
</html>