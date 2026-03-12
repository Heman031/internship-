<?php
session_start();
require_once "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Staff Management</title>
<link rel="stylesheet" href="assets/style.css">
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
  <a href="dashboard.php">Home</a>
  <a href="#">Contact</a>
</div>

  </div>
</header>

<div class="sidebar">
<h2>Admin Panel</h2>

<a href="dashboard.php">Dashboard</a> <a href="admission/list.php">Applications</a> <a href="staff_management.php">Staff Management</a> <a href="logout.php">Logout</a>

</div>

<div class="main">

<h1>Staff Management</h1>

<div class="card-container">

<a href="create_staff.php" class="card blue">
<h3>Create Staff</h3>
<p>Add new staff login</p>
</a>

<a href="manage_staff.php" class="card green">
<h3>Manage Staff</h3>
<p>Edit or delete staff accounts</p>
</a>

</div>

</div>

</body>
</html>
