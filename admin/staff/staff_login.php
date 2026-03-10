<?php
session_start();
require_once "../../db.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        $error = "Please enter username and password.";
    } else {

        $stmt = $conn->prepare("SELECT * FROM staff WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $staff = $stmt->get_result()->fetch_assoc();

        if($staff && $password == $staff['password']){
            $_SESSION['staff'] = $staff['username'];
            $_SESSION['course_type'] = $staff['course_type'];

            header("Location: students.php");
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
<title>University Staff Login</title>
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

background-image:url("../../image/back.jpeg");
background-size:cover;
background-position:center;
background-repeat:no-repeat;
background-attachment:fixed;
}

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
box-shadow:0 15px 35px rgba(0,0,0,0.3);
text-align:center;
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

</style>
</head>

<body>

<!-- HEADER -->
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
<a href="../../index.php">Home</a>
<a href="#">About</a>
<a href="#">Contact</a>
<a href="../login.php">Admin Login</a>
</nav>

</div>
</header>

<!-- LOGIN BOX -->

<div class="login-wrapper">
<div class="login-box">

<h2>Distance Education Staff</h2>

<p>🔒 Authorized staff access only</p>

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