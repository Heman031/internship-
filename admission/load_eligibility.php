<?php
include "db.php";

if (!isset($_GET['course'], $_GET['level'])) exit;

$course = $_GET['course'];
$level  = $_GET['level'];

$tableMap = [
    'UG' => 'ug_courses',
    'PG' => 'pg_courses',
    'Professional' => 'professional_courses',
    'Diploma' => 'diploma_courses'
];

if (!isset($tableMap[$level])) exit;

$table = $tableMap[$level];

$sql = "SELECT eligibility FROM $table WHERE course_name='$course'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    echo $row['eligibility'];
}
