let selectedLevel = "";

function loadCourses(level) {
    selectedLevel = level;

    const course = document.getElementById("course");
    const eligibilityBox = document.getElementById("eligibilityBox");

    course.disabled = false;
    course.innerHTML = "<option>Loading...</option>";
    eligibilityBox.innerText = "Eligibility will appear here";

    fetch("load_courses.php?level=" + level)
        .then(res => res.text())
        .then(data => course.innerHTML = data);
}

function loadEligibility(courseName) {
    if (courseName === "") return;

    fetch(
        "load_eligibility.php?course=" +
        encodeURIComponent(courseName) +
        "&level=" +
        selectedLevel
    )
        .then(res => res.text())
        .then(data => {
            document.getElementById("eligibilityBox").innerHTML =
                "<strong>Eligibility:</strong> " + data;
            document.getElementById("eligibility").value = data;
            document.getElementById("nextBtn").disabled = false;
        });
}
