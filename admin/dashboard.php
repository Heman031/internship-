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
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style.css">
<title>Admin Dashboard</title>
</head>
<body>

<div class="sidebar">
<h2>Admin Panel</h2>
<a href="dashboard.php">Dashboard</a>
<a href="admission/list.php">Applications</a>
<a href="logout.php">Logout</a>
</div>

<div class="main">

<h1>Dashboard Overview</h1>

<div class="card-container">

<div class="card blue">
<h3>Total Applications</h3>
<p><?php echo $total; ?></p>
</div>

<div class="card orange">
<h3>Pending</h3>
<p><?php echo $pending; ?></p>
</div>

<div class="card green">
<h3>Approved</h3>
<p><?php echo $approved; ?></p>
</div>

<div class="card red">
<h3>Rejected</h3>
<p><?php echo $rejected; ?></p>
</div>

</div>

</div>

</body>
</html>