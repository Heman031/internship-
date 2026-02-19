<?php
$conn = mysqli_connect("localhost:3307", "root", "", "admission_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
