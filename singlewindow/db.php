<?php
$host = "localhost:3307";
$user = "root";
$pass = "";
$db   = "admission_db"; // ✅ correct DB

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// 🔥 FORCE select correct DB
mysqli_select_db($conn, "admission_db");
?>