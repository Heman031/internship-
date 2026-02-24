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

/* Default Status */
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

    /* Determine Status */
    switch($action){
        case "approve":
            $status = "Approved";
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

    /* Update Record */
    $update = $conn->prepare("
        UPDATE records 
        SET status=?, staff_remark=?, processed_by=?, processed_at=NOW()
        WHERE id=?
    ");
    $update->bind_param("sssi", $status, $remark, $admin, $id);
    $update->execute();

    /* Insert Log */
    $log = $conn->prepare("
        INSERT INTO approval_logs
        (application_id, application_no, action_type, remark, processed_by)
        VALUES (?,?,?,?,?)
    ");
    $log->bind_param(
        "issss",
        $id,
        $data['application_no'],
        $status,
        $remark,
        $admin
    );
    $log->execute();

    /* Email Notification */
    if(!empty($data['email'])){
        $to = $data['email'];
        $subject = "Application Status Update - ".$data['application_no'];

        $message = "Dear ".$data['name'].",\n\n";
        $message .= "Your application (".$data['application_no'].") has been ".$status.".\n\n";
        $message .= "Remark:\n".$remark."\n\n";
        $message .= "Regards,\nDistance Education Department";

        @mail($to, $subject, $message);
    }

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
</table>

<hr>

<h3>2. Course Details</h3>
<table class="details-table">
<tr><td>Course Type</td><td><?php echo htmlspecialchars($data['course_type']); ?></td></tr>
<tr><td>Programme</td><td><?php echo htmlspecialchars($data['programme_name']); ?></td></tr>
<tr><td>Medium</td><td><?php echo htmlspecialchars($data['medium']); ?></td></tr>
</table>

<hr>

<h3>3. Uploaded Documents</h3>

<h3>3. Uploaded Documents</h3>

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
                . $label . '</a>';
        } else {
            echo '<p style="color:red;">' . $label . ' File Not Found</p>';
        }
    }
}
?>

<?php
showFile($data['sslc_file'], "View SSLC", $baseURL, $basePath, $appFolder);
showFile($data['hsc_file'], "View HSC", $baseURL, $basePath, $appFolder);
showFile($data['ug_file'], "View UG", $baseURL, $basePath, $appFolder);
?>
<?php if($data['status']=="Pending"): ?>

<form method="POST">
<label>Staff Remark</label>
<textarea name="remark" rows="4" required></textarea>
<br><br>

<button name="action" value="approve" class="btn approve">Approve</button>
<button name="action" value="reject" class="btn reject">Reject</button>
</form>

<?php else: ?>

<p><strong>Processed By:</strong> <?php echo htmlspecialchars($data['processed_by']); ?></p>
<p><strong>Processed At:</strong> <?php echo htmlspecialchars($data['processed_at']); ?></p>
<p><strong>Remark:</strong> <?php echo htmlspecialchars($data['staff_remark']); ?></p>

<br>

<button onclick="document.getElementById('editStatus').style.display='block'"
class="btn view">Edit Status</button>

<div id="editStatus" style="display:none; margin-top:15px;">
<form method="POST">

<label>Update Remark</label>
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