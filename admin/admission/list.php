<?php
session_start();
require_once "../../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

/* =============================
   HANDLE BULK PROCESS
============================= */
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['bulk_action'])){

    $ids = $_POST['ids'] ?? [];
    $action = $_POST['bulk_action'];
    $admin = $_SESSION['admin'];

    if(!empty($ids)){
        foreach($ids as $id){

            $status = ($action == "approve") ? "Approved" : "Rejected";

            $stmt = $conn->prepare("
                UPDATE records
                SET status=?, processed_by=?, processed_at=NOW()
                WHERE id=?
            ");
            $stmt->bind_param("ssi", $status, $admin, $id);
            $stmt->execute();

            /* Insert approval log */
            $log = $conn->prepare("
                INSERT INTO approval_logs
                (application_id, application_no, action_type, processed_by)
                SELECT id, application_no, ?, ?
                FROM records WHERE id=?
            ");
            $log->bind_param("ssi", $status, $admin, $id);
            $log->execute();
        }
    }

    header("Location: list.php");
    exit();
}

/* =============================
   FILTER + SEARCH
============================= */
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';
$type   = $_GET['type'] ?? '';
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$limit = 10;
$start = ($page - 1) * $limit;

$where = " WHERE 1=1 ";
$params = [];
$types = "";

if($search){
    $where .= " AND (application_no LIKE ? OR name LIKE ? OR mobile LIKE ?)";
    $searchTerm = "%$search%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= "sss";
}

if($status){
    $where .= " AND status=?";
    $params[] = $status;
    $types .= "s";
}

if($type){
    $where .= " AND course_type=?";
    $params[] = $type;
    $types .= "s";
}

/* Total Count */
$countSql = "SELECT COUNT(*) as c FROM records $where";
$countStmt = $conn->prepare($countSql);
if(!empty($params)){
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$totalRows = $countStmt->get_result()->fetch_assoc()['c'];
$totalPages = ceil($totalRows / $limit);

/* Main Query */
$sql = "
SELECT id, application_no, name, course_type, programme_name,
mobile, status, created_at
FROM records
$where
ORDER BY created_at DESC
LIMIT ?,?
";

$stmt = $conn->prepare($sql);

if(!empty($params)){
    $types .= "ii";
    $params[] = $start;
    $params[] = $limit;
    $stmt->bind_param($types, ...$params);
}else{
    $stmt->bind_param("ii", $start, $limit);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style.css">
<title>Application Management</title>
<script>
function toggleSelectAll(source) {
    checkboxes = document.getElementsByName('ids[]');
    for(var i=0; i<checkboxes.length; i++)
        checkboxes[i].checked = source.checked;
}
</script>
</head>
<body>

<div class="sidebar">
<h2>Distance Education</h2>
<a href="../dashboard.php">Dashboard</a>
<a href="list.php">Applications</a>
<a href="history.php">Approval History</a>
<a href="export.php">Export Approved</a>
<a href="../logout.php">Logout</a>
</div>

<div class="main">

<h1>Application Processing</h1>
<p>Total Records: <strong><?php echo $totalRows; ?></strong></p>

<div class="card white">

<!-- FILTER FORM -->
<form method="GET" class="filter-form">
<input type="text" name="search" placeholder="Search ID / Name / Mobile"
value="<?php echo htmlspecialchars($search); ?>">

<select name="status">
<option value="">All Status</option>
<option value="Pending" <?php if($status=="Pending") echo "selected"; ?>>Pending</option>
<option value="Approved" <?php if($status=="Approved") echo "selected"; ?>>Approved</option>
<option value="Rejected" <?php if($status=="Rejected") echo "selected"; ?>>Rejected</option>
</select>

<select name="type">
<option value="">All Course</option>
<option value="UG" <?php if($type=="UG") echo "selected"; ?>>UG</option>
<option value="PG" <?php if($type=="PG") echo "selected"; ?>>PG</option>
<option value="DIP" <?php if($type=="DIP") echo "selected"; ?>>Diploma</option>
<option value="CERT" <?php if($type=="DIP") echo "selected"; ?>>Certificate</option>
</select>

<button type="submit">Filter</button>
</form>

<br>

<form method="POST">

<table class="data-table">
<thead>
<tr>
<th><input type="checkbox" onclick="toggleSelectAll(this)"></th>
<th>Application ID</th>
<th>Name</th>
<th>Course</th>
<th>Mobile</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
<td><?php echo $row['application_no']; ?></td>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['programme_name']; ?></td>
<td><?php echo $row['mobile']; ?></td>
<td>
<?php
if($row['status']=="Pending")
echo "<span class='badge pending'>Pending</span>";
elseif($row['status']=="Approved")
echo "<span class='badge approved'>Approved</span>";
else
echo "<span class='badge rejected'>Rejected</span>";
?>
</td>

<td><?php echo date("d-m-Y", strtotime($row['created_at'])); ?></td>

<td>
<a class="btn view" href="view.php?id=<?php echo $row['id']; ?>">View</a>
<a class="btn edit"
href="edit.php?id=<?php echo $row['id']; ?>">
Edit
</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<br>

<button name="bulk_action" value="approve" class="btn approve">
Bulk Approve
</button>

<button name="bulk_action" value="reject" class="btn reject">
Bulk Reject
</button>

</form>

<br>

<!-- PAGINATION -->
<div class="pagination">
<?php for($i=1;$i<=$totalPages;$i++): ?>
<a class="<?php echo ($i==$page)?'active':''; ?>"
href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&status=<?php echo $status; ?>&type=<?php echo $type; ?>">
<?php echo $i; ?>
</a>
<?php endfor; ?>
</div>

</div>
</div>

</body>
</html>