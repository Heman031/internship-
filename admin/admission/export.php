<?php
require_once "../../db.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=approved_students.xls");

$result = $conn->query("
SELECT application_no, name, programme_name, mobile, processed_by, processed_at
FROM records
WHERE status='Approved'
");

echo "Application ID\tName\tCourse\tMobile\tProcessed By\tDate\n";

while($row = $result->fetch_assoc()){
    echo "{$row['application_no']}\t{$row['name']}\t{$row['programme_name']}\t{$row['mobile']}\t{$row['processed_by']}\t{$row['processed_at']}\n";
}