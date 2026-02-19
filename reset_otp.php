<?php
session_start();
include "db.php";

if (!isset($_SESSION['reset_email'])) {
    header("Location: login.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $otp = trim($_POST['otp']);
    $email = $_SESSION['reset_email'];

    $stmt = $conn->prepare(
        "SELECT otp, otp_expires_at FROM users WHERE email=?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {

        if ($row['otp_expires_at'] < date("Y-m-d H:i:s")) {
            $error = "OTP expired. Please resend.";
        }
        elseif ((string)$row['otp'] === (string)$otp) {
            header("Location: reset_password.php");
            exit;
        } else {
            $error = "Invalid OTP";
        }

    } else {
        $error = "Session expired. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Verify OTP | Distance Education</title>
<link rel="stylesheet" href="style.css">

<style>
/* MATCH LOGIN BOX STYLE */
.banner {
    min-height: calc(100vh - 140px);
    background: url("image/back.jpeg") no-repeat center center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-box {
    background: rgba(255,255,255,0.96);
    width: 380px;
    padding: 35px;
    border-radius: 6px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

.login-box h2 {
    margin-bottom: 10px;
    color: #0c1d42;
    font-size: 24px;
    text-align: center;
}

.login-box p.info {
    font-size: 14px;
    color: #555;
    margin-bottom: 15px;
    text-align: center;
}

.login-box input {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 15px;
}

.login-box input:focus {
    border-color: #0c1d42;
    outline: none;
}

.login-box button {
    background: #0c1d42;
    color: white;
    padding: 12px;
    width: 100%;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

.login-box button:hover {
    background: #142d6b;
}

.error {
    background: #ffe5e5;
    color: #c62828;
    padding: 8px;
    border-radius: 4px;
    font-size: 14px;
    margin-bottom: 10px;
    text-align: center;
}

.back-link {
    margin-top: 15px;
    text-align: center;
    font-size: 14px;
}

.back-link a {
    color: #1a73e8;
    text-decoration: none;
}

.back-link a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="banner">
    <div class="login-box">

        <h2>Verify OTP</h2>
        <p class="info">Enter the OTP sent to your email</p>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <button type="submit">Verify</button>
        </form>

        <div class="back-link">
            <p><a href="forgot_password.php">← Resend OTP</a></p>
        </div>

    </div>
</div>

</body>
</html>
