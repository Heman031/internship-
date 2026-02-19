<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* ===== DOB VALIDATION ===== */
    if (empty($_POST['dob'])) {
        die("Date of Birth required.");
    }

    $dobDate = new DateTime($_POST['dob']);
    $today   = new DateTime();
    $age     = $today->diff($dobDate)->y;

    if ($age < 17) {
        die("Applicant must be at least 17 years old.");
    }

    /* ===== PHOTO UPLOAD ===== */
    $photoName = null;

    if (!empty($_FILES['photo']['name'])) {

        $allowed = ['jpg','jpeg','png'];
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            die("Invalid photo format.");
        }

        if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
            die("Photo size must be below 2MB.");
        }

        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        $photoName = time() . "_PHOTO." . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $photoName);
    }

    /* ===== GENERATE APPLICATION NO ===== *//* ===== GENERATE APPLICATION NO (Academic / Calendar) ===== */

$course = $_POST['course_type'];   // UG / PG / DIP / CERT
$year = date("Y");
$month = date("n"); // 1 to 12

/* Safety check */
if (!in_array($course, ['UG','PG','DIP','CERT'])) {
    die("Invalid Course Type");
}

/* Decide Academic (A) or Calendar (C) */
if ($month >= 1 && $month <= 6) {
    $period = "A";   // Academic Year (Jan–June)
} else {
    $period = "C";   // Calendar Year (July–Dec)
}

/* Prefix like UGA / UGC / PGA / PGC */
$prefix = $course . $period;

/* Fetch last number for same prefix + year */
$stmt = $pdo->prepare("
    SELECT application_no 
    FROM records 
    WHERE application_no LIKE :pattern
    ORDER BY id DESC
    LIMIT 1
");

$pattern = $prefix . "-" . $year . "-%";

$stmt->execute([':pattern' => $pattern]);

$lastRecord = $stmt->fetch(PDO::FETCH_ASSOC);

if ($lastRecord) {
    $lastNumber = (int) substr($lastRecord['application_no'], -5);
    $newNumber = $lastNumber + 1;
} else {
    $newNumber = 1;
}

/* 5 digit formatting */
$formattedNumber = str_pad($newNumber, 5, "0", STR_PAD_LEFT);

$application_no = $prefix . "-" . $year . "-" . $formattedNumber;



    /* ===== INSERT USING PDO ===== */

    $sql = "INSERT INTO records (
        application_no, course_type, foundation_lang, programme_name,
        main_subject, medium, photo,
        name, street, town, state, district, pincode,
        phone, mobile,
        name_english, name_tamil, email, dob, age,
        guardian_name, mother_name, aadhaar, nationality,
        religion, mother_tongue, community, caste,
        employment_status, employment_type
    ) VALUES (
        :application_no, :course_type, :foundation_lang, :programme_name,
        :main_subject, :medium, :photo,
        :name, :street, :town, :state, :district, :pincode,
        :phone, :mobile,
        :name_english, :name_tamil, :email, :dob, :age,
        :guardian_name, :mother_name, :aadhaar, :nationality,
        :religion, :mother_tongue, :community, :caste,
        :employment_status, :employment_type
    )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':application_no' => $application_no,
        ':course_type' => $_POST['course_type'],
        ':foundation_lang' => $_POST['foundation_lang'],
        ':programme_name' => $_POST['programme_name'],
        ':main_subject' => $_POST['main_subject'],
        ':medium' => $_POST['medium'],
        ':photo' => $photoName,
        ':name' => $_POST['name'],
        ':street' => $_POST['street'],
        ':town' => $_POST['town'],
        ':state' => $_POST['state'],
        ':district' => $_POST['district'],
        ':pincode' => $_POST['pincode'],
        ':phone' => $_POST['phone'],
        ':mobile' => $_POST['mobile'],
        ':name_english' => $_POST['name_english'],
        ':name_tamil' => $_POST['name_tamil'],
        ':email' => $_POST['email'],
        ':dob' => $_POST['dob'],
        ':age' => $age,
        ':guardian_name' => $_POST['guardian_name'],
        ':mother_name' => $_POST['mother_name'],
        ':aadhaar' => $_POST['aadhaar'],
        ':nationality' => $_POST['nationality'],
        ':religion' => $_POST['religion'],
        ':mother_tongue' => $_POST['mother_tongue'],
        ':community' => $_POST['community'],
        ':caste' => $_POST['caste'],
        ':employment_status' => $_POST['employment_status'],
        ':employment_type' => $_POST['employment_type']
    ]);

    $_SESSION['application_no'] = $application_no;

    header("Location: ap2.php");
    exit;
}
?>



    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <title>Admission Application - Step 1</title>

    <style>
    body{font-family:Arial;background:#f2f2f2;margin:0;}
   /* ===============================
   HEADER DESIGN
================================ */

.top-header {
    background: #4a90c2;   /* Your blue color */
    padding: 15px 0;
}

/* Main Header Layout */
.header-container {
    width: 95%;
    max-width: 1300px;
    margin: -29px;
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
}

.header-logo-section {
    padding-left: 30px;   /* Move logo right */
}


/* ===============================
   LOGO
================================ */
.header-logo-section img {
    width: 150px;   /* Adjust logo size here */
    height: auto;
   margin: 20px;
}

/* ===============================
   CENTER TEXT
================================ */
.header-title {
    text-align: left;
    color: white;
}

.tamil-text {
    font-size: 20px;
    font-weight: bold;
}

.english-text {
    font-size: 15px;
    margin-top: 5px;
}

/* ===============================
   NAVIGATION
================================ */
.header-nav {
    display: flex;
    gap: 30px;
    padding-right: 0px;  /* Move nav more right */
    transform: translateX(180px);
}



.header-nav a {
    
    text-decoration: none;
    color: white;
    font-size: 15px;
    position: relative;
    padding-bottom: 4px;
}

/* Gold underline */
.header-nav a::after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    background: gold;
    left: 0;
    bottom: 0;
    transition: 0.3s;
}

.header-nav a:hover::after,
.header-nav a.active::after {
    width: 100%;
}

/* ===============================
   RESPONSIVE
================================ */
@media (max-width: 768px) {
    .header-container {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 15px;
    }

    .header-nav {
        justify-content: center;
    }
}

    .container{width:1000px;margin:20px auto;background:white;padding:25px;}
    h2{text-align:center;margin-bottom:20px;}

    fieldset{border:2px solid #000;padding:20px;margin-bottom:25px;}
    legend{font-weight:bold;padding:0 10px;}
    .form-row{margin-bottom:15px;}
    label{display:block;margin-bottom:5px;}
    input,select{width:100%;padding:8px;border:1px solid #000;}

    .radio-group{display:flex;flex-wrap:wrap;gap:35px;margin-top:8px;}
    .radio-item{display:flex;align-items:center;gap:6px;}

    .programme-wrapper{display:flex;gap:40px;}
    .programme-left{flex:1;}

    /* PHOTO BOX - REDUCED SIZE */
    .photo-box{
        width:180px;          /* reduced width */
        text-align:center;
    }

    .upload-area{
        width:100%;
        height:200px;         /* reduced height */
        border:2px dashed #999;
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        overflow:hidden;      /* prevents overflow */
    }

    .upload-area img{
        max-width:100%;
        max-height:100%;
        object-fit:cover;     /* keeps image proportional */
        display:none;
    }

    .actions{text-align:center;}
    button{padding:8px 25px;margin:5px;border:1px solid #000;background:white;cursor:pointer;}
    footer{background:#003366;color:white;text-align:center;padding:12px;}
    </style>
    </head>

    <body>

    <header class="top-header">
    <div class="header-container">

        <!-- LEFT: Logo -->
        <div class="header-logo-section">
            <img src="image/Univ.png" alt="University Logo">
        </div>

        <!-- CENTER: Text -->
        <div class="header-title">
            <div class="tamil-text">
                சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்
            </div>
            <div class="english-text">
                University of Madras – Institute of Distance Education
            </div>
        </div>

        <!-- RIGHT: Navigation -->
        <nav class="header-nav">
            <a href="../index.php" class="active">Home</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
        </nav>

    </div>
</header>

    <main class="container">

    <h2>ADMISSION APPLICATION FORM - STEP 1</h2>

    <form method="POST" enctype="multipart/form-data">

    <!-- PROGRAMME DETAILS -->
    <fieldset>
    <legend>Programme Details</legend>

    <div class="programme-wrapper">
    <div class="programme-left">

    <div class="form-row">
    <label><strong>Language Chosen for Foundation Course (UG Only)</strong></label>
    <div class="radio-group" id="foundationBox">
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Tamil">Tamil</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Hindi">Hindi</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Telugu">Telugu</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Arabic">Arabic</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="French">French</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Malayalam">Malayalam</label>
    </div>
    </div>

    <div class="form-row">
    <label>Course Type *</label>
    <select name="course_type" id="course_type" onchange="loadCourses()" required>


    <option value="">Select Course Type</option>
    <option value="UG">Under Graduate</option>
    <option value="PG">Post Graduate</option>
    <option value="DIP">Diploma</option>
    <option value="CERT">Certificate</option>
    </select>
    </div>

    <div class="form-row">
<label>Name of the Programme</label>
<select name="programme_name" id="programme_name" required>
<option value="">Select Programme</option>
</select>
</div>

<div class="form-row">
<label>Main Subject</label>
<select name="main_subject" id="main_subject" required>
<option value="">Select Subject</option>
</select>
</div>


    <div class="form-row">
    <label>Medium</label>
    <div class="radio-group">
    <label class="radio-item"><input type="radio" name="medium" value="Tamil">Tamil</label>
    <label class="radio-item"><input type="radio" name="medium" value="English">English</label>
    </div>
    </div>

    </div>

    <div class="photo-box">
    <label><strong>Recent Passport Photo</strong></label>
    <div class="upload-area" onclick="document.getElementById('photoInput').click();">
    <img id="photoPreview">
    <span id="uploadText">Click to Upload</span>
    </div>
    <input type="file" name="photo" id="photoInput" accept="image/*" hidden>
    </div>
    </div>
    </fieldset>

    <!-- ADDRESS FOR COMMUNICATION -->
    <fieldset>
    <legend>Address for Communication</legend>

    <div class="form-row">
    <label>Name *</label>
    <input type="text" name="name" required>
    </div>

    <div class="form-row">
    <label>Door No & Street *</label>
    <input type="text" name="street" required>
    </div>

    <div class="form-row">
    <label>Town / Village Post *</label>
    <input type="text" name="town" required>
    </div>

    <div class="form-row">
    <label>State *</label>
    <select name="state" required>
    <option value="">Select State</option>
    <option value="Tamil Nadu">Tamil Nadu</option>
    <option value="Kerala">Kerala</option>
    <option value="Karnataka">Karnataka</option>
    </select>
    </div>

    <div class="form-row">
    <label>District *</label>
    <select name="district" required>
    <option value="">Select District</option>
    <option value="Chennai">Chennai</option>
    <option value="Madurai">Madurai</option>
    <option value="Coimbatore">Coimbatore</option>
    </select>
    </div>

    <div class="form-row">
    <label>Pin Code *</label>
    <input type="text" name="pincode" maxlength="6" required>
    </div>

    <div class="form-row">
    <label>Phone No (Res/Off) *</label>
    <input type="text" name="phone" maxlength="10" required>
    </div>

    <div class="form-row">
    <label>Mobile Number *</label>
    <input type="text" name="mobile" maxlength="10" required>
    </div>

    </fieldset>

    <!-- APPLICANT DETAILS -->
    <div class="form-row">
    <label>Name (English) *</label>
    <input type="text" name="name_english" id="name_english" required>

    </div>

    <div class="form-row">
    <label>Name (Tamil) *</label>
    <input type="text" name="name_tamil" id="name_tamil" required>
    </div>
    <div class="form-row">
    <label>Email ID *</label>
    <input type="email" name="email" required>
    </div>
    <div class="form-row">
    <label>Date of Birth *</label>
    <input type="date" name="dob" required max="<?php echo date('Y-m-d', strtotime('-17 years')); ?>">
    </div>

    <div class="form-row">
    <label>Age *</label>
    <input type="text" name="age" readonly>
    </div>

    <div class="form-row">
    <label>Father's / Guardian Name *</label>
    <input type="text" name="guardian_name" required>
    </div>

    <div class="form-row">
    <label>Mother's Name *</label>
    <input type="text" name="mother_name" required>
    </div>

    <div class="form-row">
      <label>Aadhaar Number <span class="required-star">*</span></label>

        <input type="text"
               name="aadhaar"
               id="aadhaar"
               maxlength="14"
               placeholder="XXXX XXXX XXXX"
        required>
    </div>

    <div class="form-row">
    <label>Nationality *</label>
    <input type="text" name="nationality" value="INDIAN" required>
    </div>

    <div class="form-row">
    <label>Religion *</label>
    <input type="text" name="religion" required>
    </div>

    <div class="form-row">
    <label>Mother Tongue *</label>
    <input type="text" name="mother_tongue" required>
    </div>

    <div class="form-row">
    <label>Community *</label>
    <div class="radio-group">
    <label class="radio-item"><input type="radio" name="community" value="OC" required>OC</label>
    <label class="radio-item"><input type="radio" name="community" value="BC">BC</label>
    <label class="radio-item"><input type="radio" name="community" value="MBC">MBC</label>
    <label class="radio-item"><input type="radio" name="community" value="SC">SC</label>
    <label class="radio-item"><input type="radio" name="community" value="ST">ST</label>
    </div>
    </div>

    <div class="form-row">
    <label>Caste *</label>
    <input type="text" name="caste" required>
    </div>

    </fieldset>
    <!-- ✅ 23. EMPLOYMENT ADDED -->
    <!-- EMPLOYMENT -->
    <div class="form-row">
      <label>
         23. Are you currently employed?
         <span class="required-star">*</span>
      </label>

    <div class="inline">

     <label>
        <input type="radio"
               name="employment_status"
               value="yes"
               required>
        Yes
     </label>

     <label>
       <input type="radio"
              name="employment_status"
              value="no">
        No
     </label>

    </div>
</div>

<!-- ORGANIZATION -->
 <div id="employmentOptions"
     style="display:none; margin-top:10px;">

    <label>Select Organization:</label>

    <div class="inline">

      <label>
         <input type="radio"
                name="employment_type"
                value="University of Madras">
         University of Madras
      </label>

      <label>
         <input type="radio"
                name="employment_type"
                value="Others">
         Others
      </label>

    </div>
  </div>


    <div class="actions">
    <button type="submit">NEXT</button>
    <button type="reset">RESET</button>
    </div>

    </form>
    </main>

    <footer>
    © 2026 University of Madras. All Rights Reserved.
    </footer>

    <script>
    document.querySelector("input[name='dob']").addEventListener("change", function(){
    let dob = new Date(this.value);
    let today = new Date();
    let age = today.getFullYear() - dob.getFullYear();
    document.querySelector("input[name='age']").value = age;
    });

    document.getElementById("photoInput").addEventListener("change", function(e){
    const file = e.target.files[0];
    if(file){
    const reader = new FileReader();
    reader.onload = function(event){
    const img = document.getElementById("photoPreview");
    img.src = event.target.result;
    img.style.display = "block";
    };
    reader.readAsDataURL(file);
    }
    });
    /* ===================================================
    EMPLOYMENT YES / NO TOGGLE
    =================================================== */
    document.addEventListener("DOMContentLoaded", function () {

    const employmentOptions =
        document.getElementById("employmentOptions");

    const employmentRadios =
        document.querySelectorAll(
            'input[name="employment_status"]'
        );

    if (employmentOptions && employmentRadios.length > 0) {

        employmentRadios.forEach(radio => {

            radio.addEventListener("change", function () {

                if (this.value === "yes") {

                    employmentOptions.style.display = "block";

                } else {

                    employmentOptions.style.display = "none";

                    /* Clear selection */
                    document.querySelectorAll(
                        'input[name="employment_type"]'
                    ).forEach(r => r.checked = false);
                }

            });

        });

    }

  });
 /* =========================================
   AADHAAR AUTO FORMAT + VALIDATION
========================================= */

const aadhaarInput =
  document.getElementById("aadhaar");

if (aadhaarInput) {

  /* FORMAT WHILE TYPING */
  aadhaarInput.addEventListener("input", function () {

    // Remove non-digits
    let digits =
      this.value.replace(/\D/g, "");

    // Limit to 12 digits
    digits = digits.substring(0, 12);

    // Add space every 4 digits
    digits =
      digits.replace(/(.{4})/g, "$1 ").trim();

    this.value = digits;
  });


  /* ALLOW ONLY NUMBERS (BUT KEEP CONTROL KEYS) */
  aadhaarInput.addEventListener("keydown", function (e) {

    const allowedKeys = [
      "Backspace",
      "Delete",
      "ArrowLeft",
      "ArrowRight",
      "Tab"
    ];

    if (
      allowedKeys.includes(e.key) ||
      /^[0-9]$/.test(e.key)
    ) {
      return; // allow
    }

    e.preventDefault(); // block others

  });


  /* PASTE VALIDATION */
  aadhaarInput.addEventListener("paste", function (e) {

    e.preventDefault();

    let pasteData =
      (e.clipboardData || window.clipboardData)
      .getData("text");

    pasteData =
      pasteData.replace(/\D/g, "")
               .substring(0, 12);

    pasteData =
      pasteData.replace(/(.{4})/g, "$1 ").trim();

    this.value = pasteData;

  });

 }

let courseData = []; // store all data

function loadCourses() {

    let type =
        document.getElementById("course_type").value;

    if (!type) return;

    fetch("fetch_courses.php?type=" + type)
    .then(res => res.json())
    .then(data => {

        courseData = data; // save globally

        let programme =
            document.getElementById("programme_name");

        programme.innerHTML =
            "<option value=''>Select Programme</option>";

        /* Get unique degrees */
        let degrees = [...new Set(
            data.map(row => row.programme_degree)
        )];

        degrees.forEach(deg => {

            programme.innerHTML +=
            `<option value="${deg}">
                ${deg}
             </option>`;
        });

        /* Clear subject */
        document.getElementById(
            "main_subject"
        ).innerHTML =
        "<option>Select Subject</option>";
    });
}


/* =========================================
   FILTER SUBJECT BASED ON DEGREE
========================================= */

document.getElementById("programme_name")
.addEventListener("change", function() {

    let selectedDegree = this.value;

    let subject =
        document.getElementById("main_subject");

    subject.innerHTML =
        "<option>Select Subject</option>";

    courseData
    .filter(row =>
        row.programme_degree === selectedDegree
    )
    .forEach(row => {

        subject.innerHTML +=
        `<option value="${row.main_subject}">
            ${row.main_subject}
         </option>`;
    });

});

    </script>
    <script src="https://inputtools.google.com/request?itc=ta-t-i0-und&num=5"></script>

<script>
const englishInput = document.getElementById("name_english");
const tamilInput = document.getElementById("name_tamil");

englishInput.addEventListener("input", async function () {
    const text = this.value;

    if (text.length === 0) {
        tamilInput.value = "";
        return;
    }

    const response = await fetch(
        "https://inputtools.google.com/request?text=" +
        encodeURIComponent(text) +
        "&itc=ta-t-i0-und&num=5"
    );

    const data = await response.json();

    if (data[0] === "SUCCESS") {
        tamilInput.value = data[1][0][1][0];
    }
});
/* =========================================
   FOUNDATION LANGUAGE TOGGLE
========================================= */

function toggleFoundation() {

    const courseType =
        document.getElementById("course_type").value;

    const foundationRadios =
        document.querySelectorAll(
            'input[name="foundation_lang"]'
        );

    if (courseType === "UG") {

        /* Enable radios */
        foundationRadios.forEach(radio => {
            radio.disabled = false;
        });

    } else {

        /* Disable + Clear selection */
        foundationRadios.forEach(radio => {
            radio.checked = false;
            radio.disabled = true;
        });
    }
}

/* Run on page load */
document.addEventListener("DOMContentLoaded", toggleFoundation);

</script>
<script>
document.getElementById("name_english").addEventListener("input", function() {
    document.getElementById("name_tamil").value = this.value;
});
</script>
    </body>
    </html>