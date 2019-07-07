<?php

include 'base.php';

$title = "Update Staff Details";
html_begin($title, $title);
$link = dream_connect();

$staffNum = $_GET['staff_num'];
$query = "select * from staff where Sno = '$staffNum'";
$staffResponse = mysqli_query($link, $query)
        or die("Cannot find branch identifiers");
$i = 0;
if ($row = mysqli_fetch_row($staffResponse)) {
    $staffData = [
        'staff_num' => $row[0],
        'f_name' => $row[1],
        'l_name' => $row[2],
        'address' => $row[3],
        'tel_no' => $row[4],
        'position' => $row[5],
        'sex' => $row[6],
        'dob' => $row[7],
        'salary' => $row[8],
        'nin' => $row[9],
        'b_no' => $row[10]
    ];
} else {
    print("<h3>Staff details does not exist for staff number: $staffNum</h3>");
    return;
}
mysqli_free_result($staffResponse);

staff_details_form(FALSE, $staffData);
