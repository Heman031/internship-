<?php
session_start();

/* -------------------------------
   SERVER-SIDE VALIDATION
-------------------------------- */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* AGE VALIDATION (17+) */
    $dob = $_POST['dob'];
    $dobDate = new DateTime($dob);
    $today   = new DateTime();
    $age     = $today->diff($dobDate)->y;

    if ($age < 17) {
        echo "<script>alert('Applicant must be at least 17 years old.');window.history.back();</script>";
        exit;
    }

    /* EMAIL VALIDATION */
    $email        = $_POST['email'];
    $confirmEmail = $_POST['confirm_email'];

    if ($email !== $confirmEmail) {
        echo "<script>alert('Emails do not match.');window.history.back();</script>";
        exit;
    }

    /* PASSWORD VALIDATION */
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match.');window.history.back();</script>";
        exit;
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\\d)(?=.*[@$!%*?&]).{8,}$/', $password)) {
        echo "<script>alert('Password must contain uppercase, lowercase, number & special character (min 8 chars).');window.history.back();</script>";
        exit;
    }

    /* HASH PASSWORD */
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $_SESSION['form_data'] = [
        'programme'   => $_POST['programme'],
        'name'        => $_POST['name'],
        'mobile'      => $_POST['mobile'],
        'email'       => $email,
        'password'    => $hashedPassword,
        'dob'         => $_POST['dob'],
        'course_id'   => $_POST['course'],
        'course_name' => $_POST['course_name'],
        'eligibility' => $_POST['eligibility']
    ];

    header("Location: next.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Distance Education Registration</title>
  <style>
    * {margin:0; padding:0; box-sizing:border-box; font-family:"Roboto",sans-serif;}
    body {background:#f5f7fa; color:#333;}
    header {background:linear-gradient(90deg,#0066cc,#004080); color:#fff; padding:20px; display:flex; align-items:center; justify-content:space-between;}
    header .logo {display:flex; align-items:center;}
    header .logo img {height:60px; margin-right:15px;}
    nav a {color:#fff; margin-left:20px; text-decoration:none; font-weight:500;}
    nav a:hover {text-decoration:underline;}
    .container {max-width:900px; margin:40px auto; background:#fff; padding:40px; border-radius:12px; box-shadow:0 6px 16px rgba(0,0,0,0.1);}
    h2 {text-align:center; margin-bottom:30px; color:#004080;}
    form {display:grid; grid-template-columns:1fr 1fr; gap:20px;}
    form label {font-weight:600; margin-bottom:6px; display:block; color:#004080;}
    form input, form select {width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;}
    form input:focus, form select:focus {border-color:#0066cc; outline:none;}
    .full-width {grid-column:1 / span 2;}
    small {font-size:12px; color:red;}
    .note {grid-column:1 / span 2; background:#eef6ff; border-left:4px solid #0066cc; padding:12px; margin-top:10px;}
    button {grid-column:1 / span 2; padding:14px; background:#0066cc; color:#fff; border:none; border-radius:6px; font-size:16px; font-weight:bold; cursor:pointer; margin-top:20px;}
    button:disabled {background:#999; cursor:not-allowed;}
    button:hover:not(:disabled) {background:#004080;}
    footer {text-align:center; padding:20px; background:#004080; color:#fff; margin-top:40px;}
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="image/Univ.png" alt="University Logo">
    <div>
      <div>சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்</div>
      <div>University of Madras – Institute of Distance Education</div>
    </div>
  </div>
  <nav>
    <a href="index.php">Home</a>
    <a href="#">About Us</a>
    <a href="#">Contact Us</a>
  </nav>
</header>

<div class="container">
  <h2>Distance Education Registration</h2>
  <form method="post">
    <div>
      <label>Programme</label>
      <select name="programme" onchange="loadCourses(this.value)" required>
        <option value="">-- Select Programme --</option>
        <option value="UG">Under Graduate</option>
        <option value="PG">Post Graduate</option>
        <option value="Diploma">Diploma</option>
        <option value="Certificate">Certificate</option>
      </select>
    </div>

    <div>
      <label>Name</label>
      <input type="text" name="name" required>
    </div>

    <div>
      <label>Mobile</label>
      <input type="text" name="mobile" maxlength="10" pattern="[0-9]{10}" required>
    </div>

    <div>
      <label>Email</label>
      <input type="email" name="email" id="email" required oninput="validateForm()">
    </div>

    <div>
      <label>Confirm Email</label>
      <input type="email" name="confirm_email" id="confirm_email" required oninput="validateForm()">
      <small id="emailHint"></small>
    </div>

    <div>
      <label>Password</label>
      <input type="password" name="password" id="password" required oninput="validateForm()">
    </div>

    <div>
      <label>Confirm Password</label>
      <input type="password" name="confirm_password" id="confirm_password" required oninput="validateForm()">
      <small id="passwordHint"></small>
    </div>

    <div>
      <label>Date of Birth</label>
      <input type="date" name="dob" id="dob" required max="<?php echo date('Y-m-d', strtotime('-17 years')); ?>" onchange="validateForm()">
    </div>

    <div>
      <label>Course</label>
      <select name="course" id="course" onchange="loadEligibility(this); validateForm();" required>
        <option value="">-- Select Course --</option>
      </select>
    </div>

    <div id="eligibilityBox" class="note full-width">
      Please check the eligibility criteria before applying.
    </div>

    <input type="hidden" name="eligibility" id="eligibility">
    <input type="hidden" name="course_name" id="course_name">

    <div class="full-width">
      <label><input type="checkbox" required onchange="validateForm()"> All details are authorized</label>
    </div>

    <button type="submit" id="nextBtn" disabled>Next</button>
  </form>
</div>

<script src="script.js"></script>
<script>
function validateForm() {
    const dob = document.getElementById("dob").value;
    const pwd = document.getElementById("password").value;
    const cpw = document.getElementById("confirm_password").value;
    const email = document.getElementById("email").value;
    const cemail = document.getElementById("confirm_email").value;
    const course = document.getElementById("course").value;

    const hint = document.getElementById("passwordHint");
    const emailHint = document.getElementById("emailHint");

    let valid = true;

    if (dob) {
        const d = new Date(dob);
        const t = new Date();
        let age = t.getFullYear() - d.getFullYear();
        const m = t.getMonth() - d.getMonth();
        if (m < 0 || (m === 0 && t.getDate() < d.getDate())) age--;
        if (age < 17) valid = false;
    } else valid = false;

    if (email !== cemail) {
        emailHint.innerText = "Emails do not match.";
        valid = false;
    } else {
        emailHint.innerText = "";
    }

    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d