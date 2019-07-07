<?php

include 'base.php';

$title = "Branch Details";
html_begin($title, $title);
$link = dream_connect();
$branchNumber = $_GET['branch_no'] ?? '';
$city = $_GET['city'] ?? '';
$pcode = $_GET['p_code'] ?? '';

$query = "select Bno, Street, Area, City, Pcode, Tel_No, Fax_No from branch ";
$conditions = "";
if (!empty($branchNumber)) {
    $conditions .= " Bno = '$branchNumber' ";
}
if (!empty($city)) {
    if (!empty($conditions)) {
        $conditions .= " and ";
    }
    $conditions .= " City = '$city' ";
}
if (!empty($pcode)) {
    if (!empty($conditions)) {
        $conditions .= " and ";
    }
    $conditions .= " Pcode = '$pcode' ";
}
if (!empty($conditions)) {
    $query .= " where " . $conditions;
}
$result_id = mysqli_query($link, $query);

if (!$result_id) {
    print("<h4>Unable to fetch branch details</h4>");
    return;
}

if (mysqli_num_rows($result_id) == 0) {
    print("<h4> No branch details available with given filters.</h4>");
    return;
}

$headings = ["Branch Number", "Street", "Area", "City", "Pincode", "Tel Number", "Fax Number"];
display_result_table($headings, $result_id);

html_end();

?>
