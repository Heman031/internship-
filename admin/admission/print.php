<?php
session_start();
require_once "../../db.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM records WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Print Application</title>
<style>
body{ font-family:Arial; }
h2{ text-align:center; }
table{ width:100%; border-collapse:collapse; }
td{ padding:8px; border-bottom:1px solid #ddd; }
.label{ width:30%; font-weight:bold; }
</style>
</head>
<body onload="window.print()">

<h2>Distance Education - Approved Application</h2>

<table>

<tr>
<td class="label">Application ID</td>
<td><?php echo htmlspecialchars($data['application_no']); ?></td>
</tr>

<tr>
<td class="label">Name</td>
<td><?php echo htmlspecialchars($data['name']); ?></td>
</tr>

<tr>
<td class="label">Course Type</td>
<td><?php echo htmlspecialchars($data['course_type']); ?></td>
</tr>

<tr>
<td class="label">Programme</td>
<td><?php echo htmlspecialchars($data['programme_name']); ?></td>
</tr>

<tr>
<td class="label">Main Subject</td>
<td><?php echo htmlspecialchars($data['main_subject']); ?></td>
</tr>

<tr>
<td class="label">Foundation Language</td>
<td><?php echo htmlspecialchars($data['foundation_lang']); ?></td>
</tr>

<tr>
<td class="label">Medium</td>
<td><?php echo htmlspecialchars($data['medium']); ?></td>
</tr>

<tr>
<td class="label">Status</td>
<td><?php echo htmlspecialchars($data['status']); ?></td>
</tr>

<tr>
<td class="label">Processed By</td>
<td><?php echo htmlspecialchars($data['processed_by']); ?></td>
</tr>

<tr>
<td class="label">Processed At</td>
<td><?php echo htmlspecialchars($data['processed_at']); ?></td>
</tr>

<tr>
<td class="label">Staff Remark</td>
<td><?php echo !empty($data['staff_remark']) ? htmlspecialchars($data['staff_remark']) : '-'; ?></td>
</tr>

</table>

</body>
</html>