<?php
session_start();
require_once('db.php');

if(!isset($_SESSION['staff'])){
    header("Location: staff_login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("
SELECT r.*, s.state_name
FROM records r
LEFT JOIN states s ON r.state = s.id
WHERE r.id=?
");

$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if(!$data){
    die("Student not found");
}
/* SAVE CC DETAILS */
if(isset($_POST['save_cc_details'])){
    $cc_serial_no = trim($_POST['cc_serial_no'] ?? '');
    $cc_date_of_issue = trim($_POST['cc_date_of_issue'] ?? '');
    $cc_bottom_serial_no_input = trim($_POST['cc_bottom_serial_no'] ?? '');

    if(empty($cc_serial_no) || empty($cc_date_of_issue) || empty($cc_bottom_serial_no_input)){
        echo "<script>alert('All CC fields are required.'); window.history.back();</script>";
        exit;
    }

    if(!preg_match('/^\d{7}$/', $cc_bottom_serial_no_input)){
        echo "<script>alert('Enter exactly 7 digits'); window.history.back();</script>";
        exit;
    }

    $prefix = "2K" . date("y") . "/";

    if(!empty($data['cc_bottom_serial_no'])){
        $parts = explode("/", $data['cc_bottom_serial_no']);
        if(count($parts) == 2){
            $prefix = $parts[0] . "/";
        }
    }

    $full_bottom_serial = $prefix . $cc_bottom_serial_no_input;

    $stmtUpdate = $conn->prepare("
        UPDATE records 
        SET cc_serial_no=?, cc_date_of_issue=?, cc_bottom_serial_no=? 
        WHERE id=?
    ");

    $stmtUpdate->bind_param("sssi", $cc_serial_no, $cc_date_of_issue, $full_bottom_serial, $id);
    $stmtUpdate->execute();

    header("Location: ".$_SERVER['REQUEST_URI']."&success=cc");
    exit;
}
/* PHOTO PATH */
$baseURL  = "/admission/admission-form/uploads/";
$basePath = $_SERVER['DOCUMENT_ROOT'] . $baseURL;

$appFolder = $data['application_no']."/";
$photoFile = $data['photo'] ?? "";

$photoPath = $basePath.$appFolder.$photoFile;
$photoURL  = $baseURL.$appFolder.$photoFile;

$statusClass="badge-pending";

if($data['status']=="Approved") $statusClass="badge-approved";
elseif($data['status']=="Rejected") $statusClass="badge-rejected";

/* SAVE CC DETAILS */
if(isset($_POST['save_cc_details'])){
    $cc_serial_no = trim($_POST['cc_serial_no'] ?? '');
    $cc_date_of_issue = trim($_POST['cc_date_of_issue'] ?? '');
    $cc_bottom_serial_no_input = trim($_POST['cc_bottom_serial_no'] ?? '');

    if(empty($cc_serial_no) || empty($cc_date_of_issue) || empty($cc_bottom_serial_no_input)){
        echo "<script>alert('All CC fields are required.'); window.history.back();</script>";
        exit;
    }

    if(!preg_match('/^\d{7}$/', $cc_bottom_serial_no_input)){
        echo "<script>alert('Enter exactly 7 digits'); window.history.back();</script>";
        exit;
    }

    $prefix = "2K" . date("y") . "/";

    if(!empty($data['cc_bottom_serial_no'])){
        $parts = explode("/", $data['cc_bottom_serial_no']);
        if(count($parts) == 2){
            $prefix = $parts[0] . "/";
        }
    }

    $full_bottom_serial = $prefix . $cc_bottom_serial_no_input;

    $stmtUpdate = $conn->prepare("
        UPDATE records 
        SET cc_serial_no=?, cc_date_of_issue=?, cc_bottom_serial_no=? 
        WHERE id=?
    ");

    $stmtUpdate->bind_param("sssi", $cc_serial_no, $cc_date_of_issue, $full_bottom_serial, $id);
    $stmtUpdate->execute();

    header("Location: ".$_SERVER['REQUEST_URI']."&success=cc");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>

<title>Student Application</title>

<style>

body{
font-family:Arial;
background:#f5f7fb;
}

.main-card{
background:#fff;
padding:25px;
border-radius:8px;
box-shadow:0 3px 12px rgba(0,0,0,0.1);
width:90%;
margin:auto;
margin-top:20px;
}

.header-flex{
display:flex;
justify-content:space-between;
}

.photo-box img{
width:150px;
height:180px;
object-fit:cover;
border:2px solid #000;
border-radius:6px;
}

.section{
margin-top:20px;
border:1px solid #ccc;
border-radius:6px;
padding:15px;
}

.section h3{
border-bottom:2px solid #000;
padding-bottom:6px;
}

.details-table{
width:100%;
border-collapse:collapse;
}

.details-table td{
padding:8px;
border-bottom:1px solid #eee;
}

.details-table td:first-child{
font-weight:bold;
width:30%;
}

.badge-approved{
background:green;
color:#fff;
padding:6px 14px;
border-radius:20px;
}

.badge-rejected{
background:red;
color:#fff;
padding:6px 14px;
border-radius:20px;
}

.badge-pending{
background:orange;
color:#fff;
padding:6px 14px;
border-radius:20px;
}

.doc-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:10px;
}

.doc-btn{
display:block;
background:#003366;
color:#fff;
padding:8px;
text-align:center;
border-radius:4px;
text-decoration:none;
}

</style>

</head>

<body>

<div class="main-card">

<!-- HEADER -->
<div class="header-flex">

<div>

<h2>

Application No : <?php echo $data['application_no']; ?>

<?php if(!empty($data['enrollment_no'])){ ?>

<br>

<span style="font-size:22px;color:#003366;">

Enrollment No : <strong><?php echo $data['enrollment_no']; ?></strong>

</span>

<?php } ?>

</h2>

<p>

<span class="<?php echo $statusClass; ?>">
<?php echo $data['status']; ?>
</span>

</p>

<p><strong>Processed By:</strong> <?php echo $data['processed_by'] ?? '-'; ?></p>
<p><strong>Processed At:</strong> <?php echo $data['processed_at'] ?? '-'; ?></p>

</div>


<!-- PHOTO -->

<div class="photo-box">

<?php if(!empty($photoFile) && file_exists($photoPath)){ ?>

<img src="<?php echo $photoURL; ?>">

<?php }else{ ?>

<div style="width:150px;height:180px;border:1px solid #000;
display:flex;align-items:center;justify-content:center;">
No Photo
</div>

<?php } ?>

</div>

</div>


<!-- COURSE DETAILS -->

<div class="section">

<h3>COURSE DETAILS</h3>

<table class="details-table">

<tr><td>Course Type</td><td><?php echo $data['course_type']; ?></td></tr>

<tr><td>Programme</td><td><?php echo $data['programme_name']; ?></td></tr>

<tr><td>Main Subject</td><td><?php echo $data['main_subject']; ?></td></tr>

<tr><td>Foundation Language</td><td><?php echo $data['foundation_lang']; ?></td></tr>

<tr><td>Medium</td><td><?php echo $data['medium']; ?></td></tr>
<tr>
<td>Specially Challenged</td>
<td>
<?php echo !empty($data['differently_abled']) 
        ? htmlspecialchars($data['differently_abled']) 
        : 'No'; ?>
</td>
</tr>



</table>

</div>


<!-- PERSONAL DETAILS -->
<div class="section">
<h3> PERSONAL DETAILS</h3>

<div style="display:flex; gap:30px; align-items:flex-start;">

<!-- LEFT COLUMN -->
<table class="details-table" style="width:50%;">
<tr><td>Name</td><td><?php echo $data['name'] ?? '-'; ?></td></tr>
<tr><td>Name (Tamil)</td><td><?php echo $data['name_tamil'] ?? '-'; ?></td></tr>
<tr><td>DOB</td><td><?php echo $data['dob'] ?? '-'; ?></td></tr>
<tr><td>Age</td><td><?php echo $data['age'] ?? '-'; ?></td></tr>
<tr><td>Mobile</td><td><?php echo $data['mobile'] ?? '-'; ?></td></tr>
<tr><td>Email</td><td><?php echo $data['email'] ?? '-'; ?></td></tr>
<tr><td>Nationality</td><td><?php echo $data['nationality'] ?? '-'; ?></td></tr>
<tr><td>Mother Tongue</td><td><?php echo $data['mother_tongue'] ?? '-'; ?></td></tr>
</table>

<!-- RIGHT COLUMN -->
<table class="details-table" style="width:50%;">
<tr><td>Father Name</td><td><?php echo $data['guardian_name'] ?? '-'; ?></td></tr>
<tr><td>Mother Name</td><td><?php echo $data['mother_name'] ?? '-'; ?></td></tr>
<tr><td>Aadhaar</td><td><?php echo $data['aadhaar'] ?? '-'; ?></td></tr>
<tr><td>Religion</td><td><?php echo $data['religion'] ?? '-'; ?></td></tr>
<tr><td>Community</td><td><?php echo $data['community'] ?? '-'; ?></td></tr>
<tr><td>Caste</td><td><?php echo $data['caste'] ?? '-'; ?></td></tr>
<tr><td>Employment Status</td>
<td>
<?php
if(!empty($data['employment_status'])){
    echo ucfirst($data['employment_status']);
}else{
    echo '-';
}
?>
</td>
</tr>

<tr><td>Employment Details</td>
<td>
<?php echo $data['employment_type'] ?? '-'; ?>
</td>
</tr>
</table>

</div>
</div>

<!-- ADDRESS -->

<div class="section">

<h3>ADDRESS</h3>

<table class="details-table">

<tr><td>Street</td><td><?php echo $data['street']; ?></td></tr>

<tr><td>Town</td><td><?php echo $data['town']; ?></td></tr>

<tr><td>District</td><td><?php echo $data['district']; ?></td></tr>

<tr><td>State</td><td><?php echo $data['state_name']; ?></td></tr>

<tr><td>Pincode</td><td><?php echo $data['pincode']; ?></td></tr>
<tr><td>Phone</td><td><?php echo $data['phone']; ?></td></tr>
</table>

</div>

<!-- ADDITIONAL INFORMATION -->
<div class="section">
<h3> ADDITIONAL INFORMATION</h3>

<table class="details-table">

<tr>
<td>ABC Status</td>
<td>
<?php echo htmlspecialchars($data['abc_status'] ?? 'No'); ?>
</td>
</tr>

<tr>
<td>ABC ID</td>
<td>
<?php 
if(!empty($data['abc_id'])){
    echo chunk_split($data['abc_id'],4,' ');
}else{
    echo 'Not Available';
}
?>
</td>
</tr>

<tr>
<td>Undergoing Other Course</td>
<td>
<?php echo htmlspecialchars($data['other_course'] ?? 'No'); ?>
</td>
</tr>

<tr>
<td>Other Course Details</td>
<td>
<?php echo !empty($data['other_course_details']) 
        ? htmlspecialchars($data['other_course_details']) 
        : '-'; ?>
</td>
</tr>

<tr>
<td>Ward of Defence</td>
<td>
<?php
if(!empty($data['defence_personnel'])){
    echo "Defence Personnel";
}
elseif(!empty($data['ex_servicemen'])){
    echo "Ex-Servicemen";
}
else{
    echo "None";
}
?>
</td>
</tr>
</table>
</div>


<!-- DOCUMENTS -->

<div class="section">

<h3>UPLOADED DOCUMENTS</h3>

<div class="doc-grid">

<?php

$files = [

'sslc_file'=>'SSLC',

'hsc_file'=>'HSC',

'ug_file'=>'UG',

'tc_file'=>'Transfer Certificate',

'migration_file'=>'Migration Certificate',

'undertaking_file'=>'Undertaking'

];

foreach($files as $key=>$label){

if(!empty($data[$key])){

echo '<a class="doc-btn" target="_blank" href="'.$baseURL.$appFolder.$data[$key].'">'.$label.'</a>';

}

}

?>

</div>

</div>

<!-- ✅ PASTE CC PANEL HERE -->
<div class="section" style="background:#e8f4f8; margin-top:20px; border:1px solid #b3d4fc;">

<h3 style="border-bottom:2px solid #005580; color:#005580;">
COURSE COMPLETION (CC) CERTIFICATE DETAILS
</h3>

<form method="POST">

<table class="details-table">

<tr>
<td>Certificate Serial No.</td>
<td>
<input type="text" name="cc_serial_no"
value="<?php echo htmlspecialchars($data['cc_serial_no'] ?? ''); ?>"
style="width:90%; padding:8px;" required>
</td>
</tr>

<tr>
<td>Date of Issue</td>
<td>
<input type="date" name="cc_date_of_issue"
value="<?php echo htmlspecialchars($data['cc_date_of_issue'] ?? ''); ?>"
style="width:90%; padding:8px;" required>
</td>
</tr>

<?php
$savedBottom = $data['cc_bottom_serial_no'] ?? '';
$prefix = "2K" . date("y") . "/";
$numberPart = "";

if(!empty($savedBottom)){
    $parts = explode("/", $savedBottom);
    if(count($parts) == 2){
        $prefix = $parts[0] . "/";
        $numberPart = $parts[1];
    } else {
        $numberPart = $savedBottom;
    }
}
?>

<tr>
<td>Printed Bottom Serial No.</td>
<td>
<div style="display:flex; width:90%;">
<span style="background:#ddd; padding:8px;">
<?php echo $prefix; ?>
</span>

<input type="text" name="cc_bottom_serial_no"
value="<?php echo $numberPart; ?>"
maxlength="7" pattern="\d{7}"
style="flex:1; padding:8px;" required>
</div>
</td>
</tr>

</table>

<button type="submit" name="save_cc_details" class="doc-btn">
Save CC Details
</button>

<?php
if(isset($_GET['success']) && $_GET['success']=='cc'){
    echo "<span style='color:green;margin-left:10px;'>Saved!</span>";
}
?>

</form>
</div>

</div>

</body>
</html>