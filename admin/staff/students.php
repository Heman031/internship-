<?php
session_start();
require_once "../../db.php";

if(!isset($_SESSION['staff'])){
    header("Location: staff_login.php");
    exit();
}

$type = $_SESSION['course_type'];
$search = $_GET['search'] ?? '';

if(!empty($search)){

$searchTerm = "%".$search."%";

$stmt = $conn->prepare("
SELECT * FROM records 
WHERE course_type=? 
AND (
application_no LIKE ?
OR enrollment_no LIKE ?
OR name LIKE ?
OR mobile LIKE ?
)
ORDER BY id DESC
");

$stmt->bind_param("sssss",$type,$searchTerm,$searchTerm,$searchTerm,$searchTerm);

}else{

$stmt = $conn->prepare("
SELECT * FROM records 
WHERE course_type=? 
ORDER BY id DESC
");

$stmt->bind_param("s",$type);

}

$stmt->execute();
$result=$stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<title>Student List</title>

<style>
    /* HEADER */

.top-header{
background:#2374ad;
padding:15px 0;
color:white;
}

.container{
width:95%;
margin:auto;
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
display:flex;
align-items:center;
}

.logo img{
width:60px;
margin-right:15px;
}

.tamil-text{
font-size:14px;
}

.english-text{
font-size:18px;
font-weight:bold;
}

.nav a{
color:white;
text-decoration:none;
margin-left:15px;
padding:6px 12px;
border-radius:4px;
}

.nav a:hover{
background:rgba(255,255,255,0.2);
}

body{
font-family:Arial;
background:#f5f7fb;
margin:0;
}

/* TABLE */

.table-container{
width:95%;
margin:30px auto;
background:white;
border-radius:8px;
overflow:hidden;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

table{
width:100%;
border-collapse:collapse;
}

thead{
background:#1f2a44;
color:white;
}

thead th{
padding:15px;
text-align:left;
font-size:15px;
}

tbody td{
padding:15px;
border-bottom:1px solid #eee;
}

tbody tr:hover{
background:#f9fafc;
}

/* CHECKBOX */

input[type="checkbox"]{
width:18px;
height:18px;
}

/* STATUS BADGE */

.status{
padding:6px 14px;
border-radius:20px;
font-size:13px;
font-weight:bold;
}

.approved{
background:#c7ead7;
color:#0b6b3a;
}

.pending{
background:#ffe6a3;
color:#996c00;
}

.rejected{
background:#f5c6cb;
color:#7a0000;
}

/* VIEW BUTTON */

.view-btn{
background:#1d4ed8;
color:white;
padding:8px 18px;
border-radius:8px;
text-decoration:none;
font-size:14px;
}

.view-btn:hover{
background:#123bb5;
}

</style>
</head>

<body>

<header class="top-header">

<div class="container">

<div class="logo">

<img src="../../image/Univ.png" alt="University Logo">

<div>

<div class="tamil-text">
சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்
</div>

<div class="english-text">
University of Madras – Institute of Distance Education
</div>

</div>

</div>

<nav class="nav">

<a href="../dashboard.php">Home</a>

<a href="students.php">Student List</a>

<a href="../logout.php">Logout</a>

</nav>

</div>

</header>
    <form method="GET" style="margin:20px;">

<input type="text" name="search"
placeholder="Search Application / Enrollment / Name / Mobile"
value="<?php echo $_GET['search'] ?? ''; ?>"
style="padding:10px;width:300px;border:1px solid #ccc;border-radius:6px;">

<button type="submit"
style="padding:10px 15px;background:#1d4ed8;color:#fff;border:none;border-radius:6px;">
Search
</button>

<a href="students.php"
style="padding:10px 15px;background:#555;color:#fff;text-decoration:none;border-radius:6px;">
Reset
</a>

</form>

<div class="table-container">

<table>

<thead>
<tr>
<th><input type="checkbox"></th>
<th>Enrollment No</th>
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

<?php while($row=$result->fetch_assoc()){

$statusClass="pending";

if($row['status']=="Approved") $statusClass="approved";
elseif($row['status']=="Rejected") $statusClass="rejected";

?>

<tr>

<td><input type="checkbox"></td>

<td>
<?php 
if(!empty($row['enrollment_no'])){
    echo $row['enrollment_no'];
}else{
    echo "-";
}
?>
</td>

<td><?php echo $row['application_no']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['programme_name']; ?></td>

<td><?php echo $row['mobile']; ?></td>

<td>
<span class="status <?php echo $statusClass; ?>">
<?php echo $row['status']; ?>
</span>
</td>

<td><?php echo date("d-m-Y",strtotime($row['created_at'])); ?></td>

<td>
<a class="view-btn" href="view.php?id=<?php echo $row['id']; ?>">
View
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>