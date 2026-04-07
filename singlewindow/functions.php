<?php

function generateEnrollment($conn, $type, $language){

    $center = "105";
    $course_code = "FTECH";

    if($language == "English"){
        $base = 6000;
    } else {
        $base = 1000;
    }

    $query = "SELECT enrollment_no FROM applications 
              WHERE language='$language' 
              ORDER BY id DESC LIMIT 1";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        preg_match('/(\d+)$/', $row['enrollment_no'], $matches);
        $last_num = isset($matches[1]) ? intval($matches[1]) : $base;

        $next = $last_num + 1;

    } else {
        $next = $base + 1;
    }

    return $type . $center . $course_code . $next;
}
?>