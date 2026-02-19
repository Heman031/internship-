<?php
session_start();
include "db.php";

/* Security */
if (!isset($_SESSION['otp_email'], $_SESSION['form_data'])) {
    header("Location: form.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Clean OTP input
    $otp   = preg_replace('/\s+/', '', $_POST['otp']);
    $email = $_SESSION['otp_email'];

    $stmt = $conn->prepare(
        "SELECT otp, otp_expires_at 
         FROM users 
         WHERE email=? AND is_verified=0"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {

        $currentTime = date("Y-m-d H:i:s");

        if ($row['otp_expires_at'] < $currentTime) {
            $error = "OTP expired. Please resend OTP.";
        }
        elseif ((string)$row['otp'] === (string)$otp) {

            // ✅ Get form data (contains HASHED password)
            $d = $_SESSION['form_data'];

            // ✅ UPDATE users table (THIS FIXES LOGIN)
            $update = $conn->prepare(
                "UPDATE users 
                 SET is_verified=1, otp=NULL, password=? 
                 WHERE email=?"
            );
            $update->bind_param(
                "ss",
                $d['password'],   // 🔐 hashed password
                $email
            );
            $update->execute();

            // Insert student data
            $insert = $conn->prepare(
                "INSERT INTO students
                 (name, mobile, email, level, course)
                 VALUES (?,?,?,?,?)"
            );
            $insert->bind_param(
                "sssss",
                $d['name'],
                $d['mobile'],
                $d['email'],
                $d['programme'],
                $d['course_name']
            );
            $insert->execute();

            // Clear session
            session_destroy();

            echo "<script>
                alert('Registration completed successfully 🎉 Please login.');
                window.location='login.php';
            </script>";
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
<title>Verify OTP</title>

<style>
/* HEADER */
.top-header {
    background: #3872e7;
    padding: 10px 0;
    color: white;
}
.container {
    width: 95%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.logo {
    display: flex;
    align-items: center;
}
.logo img {
    width: 150px;
    margin-right: 15px;
}
.tamil-text {
    font-family: "Latha", "Nirmala UI", sans-serif;
    font-size: 16px;
}
.english-text {
    font-family: "Times New Roman", Times, serif;
    font-size: 20px;
}
.nav a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    padding: 6px 12px;
}
.nav a:hover {
    background: rgba(255,255,255,0.2);
    border-radius: 4px;
}

/* BANNER */
.banner {
    min-height: 100vh;
    background: url("image/back.jpeg") center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* OTP BOX */
.otp-box {
    background: rgba(255,255,255,0.95);
    padding: 30px;
    width: 350px;
    border-radius: 8px;
    text-align: center;
}
.otp-box input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}
.otp-box button {
    background: rgb(12, 29, 66);
    color: white;
    padding: 10px;
    width: 100%;
    border: none;
    cursor: pointer;
}
.otp-box button:disabled {
    background: gray;
}
.error {
    color: red;
}

/* FOOTER */
footer {
    background: #111010;
    color: white;
    text-align: center;
    padding: 15px;
}
</style>
</head>

<body>

<div class="top-header">
    <div class="container">
        <div class="logo">
            <img src="image/Univ.png">
            <div>
                <div class="tamil-text">சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்</div>
                <div class="english-text">University of Madras – Institute of Distance Education</div>
            </div>
        </div>
        <div class="nav">
            <a href="form.php">Home</a>
        </div>
    </div>
</div>

<div class="banner">
    <div class="otp-box">
        <h2>Verify OTP</h2>

        <p id="timer" style="color:green;font-weight:bold;"></p>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="otp" maxlength="6" placeholder="Enter OTP" required>
            <button type="submit">Verify</button>
        </form>

        <br>

        <form method="post" action="resend_otp.php">
            <button type="submit" id="resendBtn" disabled>Resend OTP</button>
        </form>
    </div>
</div>

<footer>
    © 2026 Distance Education | All Rights Reserved
</footer>

<script>
let timeLeft = 300;
let timer = document.getElementById("timer");
let resendBtn = document.getElementById("resendBtn");

let countdown = setInterval(() => {
    let min = Math.floor(timeLeft / 60);
    let sec = timeLeft % 60;

    timer.innerHTML = "OTP expires in " + min + ":" + (sec < 10 ? "0" : "") + sec;
    timeLeft--;

    if (timeLeft < 0) {
        clearInterval(countdown);
        timer.innerHTML = "OTP expired";
        resendBtn.disabled = false;
    }
}, 1000);
</script>

</body>
</html>