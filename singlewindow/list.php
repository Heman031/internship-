<?php
include("db.php");

session_start();

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// FILTERS
$search = $_GET['search'] ?? '';
$course = $_GET['course'] ?? '';

// ================= FINAL QUERY =================
$query = "SELECT * FROM records 
          WHERE application_no IS NOT NULL 
          AND enrollment_no IS NOT NULL 
          AND enrollment_no != ''
          AND LOWER(TRIM(status)) = 'approved'";

$params = [];

// SEARCH FILTER
if($search != ''){
    $query .= " AND (application_no LIKE ? OR name LIKE ? OR mobile LIKE ? OR enrollment_no LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// COURSE FILTER
if($course != ''){
    $query .= " AND programme_name = ?";
    $params[] = $course;
}

$query .= " ORDER BY id DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Approved Students</title>

<style>
body{
    font-family:'Segoe UI';
    background:#eef2f7;
    margin:0;
}

/* HEADER */
.top-header{
    width:100%;
    background:linear-gradient(135deg,#2c3e50,#4a6ea9);
    color:#fff;
    padding:15px 25px;
    font-size:18px;
    font-weight:600;
}

/* CONTAINER */
.container{
    width:95%;
    margin:30px auto;
}

/* FILTER BAR */
.filter-bar{
    display:flex;
    gap:15px;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.filter-bar input,
.filter-bar select{
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
}

.filter-bar button{
    background:#2a5298;
    color:#fff;
    border:none;
    padding:10px 20px;
    border-radius:8px;
    cursor:pointer;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
}

th{
    background:#24324a;
    color:#fff;
    padding:15px;
    text-align:left;
}

td{
    padding:15px;
    border-bottom:1px solid #eee;
}

/* BADGE */
.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    background:#d4edda;
    color:#155724;
}

/* BUTTON */
.btn{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:13px;
    background:#2a5298;
    color:#fff;
}

</style>

</head>
<body>

<div class="top-header">
    🎓 University of Madras – Enrolled Students
</div>

<div class="container">

<h2>Approved Students (With Enrollment Number)</h2>

<!-- FILTER -->
<form method="GET" class="filter-bar">
    <input type="text" name="search" placeholder="Search ID / Name / Mobile / Enrollment" value="<?php echo $search; ?>">

    <select name="course">
        <option value="">All Course</option>
        <option <?php if($course=="B.Com") echo "selected"; ?>>B.Com</option>
        <option <?php if($course=="M.A") echo "selected"; ?>>M.A</option>
        <option <?php if($course=="M.Sc") echo "selected"; ?>>M.Sc</option>
    </select>

    <button type="submit">Filter</button>
</form>

<!-- TABLE -->
<table>

<tr>
    <th><input type="checkbox"></th>
    <th>Application No</th>
    <th>Enrollment No</th>
    <th>Name</th>
    <th>Course</th>
    <th>Mobile</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php if(empty($data)){ ?>
<tr>
    <td colspan="9" style="text-align:center; padding:20px; font-weight:bold; color:red;">
        No Approved Students Found
    </td>
</tr>
<?php } else { ?>
<?php foreach($data as $row){ ?>

<tr>
    <td><input type="checkbox"></td>

    <td><?php echo $row['application_no']; ?></td>
    <td><?php echo $row['enrollment_no']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['programme_name']; ?></td>
    <td><?php echo $row['mobile']; ?></td>

    <td>
        <span class="badge">Approved</span>
    </td>

    <td>
        <?php 
        if(!empty($row['created_at'])){
            echo date("d-m-Y", strtotime($row['created_at']));
        } else {
            echo "-";
        }
        ?>
    </td>

</tr>

<?php } ?>
<?php } ?>

</table>

</div>

</body>
</html>