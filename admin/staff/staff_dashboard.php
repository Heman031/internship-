<?php
session_start();

if(!isset($_SESSION['staff'])){
header("Location: login.php");
exit();
}

$dept=$_SESSION['department'];
?>

<h2>Welcome Staff</h2>

<p>Your Department : <?php echo $dept; ?></p>

<a href="students.php">View Students</a>