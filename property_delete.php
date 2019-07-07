<?php

include 'base.php';

$title = "Deletion of Property Details";
html_begin($title, $title);
$link = dream_connect();

$propertyNum = $_GET['property_no'] ?? '';

$selectQuery = "select * from property_for_rent where Pno ='$propertyNum'";
$result_id = mysqli_query($link, $selectQuery);
if (!$result_id || empty(mysqli_fetch_row($result_id))) {
    print("<h4>Property details does not exist for property number: $propertyNum</h4>");
    return;
}

$deleteQuery = "delete from property_for_rent where Pno = '$propertyNum'";
$result_id = mysqli_query($link, $deleteQuery);
if (!$result_id) {
    print("<h4>Unable to delete the property details with property number: $propertyNum</h4>");
} else {
    print("<h4>The property details with property number: $propertyNum has been deleted.</h4>");
}
