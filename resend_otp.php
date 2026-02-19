<?php
session_start();
include "db.php";

/* DEBUG (remove in production if you want) */
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

/* Security */
if (!isset($_SESSION['otp_email'])) {
    header("Location: form.php");
    exit;
}

$email  = $_SESSION['otp_email'];
$newOtp = (string) rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

/* Update OTP + reset verification */
$stmt = $conn->prepare(
    "UPDATE users 
     SET otp=?, otp_expires_at=?, is_verified=0
     WHERE email=?"
);

if (!$stmt) {
    die("DB Prepare failed");
}

$stmt->bind_param("sss", $newOtp, $expiry, $email);

if (!$stmt->execute()) {
    die("DB Execute failed");
}

/* SEND OTP MAIL */
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hemaoffice153@gmail.com';
    $mail->Password   = 'pqub jypz oxfn dzkg'; // Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('hemaoffice153@gmail.com', 'Distance Education');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "OTP Verification (Resent)";
    $mail->Body    = "
        <h2>Your New OTP</h2>
        <p style='font-size:18px;'><strong>$newOtp</strong></p>
        <p>This OTP is valid for <b>5 minutes</b>.</p>
        <p>Please do not share your OTP.</p>
    ";

    if (!$mail->send()) {
        throw new Exception("Mailer Error");
    }

    header("Location: verify_otp.php");
    exit;

} catch (Exception $e) {
    echo "<h3>OTP resend failed</h3>";
    echo "<p>{$mail->ErrorInfo}</p>";
}
