<?php
session_start();
require_once "../../db.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM records WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Print Application</title>
<style>
body{ font-family:Arial; }
h2{ text-align:center; }
table{ width:100%; border-collapse:collapse; }
td{ padding:8px; border-bottom:1px solid #ddd; }
</style>
</head>
<body onload="window.print()">

<h2>Distance Education - Approved Application</h2>

<table>
<tr><td>Application ID</td><td><?php echo $data['application_no']; ?></td></tr>
<tr><td>Name</td><td><?php echo $data['name']; ?></td></tr>
<tr><td>Course</td><td><?php echo $data['programme_name']; ?></td></tr>
<tr><td>Status</td><td><?php echo $data['status']; ?></td></tr>
<tr><td>Processed By</td><td><?php echo $data['processed_by']; ?></td></tr>
<tr><td>Processed At</td><td><?php echo $data['processed_at']; ?></td></tr>
</table>

</body>
</html>