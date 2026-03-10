<?php
session_start();
include "../db.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        $error = "Please enter username and password.";
    } else {

        $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $admin = $stmt->get_result()->fetch_assoc();

        if($admin && password_verify($password, $admin['password'])){
            $_SESSION['admin'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid login credentials.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>University Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI", Arial, sans-serif;
}

/* BODY */
body{
    min-height:100vh;
    margin:0;

    background-image: url("../image/back.jpeg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;

    position: relative;
}

/* HEADER */
.top-header{
    background: #2374ad;
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

/* LOGO */
.logo{
    display:flex;
    align-items:center;
}

.logo img{
    width:70px;
    margin-right:15px;
}

.tamil-text{
    font-size:14px;
}

.english-text{
    font-size:18px;
    font-weight:bold;
}

/* NAVIGATION */
.nav a{
    color:white;
    text-decoration:none;
    margin-left:15px;
    padding:6px 12px;
    border-radius:4px;
    transition:0.3s;
}

.nav a:hover{
    background:rgba(255,255,255,0.2);
}

/* LOGIN WRAPPER */
.login-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    height:80vh;
}

/* LOGIN BOX */
.login-box{
    background:white;
    width:380px;
    padding:40px;
    border-radius:12px;
    box-shadow:0 15px 35px rgba(235, 240, 245, 0.3);
    text-align:center;
    animation:fadeIn 0.5s ease-in-out;
}

.login-box h2{
    margin-bottom:25px;
    color:#1e293b;
}

/* INPUTS */
.login-box input{
    width:100%;
    padding:12px;
    margin-bottom:18px;
    border:1px solid #d1d5db;
    border-radius:8px;
    font-size:14px;
    transition:0.3s;
}

.login-box input:focus{
    border-color:#2563eb;
    outline:none;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
}

/* BUTTON */
.login-box button{
    width:100%;
    padding:12px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.login-box button:hover{
    background:#1e40af;
}

/* ERROR */
.error{
    background:#fee2e2;
    color:#991b1b;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
    font-size:14px;
}

/* ANIMATION */
@keyframes fadeIn{
    from{ opacity:0; transform:translateY(-15px);}
    to{ opacity:1; transform:translateY(0);}
}

/* RESPONSIVE */
@media(max-width:768px){
    .container{
        flex-direction:column;
        text-align:center;
    }
    .nav{
        margin-top:10px;
    }
}

</style>
</head>
<body>

<!-- HEADER -->
<header class="top-header">
    <div class="container">

        <div class="logo">
            <img src="../image/Univ.png" alt="University Logo">
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
            <a href="../index.php">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="staff/staff_login.php">Staff Login</a>
        </nav>

    </div>
</header>

<!-- LOGIN SECTION -->
<div class="login-wrapper">
    <div class="login-box">

        <h2>Distance Education Admin</h2>
        <div class="login-note">
    🔒 This portal is restricted to authorized university administrators only.
</div>

        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

    </div>
</div>

</body>
</html>