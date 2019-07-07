<?php

include 'base.php';

$title = "Branch Management";

html_begin($title, $title);
$link = dream_connect() or exit("Could not connect to the database!");
?>

<script>
    function validateForm(formName) {
        if (document.getElementById(formName).branch_no.value == "") {
            alert('Branch number is mandatory. This cannot be blank');
            return false;
        }
    }
</script>
    
<h3>View Branch Details:</h3>
<p style="margin-left: 20px"><b>Filters:</b></p>
<form action="branch_search.php" method="GET">
    <label style="width: 100px; float: left; text-align: right;">Branch No:</label>  <input type="text" name="branch_no">
    <br>
    <label style="width: 100px; float: left; text-align: right;">City:</label>  <input type="text" name="city">
    <br>
    <label style="width: 100px; float: left; text-align: right;">Pincode:</label>  <input type="text" name="p_code">
    <br><br>
    <input style="margin-left: 20px" type="submit" value="View">
</form>

<br><br>
<hr>
<br><br>

<h3>Add a new Branch:</h3>
<form action="branch_add.php" method="GET">
    <input type="submit" value="Add New Branch"/>    
</form>

<br><br>
<hr>
<br><br>

<h3>Update Branch details by Branch No:</h3>
<form id="update_form" action="branch_update_form.php" method="GET">
    <input type="text" name="branch_no"/>
    <input type="submit" value="Update" onclick="return validateForm('update_form')"/>    
</form>

<br><br>
<hr>
<br><br>

<h3>Delete Branch Details by Branch No:</h3>
<form id="delete_form" action="branch_delete.php" method="GET">
    <input type="text" name="branch_no"/>
    <input type="submit" value="Delete" onclick="return validateForm('delete_form')"/>    
</form>

<br><br>

<?php

html_end();
?>