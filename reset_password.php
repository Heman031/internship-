<?php
session_start();
include "db.php";

if (!isset($_SESSION['reset_email'])) {
    header("Location: login.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($pass !== $confirm) {
        $error = "Passwords do not match.";
    }
    elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/', $pass)) {
        $error = "Password must be 8+ characters with uppercase, lowercase, number & special character.";
    }
    else {

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];

        $update = $conn->prepare(
            "UPDATE users 
             SET password=?, otp=NULL, otp_expires_at=NULL 
             WHERE email=?"
        );
        $update->bind_param("ss", $hash, $email);
        $update->execute();

        session_destroy();

        echo "<script>
            alert('Password updated successfully. Please login.');
            window.location='login.php';
        </script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password | Distance Education</title>
<link rel="stylesheet" href="style.css">

<style>
/* SAME LOGIN BOX STYLE */
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

.password-hint {
    font-size: 13px;
    color: #666;
    margin-bottom: 10px;
    text-align: center;
}
</style>
</head>

<body>

<div class="banner">
    <div class="login-box">

        <h2>Reset Password</h2>
        <p class="info">Create a new strong password</p>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="password" name="password" placeholder="New Password" required>
            <input type="password" name="confirm" placeholder="Confirm Password" required>

            <div class="password-hint">
                Must be 8+ chars with uppercase, lowercase, number & symbol
            </div>

            <button type="submit">Update Password</button>
        </form>

    </div>
</div>

</body>
</html>
