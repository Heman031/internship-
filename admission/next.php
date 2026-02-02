<?php
session_start();
include "db.php";

/* Prevent direct access */
if (!isset($_SESSION['form_data'])) {
    header("Location: index.php");
    exit;
}

$data = $_SESSION['form_data'];
$popupStatus = ""; // success | error

/* Handle final submit */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['final_submit'])) {

    $level = $data['level'];
    $name = $data['name'];
    $mobile = $data['mobile'];
    $email = $data['email'];
    $course = $data['course'];
    $eligibility = $data['eligibility'];

    $sql = "INSERT INTO admission_form
            (level, name, mobile, email, course, eligibility)
            VALUES
            ('$level', '$name', '$mobile', '$email', '$course', '$eligibility')";

try {

    mysqli_query($conn, $sql);

    // ✅ SUCCESS
    $popupStatus = "success";
    session_destroy();

} catch (mysqli_sql_exception $e) {

    // ❌ DUPLICATE ENTRY
    if ($e->getCode() == 1062) {
        $popupStatus = "duplicate";
    } 
    // ❌ OTHER DATABASE ERROR
    else {
        $popupStatus = "error";
    }
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Details</title>
    <link rel="stylesheet" href="style.css">

    <!-- Popup CSS -->
    <style>
        .popup-overlay{
            display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.6);
            z-index:999;
            justify-content:center;
            align-items:center;
        }
        .popup-box{
            background:#fff;
            width:340px;
            padding:24px;
            border-radius:14px;
            text-align:center;
            box-shadow:0 20px 40px rgba(0,0,0,.35);
            animation:scaleIn .25s ease;
        }
        .popup-box h3{
            margin-bottom:8px;
            color:#0f172a;
        }
        .popup-box p{
            font-size:14px;
            color:#475569;
            margin-bottom:18px;
        }
        .popup-box button{
            padding:8px 22px;
            border:none;
            border-radius:10px;
            background:#2563eb;
            color:#fff;
            cursor:pointer;
        }
        .popup-box button:hover{
            background:#1e40af;
        }
        @keyframes scaleIn{
            from{ transform:scale(.85); opacity:0; }
            to{ transform:scale(1); opacity:1; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirm Your Details</h2>

    <div class="row"><strong>Level:</strong> <?= htmlspecialchars($data['level']); ?></div>
    <div class="row"><strong>Name:</strong> <?= htmlspecialchars($data['name']); ?></div>
    <div class="row"><strong>Mobile:</strong> <?= htmlspecialchars($data['mobile']); ?></div>
    <div class="row"><strong>Email:</strong> <?= htmlspecialchars($data['email']); ?></div>
    <div class="row"><strong>Course:</strong> <?= htmlspecialchars($data['course']); ?></div>
    <div class="row"><strong>Eligibility:</strong> <?= htmlspecialchars($data['eligibility']); ?></div>

    <!-- Back + Submit -->
    <form method="post">
        <div class="row" style="display:flex; gap:10px;">
            <button type="button" onclick="window.location.href='index.php'">
                ⬅ Back
            </button>
            <button type="submit" name="final_submit">
                Submit
            </button>
        </div>
    </form>
</div>

<!-- CENTER POPUP -->
<div id="popupOverlay" class="popup-overlay">
    <div class="popup-box">
        <h3 id="popupTitle"></h3>
        <p id="popupMessage"></p>
        <button onclick="closePopup()">OK</button>
    </div>
</div>

<!-- POPUP SCRIPT -->
<script>
function showPopup(title, message){
    document.getElementById("popupTitle").innerText = title;
    document.getElementById("popupMessage").innerText = message;
    document.getElementById("popupOverlay").style.display = "flex";
}

/* AUTO REDIRECT AFTER OK */
function closePopup(){
    document.getElementById("popupOverlay").style.display = "none";
    window.location.href = "home.php"; // change if needed
}
</script>

<?php if ($popupStatus === "success") { ?>
<script>
    showPopup("Success 🎉", "Details successfully completed!");
</script>
<?php } ?>

<?php if ($popupStatus === "error") { ?>
<script>
    showPopup("Error ⚠️", "Details not saved. Please try again!");
</script>
<?php } ?>
<?php if ($popupStatus === "duplicate") { ?>
<script>
    showPopup(
        "Duplicate Entry ⚠️",
        "This mobile number or email is already registered."
    );
</script>
<?php } ?>

</body>
</html>
