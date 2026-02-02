<?php
include "db.php";

if (!isset($_GET['level'])) exit;

$level = $_GET['level'];

/* Map radio value to table */
$tableMap = [
    'UG' => 'ug_courses',
    'PG' => 'pg_courses',
    'Professional' => 'professional_courses',
    'Diploma' => 'diploma_courses'
];

if (!isset($tableMap[$level])) exit;

$table = $tableMap[$level];

$result = mysqli_query($conn, "SELECT course_name FROM $table");

echo "<option value=''>-- Select Course --</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='{$row['course_name']}'>{$row['course_name']}</option>";
}
?>