<?php

$response = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>University of Madras - IDE</title>
<link rel="stylesheet" href="stylee.css">

<style>


/* RULES POPUP */

#rulesPopup{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.6);
display:flex;
justify-content:center;
align-items:center;
z-index:9999;
}

/* POPUP CARD */

.rules-box{
    background:#fff;
    width:600px;
    max-height:800px;
    overflow-y:auto;
    border-radius:10px;
    box-shadow:0 8px 25px rgba(0,0,0,0.4);
    animation:popupAnim 0.4s ease;
    font-family:Arial;
}
/* HEADER */

.rules-header{
background:#0a6ea8;
color:white;
padding:12px;
font-size:18px;
border-radius:8px 8px 0 0;
text-align:center;
}

/* BODY */

.rules-body{
padding:20px;
max-height:280px;
overflow-y:auto;
line-height:1.6;
}

/* FOOTER */

.rules-footer{
display:flex;
justify-content:space-between;
align-items:center;
padding:15px 20px;
border-top:1px solid #ddd;
}

.agree{
font-size:14px;
display:flex;
align-items:center;
gap:8px;
}

.agree input{
width:16px;
height:16px;
}

#continueBtn{
background:#1e6fa1;
color:#fff;
border:none;
padding:10px 18px;
border-radius:5px;
cursor:not-allowed;
opacity:0.5;
}

#continueBtn.active{
opacity:1;
cursor:pointer;
}

.agree-box{
font-size:14px;
}

#continueBtn{
background:#1e6fa1;
color:#fff;
border:none;
padding:10px 20px;
border-radius:5px;
cursor:pointer;
opacity:0.6;
}

#continueBtn.active{
opacity:1;
cursor:pointer;
}

/* BUTTON */

.rules-btn{
background:#0a6ea8;
color:white;
border:none;
padding:8px 20px;
border-radius:4px;
cursor:pointer;
}

/* STEPS SECTION */

.steps-section {
    padding: 20px 20px;
    background: #f4f6f9;
    text-align: center;
}

.steps-title {
    font-size: 32px;
    font-weight: bold;
    color: #0a3d62;
    margin-bottom: 40px;
    position: relative;
}

.steps-title::after {
    content: "";
    width: 80px;
    height: 4px;
    background: #0a3d62;
    display: block;
    margin: 10px auto;
    border-radius: 5px;
}

/* STEP CARD */

.step {
    background: #1f5aa6;
    color: white;
    border-radius: 15px;
    padding: 20px;
    margin: 20px auto;
    max-width: 800px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.step:hover {
    transform: translateY(-5px);
}

/* NUMBER */

.step-number {
    font-size: 40px;
    font-weight: bold;
    opacity: 0.9;
}

/* CONTENT */

.step-content {
    text-align: left;
    flex: 1;
    margin: 0 20px;
}

.step-content h3 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
}

.step-content p {
    font-size: 14px;
    margin-top: 5px;
}

/* ICON */

.step-icon {
    background: white;
    color: black;
    width: 70px;
    height: 70px;
    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 28px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

/* ANIMATION */

@keyframes popupAnim{
from{
transform:scale(0.7);
opacity:0;
}
to{
transform:scale(1);
opacity:1;
}
}

.scroll-notice {
    height: 120px;           /* visible area */
    overflow: hidden;
    position: relative;
}

.scroll-notice ul {
    position: absolute;
    width: 100%;
    animation: scrollUp 10s linear infinite;
}

@keyframes scrollUp {
    0% {
        top: 100%;
    }
    100% {
        top: -100%;
    }
}


</style>
<script>
function closeRules(){
document.getElementById("rulesPopup").style.display="none";
}
</script>

</head>
<body>
<!-- RULES POPUP -->

<div id="rulesPopup">

<div class="rules-box">

<p style="font-size:16px; font-weight:bold; color:#d9534f; text-align:center;">
⚠ Please read the instructions carefully before clicking "Read & Continue".
</p>


<div class="rules-body">

<b> APPLICATION FORMALITIES</b>
<p>1. Applicants must provide correct personal details.</p>
<p>2. Upload valid and clear documents only.</p>
<p>3. Incomplete applications will not be processed.</p>
<p>4. Incomplete or incorrect applications will be rejected without notice.</p>
<p>5. Applicants must ensure that the details entered match their official documents.</p>
<p>6. The institution reserves the right to verify all submitted documents.</p>
<p>7. Applicants must upload recent passport-size photographs.</p>
<p>8. All communication will be done through the registered email or phone number.</p>
<p>9. Applicants are responsible for keeping their login credentials secure.</p>
<p>10.The decision of the institution regarding admission and concessions will be final.</p>
<p>12.The institution is not responsible for errors caused by incorrect information entered by the applicant.</p>
<p>13.By submitting the application form, the applicant agrees to all the above rules and regulations.</p>

<b>REGISTRATION AND LOGIN INSTRUCTIONS</b>

<p>1. Applicants must first complete the registration process before accessing the application form.</p>
<p>2. During registration, provide a valid email address and create a secure password.</p>
<p>3. After successful registration, applicants must log in using the registered email ID and password.</p>
<p>4. Keep your login credentials confidential and do not share them with anyone.</p>
<p>5. If you forget your password, use the "Forgot Password" option to reset it.</p>
<p>6. Ensure that the email address used during registration is active for receiving notifications.</p>
<p>7. All application updates and communication will be sent to the registered email address.</p>
<p>8. Applicants must log in to complete, edit, or track their application status.</p>
<p>9. Multiple registrations with the same email ID are not allowed.</p>
<p>10. The institution is not responsible for issues caused by incorrect login details entered by the applicant.</p>

<b>APPLICATION INSTRUCTIONS</b>

<p>1. Read all instructions carefully before filling out the application form.</p>
<p>2. Ensure you meet the eligibility criteria for the course before applying.</p>
<p>3. Fill in all mandatory fields marked in the application form.</p>
<p>4. Enter your personal details exactly as mentioned in official documents.</p>
<p>5. Provide a valid email address and mobile number for communication.</p>
<p>6. Upload a recent passport-size photograph in the specified format.</p>
<p>7. Upload all required documents clearly and in the prescribed file format.</p>
<p>8. Ensure the uploaded documents are readable and not blurred.</p>
<p>9. Uploaded Document And Image Size Should Be Less Then 2MB</p>
<p>10. Verify all details before submitting the application.</p>
<p>11. Once submitted, certain details may not be editable.</p>
<p>12. Applications with incomplete information may be rejected.</p>
<p>13. Avoid multiple submissions of the same application.</p>
<p>14. Keep scanned copies of certificates ready before starting the application.</p>
<p>15. Uploaded Document And Image Size Should Be Less Then 2MB</p>
<p>16. Ensure the date of birth entered matches your official records.</p>
<p>17. Applicants must select the correct category  type for concession.</p>
<p>18. Supporting documents must be uploaded for fee concessions.</p>
<p>19. Applications submitted after the deadline may not be considered.</p>
<p>20. Keep a copy of the submitted application for your reference.</p>
<p>21. The institution may contact applicants for verification if required.</p>
<p>22. Any incorrect or false information may lead to application cancellation.</p>
<p>23. Follow the guidelines mentioned for document size and format.</p>
<p>24. Applicants must check the portal regularly for updates.</p>
<p>25. Ensure stable internet connection while submitting the application.</p>
<p>26. Contact the administration if you face technical issues.</p>
<p>27. By submitting the application, you agree to follow all admission rules and guidelines.</p>

</div>
<div class="rules-footer">

<label class="agree">
<input type="checkbox" id="agreeCheck">
I have read the instructions carefully
</label>

<button id="continueBtn" disabled>Read & Continue</button>

</div>

</div>
</div>
<!-- HEADER -->
<header class="top-header">
<div class="container">

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
<a class="active" href="#">Home</a>
<a href="#">About Us</a>
<a href="#">Contact Us</a>
<a href="admin/login.php">Admin Panel</a>
<a href="lsclogin.php">LSC Login</a>
<a href="singlewindow/index.php">S-W-L</a>
</nav>

</div>
</header>


<!-- BANNER -->
<section class="banner">

<div class="white-wrapper">

<div class="portal">

<h2>Institute of Distance Education</h2>
<h3>Online Application Portal</h3>

<div class="buttons">
<a href="login.php" class="btn btn-outline">Login</a>
<a href="form.php" class="btn btn-outline">Register Here</a>
</div>

<div class="notice-box">
<h4>📢 Important Notices</h4>

<div class="scroll-notice">
<ul>
<li>Admissions open for Academic Year 2025–2026</li>
<li>Last date for UG applications: <strong>30 June 2025</strong></li>
<li>Online payment facility available for all programmes</li>
<li>Hall ticket download notification will be announced shortly</li>
</ul>
</div>

</div>

</div>
</div>

</div>

</section>







<!-- FOOTER -->
<footer>

<div class="about-ide">

<h2>About the Institute of Distance Education</h2>

<p>
The Institute of Correspondence Education (ICE), now called the
Institute of Distance Education (IDE), was established in 1981.
</p>

<p>
Having completed 43 years, IDE today is a mega institute with more than
one lakh learners.
</p>

<p>
IDE offers <strong>73 Programmes</strong> including UG, PG, Diploma and Certificate courses.
</p>

<p>
Admissions are open throughout the year in both Academic Year (July–June)
and Calendar Year (January–December).
</p>

<p>
69 Learner Support Centres have been established and online admission
facility has been introduced.
</p>

<p>© 2025 University of Madras. All Rights Reserved.</p>

</div>



</footer>

<script>

const checkbox = document.getElementById("agreeCheck");
const button = document.getElementById("continueBtn");

checkbox.addEventListener("change", function () {

    if (this.checked) {
        button.disabled = false;
        button.style.opacity = "1";
        button.style.cursor = "pointer";
    } else {
        button.disabled = true;
        button.style.opacity = "0.5";
        button.style.cursor = "not-allowed";
    }

});

button.addEventListener("click", function () {

    if (checkbox.checked) {
        document.getElementById("rulesPopup").style.display = "none";
    }

});

</script>

</body>
</html>