<?php
session_start();
require_once "../../db.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM records WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
/* FETCH COURSE FEES */
$feeStmt = $conn->prepare("
SELECT special_fee, tuition_fee, general_fee
FROM course_fees
WHERE course_code=?
LIMIT 1
");

$feeStmt->bind_param("s",$courseCode);
$feeStmt->execute();
$fee = $feeStmt->get_result()->fetch_assoc();

/* BASE VALUES */
$G  = $fee['general_fee'] ?? 0;
$SF = $fee['special_fee'] ?? 0;
$TF = $fee['tuition_fee'] ?? 0;

/* CATEGORY */
$category = $data['approved_category'] ?? 'GENERAL';

/* CALCULATION */
switch($category){

case "VC":
case "PRISONER":
case "DA":
    $concession = $SF + $TF;
    $total_fee  = $G - $concession;
break;

case "STAFF":
    $concession = ($TF * 50) / 100;
    $total_fee  = $G - $concession;
break;

default:
    $concession = 0;
    $total_fee  = $G;
}

/* SAFETY */
if($total_fee < 0){
    $total_fee = 0;
}
/* FETCH COURSE CODE */

if($data['course_type']=="UG"){
$courseTable="ug_courses";
}
elseif($data['course_type']=="PG"){
$courseTable="pg_courses";
}
elseif($data['course_type']=="DIP"){
$courseTable="diploma_courses";
}
else{
$courseTable="certificate_courses";
}

$getCourse = $conn->prepare("
SELECT course_code
FROM $courseTable
WHERE programme_degree=? 
AND main_subject=?
LIMIT 1
");

$getCourse->bind_param(
"ss",
$data['programme_name'],
$data['main_subject']
);

$getCourse->execute();
$courseRow = $getCourse->get_result()->fetch_assoc();

$courseCode = $courseRow['course_code'] ?? '';

/* FETCH COURSE FEES */
$feeStmt = $conn->prepare("
SELECT special_fee, tuition_fee, general_fee
FROM course_fees
WHERE course_code=?
LIMIT 1
");

$feeStmt->bind_param("s",$courseCode);
$feeStmt->execute();
$fee = $feeStmt->get_result()->fetch_assoc();

/* BASE VALUES */
$G  = $fee['general_fee'] ?? 0;
$SF = $fee['special_fee'] ?? 0;
$TF = $fee['tuition_fee'] ?? 0;

/* CATEGORY */
$category = strtoupper($data['approved_category'] ?? 'GENERAL');

/* CALCULATION */
switch($category){

case "VC":
case "PRISONER":
    $total_fee  = $G - $TF;              // ✅ ONLY Tuition
break;

case "DA":
    $total_fee  = $G - ($SF + $TF);      // ✅ Special + Tuition
break;

case "STAFF":
    $total_fee  = $G - (($TF * 50) / 100); // ✅ 50% Tuition
break;

default:
    $total_fee  = $G;
}

/* CONCESSION */
$concession = $G - $total_fee;

/* SAFETY */
if($total_fee < 0){
    $total_fee = 0;
}
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

<style>
body{
    font-family:"Times New Roman", serif;
    margin:0;
}

/* PAGE LAYOUT */
.sheet{
    width:750px;
    margin:10px auto;
}

/* COPY BOX */
.copy-box{
    border:2px solid #4a6ea9;
    border-radius:15px;
    padding:15px;
    margin-bottom:15px;
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
    font-size:18px;
    font-weight:bold;
    letter-spacing:1px;
}

.ide{
    font-size:14px;
}

.addr{
    font-size:12px;
}

.title{
    margin-top:10px;
    font-weight:bold;
    font-size:15px;
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
    padding:3px;
    font-size:13px;
}

.label{
    width:35%;
}

/* SIGNATURE */

.sign-row{
    margin-top:20px;
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

.copy-box{
page-break-inside: avoid;
}

@page{
size:A4;
margin:10mm;
}

}
</style>
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
<td colspan="3">

<table style="width:100%; font-size:15px; border-collapse:collapse;">

<tr>
<td>General Fee</td>
<td style="text-align:right;">₹ <?php echo $G; ?></td>
</tr>

<tr>
<td>Special Fee</td>
<td style="text-align:right;">₹ <?php echo $SF; ?></td>
</tr>

<tr>
<td>Tuition Fee</td>
<td style="text-align:right;">₹ <?php echo $TF; ?></td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td style="color:green;">
Concession (<?php echo $category; ?>)
</td>
<td style="text-align:right; color:green;">
- ₹ <?php echo $concession; ?>
</td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td><b>Total Fees</b></td>
<td style="text-align:right;"><b>₹ <?php echo $total_fee; ?></b></td>
</tr>

</table>


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

<td class="label">Fees to be paid (in Rupees)</td>
<td colspan="2">: ₹ <?php echo number_format($total_fee); ?></td>
<tr>
<td colspan="3">

<table style="width:100%; font-size:15px; border-collapse:collapse;">

<tr>
<td>General Fee</td>
<td style="text-align:right;">₹ <?php echo $G; ?></td>
</tr>

<tr>
<td>Special Fee</td>
<td style="text-align:right;">₹ <?php echo $SF; ?></td>
</tr>

<tr>
<td>Tuition Fee</td>
<td style="text-align:right;">₹ <?php echo $TF; ?></td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td style="color:green;">
Concession (<?php echo $category; ?>)
</td>
<td style="text-align:right; color:green;">
- ₹ <?php echo $concession; ?>
</td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td><b>Total Fees</b></td>
<td style="text-align:right;"><b>₹ <?php echo $total_fee; ?></b></td>
</tr>

</table>

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