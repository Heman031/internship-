<?php
session_start();
include "../../db.php";

$id = $_GET['id'];
$stmt = $conn->prepare("UPDATE records SET status='Rejected' WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: list.php");