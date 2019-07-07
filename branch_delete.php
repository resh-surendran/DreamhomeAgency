<?php

include 'base.php';

$title = "Deletion of Branch Details";
html_begin($title, $title);
$link = dream_connect();

$branchNum = $_GET['branch_no'];

$selectQuery = "select * from branch where Bno ='$branchNum'";
$result_id = mysqli_query($link, $selectQuery);
if (!$result_id || empty(mysqli_fetch_row($result_id))) {
    print("<h4>Branch details does not exist for branch number: $branchNum</h4>");
    return;
}

//Check if any staff is linked to branch
$staffQuery = "select * from staff where Bno = '$branchNum'";
$result = mysqli_query($link, $staffQuery);
if ($result && !empty(mysqli_fetch_row($result))) {
    print("<h4>Cannot delete branch since there are some staff members associated with the branch</h4>");
    return;
}

$selectQuery = "select * from property_for_rent where Bno = '$branchNum'";
$result_id = mysqli_query($link, $selectQuery);
if ($result_id && !empty(mysqli_fetch_row($result_id))) {
    print("<h4>Cannot delete branch since there are some properties associated with the branch</h4>");
    return;
}


$deleteQuery = "delete from branch where Bno = '$branchNum'";
$result_id = mysqli_query($link, $deleteQuery);
if (!$result_id) {
    print("<h4>Unable to delete the branch details with branch number: $branchNum</h4>");
} else {
    print("<h4>The branch details with branch number: $branchNum has been deleted.</h4>");
}