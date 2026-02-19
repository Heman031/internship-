<?php
include "db.php";
header("Content-Type: application/json");

$result = $conn->query("SELECT id, state_name FROM states");

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
