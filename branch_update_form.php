<?php

include 'base.php';

$title = "Update Branch Details";
html_begin($title, $title);
$link = dream_connect();

$branchNum = $_GET['branch_no'] ?? '';
$query = "select * from branch where Bno = '$branchNum'";
$branchResponse = mysqli_query($link, $query)
        or die("Cannot find branch identifiers");
$i = 0;
if ($row = mysqli_fetch_row($branchResponse)) {
    $branchData = [
        'branch_no' => $row[0],
        'street' => $row[1],
        'area' => $row[2],
        'city' => $row[3],
        'pincode' => $row[4],
        'tel_number' => $row[5],
        'fax_number' => $row[6]
    ];
} else {
    print("<h3>Branch details does not exist for branch number: $branchNum</h3>");
    return;
}
mysqli_free_result($branchResponse);

display_branch_details_form(FALSE, $branchData);

html_end();

?>
