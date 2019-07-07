<?php

include 'base.php';

$title = "Storing Property Details";
html_begin($title, $title);
$link = dream_connect();

$propertyNum = $_POST['property_no'] ?? '';

// Validate property number to be unique
$query = "select Pno from property_for_rent order by Pno";
$result = mysqli_query($link, $query)
        or die("Cannot find owner identifiers");
$i = 0;
$propertylist = [];
while ($row = mysqli_fetch_row($result)) {
    $propertylist[$i] = $row[0];
    $i++;
}
mysqli_free_result($result);

if (in_array($propertyNum, $propertylist)) {
    exit("Property with property number: $propertyNum already exists");
}

$street = $_POST['street'] ?? '';
$area = $_POST['area'] ?? '';
$city = $_POST['city'] ?? '';
$pcode = $_POST['pincode'] ?? '';
$type = $_POST['type'] ?? '';
$rooms = $_POST['rooms'] ?? '';
$rent = $_POST['rent'] ?? '';
$owner_no = $_POST['owner_num'] ?? '';
$staff_no = $_POST['staff_num'] ?? '';
$branch_no = $_POST['branch_num'] ?? '';

$insertQuery = "insert into property_for_rent(Pno, Street, Area, City, Pcode, Type, Rooms, Rent, Ono, Sno, Bno) "
        . " values('$propertyNum', '$street', '$area', '$city', '$pcode', '$type', '$rooms', '$rent', '$owner_no', '$staff_no', '$branch_no')";
$result_id = mysqli_query($link, $insertQuery);

if (!$result_id) {
    print("Could not add the new property details " . mysqli_error($link));
    return;
}

header('Location: property_search.php?property_no=' . $propertyNum);

?>
