<?php
include "db.php";
header("Content-Type: application/json");

$state_id = $_GET['state_id'];

$result = $conn->query(
  "SELECT district_name FROM districts WHERE state_id='$state_id'"
);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row['district_name'];
}

echo json_encode($data);



