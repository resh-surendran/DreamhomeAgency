<?php

include 'base.php';

$title = "Storing Branch Details";
html_begin($title, $title);
$link = dream_connect();

$branchNum = $_POST['branch_no'] ?? '';
$street = $_POST['street'] ?? '';
$area = $_POST['area'] ?? '';
$city = $_POST['city'] ?? '';
$pcode = $_POST['pincode'] ?? '';
$telNo = $_POST['tel_number'] ?? '';
$faxNo = $_POST['fax_number'] ?? '';

$updateQuery = "update branch set Street = '$street', Area = '$area', City = '$city', Pcode = '$pcode', Tel_No = '$telNo', Fax_No = '$faxNo' "
        . " where Bno = '$branchNum'";
$result_id = mysqli_query($link, $updateQuery);

if (!$result_id) {
    print("<h3>Could not update details of branch member with branch number: $branchNum</h3>");
}
header('Location: branch_search.php?branch_no=' . $branchNum);
