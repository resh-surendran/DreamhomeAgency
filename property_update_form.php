<?php

include 'base.php';

$title = "Update Property Details";
html_begin($title, $title);
$link = dream_connect();

$propertyNum = $_GET['property_no'] ?? '';
$query = "select * from property_for_rent where Pno = '$propertyNum'";
$propertyResponse = mysqli_query($link, $query)
        or die("Cannot find property identifiers");
$i = 0;
if ($row = mysqli_fetch_row($propertyResponse)) {
    $propertyData = [
        'property_no' => $row[0],
        'street' => $row[1],
        'area' => $row[2],
        'city' => $row[3],
        'pincode' => $row[4],
        'type' => $row[5],
        'rooms' => $row[6],
        'rent' => $row[7],
        'o_no' => $row[8],
        's_no' => $row[9],
        'b_no' => $row[10]
    ];
} else {
    print("<h3>Property details does not exist for property number: $propertyNum</h3>");
    return;
}
mysqli_free_result($propertyResponse);

display_property_details_form(FALSE, $propertyData);

html_end();

?>
