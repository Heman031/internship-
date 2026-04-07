<?php
require "db.php";

$type = $_GET['type'] ?? '';

switch ($type) {
    case "UG":  $table="ug_courses"; break;
    case "PG":  $table="pg_courses"; break;
    case "DIP": $table="diploma_courses"; break;
    case "CERT":$table="certificate_courses"; break;
    default: echo json_encode([]); exit;
}

$stmt = $pdo->query("
    SELECT programme_degree, main_subject
    FROM $table
");

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);