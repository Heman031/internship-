<?php
session_start();
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $otp   = rand(100000, 999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $check = $conn->prepare(
        "SELECT id FROM users WHERE email=? AND is_verified=1"
    );
    $check->bind_param("s", $email);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows === 1) {

        $update = $conn->prepare(
            "UPDATE users SET otp=?, otp_expires_at=? WHERE email=?"
        );
        $update->bind_param("sss", $otp, $expiry, $email);
        $update->execute();

        $_SESSION['reset_email'] = $email;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hemaoffice153@gmail.com';
        $mail->Password = 'pqub jypz oxfn dzkg';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('hemaoffice153@gmail.com', 'Distance Education');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Password Reset OTP";
        $mail->Body = "<h2>Your OTP: $otp</h2><p>Valid for 5 minutes</p>";
        $mail->send();

        header("Location: reset_otp.php");
        exit;

    } else {
        $msg = "Email not found or not verified.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password | Distance Education</title>

<style>

/* HEADER */

.header{
background:#10264b;
padding:20px 0;
color:white;
}

.header-container{
width:90%;
margin:auto;
display:flex;
align-items:center;
}

.logo-box{
width:25%;
}

.logo-box img{
height:90px;
}

.title-box{
width:50%;
text-align:center;
}

.title-box h1{
margin:0;
font-size:30px;
letter-spacing:1px;
}

.title-box p{
margin:5px 0 0;
font-size:16px;
}

.empty-box{
width:25%;
}

.logo{
position:absolute;
left:0;
height:60px;
}

.university-name{
text-align:center;
}

.university-name h1{
margin:0;
font-size:26px;
}

.university-name p{
margin:0;
font-size:14px;
}


/* BANNER */

.banner{
min-height: calc(100vh - 160px);
background:url("image/back.jpeg") no-repeat center/cover;
display:flex;
align-items:center;
justify-content:center;
}


/* LOGIN BOX */

.login-box{
background:rgba(255,255,255,0.96);
width:380px;
padding:35px;
border-radius:6px;
box-shadow:0 10px 25px rgba(0,0,0,0.25);
}

.login-box h2{
margin-bottom:15px;
color:#0c1d42;
font-size:24px;
text-align:center;
}

.login-box p.info{
font-size:14px;
color:#555;
margin-bottom:15px;
text-align:center;
}

.login-box input{
width:100%;
padding:12px;
margin:12px 0;
border:1px solid #ccc;
border-radius:4px;
font-size:15px;
}

.login-box input:focus{
border-color:#0c1d42;
outline:none;
}

.login-box button{
background:#0c1d42;
color:white;
padding:12px;
width:100%;
border:none;
border-radius:4px;
font-size:16px;
cursor:pointer;
}

.login-box button:hover{
background:#142d6b;
}

.error{
background:#ffe5e5;
color:#c62828;
padding:8px;
border-radius:4px;
font-size:14px;
margin-bottom:10px;
text-align:center;
}

.back-link{
margin-top:15px;
text-align:center;
font-size:14px;
}

.back-link a{
color:#1a73e8;
text-decoration:none;
}

.back-link a:hover{
text-decoration:underline;
}


/* FOOTER */

.footer{
background:#0c1d42;
color:white;
text-align:center;
padding:12px;
font-size:14px;
}

</style>
</head>

<body>


<!-- HEADER -->
<div class="header">

    <div class="header-container">

        <div class="logo-box">
            <img src="image/Univ.png" alt="University Logo">
        </div>

        <div class="title-box">
            <h1>DISTANCE EDUCATION</h1>
            <p>Online Admission Portal</p>
        </div>

        <div class="empty-box"></div>

    </div>

</div>


<!-- MAIN CONTENT -->

<div class="banner">

<div class="login-box">

<h2>Forgot Password</h2>
<p class="info">Enter your registered email to receive OTP</p>

<?php if ($msg): ?>
<div class="error"><?php echo $msg; ?></div>
<?php endif; ?>

<form method="post">
<input type="email" name="email" placeholder="Registered Email" required>
<button type="submit">Send OTP</button>
</form>

<div class="back-link">
<p><a href="login.php">← Back to Login</a></p>
</div>

</div>

</div>



<!-- FOOTER -->

<div class="footer">
© <?php echo date("Y"); ?> Distance Education Admission Portal. All Rights Reserved.
</div>


</body>
</html>