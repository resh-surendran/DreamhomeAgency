<?php

include 'base.php';

$title = "Storing Staff Details";
html_begin($title, $title);
$link = dream_connect();

$staffNum = $_POST['staff_no'] ?? '';

//Validate staff number to be unique
$query = "select Sno from staff order by Sno";
$result = mysqli_query($link, $query)
        or die("Cannot find owner identifiers");
$i = 0;
$stafflist = [];
while ($row = mysqli_fetch_row($result)) {
    $stafflist[$i] = $row[0];
    $i++;
}
mysqli_free_result($result);

if (in_array($staffNum, $stafflist)) {
    exit("Staff member with staff number: $staffNum already exists");
}

$fname = $_POST['first_name'] ?? '';
$lname = $_POST['last_name'] ?? '';
$address = $_POST['address'] ?? '';
$telNo = $_POST['tel_no'] ?? '';
$position = $_POST['position'] ?? '';
$sex = $_POST['sex'] ?? '';
$dob = $_POST['dob'] ?? '';
$salary = $_POST['salary'] ?? '';
$nin = $_POST['nin'] ?? '';
$bNo = $_POST['branch_num'] ?? '';

$insertQuery = "insert into staff(Sno, FName, LName, Address, Tel_No, Position, Sex, DOB, Salary, NIN, Bno) "
        . " values('$staffNum', '$fname', '$lname', '$address', '$telNo', '$position', '$sex', '$dob', '$salary', '$nin', '$bNo')";
$result_id = mysqli_query($link, $insertQuery);

if (!$result_id) {
    print("Could not add the new member details ");
    return;
}

header('Location: staff_search.php?staff_no=' . $staffNum);

?>
