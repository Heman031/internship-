document.addEventListener("DOMContentLoaded", function () {

  /* ===================================================
     STATE & DISTRICT DROPDOWN
  =================================================== */

  const stateSelect = document.getElementById("state");
  const districtSelect = document.getElementById("district");

  if (stateSelect && districtSelect) {

    // Load States
    fetch("fetch_states.php")
      .then(res => res.json())
      .then(states => {
        stateSelect.innerHTML = `<option value="">Select State</option>`;
        states.forEach(s => {
          stateSelect.innerHTML += 
            `<option value="${s.id}">${s.state_name}</option>`;
        });
      })
      .catch(err => console.error("State fetch error:", err));

    // Load Districts on change
    stateSelect.addEventListener("change", function () {

      districtSelect.innerHTML = 
        `<option value="">Select District</option>`;

      if (!this.value) return;

      fetch(`fetch_districts.php?state_id=${this.value}`)
        .then(res => res.json())
        .then(districts => {
          districts.forEach(d => {
            districtSelect.innerHTML += 
              `<option value="${d}">${d}</option>`;
          });
        })
        .catch(err => console.error("District fetch error:", err));
    });
  }



  /* ===================================================
     DOB VALIDATION (17+)
  =================================================== */

  const dobInput = document.getElementById("dob");

  if (dobInput) {
    dobInput.addEventListener("change", function () {

      const dob = new Date(this.value);
      const today = new Date();

      let age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();

      if (
        monthDiff < 0 ||
        (monthDiff === 0 && today.getDate() < dob.getDate())
      ) {
        age--;
      }

      if (age < 17) {
        alert("Applicant must be 17 years or above.");
        this.value = "";
      }
    });
  }



  /* ===================================================
     PHOTO PREVIEW
  =================================================== */

  const photoInput = document.getElementById("photoInput");
  const photoPreview = document.getElementById("photoPreview");

  if (photoInput && photoPreview) {
    photoInput.addEventListener("change", function () {

      const file = this.files[0];
      if (!file) return;

      // Allow only image files
      if (!file.type.startsWith("image/")) {
        alert("Please upload an image file only.");
        this.value = "";
        photoPreview.style.display = "none";
        return;
      }

      const reader = new FileReader();
      reader.onload = function () {
        photoPreview.src = reader.result;
        photoPreview.style.display = "block";
      };

      reader.readAsDataURL(file);
    });
  }



  /* ===================================================
     COMMUNITY → CASTE LOADING
  =================================================== */

  const casteSelect = document.getElementById("caste");

  if (casteSelect) {
    document.querySelectorAll('input[name="community"]')
      .forEach(radio => {

        radio.addEventListener("change", function () {

          const community = this.value;

          casteSelect.innerHTML = 
            '<option>Loading...</option>';

          fetch("get_caste.php", {
            method: "POST",
            headers: {
              "Content-Type": 
              "application/x-www-form-urlencoded"
            },
            body: "community=" + encodeURIComponent(community)
          })
          .then(res => res.text())
          .then(data => {
            casteSelect.innerHTML = data;
          })
          .catch(err => {
            console.error("Caste load error:", err);
            casteSelect.innerHTML =
              '<option>Error loading caste</option>';
          });

        });

      });
  }



  /* ===================================================
     EMPLOYMENT YES/NO TOGGLE
  =================================================== */

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

          // Clear selected employment type
          document.querySelectorAll(
            'input[name="employment_type"]'
          ).forEach(r => r.checked = false);
        }

      });

    });
  }
  /* =========================================
   OTHER COURSE YES / NO TOGGLE (FIXED)
 ========================================= */

 document.addEventListener("change", function (e) {

  if (e.target.name === "other_course") {

    const otherCourseBox =
      document.getElementById("otherCourseBox");

    if (!otherCourseBox) return;

    if (e.target.value === "Yes") {

      otherCourseBox.style.display = "block";

    } else {

      otherCourseBox.style.display = "none";

      const input =
        otherCourseBox.querySelector("input");

      if (input) input.value = "";

    }

  }

 });

 /* =========================================
   ABC YES / NO TOGGLE
 ========================================= */

 const abcRadios =
  document.querySelectorAll('input[name="abc"]');

 const abcBox =
  document.getElementById("abcBox");

 if (abcRadios.length > 0 && abcBox) {

  abcRadios.forEach(radio => {

    radio.addEventListener("change", function () {

      if (this.value === "Yes") {

        abcBox.style.display = "block";

      } else {

        abcBox.style.display = "none";

        document.getElementById("abc_id").value = "";
      }

    });

  });

 }
 
 /* =========================================
   ABC ID FORMAT + VALIDATION
 ========================================= */

 const abcInput = document.getElementById("abc_id");

 if (abcInput) {

  abcInput.addEventListener("input", function () {

    /* Remove non-digits */
    let value = this.value.replace(/\D/g, "");

    /* Limit to 12 digits */
    value = value.substring(0, 12);

    /* Add space every 4 digits */
    value = value.replace(/(.{4})/g, "$1 ").trim();

    this.value = value;
  });


  /* Prevent typing letters */
  abcInput.addEventListener("keypress", function (e) {

    if (!/[0-9]/.test(e.key)) {
      e.preventDefault();
    }

  });

 }

 /* =========================================
   AUTO ENCLOSURE SELECT ON FILE UPLOAD
 ========================================= */

 document.addEventListener("DOMContentLoaded", function () {

  const mapping = [

    { file: "file_sslc", enc: "enc_sslc" },
    { file: "file_hsc", enc: "enc_hsc" },
    { file: "file_ug", enc: "enc_ug" },
    { file: "file_tc", enc: "enc_tc" },
    { file: "file_migration", enc: "enc_migration" },
    { file: "file_undertaking", enc: "enc_undertaking" }

  ];

  mapping.forEach(item => {

    const fileInput =
      document.getElementById(item.file);

    const checkbox =
      document.getElementById(item.enc);

    if (fileInput && checkbox) {

      fileInput.addEventListener("change", function () {

        if (this.files.length > 0) {

          checkbox.checked = true;

        } else {

          checkbox.checked = false;

        }

      });

    }

  });

 });
 /* =========================================
   DECLARATION MANDATORY VALIDATION
 ========================================= */

 document.addEventListener("DOMContentLoaded", function () {

  const form =
    document.querySelector("form");

  const declaration =
    document.getElementById("declaration");

  if (form && declaration) {

    form.addEventListener("submit", function (e) {

      if (!declaration.checked) {

        e.preventDefault(); // Stop submit

        alert(
          "Please accept the Declaration before proceeding."
        );

        declaration.focus();

      }

    });

  }

 });
 /* =========================================
   DOCUMENT VALIDATION LIKE DECLARATION
 ========================================= */

 document.querySelector("form")
 .addEventListener("submit", function (e) {

  let errors = [];

  function checkFile(id, name) {

    const file =
      document.getElementById(id);

    if (!file || file.files.length === 0) {

      errors.push(name);

      file.classList.add("error-field");

    } else {

      file.classList.remove("error-field");

    }

  }

  /* Mandatory for ALL */

  checkFile("file_sslc", "SSLC Certificate");
  checkFile("file_hsc", "HSC Certificate");
  checkFile("file_tc", "Transfer Certificate");
  checkFile("file_migration", "Migration Certificate");
  checkFile("file_undertaking", "Undertaking");

  /* UG mandatory ONLY for PG */

  const courseType =
    "<?= $course_type ?>";   // from PHP

  if (courseType === "PG") {
    checkFile("file_ug", "UG Certificate");
  }

  /* If any error */

  if (errors.length > 0) {

    e.preventDefault(); // STOP submit

    alert(
      "Please upload mandatory documents:\n\n"
      + errors.join("\n")
    );

  }

 });

 /* =========================================
   ALL EXAM PASSING DATE VALIDATION
========================================= */

document.querySelector("form")
.addEventListener("submit", function (e) {

  let hasError = false;

  function validatePassing(id, examName) {

    const field =
      document.getElementById(id);

    if (!field || !field.value) return;

    const parts =
      field.value.split("/");

    if (parts.length !== 2) {

      alert(
        examName +
        " Passing date format must be MM/YYYY"
      );

      field.classList.add("error-field");
      hasError = true;
      return;

    }

    const month = parseInt(parts[0]);
    const year  = parseInt(parts[1]);

    if (month < 1 || month > 12) {

      alert(
        examName +
        " Month must be between 01-12"
      );

      field.classList.add("error-field");
      hasError = true;
      return;

    }

    const today = new Date();

    const passingDate =
      new Date(year, month - 1);

    if (passingDate >= today) {

      alert(
        examName +
        " Passing date must be before application date."
      );

      field.classList.add("error-field");
      hasError = true;

    } else {

      field.classList.remove("error-field");

    }

  }

  /* Validate All Exams */

  validatePassing("sslc_pass_year", "SSLC");

  validatePassing("hsc_pass_year", "HSC");

  validatePassing("dip_pass_year", "Diploma");

  validatePassing("ug_pass_year", "UG");

  /* STOP SUBMIT */

  if (hasError) {
    e.preventDefault();
  }

 });

});


