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
        echo "<script>
            alert('Applicant must be at least 17 years old.');
            window.history.back();
        </script>";
        exit;
    }

    /* EMAIL VALIDATION */
    $email        = $_POST['email'];
    $confirmEmail = $_POST['confirm_email'];

    if ($email !== $confirmEmail) {
        echo "<script>
            alert('Emails do not match.');
            window.history.back();
        </script>";
        exit;
    }

    /* PASSWORD VALIDATION */
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        echo "<script>
            alert('Passwords do not match.');
            window.history.back();
        </script>";
        exit;
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\\d)(?=.*[@$!%*?&]).{8,}$/', $password)) {
        echo "<script>
            alert('Password must contain uppercase, lowercase, number & special character (min 8 chars).');
            window.history.back();
        </script>";
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
<html>
<head>
    <title>Distance Education </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="top-header">
    <div class="container1">
        <div class="logo">
            <img src="image/Univ.png" alt="University Logo">
            <div class="logo-text">
                <div class="tamil-text">
                    சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்
                </div>
                <div class="english-text">
                    University of Madras – Institute of Distance Education
                </div>
            </div>
        </div>

        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
        </nav>
    </div>
</header>

<div class="container">
<h2>DISTANCE EDUCATION REGISTRATION

</h2>

<form method="post">
<div class="sub">

<label>Programme</label>
<select name="programme" onchange="loadCourses(this.value)" required>
    <option value="">-- Select Programme --</option>
    <option value="UG">Under Graduate</option>
    <option value="PG">Post Graduate</option>
    <option value="Diploma">Diploma</option>
    <option value="Certificate">Certificate</option>
</select>

<label>Name</label>
<input type="text" name="name" required>

<label>Mobile</label>
<input type="text" name="mobile" maxlength="10" pattern="[0-9]{10}" required>

<!-- EMAIL -->
<label>Email</label>
<input type="email" name="email" id="email" required oninput="validateForm()">

<label>Confirm Email</label>
<input type="email" name="confirm_email" id="confirm_email" required oninput="validateForm()">
<small id="emailHint" style="color:red;"></small>

<!-- PASSWORD -->
<label>Password</label>
<input type="password" name="password" id="password" required oninput="validateForm()">

<label>Confirm Password</label>
<input type="password" name="confirm_password" id="confirm_password" required oninput="validateForm()">
<small id="passwordHint" style="color:red;"></small>

<!-- DOB -->
<label>Date of Birth</label>
<input
    type="date"
    name="dob"
    id="dob"
    required
    max="<?php echo date('Y-m-d', strtotime('-17 years')); ?>"
    onchange="validateForm()"
>

<label>Course</label>
<select name="course" id="course" onchange="loadEligibility(this); validateForm();" required>
    <option value="">-- Select Course --</option>
</select>

</div>

<div id="eligibilityBox" class="note">
   Please Check The Eligibility Criteria For Candidates Before Applying 
</div>
<div class="form-container">
   <!-- your form here -->
</div>

<input type="hidden" name="eligibility" id="eligibility">
<input type="hidden" name="course_name" id="course_name">

<label>
    <input type="checkbox" required onchange="validateForm()"> All Details Are Authorized
</label>

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

    /* AGE CHECK */
    if (dob) {
        const d = new Date(dob);
        const t = new Date();
        let age = t.getFullYear() - d.getFullYear();
        const m = t.getMonth() - d.getMonth();
        if (m < 0 || (m === 0 && t.getDate() < d.getDate())) age--;
        if (age < 17) valid = false;
    } else valid = false;

    /* EMAIL CHECK */
    if (email !== cemail) {
        emailHint.innerText = "Emails do not match.";
        valid = false;
    } else {
        emailHint.innerText = "";
    }

    /* PASSWORD CHECK */
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    if (!regex.test(pwd)) {
        hint.innerText = "Password must be 8+ chars with upper, lower, number & symbol.";
        valid = false;
    } else if (pwd !== cpw) {
        hint.innerText = "Passwords do not match.";
        valid = false;
    } else {
        hint.innerText = "";
    }

    if (!course) valid = false;

    document.getElementById("nextBtn").disabled = !valid;
}

window.onload = function () {
    loadCourses('UG');
};
</script>

<footer>
    <p>© 2026 University of Madras. All Rights Reserved.</p>
</footer>

</body>
</html>