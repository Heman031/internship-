<?php
include "db.php";

$programme = $_GET['programme'];

switch ($programme) {
    case 'UG': $table = 'ug_courses'; break;
    case 'PG': $table = 'pg_courses'; break;
    case 'Diploma': $table = 'diploma_courses'; break;
    case 'Certificate': $table = 'certificate_courses'; break;
    default: exit;
}

$result = mysqli_query($conn,"SELECT id, course_name FROM $table");

echo "<option value=''>-- Select Course --</option>";
while($row = mysqli_fetch_assoc($result)){
    echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
}
