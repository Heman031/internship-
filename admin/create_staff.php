<?php
session_start();
include "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['create'])){

    $username   = trim($_POST['username']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $department = $_POST['department'];

    if(empty($username) || empty($department)){
        echo "<script>alert('All fields are required');</script>";
    } else {

        // ✅ IF ADMIN USER
        if($department == "ADMIN"){

            $stmt = $conn->prepare("INSERT INTO admin_users (username, password, department) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $department);

        } else {
            // ✅ NORMAL STAFF
            $stmt = $conn->prepare("INSERT INTO staff_users (username, password, department) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $department);
        }

        if($stmt->execute()){
            echo "<script>alert('User Created Successfully');</script>";
        } else {
            echo "<script>alert('Error creating user');</script>";
        }
    }
}
?>
<!DOCTYPE html>

<html>
<head>

<title>Create Staff</title>

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

</div>

</header>

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="dashboard.php">Dashboard</a>

<a href="admission/list.php">Applications</a>

<a href="staff_management.php">Staff Management</a>

<a href="logout.php">Logout</a>

</div>

<div class="main create-staff-page">

<h1>Create Staff</h1>

<div class="staff-form-card">

<form method="POST">

<div class="staff-form-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="staff-form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<div class="staff-form-group">
<label>Department</label>

<select name="department">
      <option value="">Select Department</option>
<option value="UG">UG Application</option>
<option value="PG">PG Application</option>
<option value="DIP">Diploma Application</option>
<option value="CERT">Certificate Application</option>
<option value="SWA">Single Window</option>
<option value="ADMIN">Admin Users</option>
</select>

</div>

<button class="staff-btn" name="create">Create Staff</button>

</form>

<br>

<a href="manage_staff.php" class="staff-link-btn">View Staff List</a>

</div>
</div>

</body>
</html>
