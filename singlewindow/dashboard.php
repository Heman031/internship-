<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<a href="../admission-form/ap1.php">1.New Application</a><br><br>
<a href="reintimation.php">2. Reintimation</a><br><br>
<a href="payment.php">3. Payment</a><br><br>
<a href="status.php">4. Application Status</a><br><br>

<a href="logout.php">Logout</a>

</body>
</html>

