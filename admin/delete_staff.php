<?php
include "../db.php";

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM staff_users WHERE id='$id'");

echo "<script>
alert('Staff Deleted Successfully');
window.location='manage_staff.php';
</script>";
?>