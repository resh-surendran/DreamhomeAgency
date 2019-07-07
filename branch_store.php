<?php

include 'base.php';

$title = "Storing Branch Details";
html_begin($title, $title);
$link = dream_connect();

$branchNum = $_POST['branch_no'];

// Validate branch number to be unique
$branchList = get_branch_list();
if (in_array($branchNum, $branchList)) {
    exit("Branch with branch number: $branchNum already exists");
}

$street = $_POST['street'] ?? '';
$area = $_POST['area'] ?? '';
$city = $_POST['city'] ?? '';
$pcode = $_POST['pincode'] ?? '';
$telNo = $_POST['tel_number'] ?? '';
$faxNo = $_POST['fax_number'] ?? '';

$insertQuery = "insert into branch(Bno, Street, Area, City, Pcode, Tel_No, Fax_No) "
        . " values('$branchNum', '$street', '$area', '$city', '$pcode', '$telNo', '$faxNo')";
$result_id = mysqli_query($link, $insertQuery);

if (!$result_id) {
    print("Could not add the new branch details " . mysqli_error($link));
    return;
}

header('Location: branch_search.php?branch_no=' . $branchNum);

?>
