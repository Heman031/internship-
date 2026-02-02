<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['form_data'] = [
        'level'       => $_POST['level'] ?? '',
        'name'        => $_POST['name'] ?? '',
        'mobile'      => $_POST['mobile'] ?? '',
        'email'       => $_POST['email'] ?? '',
        'course'      => $_POST['course'] ?? '',
        'eligibility' => $_POST['eligibility'] ?? ''
    ];

    header("Location: next.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admission Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Admission Form</h2>

    <form method="post">

        <!-- LEVEL -->
        <div class="row radio-group">
            <label><input type="radio" name="level" value="UG" onchange="loadCourses(this.value)" checked> UG</label>
            <label><input type="radio" name="level" value="PG" onchange="loadCourses(this.value)"> PG</label>
            <label><input type="radio" name="level" value="Professional" onchange="loadCourses(this.value)"> Professional</label>
            <label><input type="radio" name="level" value="Diploma" onchange="loadCourses(this.value)"> Diploma</label>
        </div>

        <div class="row">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="row">
            <label>Mobile</label>
            <input
                type="tel"
                name="mobile"
                placeholder="Enter 10-digit mobile number"
                maxlength="10"
                pattern="[0-9]{10}"
                inputmode="numeric"
                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                required
            >
        </div>

        <div class="row">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="row">
            <label>Course</label>
            <select name="course" id="course" onchange="loadEligibility(this.value)" required>
                <option value="">-- Select Course --</option>
            </select>
        </div>

        <div class="row eligibility-box" id="eligibilityBox">
            Eligibility will appear here
        </div>

        <input type="hidden" name="eligibility" id="eligibility">

        <div class="row checkbox">
            <label>
                <input type="checkbox" required>
                All details are authorized
            </label>
        </div>

        <div class="row">
            <button type="submit" id="nextBtn" disabled>Next</button>
        </div>

    </form>
</div>

<script src="script.js"></script>
<script>
    window.onload = function () {
        loadCourses('UG');
    };
</script>
</body>
</html>
