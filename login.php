<?php
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT id, password 
         FROM users 
         WHERE email=? AND is_verified=1"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {

            $_SESSION['student_id'] = $row['id'];
            $_SESSION['student_email'] = $email;

            header("Location: admission-form/ap1.php");
            exit;

        } else {
            $error = "Invalid email or password";
        }

    } else {
        $error = "Account not found or not verified";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Login | University of Madras</title>

<style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

/* HEADER */
.top-header {
    background: #1a75ba;
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
    width: 120px;
    margin-right: 15px;
}

.tamil-text {
    font-size: 15px;
    color: #ffffff;
}

.english-text {
    font-size: 18px;
    color: #ffffff;
    font-weight: bold;
}

/* NAV */
.nav a {
    color: #ffffff;
    text-decoration: none;
    margin-left: 15px;
    padding: 6px 12px;
}

.nav a.active,
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

/* LOGIN BOX */
.white-wrapper {
    width: 520px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    overflow: hidden;
}

/* TITLE BAR */
.uni-title {
    background: linear-gradient( #1c8aea);
    color: #ffffff;
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    padding: 14px;
}

/* CONTENT */
.login-content {
    padding: 30px;
    text-align: center;
}

.login-content img {
    width: 90px;
    margin-bottom: 15px;
}

.login-content h3 {
    font-size: 17px;
    margin-bottom: 20px;
}

.login-content h3 span {
    color: red;
    font-weight: bold;
}

/* TABLE */
.login-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
}

.login-table td {
    border: 1px solid #444;
    padding: 8px;
}

.login-table input {
    width: 100%;
    padding: 6px;
}

/* BUTTON */
button {
    padding: 6px 20px;
    font-size: 15px;
    cursor: pointer;
}

/* ERROR */
.error {
    background: #ffe5e5;
    color: #c62828;
    padding: 8px;
    border-radius: 4px;
    margin-bottom: 10px;
}

/* SHOW PASSWORD */
.show-pass {
    text-align: left;
    margin-bottom: 10px;
    font-size: 14px;
}

/* LINKS */
.login-links {
    margin-top: 15px;
    text-align: center;
    font-size: 14px;
}

.login-links a {
    color: #0b5fa5;
    text-decoration: none;
    font-weight: bold;
}

.login-links a:hover {
    text-decoration: underline;
}

/* FOOTER */
footer {
    background: #075d9f;
    color: #ffffff;
    text-align: center;
    padding: 12px;
}
</style>
</head>

<body>

<header class="top-header">
    <div class="container">
        <div class="logo">
            <img src="image/Univ.png">
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
            <a href="form.php">Home</a>
            <a class="active" href="#">Login</a>
        </nav>
    </div>
</header>

<div class="banner">
    <div class="white-wrapper">

        <div class="uni-title">University of Madras</div>

        <div class="login-content">

            <img src="image/Univ.png">

            <h3>
                Institute of Distance Education
                <span></span><br>
                University Departments
            </h3>

            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post">
                <table class="login-table">
                    <tr>
                        <td>Email :</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td><input type="password" name="password" id="password" required></td>
                    </tr>
                </table>

                <div class="show-pass">
                    <input type="checkbox" onclick="togglePassword()"> Show Password
                </div>

                <button type="submit">Check</button>
            </form>

            <!-- 🔹 NEW OPTIONS ADDED -->
            <div class="login-links">
                <p><a href="forgot_password.php">Forgot Password?</a></p>
                <p>New Applicant? <a href="form.php">Register Here</a></p>
            </div>

        </div>
    </div>
</div>

<footer>
    © 2026 University of Madras. All Rights Reserved.
</footer>

<script>
function togglePassword() {
    const pwd = document.getElementById("password");
    pwd.type = pwd.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
