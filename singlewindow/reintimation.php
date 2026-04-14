<?php 
include("db.php");

// ---------- UPDATE ----------
if(isset($_POST['update'])){
    $stmt = $pdo->prepare("
        UPDATE records SET 
        name=?, name_tamil=?, mobile=?, email=?, medium=? 
        WHERE enrollment_no=?
    ");

    $stmt->execute([
        $_POST['name'],
        $_POST['name_tamil'],
        $_POST['mobile'],
        $_POST['email'],
        $_POST['medium'],
        $_POST['enrollment_no']
    ]);

    echo "<script>alert('Updated Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admission Page</title>

<style>
body{
    font-family: 'Segoe UI';
    background: #f4f6f9;
}

/* SEARCH */
.search-box{
    width:400px;
    margin:40px auto;
    text-align:center;
}

.search-box input{
    padding:10px;
    width:70%;
}

.search-box button{
    padding:10px;
    background:#4a6ea9;
    color:#fff;
    border:none;
}

/* CARD */
.card{
    width:900px;
    margin:20px auto;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* HEADER */
.header{text-align:center;}

/* BUTTONS */
.btn{
    padding:10px 15px;
    border:none;
    border-radius:5px;
    margin:5px;
    cursor:pointer;
}

.print{background:#27ae60;color:#fff;}
.pdf{background:#2980b9;color:#fff;}
.edit{background:#f39c12;color:#fff;}
.save{background:#8e44ad;color:#fff;}

/* EDIT MODE */
.edit-field{display:none;}
.editing .view{display:none;}
.editing .edit-field{display:inline-block;}

/* ================= PRINT DESIGN (OLD STYLE) ================= */
@media print {

    body * {
        visibility: hidden;
    }

    #printArea, #printArea * {
        visibility: visible;
    }

    #printArea {
    position: absolute;
    left: 0;
    top: 0;
    width: 850px;
    font-family: 'Times New Roman';
}

/* ADD THIS NEW BLOCK */
#printArea::after {
    content: "";
    display: block;
    page-break-after: always;
}

#printArea {
    border: 3px solid #4a6ea9;
    border-radius: 15px;
    padding: 20px;
    background: #fff;
}

/* DUPLICATE COPY USING CLONE EFFECT */
#printArea:before {
    content: attr(data-clone);
    display: block;
}

    input{border:none;}

    .btn{display:none;}

    .header h2, .header h3, .header p{
        text-align:center;
    }
}

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
}
</style>

</head>
<body>
    <div class="top-header">

    <div class="left-header">

        <div class="logo">
            <img src="image/Univ.png" alt="University Logo">
        </div>

        <div>
            <div class="title">UNIVERSITY OF MADRAS</div>
            <div class="sub">Institute of Distance Education</div>
        </div>

    </div>

    <div class="right-header">
        🎓 Admission Portal
    </div>

</div>

<div class="search-container">
    <form method="GET" class="search-form">
        <label>🔍 Enrollment Number</label>
        
        <div class="search-box-new">
            <input type="text" name="enrollment_no" placeholder="Enter Enrollment No (Eg: A26101UEC6017)" required>
            <button type="submit">Search</button>
        </div>
    </form>
</div>

<?php
if(isset($_GET['enrollment_no'])){

    $en = trim($_GET['enrollment_no']);

    $stmt = $pdo->prepare("SELECT * FROM records WHERE LOWER(TRIM(enrollment_no)) = LOWER(TRIM(?))");
    $stmt->execute([$en]);
    $d = $stmt->fetch();

    if($d){

        // COURSE TABLE
        if($d['course_type']=="UG"){
            $courseTable="ug_courses";
        }elseif($d['course_type']=="PG"){
            $courseTable="pg_courses";
        }elseif($d['course_type']=="DIP"){
            $courseTable="diploma_courses";
        }else{
            $courseTable="certificate_courses";
        }

        // COURSE CODE
        $getCourse = $pdo->prepare("
        SELECT course_code FROM $courseTable
        WHERE programme_degree=? AND main_subject=?
        LIMIT 1
        ");
        $getCourse->execute([$d['programme_name'], $d['main_subject']]);
        $courseRow = $getCourse->fetch();
        $courseCode = $courseRow['course_code'] ?? '';

        // FEES
        $feeStmt = $pdo->prepare("
        SELECT special_fee, tuition_fee, general_fee
        FROM course_fees
        WHERE course_code=?
        LIMIT 1
        ");
        $feeStmt->execute([$courseCode]);
        $fee = $feeStmt->fetch();

        $G  = $fee['general_fee'] ?? 0;
        $SF = $fee['special_fee'] ?? 0;
        $TF = $fee['tuition_fee'] ?? 0;

        // CATEGORY
        $category = strtoupper($d['approved_category'] ?? 'GENERAL');

        switch($category){
            case "VC":
            case "PRISONER":
                $total_fee = $G - $TF;
                break;

            case "DA":
                $total_fee = $G - ($SF + $TF);
                break;

            case "STAFF":
                $total_fee = $G - (($TF * 50)/100);
                break;

            default:
                $total_fee = $G;
        }

        if($total_fee < 0){ $total_fee = 0; }

        $date = date("d-m-Y");

        $full_name = $d['name'];
        if(!empty($d['name_tamil'])){
            $full_name .= " - ".$d['name_tamil'];
        }
?>

<div class="card" id="printArea" data-clone="">

<div class="header">
    <h2>UNIVERSITY OF MADRAS</h2>
    <h3>INSTITUTE OF DISTANCE EDUCATION</h3>
    <p>Chepauk, Chennai - 600 005</p>
</div>

<h3 style="text-align:center;">PROVISIONAL ADMISSION INTIMATION</h3>

<form method="POST">
<input type="hidden" name="enrollment_no" value="<?php echo $d['enrollment_no']; ?>">

<table width="100%">

<tr>
<td><b>Name</b></td>
<td>
<span class="view"><?php echo $full_name; ?></span>
<input class="edit-field" name="name" value="<?php echo $d['name']; ?>">
<input class="edit-field" name="name_tamil" value="<?php echo $d['name_tamil']; ?>">
</td>

<td><b>Date</b></td>
<td><?php echo $date; ?></td>
</tr>

<tr>
<td><b>Programme</b></td>
<td><?php echo $d['programme_name']." - ".$d['main_subject']; ?></td>
</tr>

<tr>
<td><b>Enrollment No</b></td>
<td><?php echo $d['enrollment_no']; ?></td>
</tr>

<tr>
<td><b>Fees</b></td>
<td>₹ <?php echo number_format($total_fee); ?> /-</td>
</tr>

<tr>
<td><b>DOB</b></td>
<td><?php echo $d['dob']; ?></td>

<td><b>Gender</b></td>
<td><?php echo $d['gender']; ?></td>
</tr>

<tr>
<td><b>Mobile</b></td>
<td>
<span class="view"><?php echo $d['mobile']; ?></span>
<input class="edit-field" name="mobile" value="<?php echo $d['mobile']; ?>">
</td>

<td><b>Email</b></td>
<td>
<span class="view"><?php echo $d['email']; ?></span>
<input class="edit-field" name="email" value="<?php echo $d['email']; ?>">
</td>
</tr>

<tr>
<td><b>Medium</b></td>
<td>
<span class="view"><?php echo $d['medium']; ?></span>
<input class="edit-field" name="medium" value="<?php echo $d['medium']; ?>">
</td>
</tr>

<tr>
<td><b>Certificate Status</b></td>
<td>
<?php echo ($d['certificate_verified']==1) ? "Certificates Verified" : "Not Verified"; ?>
</td>
</tr>

</table>

<br>

<div style="text-align:center;">
    <button type="button" class="btn edit" onclick="toggleEdit()">✏️ Edit</button>
    <button class="btn save" name="update">💾 Save</button>
    <button type="button" class="btn print" onclick="printPage()">🖨️ Print</button>
    <button type="button" class="btn pdf" onclick="downloadPDF()">📄 PDF</button>
</div>

</form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
function toggleEdit(){
    document.getElementById("printArea").classList.toggle("editing");
}

function printPage(){

    var content = document.getElementById("printArea").innerHTML;

    var printWindow = window.open('', '', 'width=900,height=650');

    printWindow.document.write(`
        <html>
        <head>
        <title>Print</title>
        <style>
            body {
                font-family: 'Times New Roman';
                margin: 10px;
            }

            .copy {
                width: 850px;
                margin: auto;
                border: 3px solid #4a6ea9;
                border-radius: 15px;
                padding: 20px;
                margin-bottom: 40px;
            }

            /* hide buttons & inputs */
            .btn, input {
                display: none !important;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            td {
                padding: 6px 10px;
            }

            td b {
                display: inline-block;
                width: 130px;
            }

            .header h2,
            .header h3,
            .header p {
                text-align: center;
                margin: 3px 0;
            }

        </style>
        </head>

        <body>

            <div class="copy">${content}</div>
            <div class="copy">${content}</div>

        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.print();
}

function downloadPDF(){
    var element = document.getElementById("printArea");
    html2pdf().from(element).save("Admission.pdf");
}
</script>

<?php
    } else {
        echo "<p style='text-align:center;color:red;'>No record found</p>";
    }
}
?>
<div class="footer">
    © <?php echo date("Y"); ?> University of Madras | IDE Admission System
</div>

</body>
</html>