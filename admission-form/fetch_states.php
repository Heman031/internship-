<?php
require "db.php";

$stmt = $pdo->query("SELECT id, state_name FROM states ORDER BY state_name");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));