<?php
session_start();
include "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM staff_users WHERE id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$username=$_POST['username'];
$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
$department=$_POST['department'];

$sql="UPDATE staff_users SET
username='$username',
password='$password',
department='$department'
WHERE id='$id'";

mysqli_query($conn,$sql);

echo "<script>
alert('Staff Updated Successfully');
window.location='manage_staff.php';
</script>";
}
?>

<!DOCTYPE html>

<html>
<head>

<title>Edit Staff</title>

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

<div class="main">

<h1>Edit Staff</h1>

<div class="edit-staff-card">

<form method="POST">

<div class="edit-form-group">
<label>Username</label>
<input type="text" name="username" value="<?php echo $row['username']; ?>" required>
</div>

<div class="edit-form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<div class="edit-form-group">
<label>Department</label>

<select name="department">

<option value="UG" <?php if($row['department']=="UG") echo "selected"; ?>>UG</option>
<option value="PG" <?php if($row['department']=="PG") echo "selected"; ?>>PG</option>
<option value="DIP" <?php if($row['department']=="DIP") echo "selected"; ?>>Diploma</option>
<option value="CERT" <?php if($row['department']=="CERT") echo "selected"; ?>>Certificate</option>

</select>

</div>

<button class="edit-staff-btn" name="update">Update Staff</button>

</form>

</div>
</div>

</body>
</html>
