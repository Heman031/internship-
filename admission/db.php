<?php
$conn = mysqli_connect("localhost", "root", "root@123", "admission_db");

if (!$conn) {
    die("Database connection failed");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = mysqli_connect("localhost", "root", "root@123", "admission_db");
