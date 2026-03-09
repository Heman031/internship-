<?php
session_start();
require "db.php";

/* ===== FETCH STATES ===== */
$states = $pdo->query("SELECT * FROM states ORDER BY state_name ASC")->fetchAll();

/* ===== FETCH DISTRICTS ===== */
$districts = $pdo->query("SELECT * FROM districts ORDER BY district_name ASC")->fetchAll();

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
/* ===== PHOTO UPLOAD (SAVE AS APPLICATION NUMBER) ===== */

$photoName = null;

if (!empty($_FILES['photo']['name'])) {

    $allowed = ['jpg','jpeg','png'];
    $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("Invalid photo format. Only JPG, JPEG, PNG allowed.");
    }

    if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
        die("Photo size must be below 2MB.");
    }

    // Create folder like uploads/UGA-2026-00001/
    $uploadDir = "uploads/" . $application_no . "/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Final filename: UGA-2026-00001.jpg
    $photoName = $application_no . "." . $ext;

    $destination = $uploadDir . $photoName;

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
        die("Failed to upload photo.");
    }
}
/* ===== FOUNDATION LANGUAGE SAFETY ===== */
if ($_POST['course_type'] !== "UG") {
    $_POST['foundation_lang'] = null;
}
    /* ===== INSERT USING PDO ===== */
    $sql = "INSERT INTO records (
        application_no, course_type, foundation_lang, programme_name,
        main_subject, medium,differently_abled, photo,
        name, street, town, state, district, pincode,
        phone, mobile,
        name_english, name_tamil, email, dob, age,
        guardian_name, mother_name, aadhaar, nationality,
        religion, mother_tongue, blood_group, community, caste,
        employment_status, employment_type
    ) VALUES (
        :application_no, :course_type, :foundation_lang, :programme_name,
        :main_subject, :medium, :differently_abled, :photo,
        :name, :street, :town, :state, :district, :pincode,
        :phone, :mobile,
        :name_english, :name_tamil, :email, :dob, :age,
        :guardian_name, :mother_name, :aadhaar, :nationality,
        :religion, :mother_tongue, :blood_group, :community, :caste,
        :employment_status, :employment_type
    )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':application_no' => $application_no,
        ':course_type' => $_POST['course_type'],
        ':foundation_lang' => ($_POST['course_type'] === "UG") ? $_POST['foundation_lang'] : null,
        ':programme_name' => $_POST['programme_name'],
        ':main_subject' => $_POST['main_subject'],
        ':medium' => $_POST['medium'],
        ':differently_abled' => $_POST['differently_abled'],
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
        ':blood_group' => $_POST['blood_group'],
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
    <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <header class="top-header">
  <div class="app">
    <div class="logo">
      <img src="image/Univ.png">
      <div>
        <strong>சென்னை பல்கலைக்கழகம் – தொலைதூரக் கல்வி நிறுவனம்</strong><br>
        University of Madras – Institute of Distance Education
      </div>
    </div>
    <div class="nav">
      <a href="#">Home</a>
      <a href="#">Contact</a>
    </div>
  </div>
 </header>
    <section class="banner">
    <div class="container">
    <div class="form-header">
    <h1>ADMISSION APPLICATION FORM</h1>
  <p>Step 1 - Personal & Programme Details</p>
  </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- PROGRAMME DETAILS -->
    <fieldset class="programme-fieldset">
    <legend>PROGRAMME DETAILS</legend>
    <div class="programme-content-wrapper">
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
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Urdu">Urdu</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Kannada">Kannada</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Sanskrit">Sanskrit</label>
    <label class="radio-item"><input type="radio" name="foundation_lang" value="Communicative English">Communicative English</label>
    </div>
    </div>
    <div class="form-row">
    <label>Course Type *</label>
    <select name="course_type"
        id="course_type"
        onchange="loadCourses(); toggleFoundation();"
        required>
    <option value="">Select Course Type</option>
    <option value="UG">Under Graduate</option>
    <option value="PG">Post Graduate</option>
    <option value="DIP">Diploma</option>
    <option value="CERT">Certificate</option>
    </select>
    </div>
    <div class="form-group">
    <label><b>Medium of Study</b></label><br>

    <label>
        <input type="radio" name="medium" value="tamil" required>
        Tamil 
    </label>

    <label style="margin-left:20px;">
        <input type="radio" name="medium" value="english" required>
        English 
    </label>
</div>
    <div class="form-grid">
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
</div>
    <div class="form-row">
  <label>Specially Challenged Status <span class="required-star">*</span></label><br>

  <div class="inline">
    <label class="radio-item">
      <input type="checkbox" name="special_status[]" value="Differently Abled" onchange="toggleSpecialFile()">
      Differently Abled
    </label>

    <label class="radio-item">
      <input type="checkbox" name="special_status[]" value="Visually Challenged" onchange="toggleSpecialFile()">
      Visually Challenged
    </label>

    <label class="radio-item">
      <input type="checkbox" name="special_status[]" value="Prisoner" onchange="toggleSpecialFile()">
      Prisoner
    </label>

    <label class="radio-item">
      <input type="checkbox" name="special_status[]" value="None" onchange="toggleSpecialFile()">
      None
    </label>
  </div>

  <!-- File Upload -->
  <div id="specialFileBox" style="margin-top:10px; display:none;">
    <label>Upload Supporting Certificate (PDF/JPG/PNG)</label>
    <input type="file" name="special_file" accept=".pdf,.jpg,.jpeg,.png">
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
    <legend>ADDRESS FOR COMMUNICATION</legend>
    <div class="form-grid">
    <div class="form-row">
    <label>Name *</label>
    <input type="text" name="name" required>
    </div>
    <div class="form-row">
    <label>Door No & Street *</label>
    <input type="text" name="street" required>
    </div>
</div>
    <div class="form-grid">
   <div class="form-row">
      <label>Town/Village Post *</label>
      <input type="text" name="town">
   </div>

   <div class="form-row">
      <label>Pin Code *</label>
      <input type="text" name="pincode">
   </div>
</div>
<div class="form-grid">
    <div class="form-row">
    <label for="state">State </label>
    <select name="state" id="state" required>
        <option value="">Select State</option>
    </select>
</div>

<div class="form-row">
    <label for="district">District </label>
    <select name="district" id="district" required>
        <option value="">Select District</option>
    </select>
</div>
</div>
    <div class="form-grid">
    <div class="form-row">
    <label>Phone No (Res/Off) *</label>
    <input type="text" name="phone" maxlength="10" required>
    </div>
    <div class="form-row">
    <label>Mobile Number *</label>
    <input type="text" name="mobile" maxlength="10" required>
    </div>
    </div>
    <div class="form-row">
    <label>Email ID *</label>
    <input type="email" name="email" required>
    </div>
    </fieldset>
    <!-- APPLICANT DETAILS -->
    <fieldset>
    <legend>APPLICANT DETAILS</legend>
    <div class="form-grid">
    <div class="form-row">
    <label>1.(a)Name (English in CAPITAL LETTERS) *</label>
    <input type="text" name="name_english" id="name_english" required>
    </div>
    <div class="form-row">
    <label> (b)Name (Tamil) *</label>
    <input type="text" name="name_tamil" id="name_tamil" required>
    </div>
    </div>
    
    <div class="form-grid">
    <div class="form-row">
    <label>Date of Birth as Per T.C *</label>
    <input type="date" name="dob" required max="<?php echo date('Y-m-d', strtotime('-17 years')); ?>">
    </div>
    <div class="form-row">
    <label>Age *</label>
    <input type="text" name="age" readonly>
    </div>
    <div class="form-row">
    <label>Gender</label>
    <div class="radio-group">
    <label class="radio-item"><input type="radio" name="gender" value="Male">Male</label>
    <label class="radio-item"><input type="radio" name="gender" value="Female">Female</label>
    <label class="radio-item"><input type="radio" name="gender" value="Transgender">Transgender</label>
    </div>
    </div>
   </div>
   <div class="form-grid">
    <div class="form-row">
    <label>2.Father's / Guardian Name *</label>
    <input type="text" name="guardian_name" required>
    </div>
    <div class="form-row">
    <label>Mother's Name *</label>
    <input type="text" name="mother_name" required>
    </div>
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
    <div class="form-grid">
    <div class="form-row">
    <label>Nationality *</label>
    <input type="text" name="nationality" value="INDIAN" required>
    </div>
    <div class="form-row">
    <label>Religion *</label>
    <input type="text" name="religion" required>
    </div>
</div>
    <div class="form-grid">

  <div class="form-row">
    <label>Mother Tongue *</label>
    <input type="text" name="mother_tongue" required>
  </div>

  <div class="form-row">
    <label>Blood Group *</label>
    <select name="blood_group" required>
      <option value="">Select Blood Group</option>
      <option value="A+">A+</option>
      <option value="A-">A-</option>
      <option value="B+">B+</option>
      <option value="B-">B-</option>
      <option value="O+">O+</option>
      <option value="O-">O-</option>
      <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
    </select>
  </div>

</div>
    <div class="form-grid">
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
        <input type="radio" name="employment_status" value="yes" required> Yes
     </label>
     <label>
       <input type="radio" name="employment_status" value="no"> No
     </label>
    </div>
</div>
</fieldset>
<!-- ORGANIZATION -->
 <div id="employmentOptions"
     style="display:none; margin-top:10px;">
    <label>Select Organization:</label>
    <div class="inline">
      <label>
         <input type="radio" name="employment_type" value="University of Madras"> University of Madras
      </label>
      <label>
         <input type="radio" name="employment_type" value="Others"> Others
      </label>
    </div>
  </div>
  
   <div class="form-buttons">
    <button type="submit" class="save-btn">Save and Continue</button>
    <button type="reset" class="reset-btn">Reset</button>
</div>
    </form>
    </div>
    </section>
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
document.addEventListener("DOMContentLoaded", function () {

  const stateSelect = document.getElementById("state");
  const districtSelect = document.getElementById("district");

  fetch("fetch_states.php")
    .then(res => res.json())
    .then(states => {
      states.forEach(s => {
        stateSelect.innerHTML += 
          `<option value="${s.id}">${s.state_name}</option>`;
      });
    });

  stateSelect.addEventListener("change", function () {

    districtSelect.innerHTML = `<option>Select District</option>`;

    if (!this.value) return;

    fetch("fetch_districts.php?state_id=" + this.value)
      .then(res => res.json())
      .then(districts => {
        districts.forEach(d => {
          districtSelect.innerHTML += 
            `<option value="${d}">${d}</option>`;
        });
      });

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
        foundationRadios.forEach(radio => {
            radio.disabled = false;
            radio.required = true;   // make required for UG
        });
    } else {
        foundationRadios.forEach(radio => {
            radio.checked = false;
            radio.disabled = true;
            radio.required = false;  // remove required
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
<script>
function toggleSpecialFile() {

  const checkboxes = document.querySelectorAll('input[name="special_status[]"]');
  const fileBox = document.getElementById("specialFileBox");

  let show = false;

  checkboxes.forEach(cb => {
    if (cb.checked && cb.value !== "None") {
      show = true;
    }
  });

  fileBox.style.display = show ? "block" : "none";
}
</script>
    </body>
    </html>