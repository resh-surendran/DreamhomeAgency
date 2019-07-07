<?php

include 'base.php';

$title = "Branch Details of Staff Member";
html_begin($title, $title);
$link = dream_connect();
$staffNumber = $_GET['staff_num'];

$query = "select branch.Bno, Street, Area, City, Pcode, branch.Tel_No, Fax_No from branch,staff"
        . " where staff.Bno = branch.Bno and staff.Sno = '$staffNumber'";
$result_id = mysqli_query($link, $query);

if (!$result_id) {
    exit("\nUnable to fetch branch details of staff member" . mysqli_error($link));
}

if (mysqli_num_rows($result_id) == 0) {
    print("<h4> No branch details available for the given staff member.</h4>");
    return;
}

$headings = ["Branch Number", "Street", "Area", "City", "Pincode", "Tel Number", "Fax Number"];
display_result_table($headings, $result_id);

html_end();
?>
