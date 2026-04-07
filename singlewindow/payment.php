<?php
session_start();
include("db.php"); // make sure $pdo is defined here
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Page</title>

<style>
.search-container{
    width:100%;
    display:flex;
    justify-content:center;
    margin-top:50px;
}

.search-form{
    background:#ffffff;
    padding:25px 30px;
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
    width:420px;
}

.search-form label{
    font-weight:600;
    color:#2c3e50;
    display:block;
    margin-bottom:10px;
}

.search-box-new{
    display:flex;
    gap:10px;
}

.search-box-new input{
    flex:1;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
    outline:none;
    transition:0.3s;
}

.search-box-new input:focus{
    border-color:#4a6ea9;
    box-shadow:0 0 5px rgba(74,110,169,0.3);
}

.search-box-new button{
    padding:12px 18px;
    background:linear-gradient(135deg,#4a6ea9,#2c3e50);
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}

.search-box-new button:hover{
    transform:translateY(-2px);
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* ===== TOP HEADER ===== */
.top-header{
    width:100%;
     background:linear-gradient(135deg,#2374ad,#1b5c8a);
    color:#fff;
    padding:15px 30px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 3px 10px rgba(0,0,0,0.2);
}

.top-header .title{
    font-size:20px;
    font-weight:600;
}

.top-header .sub{
    font-size:13px;
    opacity:0.9;
}

/* ===== FOOTER ===== */
.footer{
    width:100%;
    background:#2c3e50;
    color:#fff;
    text-align:center;
    padding:12px;
    margin-top:350px;
    font-size:13px;
}
/* HEADER */
.top-header{
    width:100%;
    background:linear-gradient(135deg,#2c3e50,#4a6ea9);
    color:#fff;
    padding:10px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* LEFT SIDE */
.left-header{
    display:flex;
    align-items:center;
    gap:12px;
}

.left-header img{
    width:50px;
    height:50px;
    object-fit:contain;
    background:#fff;
    border-radius:50%;
    padding:5px;
}

/* TEXT */
.title{
    font-size:18px;
    font-weight:bold;
}

.sub{
    font-size:12px;
}

/* RIGHT */
.right-header{
    font-size:14px;
    font-weight:500;
}

/* HIDE IN PRINT */
@media print{
    .top-header{ display:none; }
}

/* HIDE HEADER & FOOTER IN PRINT */
@media print{
    .top-header,
    .footer{
        display:none;
    }
}

.logo img {
    width: 60px;   /* better size for header */
    height: 60px;
    object-fit: contain;
    margin-right: 10px;
}

.left-header{
    display:flex;
    align-items:center;
}</style>
</head>

<body>

<!-- HEADER -->
<div class="top-header">
    <div class="left-header">
        <div class="logo">
            <img src="image/Univ.png">
        </div>
        <div>
            <div>UNIVERSITY OF MADRAS</div>
            <div style="font-size:12px;">Institute of Distance Education</div>
        </div>
    </div>
    <div>🎓 Payment Portal</div>
</div>

<h2 style="text-align:center;">Payment Page</h2>

<!-- SEARCH -->
<div class="search-wrapper">
<form method="GET" class="search-card">
    <label><b>🔍 Enrollment Number</b></label><br><br>
    <div class="search-box-pro">
        <input type="text" name="enrollment_no" required>
        <button type="submit">Search</button>
    </div>
</form>
</div>

<?php
if(isset($_GET['enrollment_no'])){

    $en = trim($_GET['enrollment_no']);

    $stmt = $pdo->prepare("SELECT * FROM records WHERE enrollment_no = ?");
    $stmt->execute([$en]);
    $d = $stmt->fetch(PDO::FETCH_ASSOC);

    if($d){

        // COURSE TABLE
        switch($d['course_type']){
            case "UG": $courseTable="ug_courses"; break;
            case "PG": $courseTable="pg_courses"; break;
            case "DIP": $courseTable="diploma_courses"; break;
            default: $courseTable="certificate_courses";
        }

        // GET COURSE CODE
        $getCourse = $pdo->prepare("SELECT course_code FROM $courseTable WHERE programme_degree=? AND main_subject=? LIMIT 1");
        $getCourse->execute([$d['programme_name'], $d['main_subject']]);
        $courseRow = $getCourse->fetch(PDO::FETCH_ASSOC);
        $courseCode = $courseRow['course_code'] ?? '';

        // GET FEES
        $feeStmt = $pdo->prepare("SELECT special_fee, tuition_fee, general_fee FROM course_fees WHERE course_code=? LIMIT 1");
        $feeStmt->execute([$courseCode]);
        $fee = $feeStmt->fetch(PDO::FETCH_ASSOC);

        $G  = $fee['general_fee'] ?? 0;
        $SF = $fee['special_fee'] ?? 0;
        $TF = $fee['tuition_fee'] ?? 0;

        $category = strtoupper($d['approved_category'] ?? 'GENERAL');

        switch($category){
            case "VC":
            case "PRISONER": $total_fee = $G - $TF; break;
            case "DA": $total_fee = $G - ($SF + $TF); break;
            case "STAFF": $total_fee = $G - (($TF * 50)/100); break;
            default: $total_fee = $G;
        }

        if($total_fee < 0) $total_fee = 0;
?>

<div class="card">
<h3>Student Details</h3>

<div class="details">
<div><b>Name:</b> <?= htmlspecialchars($d['name']) ?></div>
<div><b>Enrollment:</b> <?= htmlspecialchars($d['enrollment_no']) ?></div>
<div><b>Programme:</b> <?= htmlspecialchars($d['programme_name']." - ".$d['main_subject']) ?></div>
<div><b>Fees:</b> ₹<?= number_format($total_fee) ?></div>
<div><b>Phone:</b> <?= htmlspecialchars($d['mobile']) ?></div>
<div><b>Email:</b> <?= htmlspecialchars($d['email']) ?></div>
</div>

<?php if(!empty($d['paid_amount']) && $d['paid_amount'] > 0){ ?>
<p style="color:green;">
Paid: ₹<?= $d['paid_amount'] ?><br>
<?= $d['payment_date'] ?>
</p>
<?php } ?>

</div>

<!-- PAYMENT -->
<form target="_blank" method="post" action="https://apps.indianbank.in/muexam/finalCustModule.aspx">

<input type="hidden" name="UserId" value="IdeUnom">
<input type="hidden" name="PassWord" value="MuniCh1857">
<input type="hidden" name="RegNo" value="<?= $d['enrollment_no'] ?>">
<input type="hidden" name="Name" value="<?= $d['name'] ?>">
<input type="hidden" name="Purpose" value="1 YR ADMISSION FEE">
<input type="hidden" name="Degree" value="<?= $courseCode ?>">
<input type="hidden" name="Amt" value="<?= $total_fee ?>">

<div style="text-align:center;">
<input type="submit" value="💳 Pay Now"
style="padding:10px 20px;background:#27ae60;color:#fff;border:none;border-radius:6px;">
</div>
</form>

<br>

<!-- MARK PAID -->
<div style="text-align:center;">
<form method="POST">
<input type="hidden" name="paid_enrollment" value="<?= $d['enrollment_no'] ?>">
<input type="hidden" name="paid_amount" value="<?= $total_fee ?>">
<button type="submit" name="mark_paid"
style="padding:10px;background:#e74c3c;color:#fff;border:none;border-radius:6px;">
Mark as Paid
</button>
</form>
</div>

<?php
    } else {
        echo "<h3 style='color:red;text-align:center;'>No record found!</h3>";
    }
}

// MARK PAID
if(isset($_POST['mark_paid'])){

    $enroll = $_POST['paid_enrollment'];
    $amount = $_POST['paid_amount'];

    $stmt = $pdo->prepare("
        UPDATE records 
        SET fees = 0, paid_amount = ?, payment_date = NOW() 
        WHERE enrollment_no = ?
    ");
    $stmt->execute([$amount, $enroll]);

    echo "<script>alert('Payment Stored Successfully');window.location.href='';</script>";
}
?>

<div class="footer">
© <?= date("Y") ?> University of Madras | Payment System
</div>

</body>
</html>