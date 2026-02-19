<?php
session_start();
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

/* Get email from session */
if (!isset($_SESSION['form_data'])) {
    header("Location: form.php");
    exit;
}

$email = $_SESSION['form_data']['email'];
$otp = strval(rand(100000, 999999));
$expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

$check = $conn->prepare("SELECT is_verified FROM users WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($row = $result->fetch_assoc()) {

    if ($row['is_verified'] == 1) {
        echo "<script>
            alert('Email already verified.');
            window.location='form.php';
        </script>";
        exit;
    }

    $update = $conn->prepare(
        "UPDATE users SET otp=?, otp_expires_at=? WHERE email=?"
    );
    $update->bind_param("sss", $otp, $expiry, $email);
    $update->execute();

} else {

    $insert = $conn->prepare(
        "INSERT INTO users (email, otp, otp_expires_at, is_verified)
         VALUES (?, ?, ?, 0)"
    );
    $insert->bind_param("sss", $email, $otp, $expiry);
    $insert->execute();
}

$_SESSION['otp_email'] = $email;


/* SEND OTP MAIL */
$mail = new PHPMailer(true);

try {
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
    $mail->Subject = "🔐 OTP Verification - Distance Education";

    /* 🔥 COLORED PROFESSIONAL EMAIL DESIGN */
    $mail->Body = "
    <div style='
        max-width:500px;
        margin:auto;
        padding:25px;
        border:1px solid #ddd;
        border-radius:8px;
        font-family:Arial, sans-serif;
        text-align:center;
        background:#f9fbff;
    '>
        <h2 style='color:#0c1d42; margin-bottom:15px;'>
            Distance Education
        </h2>

        <p style='font-size:16px; color:#333;'>
            Your One Time Password (OTP) is:
        </p>

        <div style='
            font-size:30px;
            font-weight:bold;
            color:#ffffff;
            background:#1a75ba;
            padding:14px;
            border-radius:6px;
            letter-spacing:5px;
            margin:20px 0;
        '>
            $otp
        </div>

        <p style='color:#dc3545; font-size:14px;'>
            This OTP is valid for 5 minutes.
        </p>

        <p style='font-size:13px; color:#888;'>
            Do not share this OTP with anyone for security reasons.
        </p>
    </div>
    ";

    $mail->send();
    header("Location: verify_otp.php");
    exit;

} catch (Exception $e) {
    echo "Mail Error: {$mail->ErrorInfo}";
}
?>
