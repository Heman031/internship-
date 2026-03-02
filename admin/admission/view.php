<?php
session_start();
require_once "../../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id <= 0){
    die("Invalid Application ID.");
}

/* Fetch Application */
$stmt = $conn->prepare("
    SELECT r.*, s.state_name 
    FROM records r
    LEFT JOIN states s ON r.state = s.id
    WHERE r.id=?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if(!$data){
    die("Application not found.");
}

if(empty($data['status'])){
    $data['status'] = "Pending";
}

/* STATUS UPDATE */
if($_SERVER['REQUEST_METHOD'] === "POST"){

    $remark = trim($_POST['remark'] ?? '');
    $action = $_POST['action'] ?? '';
    $admin  = $_SESSION['admin'];

    if(empty($remark)){
        die("Remark is required.");
    }

    switch($action){

    case "approve":

        $status = "Approved";

        if(empty($data['medium'])){
            die("Please select medium before approving.");
        }

        if(empty($data['enrollment_no'])){

            // Academic / Calendar
            $month = date("n");
            $period = ($month <= 6) ? "A" : "C";
            $year = date("y");   // gives 26 instead of 2026
            $centerCode = "101";

            // Detect correct master table
            if($data['course_type'] == "UG"){
                $courseTable = "ug_courses";
            } elseif($data['course_type'] == "PG"){
                $courseTable = "pg_courses";
            } elseif($data['course_type'] == "DIP"){
                $courseTable = "diploma_courses";
            } else {
                $courseTable = "certificate_courses";
            }

            // Fetch course_code
            $getCourse = $conn->prepare("
                SELECT course_code
                FROM $courseTable
                WHERE programme_degree = ?
                AND main_subject = ?
                LIMIT 1
            ");
            $getCourse->bind_param("ss",
                $data['programme_name'],
                $data['main_subject']
            );
            $getCourse->execute();
            $courseRow = $getCourse->get_result()->fetch_assoc();

            if(!$courseRow){
                die("Course not found in master table.");
            }

            $courseCode = strtoupper(trim($courseRow['course_code']));

            $basePrefix = $period.$year.$centerCode;
            $prefix = $basePrefix.$courseCode;

            // Normalize medium
            $medium = strtolower(trim($data['medium']));

            if($medium == "english"){
                $startNumber = 6001;
            } elseif($medium == "tamil"){
                $startNumber = 5001;
            } else {
                die("Invalid medium selected.");
            }

            // Get last enrollment for SAME course + SAME medium
            $check = $conn->prepare("
    SELECT MAX(CAST(RIGHT(enrollment_no,4) AS UNSIGNED)) as last_number
    FROM records
    WHERE enrollment_no LIKE ?
    AND LOWER(medium) = ?
");

$like = $basePrefix . "%";   // IMPORTANT CHANGE HERE
$check->bind_param("ss", $like, $medium);
$check->execute();
$res = $check->get_result()->fetch_assoc();

if(!empty($res['last_number'])){
    $newNumber = $res['last_number'] + 1;
} else {
    $newNumber = $startNumber;
}

$newNumber = str_pad($newNumber, 4, "0", STR_PAD_LEFT);

            $enrollmentNo = $prefix.$newNumber;

            $save = $conn->prepare("
                UPDATE records
                SET enrollment_no=?
                WHERE id=?
            ");
            $save->bind_param("si",$enrollmentNo,$id);
            $save->execute();
        }

        break;

    case "reject":
        $status = "Rejected";
        break;

    case "pending":
        $status = "Pending";
        break;

    default:
        $status = $data['status'];
    }

    $update = $conn->prepare("
        UPDATE records 
        SET status=?, staff_remark=?, processed_by=?, processed_at=NOW()
        WHERE id=?
    ");
    $update->bind_param("sssi", $status, $remark, $admin, $id);
    $update->execute();

    header("Location: view.php?id=".$id);
    exit();
}
 /* PHOTO PATH */
$baseURL  = "/admission/admission-form/uploads/";
$basePath = $_SERVER['DOCUMENT_ROOT'] . $baseURL;
$appFolder = $data['application_no'] . "/";
$photoFile = $data['photo'] ?? '';
$photoPath = $basePath . $appFolder . $photoFile;
$photoURL  = $baseURL . $appFolder . $photoFile;

$statusClass = "badge-pending";
if($data['status']=="Approved") $statusClass="badge-approved";
elseif($data['status']=="Rejected") $statusClass="badge-rejected";
?>
<!DOCTYPE html>
<html>
<head>
<title>University Admin Review</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
.main-card{
    background:#fff;
    padding:25px;
    border-radius:8px;
    box-shadow:0 3px 12px rgba(0,0,0,0.1);
}

.header-flex{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.photo-box img{
    width:150px;
    height:180px;
    object-fit:cover;
    border:2px solid #003366;
    border-radius:6px;
}

.badge-approved{background:green;color:#fff;padding:6px 14px;border-radius:20px;}
.badge-rejected{background:red;color:#fff;padding:6px 14px;border-radius:20px;}
.badge-pending{background:orange;color:#fff;padding:6px 14px;border-radius:20px;}

.section{
    margin-top:20px;
    border:1px solid #ddd;
    border-radius:6px;
    padding:15px;
}

.section h3{
    margin-top:0;
    border-bottom:2px solid #003366;
    padding-bottom:6px;
    color:#003366;
}

.details-table{
    width:100%;
    border-collapse:collapse;
}

.details-table td{
    padding:6px 10px;
    border-bottom:1px solid #eee;
}

.details-table td:first-child{
    font-weight:bold;
    width:30%;
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

.approval-box{
    margin-top:20px;
    border:1px solid #ccc;
    padding:15px;
    border-radius:6px;
    background:#f9f9f9;
}

textarea{
    width:100%;
    padding:8px;
}

</style>
</head>

<body>

<div class="sidebar">
<h2>Distance Education</h2>
<a href="list.php">← Back</a>
<a href="../dashboard.php">Dashboard</a>
<a href="../logout.php">Logout</a>
</div>

<div class="main">
<div class="main-card">

<!-- HEADER -->
<!-- HEADER -->
<div class="header-flex">

<div>
<h2>
Application No: <?php echo htmlspecialchars($data['application_no']); ?>

<?php if(strtolower(trim($data['status'])) == "approved" 
      && !empty($data['enrollment_no'])): ?>
    <br>
    <span style="font-size:22px;color:#003366;">
        Enrollment No: 
        <strong>
            <?php echo htmlspecialchars($data['enrollment_no']); ?>
        </strong>
    </span>
<?php endif; ?>
</h2>

<!-- STATUS BADGE -->
<p>
<span class="<?php echo $statusClass; ?>">
<?php echo htmlspecialchars($data['status']); ?>
</span>
</p>

<p><strong>Processed By:</strong> <?php echo $data['processed_by'] ?? '-'; ?></p>
<p><strong>Processed At:</strong> <?php echo $data['processed_at'] ?? '-'; ?></p>

<!-- PRINT & EDIT BUTTONS -->
<div style="margin-top:15px;">
<a href="print.php?id=<?php echo $data['id']; ?>" 
   target="_blank" 
   class="doc-btn" 
   style="display:inline-block;width:auto;padding:8px 15px;">
   Print Application
</a>

<a href="edit.php?id=<?php echo $data['id']; ?>" 
   class="doc-btn" 
   style="display:inline-block;width:auto;padding:8px 15px;background:#444;margin-left:10px;">
   Edit Application
</a>
</div>

</div>

<!-- PHOTO -->
<div class="photo-box">
<?php if(!empty($photoFile) && file_exists($photoPath)): ?>
<img src="<?php echo $photoURL; ?>">
<?php else: ?>
<div style="width:150px;height:180px;border:1px solid #000;
display:flex;align-items:center;justify-content:center;">
No Photo
</div>
<?php endif; ?>
</div>

</div>
<!-- COURSE DETAILS -->
<div class="section">
<h3>Course Details</h3>
<table class="details-table">
<tr><td>Course Type</td><td><?php echo $data['course_type']; ?></td></tr>
<tr><td>Programme</td><td><?php echo $data['programme_name']; ?></td></tr>
<tr><td>Main Subject</td><td><?php echo $data['main_subject']; ?></td></tr>
<tr><td>Foundation Language</td><td><?php echo $data['foundation_lang']; ?></td></tr>
<tr><td>Medium</td><td><?php echo $data['medium']; ?></td></tr>
</table>
</div>

<!-- PERSONAL DETAILS -->
<div class="section">
<h3>Personal Details</h3>
<table class="details-table">
<tr><td>Name</td><td><?php echo $data['name']; ?></td></tr>
<tr><td>Name (Tamil)</td><td><?php echo $data['name_tamil']; ?></td></tr>
<tr><td>DOB</td><td><?php echo $data['dob']; ?></td></tr>
<tr><td>Age</td><td><?php echo $data['age']; ?></td></tr>
<tr><td>Mobile</td><td><?php echo $data['mobile']; ?></td></tr>
<tr><td>Email</td><td><?php echo $data['email']; ?></td></tr>
<tr><td>Aadhaar</td><td><?php echo $data['aadhaar']; ?></td></tr>
<tr><td>Religion</td><td><?php echo $data['religion']; ?></td></tr>
<tr><td>Community</td><td><?php echo $data['community']; ?></td></tr>
<tr><td>Caste</td><td><?php echo $data['caste']; ?></td></tr>
<tr><td>Nationality</td><td><?php echo $data['nationality']; ?></td></tr>
<tr><td>Mother Tongue</td><td><?php echo $data['mother_tongue']; ?></td></tr>
<tr><td>Employment Status</td><td><?php echo $data['employment_status']; ?></td></tr>
<tr><td>Employment Type</td><td><?php echo $data['employment_type']; ?></td></tr>
</table>
</div>

<!-- ADDRESS -->
<div class="section">
<h3>Address</h3>
<table class="details-table">
<tr><td>Street</td><td><?php echo $data['street']; ?></td></tr>
<tr><td>Town</td><td><?php echo $data['town']; ?></td></tr>
<tr><td>District</td><td><?php echo $data['district']; ?></td></tr>
<tr><td>State</td><td><?php echo $data['state_name']; ?></td></tr>
<tr><td>Pincode</td><td><?php echo $data['pincode']; ?></td></tr>
<tr><td>Phone</td><td><?php echo $data['phone']; ?></td></tr>
</table>
</div>

<!-- DOCUMENTS -->
<div class="section">
<h3>Uploaded Documents</h3>

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
<div class="section">
<h3>Application Status Details</h3>

<table class="details-table">
<tr>
<td>Status</td>
<td>
<span class="<?php echo $statusClass; ?>">
<?php echo htmlspecialchars($data['status']); ?>
</span>
</td>
</tr>

<tr>
<td>Approved / Rejected By</td>
<td><?php echo htmlspecialchars($data['processed_by'] ?? '-'); ?></td>
</tr>

<tr>
<td>Processed Date & Time</td>
<td><?php echo htmlspecialchars($data['processed_at'] ?? '-'); ?></td>
</tr>

<tr>
<td>Staff Remark</td>
<td><?php echo htmlspecialchars($data['staff_remark'] ?? 'Not Updated'); ?></td>
</tr>
</table>

</div>
<!-- APPROVAL -->
<div class="approval-box">
<h3>Approval Panel</h3>

<form method="POST">
<label>Staff Remark</label>
<textarea name="remark" rows="3" required></textarea>
<br><br>
<button type="submit" name="action" value="approve" class="btn approve">Approve</button>
<button type="submit" name="action" value="reject" class="btn reject">Reject</button>
<button type="submit" name="action" value="pending" class="btn view">Set Pending</button>
</form>

</div>

</div>
</div>

</body>
</html>