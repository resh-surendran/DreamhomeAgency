<?php

include 'base.php';

$title = "Storing Staff Details";
html_begin($title, $title);
$link = dream_connect();

$staffNum = $_POST['staff_no'];
$address = $_POST['address'];
$telNo = $_POST['tel_no'];
$salary = $_POST['salary'];

$updateQuery = "update staff set Address = '$address', Tel_No = '$telNo', Salary = '$salary' where Sno = '$staffNum'";
$result_id = mysqli_query($link, $updateQuery);

if (!$result_id) {
    print("<h3>Could not update details of staff member with staff number: $staffNum</h3>");
}
header('Location: staff_search.php?staff_no=' . $staffNum);
