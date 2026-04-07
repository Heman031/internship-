<?php
session_start();
require_once "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// Fetch user
$stmt = $conn->prepare("SELECT * FROM swl_users WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Update
if(isset($_POST['update'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($password)){
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE swl_users SET username=?, password=? WHERE id=?");
        $update->bind_param("ssi",$username,$hashed,$id);
    } else {
        $update = $conn->prepare("UPDATE swl_users SET username=? WHERE id=?");
        $update->bind_param("si",$username,$id);
    }

    $update->execute();

    echo "<p style='color:green;'>Updated successfully</p>";
}
?>

<h2>Edit SWL User</h2>

<form method="POST">
    Username:
    <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br><br>

    New Password:
    <input type="password" name="password" placeholder="Leave blank to keep same"><br><br>

    <button name="update">Update</button>
</form>