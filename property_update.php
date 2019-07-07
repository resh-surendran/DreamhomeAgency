<?php

include 'base.php';

$title = "Storing Property Details";
html_begin($title, $title);
$link = dream_connect();

$propertyNum = $_POST['property_no'] ?? '';
$rent = $_POST['rent'] ?? '';
$staff_no = $_POST['staff_num'] ?? '';

$updateQuery = "update property_for_rent set Rent = '$rent', Sno = '$staff_no' "
        . " where Pno = '$propertyNum'";
$result_id = mysqli_query($link, $updateQuery);

if (!$result_id) {
    print("<h3>Could not update details of property member with property number: $propertyNum</h3>");
}
header('Location: property_search.php?property_no=' . $propertyNum);
