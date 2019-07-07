<?php

include 'base.php';

$title = "Staff Details";
html_begin($title, $title);
$link = dream_connect();
$staffNumber = $_GET['staff_no'] ?? '';
$lastName = $_GET['last_name'] ?? '';

$query = "select Sno, FName, LName, Address, Tel_No, Position, Sex, DOB, Salary, Bno from staff ";
$conditions = "";
if (!empty($staffNumber)) {
    $conditions .= " Sno = '$staffNumber' ";
}
if (!empty($lastName)) {
    if (!empty($conditions)) {
        $conditions .= " and ";
    }
    $conditions .= " LName = '$lastName' ";
}
if (!empty($conditions)) {
    $query .= " where " . $conditions;
}
$result_id = mysqli_query($link, $query);

if (!$result_id) {
    print("<h4>Unable to fetch staff details</h4");
    return;
}

if (mysqli_num_rows($result_id) == 0) {
    print("<h4> No staff details available with given filters.</h4>");
    return;
}

$headings = ["Staff Number", "First Name", "Last Name", "Address", "Tel Number", "Position", "Sex", "Date of Birth", "Salary", "Branch Number"];
display_result_table($headings, $result_id);

html_end();
?>
