<?php
session_start();
include "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$result=mysqli_query($conn,"SELECT * FROM staff_users");
?>

<!DOCTYPE html>

<html>
<head>

<title>Manage Staff</title>

<link rel="stylesheet" href="assets/style.css">

</head>

<body>

<header class="top-header">

<div class="app">

<div class="logo">

<img src="../image/Univ.png">

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

<div class="main manage-staff-page">

<h1>Manage Staff</h1>

<div class="manage-staff-card">

<a class="staff-create-btn" href="create_staff.php">Create New Staff</a>

<table class="staff-table">
<tr>
<th>ID</th>
<th>Username</th>
<th>Department</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['department']; ?></td>

<td>

<a class="btn" href="edit_staff.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="btn red" href="delete_staff.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this staff?')">
Delete </a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>
