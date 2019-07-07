<?php

include 'base.php';

$title = "Deletion of Staff Details";
html_begin($title, $title);
$link = dream_connect();

$staffNum = $_GET['staff_num'] ?? '';

$selectQuery = "select * from staff where Sno ='$staffNum'";
$result_id = mysqli_query($link, $selectQuery);
if (!$result_id || empty(mysqli_fetch_row($result_id))) {
    print("<h4>Staff details does not exist for staff number: $staffNum</h4>");
    return;
}

$selectQuery = "select * from property_for_rent where Sno = '$staffNum'";
$result_id = mysqli_query($link, $selectQuery);
if ($result_id && !empty(mysqli_fetch_row($result_id))) {
    print("<h4>Cannot delete staff details since there are some properties associated with the staff member</h4>");
    return;
}


$deleteQuery = "delete from staff where Sno = '$staffNum'";
$result_id = mysqli_query($link, $deleteQuery);
if (!$result_id) {
    print("<h4>Unable to delete the staff details with staff number: $staffNum</h4>");
} else {
    print("<h4>The staff details for member with staff number: $staffNum has been deleted.</h4>");
}
