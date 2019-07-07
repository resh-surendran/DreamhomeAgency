<?php

include 'base.php';

$title = "Staff Management";

html_begin($title, $title);
$link = dream_connect() or exit("Could not connect to the database!");
?>

<script>
    function validateForm(formName) {
        console.log(document.getElementById(formName));
        console.log(document.getElementById(formName).staff_num.value);
        if (document.getElementById(formName).staff_num.value == "") {
            alert('Staff number is mandatory. This cannot be blank');
            return false;
        }
    }
</script>
    
<h3>View Staff Members:</h3>
<p style="margin-left: 20px"><b>Filters:</b></p>
<form action="staff_search.php" method="GET">
    <label style="width: 100px; float: left; text-align: right;">Staff No:</label>  <input type="text" name="staff_no">
    <br>
    <label style="width: 100px; float: left; text-align: right;">Last name:</label>  <input type="text" name="last_name">
    <br><br>
    <input style="margin-left: 20px" type="submit" value="View">
</form>
<br>
<h3>View details of branch employing staff member:</h3>
<form id="branch_form" action="staff_branch_search.php" method="GET">
    <label style="width: 100px; float: left; text-align: right;">Staff No:</label> <input type="text" name="staff_num"/>
    <input type="submit" value="Get Branch" onclick="return validateForm('branch_form')"/>    
</form>
<br>
<h3>View details of properties administered by staff member:</h3>
<form id="staff_property_form" action="property_search.php" method="GET">
    <label style="width: 100px; float: left; text-align: right;">Staff No:</label> <input type="text" name="staff_num"/>
    <input type="submit" value="Get Properties" onclick="return validateForm('staff_property_form')"/>    
</form>
<br>

<br><br>
<hr>
<br><br>

<h3>Add a new Staff Member:</h3>
<form action="staff_add.php" method="GET">
    <input type="submit" value="Add New Member"/>    
</form>

<br><br>
<hr>
<br><br>

<h3>Update Staff details by Staff No:</h3>
<form id="update_form" action="staff_update_form.php" method="GET">
    <input type="text" name="staff_num"/>
    <input type="submit" value="Update" onclick="return validateForm('update_form')"/>    
</form>

<br><br>
<hr>
<br><br>

<h3>Delete Staff Details by Staff No:</h3>
<form id="delete_form" action="staff_delete.php" method="GET">
    <input type="text" name="staff_num"/>
    <input type="submit" value="Delete" onclick="return validateForm('delete_form')"/>    
</form>

<br><br>
<?php

html_end();
?>