<?php
session_start();

/* -------------------------------------------------
   Prevent direct access without form submission
--------------------------------------------------*/
if (!isset($_SESSION['form_data'])) {
    header("Location: form.php");
    exit;
}

$data = $_SESSION['form_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Your Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 25px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        p {
            font-size: 16px;
            margin: 10px 0;
        }
        button {
            padding: 10px 18px;
            margin: 10px 5px 0 0;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirm Your Details</h2>

    <p><b>Programme:</b> <?= htmlspecialchars($data['programme']); ?></p>
    <p><b>Name:</b> <?= htmlspecialchars($data['name']); ?></p>
    <p><b>Mobile:</b> <?= htmlspecialchars($data['mobile']); ?></p>
    <p><b>Email:</b> <?= htmlspecialchars($data['email']); ?></p>
    <p><b>Course:</b> <?= htmlspecialchars($data['course_name']); ?></p>
    <p><b>Eligibility:</b> <?= htmlspecialchars($data['eligibility']); ?></p>

    <!-- ------------------------------------------------
         Submit button triggers OTP generation
         No DB insert happens here
    ------------------------------------------------- -->
    <form method="post" action="send_otp.php">
        <button type="button" onclick="window.location.href='form.php'">
            ⬅ Back
        </button>

        <button type="submit" name="sendOtpBtn">
            Submit & Verify OTP
        </button>

    </form>
</div>

</body>
</html>
