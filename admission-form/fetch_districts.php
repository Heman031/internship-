<?php
require "db.php";

if(isset($_GET['state_id'])) {

    $stmt = $pdo->prepare(
        "SELECT district_name FROM districts WHERE state_id = ? ORDER BY district_name"
    );
    $stmt->execute([$_GET['state_id']]);

    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
}