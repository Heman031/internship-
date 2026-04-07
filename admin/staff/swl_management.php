<?php
session_start();
require_once "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

// Fetch SWL users
$stmt = $conn->query("SELECT * FROM swl_users");
?>

<h2>SWL Management</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Action</th>
</tr>

<?php while($row = $stmt->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td>
        <a href="edit_swl.php?id=<?php echo $row['id']; ?>">Edit</a>
    </td>
</tr>
<?php endwhile; ?>
</table>