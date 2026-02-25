<?php
session_start();
require_once "../../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

/* Validate ID */
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id <= 0){
    die("Invalid Application ID.");
}

/* Fetch Application */
$stmt = $conn->prepare("SELECT * FROM records WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(!$data){
    die("Application not found.");
}

if(empty($data['status'])){
    $data['status'] = "Pending";
}

/* ===============================
   PROCESS STATUS UPDATE
================================= */
if($_SERVER['REQUEST_METHOD'] === "POST"){

    $remark = trim($_POST['remark'] ?? '');
    $action = $_POST['action'] ?? '';
    $admin  = $_SESSION['admin'];

    if(empty($remark)){
        die("Remark is required.");
    }

    switch($action){
        case "approve": $status = "Approved"; break;
        case "reject": $status = "Rejected"; break;
        case "pending": $status = "Pending"; break;
        default: $status = $data['status'];
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
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style.css">
<title>Application Review</title>
</head>
<body>

<div class="sidebar">
<h2>Distance Education</h2>
<a href="list.php">← Back to Applications</a>
<a href="../dashboard.php">Dashboard</a>
<a href="../logout.php">Logout</a>
</div>

<div class="main">

<h1>Application Review</h1>

<a class="btn view" target="_blank"
href="print.php?id=<?php echo $data['id']; ?>">
Print Application
</a>
<a class="btn approve"
href="edit.php?id=<?php echo $data['id']; ?>">
Edit Application
</a>

<div class="card">

<h2>Application ID: <?php echo htmlspecialchars($data['application_no']); ?></h2>

<hr>

<h3>1. Personal Details</h3>
<table class="details-table">
<tr><td>Name</td><td><?php echo htmlspecialchars($data['name']); ?></td></tr>
<tr><td>Date of Birth</td><td><?php echo htmlspecialchars($data['dob']); ?></td></tr>
<tr><td>Mobile</td><td><?php echo htmlspecialchars($data['mobile']); ?></td></tr>
<tr><td>Email</td><td><?php echo htmlspecialchars($data['email']); ?></td></tr>
<tr><td>Community</td><td><?php echo htmlspecialchars($data['community']); ?></td></tr>
<tr><td>Caste</td><td><?php echo htmlspecialchars($data['caste']); ?></td></tr>
<tr><td>Nationality</td><td><?php echo htmlspecialchars($data['nationality']); ?></td></tr>
<tr><td>Mother Tongue</td><td><?php echo htmlspecialchars($data['mother_tongue']); ?></td></tr>
<tr><td>Employment Status</td><td><?php echo htmlspecialchars($data['employment_status']); ?></td></tr>
<tr><td>Employment Type</td><td><?php echo htmlspecialchars($data['employment_type']); ?></td></tr>
</table>

<hr>

<h3>2. Course Details</h3>
<table class="details-table">
<tr><td>Course Type</td><td><?php echo htmlspecialchars($data['course_type']); ?></td></tr>
<tr><td>Programme</td><td><?php echo htmlspecialchars($data['programme_name']); ?></td></tr>
<tr><td>Main Subject</td><td><?php echo htmlspecialchars($data['main_subject']); ?></td></tr>
<tr><td>Foundation Language</td><td><?php echo htmlspecialchars($data['foundation_lang']); ?></td></tr>
<tr><td>Medium</td><td><?php echo htmlspecialchars($data['medium']); ?></td></tr>
</table>

<hr>

<h3>3. Examination Details</h3>

<table class="details-table">
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
<td><?php echo !empty($data['sslc_school']) ? htmlspecialchars($data['sslc_school']) : '-'; ?></td>
<td><?php echo !empty($data['sslc_board']) ? htmlspecialchars($data['sslc_board']) : '-'; ?></td>
<td><?php echo !empty($data['sslc_pass_year']) ? htmlspecialchars($data['sslc_pass_year']) : '-'; ?></td>
<td><?php echo !empty($data['sslc_reg_no']) ? htmlspecialchars($data['sslc_reg_no']) : '-'; ?></td>
<td><?php echo !empty($data['sslc_grade']) ? htmlspecialchars($data['sslc_grade']) : '-'; ?></td>
<td><?php echo !empty($data['sslc_max_marks']) ? htmlspecialchars($data['sslc_max_marks']) : '-'; ?></td>
</tr>

<tr>
<td>HSC</td>
<td><?php echo !empty($data['hsc_school']) ? htmlspecialchars($data['hsc_school']) : '-'; ?></td>
<td><?php echo !empty($data['hsc_board']) ? htmlspecialchars($data['hsc_board']) : '-'; ?></td>
<td><?php echo !empty($data['hsc_pass_year']) ? htmlspecialchars($data['hsc_pass_year']) : '-'; ?></td>
<td><?php echo !empty($data['hsc_reg_no']) ? htmlspecialchars($data['hsc_reg_no']) : '-'; ?></td>
<td><?php echo !empty($data['hsc_grade']) ? htmlspecialchars($data['hsc_grade']) : '-'; ?></td>
<td><?php echo !empty($data['hsc_max_marks']) ? htmlspecialchars($data['hsc_max_marks']) : '-'; ?></td>
</tr>

<tr>
<td>Diploma</td>
<td><?php echo !empty($data['dip_school']) ? htmlspecialchars($data['dip_school']) : '-'; ?></td>
<td><?php echo !empty($data['dip_board']) ? htmlspecialchars($data['dip_board']) : '-'; ?></td>
<td><?php echo !empty($data['dip_pass_year']) ? htmlspecialchars($data['dip_pass_year']) : '-'; ?></td>
<td><?php echo !empty($data['dip_reg_no']) ? htmlspecialchars($data['dip_reg_no']) : '-'; ?></td>
<td><?php echo !empty($data['dip_grade']) ? htmlspecialchars($data['dip_grade']) : '-'; ?></td>
<td><?php echo !empty($data['dip_max_marks']) ? htmlspecialchars($data['dip_max_marks']) : '-'; ?></td>
</tr>

<tr>
<td>UG</td>
<td><?php echo !empty($data['ug_school']) ? htmlspecialchars($data['ug_school']) : '-'; ?></td>
<td><?php echo !empty($data['ug_board']) ? htmlspecialchars($data['ug_board']) : '-'; ?></td>
<td><?php echo !empty($data['ug_pass_year']) ? htmlspecialchars($data['ug_pass_year']) : '-'; ?></td>
<td><?php echo !empty($data['ug_reg_no']) ? htmlspecialchars($data['ug_reg_no']) : '-'; ?></td>
<td><?php echo !empty($data['ug_grade']) ? htmlspecialchars($data['ug_grade']) : '-'; ?></td>
<td><?php echo !empty($data['ug_max_marks']) ? htmlspecialchars($data['ug_max_marks']) : '-'; ?></td>
</tr>

</table>

<hr>

<h3>4. Other Information</h3>
<table class="details-table">
<tr><td>Other Course</td><td><?php echo htmlspecialchars($data['other_course']); ?></td></tr>
<tr><td>Other Course Details</td><td><?php echo htmlspecialchars($data['other_course_details']); ?></td></tr>
<tr><td>Defence Personnel</td><td><?php echo htmlspecialchars($data['defence_personnel']); ?></td></tr>
<tr><td>Ex-Servicemen</td><td><?php echo htmlspecialchars($data['ex_servicemen']); ?></td></tr>
</table>

<hr>

<h3>5. Uploaded Documents</h3>

<?php
$baseURL  = "/admission/admission-form/uploads/";
$basePath = $_SERVER['DOCUMENT_ROOT'] . $baseURL;
$appFolder = $data['application_no'] . "/";
?>

<?php
function showFile($file, $label, $baseURL, $basePath, $appFolder) {
    if(!empty($file)) {
        $fileName = basename($file);
        $fullPath = $basePath . $appFolder . $fileName;

        if(file_exists($fullPath)) {
            echo '<a class="doc-btn" target="_blank" href="' 
                . $baseURL . $appFolder . $fileName . '">' 
                . $label . '</a><br>';
        } else {
            echo '<p style="color:red;">' . $label . ' File Not Found</p>';
        }
    }
}
?>

<div class="doc-container">
<?php
showFile($data['sslc_file'], "View SSLC", $baseURL, $basePath, $appFolder);
showFile($data['hsc_file'], "View HSC", $baseURL, $basePath, $appFolder);
showFile($data['ug_file'], "View UG", $baseURL, $basePath, $appFolder);
showFile($data['tc_file'], "View Transfer Certificate", $baseURL, $basePath, $appFolder);
showFile($data['migration_file'], "View Migration Certificate", $baseURL, $basePath, $appFolder);
showFile($data['undertaking_file'], "View Undertaking", $baseURL, $basePath, $appFolder);
?>
</div>

<hr>

<h3>6. Application Status</h3>

<?php if($data['status']=="Pending"): ?>

<form method="POST">
<label><strong>Staff Remark</strong></label>
<textarea name="remark" rows="4" required></textarea>
<br><br>

<button name="action" value="approve" class="btn approve">Approve</button>
<button name="action" value="reject" class="btn reject">Reject</button>
</form>

<?php else: ?>

<p><strong>Status:</strong> <?php echo htmlspecialchars($data['status']); ?></p>
<p><strong>Processed By:</strong> <?php echo htmlspecialchars($data['processed_by']); ?></p>
<p><strong>Processed At:</strong> <?php echo htmlspecialchars($data['processed_at']); ?></p>
<p><strong>Remark:</strong> <?php echo htmlspecialchars($data['staff_remark']); ?></p>

<br>

<button onclick="document.getElementById('editStatus').style.display='block'"
class="btn view">Edit Status</button>

<div id="editStatus" style="display:none; margin-top:15px;">
<form method="POST">

<label><strong>Update Remark</strong></label>
<textarea name="remark" rows="3" required></textarea>
<br><br>

<button name="action" value="approve" class="btn approve">Approve</button>
<button name="action" value="pending" class="btn view">Pending</button>
<button name="action" value="reject" class="btn reject">Reject</button>

</form>
</div>

<?php endif; ?>
</div>
</div>

</body>
</html>