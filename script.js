let currentProgramme = "";

function loadCourses(programme) {
    currentProgramme = programme;

    fetch("load_courses.php?programme=" + programme)
        .then(res => res.text())
        .then(data => {
            document.getElementById("course").innerHTML = data;
            document.getElementById("eligibilityBox").innerHTML =
                " Please Check The Eligibility Criteria For Candidates Before Applying ";
            document.getElementById("nextBtn").disabled = true;
        });
}

function loadEligibility(selectEl) {
    let courseId = selectEl.value;
    let courseName = selectEl.options[selectEl.selectedIndex].text;

    if (courseId === "") return;

    document.getElementById("course_name").value = courseName;

    fetch(
        "load_eligibility.php?programme=" + currentProgramme + "&id=" + courseId
    )
        .then(res => res.text())
        .then(data => {
            document.getElementById("eligibility").value = data;
            document.getElementById("eligibilityBox").innerHTML =
                "<b>Eligibility:</b> " + data;
            document.getElementById("nextBtn").disabled = false;
        });
}


