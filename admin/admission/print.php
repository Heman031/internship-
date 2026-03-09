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

body{
font-family:Arial;
margin:0;
}

/* UNIVERSITY HEADER */

.uni-header{
display:flex;
align-items:center;
color: black;
padding:12px 20px;
}

.uni-logo{
width:90px;
margin-right:15px;
}

.uni-title{
line-height:1.4;
}

.tamil-title{
font-size:20px;
font-weight:bold;
}

.eng-title{
font-size:22px;
font-weight:bold;
}

/* PAGE TITLE */

h2{
text-align:center;
margin:20px 0;
}

/* TABLE STYLE */

table{
width:90%;
margin:auto;
border-collapse:collapse;
}

td{
padding:8px;
border-bottom:1px solid #ddd;
}

.label{
width:30%;
font-weight:bold;
}

</style>

</head>

<body onload="window.print()">

<!-- UNIVERSITY HEADER -->

<div class="uni-header">

<img src="../../image/Univ.png" class="uni-logo">

<div class="uni-title">
    <div class="eng-title">
University of Madras – Institute of Distance Education
</div>

<div class="tamil-title">
சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்
</div>


</div>

</div>


<h2>Distance Education - Approved Application</h2>


<table>

<tr>
<td class="label">Application ID</td>
<td><?php echo htmlspecialchars($data['application_no']); ?></td>
</tr>

<?php if(!empty($data['enrollment_no'])): ?>
<tr>
<td class="label">Enrollment Number</td>
<td><?php echo htmlspecialchars($data['enrollment_no']); ?></td>
</tr>
<?php endif; ?>


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