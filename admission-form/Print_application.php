<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['application_no'])) {
    header("Location: ap1.php");
    exit;
}

$appNo = $_SESSION['application_no'];

try {
    $stmt = $pdo->prepare("
SELECT r.*, s.state_name
FROM records r
LEFT JOIN states s ON r.state = s.id
WHERE r.application_no = :appNo
");
    $stmt->execute([':appNo' => $appNo]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        die("Application not found.");
    }

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

function show($key, $data) {
    return htmlspecialchars($data[$key] ?? '');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Application Print</title>

<style>

body{
    font-family:"Times New Roman", serif;
    background:#f4f4f4;
    padding:20px;
}

.container{
    width:900px;
    margin:auto;
    background:#fff;
    padding:30px;
    border:2px solid #000;
}

.header{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    margin-bottom:10px;
}

.header-left{
    width:120px;
}

.header-center{
    flex:1;
    text-align:center;
}

.header-right{
    width:140px;
    text-align:right;
}

.logo{
    width:100px;
}

.photo{
    width:120px;
    height:140px;
    border:1px solid #000;
    object-fit:cover;
}

h1{
    margin:0;
    font-size:22px;
}

h2{
    margin:3px 0;
    font-size:18px;
}

.sub-title{
    font-weight:bold;
    margin-top:5px;
}

hr{
    border:1px solid #000;
    margin:15px 0;
}

.section-title{
    font-weight:bold;
    font-size:16px;
    margin-bottom:8px;
    border-bottom:1px solid #000;
    padding-bottom:4px;
}

.two-column{
    display:flex;
    justify-content:space-between;
}

.col{
    width:48%;
}

.row{
    margin-bottom:6px;
}

.label{
    font-weight:bold;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
    font-size:13px;
}

table th{
    background:#eaeaea;
    font-weight:bold;
}

table th, table td{
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

.enclosure div{
    margin-bottom:5px;
}

.footer{
    margin-top:50px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.print-btn{
    text-align:center;
    margin-top:20px;
}
.header-left img{
    width:250px;
    margin:-20px;
}

@media print{
    body{ background:#fff; }
    .print-btn{ display:none; }
}

</style>
</head>

<body>

<div class="container">

<!-- HEADER -->
<!-- HEADER -->
<div class="header">

    <!-- LEFT LOGO -->
    <div class="header-left">
        <img src="image/Univ.png" class="logo">
    </div>

    <!-- CENTER TITLE -->
    <div class="header-center">
        <strong>சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்</strong><br>
    
        <h1>UNIVERSITY OF MADRAS</h1>
        <h2>Institute of Distance Education</h2>
        <div class="sub-title">சேர்க்கை விண்ணப்பப் படிவம்/Admission Application Form</div>
    </div>

    <!-- RIGHT PHOTO -->
    <div class="header-right">
        <?php
$photoPath = "uploads/" . $data['application_no'] . "/" . $data['photo'];
?>

<?php if(!empty($data['photo']) && file_exists($photoPath)): ?>
    <img src="<?php echo $photoPath; ?>" class="photo">
<?php else: ?>
    <div class="photo"></div>
<?php endif; ?>
    </div>

</div>

<hr>

<div><strong>APPLICATION NO:</strong> <?php echo $appNo; ?></div>


<hr>

<!-- COURSE DETAILS -->
<div class="section-title">COURSE DETAILS</div>

<div class="two-column">
    <div class="col">
        <div class="row"><span class="label">Course Type:</span> <?php echo show('course_type',$data); ?></div>
        <div class="row"><span class="label">Programme:</span> <?php echo show('programme_name',$data); ?></div>
        <div class="row"><span class="label">Foundation Language:</span> <?php echo show('foundation_lang',$data); ?></div>
    </div>

    <div class="col">
        <div class="row"><span class="label">Main Subject:</span> <?php echo show('main_subject',$data); ?></div>
        <div class="row"><span class="label">Medium:</span> <?php echo show('medium',$data); ?></div>
    </div>
</div>
<hr>




<!-- PERSONAL DETAILS -->
<div class="section-title">PERSONAL DETAILS</div>

<div class="two-column">
    <div class="col">
        <div class="row"><span class="label">Name (English):</span> <?php echo show('name_english',$data); ?></div>
        <div class="row"><span class="label">Email:</span> <?php echo show('email',$data); ?></div>
        <div class="row"><span class="label">Age:</span> <?php echo show('age',$data); ?></div>
        <div class="row"><span class="label">Father Name:</span> <?php echo show('guardian_name',$data); ?></div>
        <div class="row"><span class="label">Religion:</span> <?php echo show('religion',$data); ?></div>
    </div>

    <div class="col">
        <div class="row"><span class="label">Name (Tamil):</span> <?php echo show('name_tamil',$data); ?></div>
        <div class="row"><span class="label">DOB:</span> <?php echo show('dob',$data); ?></div>
        <div class="row"><span class="label">Aadhaar:</span> <?php echo show('aadhaar',$data); ?></div>
        <div class="row"><span class="label">Mother Name:</span> <?php echo show('mother_name',$data); ?></div>
        <div class="row"><span class="label">Community:</span> <?php echo show('community',$data); ?></div>
    </div>
</div>

<hr>

<!-- ADDRESS -->
<!-- ADDRESS -->
<div class="section-title">ADDRESS FOR COMMUNICATION </div>

<div class="two-column">

    <!-- LEFT COLUMN -->
    <div class="col">
        <div class="row">
            <span class="label">Name:</span>
            <?php echo show('name',$data); ?>
        </div>

        <div class="row">
            <span class="label">Street:</span>
            <?php echo show('street',$data); ?>
        </div>

        <div class="row">
            <span class="label">Town:</span>
            <?php echo show('town',$data); ?>
        </div>

        <div class="row">
            <span class="label">District:</span>
            <?php echo show('district',$data); ?>
        </div>

        <div class="row">
            <span class="label">Pincode:</span>
            <?php echo show('pincode',$data); ?>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="col">
        <div class="row">
            <span class="label">State:</span>
            <?php echo htmlspecialchars($data['state_name']); ?>
        </div>

        <div class="row">
            <span class="label">Mobile:</span>
            <?php echo show('mobile',$data); ?>
        </div>

        <div class="row">
            <span class="label">Phone:</span>
            <?php echo show('phone',$data); ?>
        </div>
    </div>

</div>




<hr>

<!-- ADDITIONAL INFORMATION -->
<div class="section-title">ADDITIONAL INFORMATION</div>

<div style="margin-top:10px; line-height:1.8;">

<?php
function yesNo($value, $expected){
    return ($value == $expected) ? "☑" : "☐";
}

$abcStatus = $data['abc_status'] ?? '';
$abcID     = $data['abc_id'] ?? '';
?>

<!-- 1. ABC -->
<div style="margin-bottom:12px;">
<strong>Academic Bank of Credit (ABC)</strong><br>

<?php echo ($abcStatus == "Yes") ? "☑" : "☐"; ?> Yes
&nbsp;&nbsp;
<?php echo ($abcStatus == "No") ? "☑" : "☐"; ?> No

<?php if($abcStatus == "Yes" && !empty($abcID)): ?>
<div style="margin-top:6px;">
<?php
$formattedABC = trim(chunk_split($abcID, 4, ' '));
?>

<strong>ABC ID:</strong> <?php echo $formattedABC; ?>
</div>
<?php endif; ?>

</div>

<!-- 2. Other Course -->
<div style="margin-bottom:12px;">
<strong>Are you undergoing any other course in a College / University?</strong><br>

<?php echo ($data['other_course'] == "Yes") ? "☑" : "☐"; ?> Yes
&nbsp;&nbsp;
<?php echo ($data['other_course'] == "No") ? "☑" : "☐"; ?> No

<?php if($data['other_course'] == "Yes" && !empty($data['other_course_details'])): ?>
<div style="margin-top:6px;">
<strong>Details:</strong>
<?php echo htmlspecialchars($data['other_course_details']); ?>
</div>
<?php endif; ?>

</div>

<!-- 3. Defence -->
<div style="margin-bottom:12px;">
<strong>Ward of Defence Personnel / Ex-Servicemen</strong><br>

<?php echo (!empty($data['defence_personnel'])) ? "☑" : "☐"; ?>
Defence Personnel

&nbsp;&nbsp;&nbsp;

<?php echo (!empty($data['ex_servicemen'])) ? "☑" : "☐"; ?>
Ex-Servicemen

</div>

</div>


<!-- EXAMINATION DETAILS -->
<div class="section-title">EXAMINATION DETAILS</div>

<table>
<tr>
<th>Exam</th>
<th>Institution</th>
<th>Board</th>
<th>Year</th>
<th>Reg No</th>
<th>Grade</th>
<th>Max Marks</th>
</tr>

<tr>
<td>SSLC</td>
<td><?php echo show('sslc_school',$data); ?></td>
<td><?php echo show('sslc_board',$data); ?></td>
<td><?php echo show('sslc_pass_year',$data); ?></td>
<td><?php echo show('sslc_reg_no',$data); ?></td>
<td><?php echo show('sslc_grade',$data); ?></td>
<td><?php echo show('sslc_max_marks',$data); ?></td>
</tr>

<tr>
<td>HSC</td>
<td><?php echo show('hsc_school',$data); ?></td>
<td><?php echo show('hsc_board',$data); ?></td>
<td><?php echo show('hsc_pass_year',$data); ?></td>
<td><?php echo show('hsc_reg_no',$data); ?></td>
<td><?php echo show('hsc_grade',$data); ?></td>
<td><?php echo show('hsc_max_marks',$data); ?></td>
</tr>
</table>

<hr>

<!-- ENCLOSURES -->
<div class="section-title">ENCLOSURES SUBMITTED</div>

<div class="enclosure">
<?php
$files = [
'sslc_file' => 'S.S.L.C Statement of Marks',
'hsc_file' => 'HSC / Diploma Statement of Marks',
'ug_file' => 'UG Marks / Provisional / Degree',
'tc_file' => 'Transfer Certificate',
'migration_file' => 'Migration Certificate',
'undertaking_file' => 'Undertaking'
];

foreach($files as $key => $label){
$checked = !empty($data[$key]) ? "☑" : "☐";
echo "<div>$checked $label</div>";
}
?>
</div>
<hr>

<!-- DECLARATION -->
<div class="section-title">DECLARATION</div>

<div style="margin-top:8px; line-height:1.6; text-align:justify;">

<?php
// If you want automatic tick (always ticked for print)
$declarationChecked = "☑"; 
?>

<div style="margin-bottom:10px;">
    <?php echo $declarationChecked; ?>
    I hereby declare that all the particulars given above are correct and 
    I agree to abide by all the Rules and Regulations of the University 
    that are in force from time to time.
</div>

</div>


<!-- FOOTER -->
<!-- FOOTER -->
<div class="footer">

    <!-- LEFT SIDE -->
    <div>
        <div><strong>Place:</strong> ___________________</div>
        <div style="margin-top:6px;">
            <strong>Date:</strong> <?php echo date("d/m/Y"); ?>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div style="text-align:right;">
        <div style="margin-top:40px;">
    <strong>Signature of Applicant</strong>
        </div>
    </div>

</div>