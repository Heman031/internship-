<?php
session_start();
require_once __DIR__ . "/db.php"; // correct db connection

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 🔥 FORCE correct database and table
    $query = "SELECT * FROM admission_db.single_users 
              WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $query);

    // ❌ show real error if any
    if(!$result){
        die("Query Error: " . mysqli_error($conn));
    }

    // ✅ login success
    if(mysqli_num_rows($result) > 0){
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Single Window Admission Login</title>
</head>
<body>

<h2>Single Window Admission Login</h2>

<?php
if(isset($error)){
    echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>

    <label>Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>