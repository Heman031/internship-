<?php
session_start();
require "db.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM lsc_users WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if($user && $password == $user['password']){

        $_SESSION['lsc_code'] = $user['lsc_code'];
        $_SESSION['lsc_name'] = $user['lsc_name'];

        header("Location: admission-form/ap1.php");
        exit;

    } else {
        $error = "Invalid LSC Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>LSC Login</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:url('image/back.jpeg') no-repeat center center/cover;
}

/* TOP HEADER */
.top-header{
    background:#2c6fa3;
    color:#fff;
    padding:10px 20px;
    display:flex;
    align-items:center;
}

.top-header img{
    height:50px;
    margin-right:15px;
}

.top-header h2{
    margin:0;
    font-size:20px;
}

/* LOGIN BOX */
.login-container{
    width:400px;
    margin:80px auto;
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.login-container h2{
    text-align:center;
    margin-bottom:20px;
}

.info{
    background:#f1f5f9;
    padding:10px;
    border-radius:6px;
    font-size:14px;
    margin-bottom:15px;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
    font-size:14px;
}

button{
    width:100%;
    padding:12px;
    background:#2f6ad9;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.error{
    color:red;
    text-align:center;
    margin-bottom:10px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="top-header">
    <img src="image/Univ.png">
    <h2>
        University of Madras – Institute of Distance Education
        <br>
        <small>LSC Login Portal</small>
    </h2>
</div>

<div style="position:absolute; top:15px; right:20px;">
    <a href="/admission/lsc_logout.php"
       onclick="return confirm('Are you sure you want to logout?')"
       style="
        background:#dc2626;
        color:#fff;
        padding:8px 15px;
        text-decoration:none;
        border-radius:6px;
        font-size:14px;
    ">
        Logout
    </a>
</div>

<!-- LOGIN BOX -->
<div class="login-container">

<h2>LSC CENTER AUTHENTICATION PORTAL</h2>

<div class="info">
🔐 This portal is restricted to authorized LSC centers only.
</div>

<?php if(!empty($error)) echo "<div class='error'>$error</div>"; ?>

<form method="post">
<input type="text" name="username" placeholder="Enter LSC Username" required>
<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>
</form>

</div>

</body>
</html>