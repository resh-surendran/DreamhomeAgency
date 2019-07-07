<?php

include 'base.php';

$title = "Property Details";
html_begin($title, $title);
$link = dream_connect();
$propertyNumber = $_GET['property_no'] ?? '';
$type = $_GET['type'] ?? '';
$city = $_GET['city'] ?? '';
$pcode = $_GET['p_code'] ?? '';
$rent = $_GET['rent'] ?? '';
$staffNum = $_GET['staff_num'] ?? '';

$query = "select Pno, Street, Area, City, Pcode, Type, Rooms, Rent, Ono, Sno, Bno from property_for_rent ";
$conditions = "";
if (!empty($propertyNumber)) {
    $conditions .= " Pno = '$propertyNumber' ";
}
if (!empty($type)) {
    if (!empty($conditions)) {
        $conditions .= " and ";
    }
    $conditions .= " Type = '$type' ";
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
if (!empty($rent)) {
    if (!empty($conditions)) {
        $conditions .= " and ";
    }
    $conditions .= " Rent = '$rent' ";
}
if (!empty($staffNum)) {
    if (!empty($conditions)) {
        $conditions .= " and ";
    }
    $conditions .= " Sno = '$staffNum'";
}

if (!empty($conditions)) {
    $query .= " where " . $conditions;
}
$result_id = mysqli_query($link, $query);

if (!$result_id) {
    exit("\nUnable to fetch property details");
}

if (mysqli_num_rows($result_id) == 0) {
    print("<h4> No property details available with given filters.</h4>");
    return;
}

$headings = ["Property Number", "Street", "Area", "City", "Pincode", "Type", "Rooms", "Rent", "Owner No", "Staff No", "Branch No"];
display_result_table($headings, $result_id);

html_end();

?>
