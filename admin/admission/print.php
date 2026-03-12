<?php
session_start();
require_once "../../db.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM records WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

$date = date("d-m-Y", strtotime($data['processed_at'] ?? 'now'));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Provisional Admission Intimation</title>

<style>
body{
    font-family:"Times New Roman", serif;
    margin:0;
}

/* PAGE LAYOUT */
.sheet{
    width:900px;
    margin:10px auto;
}

/* COPY BOX */
.copy-box{
    border:3px solid #4a6ea9;
    border-radius:20px;
    padding:20px;
    margin-bottom:30px;
}

/* HEADER */
.header{
    text-align:center;
    position:relative;
}

.logo{
    position:absolute;
    left:0;
    top:0;
    width:100px;
}

.uni-title{
    font-size:22px;
    font-weight:bold;
    letter-spacing:1px;
}

.ide{
    font-size:16px;
}

.addr{
    font-size:14px;
}

.title{
    margin-top:10px;
    font-weight:bold;
    font-size:18px;
    letter-spacing:1px;
}

.copy-label{
    position:absolute;
    right:0;
    top:40px;
    background:#4a6ea9;
    color:white;
    padding:5px 12px;
    border-radius:15px;
    font-size:12px;
}

/* DETAILS TABLE */

table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

td{
    padding:6px;
    font-size:15px;
}

.label{
    width:35%;
}

/* SIGNATURE */

.sign-row{
    margin-top:40px;
    display:flex;
    justify-content:space-between;
    text-align:center;
}

.sign{
    width:30%;
}

/* PRINT */
@media print {

body{
margin:0;
}

.sheet{
margin:0 auto;
}

}
</style>
</head>

<body onload="window.print()">

<div class="sheet">

<!-- OFFICE COPY -->

<div class="copy-box">

<div class="header">

<img src="../../image/Univ.png" class="logo">

<div class="uni-title">UNIVERSITY OF MADRAS</div>
<div class="ide">INSTITUTE OF DISTANCE EDUCATION</div>
<div class="addr">CHEPAUK, CHENNAI - 600 005</div>
<div class="addr">Phone : 25613708, E-Mail: ide.director@gmail.com</div>

<div class="title">PROVISIONAL ADMISSION INTIMATION</div>

<div class="copy-label">OFFICE COPY</div>

</div>

<table>

<tr>
<td class="label">Programme</td>
<td>: <?php echo htmlspecialchars($data['programme_name']); ?></td>
<td>Date : <?php echo $date; ?></td>
</tr>

<tr>
<td class="label">Name</td>
<td colspan="2">: <?php echo htmlspecialchars($data['name']); ?></td>
</tr>

<tr>
<td class="label">Enrolment Number</td>
<td colspan="2">: <?php echo htmlspecialchars($data['enrollment_no'] ?? ''); ?></td>
</tr>

<tr>
<td class="label">Year of Admission</td>
<td colspan="2">: <?php echo date("Y"); ?></td>
</tr>

<tr>
<td class="label">Fees to be paid (in Rupees)</td>
<td colspan="2">: </td>
</tr>

<tr>
<td class="label">Original Certificates returned herewith</td>
<td colspan="2">: </td>
</tr>

<tr>
<td class="label">Medium</td>
<td colspan="2">: <?php echo htmlspecialchars($data['medium']); ?></td>
</tr>

</table>

<div class="sign-row">

<div class="sign">
Asst. / ASO
</div>

<div class="sign">
Section Officer
</div>

<div class="sign">
Asst. / Dy. Registrar
</div>

</div>

</div>


<!-- STUDENT COPY -->

<div class="copy-box">

<div class="header">

<img src="../../image/Univ.png" class="logo">

<div class="uni-title">UNIVERSITY OF MADRAS</div>
<div class="ide">INSTITUTE OF DISTANCE EDUCATION</div>
<div class="addr">CHEPAUK, CHENNAI - 600 005</div>
<div class="addr">Phone : 25613708, E-Mail: ide.director@gmail.com</div>

<div class="title">PROVISIONAL ADMISSION INTIMATION</div>

<div class="copy-label">STUDENT COPY</div>

</div>

<table>

<tr>
<td class="label">Programme</td>
<td>: <?php echo htmlspecialchars($data['programme_name']); ?></td>
<td>Date : <?php echo $date; ?></td>
</tr>

<tr>
<td class="label">Name</td>
<td colspan="2">: <?php echo htmlspecialchars($data['name']); ?></td>
</tr>

<tr>
<td class="label">Enrolment Number</td>
<td colspan="2">: <?php echo htmlspecialchars($data['enrollment_no'] ?? ''); ?></td>
</tr>

<tr>
<td class="label">Year of Admission</td>
<td colspan="2">: <?php echo date("Y"); ?></td>
</tr>

<tr>
<td class="label">Fees to be paid (in Rupees)</td>
<td colspan="2">: </td>
</tr>

<tr>
<td class="label">Original Certificates returned herewith</td>
<td colspan="2">: </td>
</tr>

<tr>
<td class="label">Medium</td>
<td colspan="2">: <?php echo htmlspecialchars($data['medium']); ?></td>
</tr>

</table>

<div class="sign-row">

<div class="sign">
Asst. / ASO
</div>

<div class="sign">
Section Officer
</div>

<div class="sign">
Asst. / Dy. Registrar
</div>

</div>

</div>

</div>

</body>
</html>