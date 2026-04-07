<?php
include("db.php");

// FILTERS
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';
$course = $_GET['course'] ?? '';

// QUERY FROM RECORDS TABLE
$query = "SELECT * FROM records WHERE application_id IS NOT NULL";

$params = [];

if($search != ''){
    $query .= " AND (application_id LIKE ? OR name LIKE ? OR mobile LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if($status != ''){
    $query .= " AND status = ?";
    $params[] = $status;
}

if($course != ''){
    $query .= " AND programme_name = ?";
    $params[] = $course;
}

$query .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>SWA List</title>

<style>
body{
    font-family:'Segoe UI';
    background:#eef2f7;
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

/* STATUS BADGES */
.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.approved{background:#d4edda;color:#155724;}
.pending{background:#fff3cd;color:#856404;}
.rejected{background:#f8d7da;color:#721c24;}

/* BUTTONS */
.btn{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:13px;
}

.view{background:#2a5298;color:#fff;}
.edit{background:#0b1e59;color:#fff;}

</style>

</head>
<body>

<div class="container">

<h2>Single Window Applications</h2>

<!-- FILTER -->
<form method="GET" class="filter-bar">
    <input type="text" name="search" placeholder="Search ID / Name / Mobile" value="<?php echo $search; ?>">

    <select name="status">
        <option value="">All Status</option>
        <option <?php if($status=="Approved") echo "selected"; ?>>Approved</option>
        <option <?php if($status=="Pending") echo "selected"; ?>>Pending</option>
        <option <?php if($status=="Rejected") echo "selected"; ?>>Rejected</option>
    </select>

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
    <th>Application ID</th>
    <th>Name</th>
    <th>Course</th>
    <th>Mobile</th>
    <th>Status</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php foreach($data as $row){ ?>

<tr>
    <td><input type="checkbox"></td>

    <td><?php echo $row['application_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['programme_name']; ?></td>
    <td><?php echo $row['mobile']; ?></td>

    <td>
        <span class="badge 
        <?php 
            if($row['status']=="Approved") echo "approved";
            elseif($row['status']=="Rejected") echo "rejected";
            else echo "pending";
        ?>">
        <?php echo $row['status']; ?>
        </span>
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

    <td>
        <button class="btn view">View</button>
        <button class="btn edit">Edit</button>
    </td>
</tr>

<?php } ?>  

</table>

</div>

</body>
</html>