<?php

include 'base.php';

$title = "Property Management";

html_begin($title, $title);
$link = dream_connect() or exit("Could not connect to the database!");
?>

<script>
    function validateForm(formName) {
        if (document.getElementById(formName).property_no.value == "") {
            alert('Property number is mandatory. This cannot be blank');
            return false;
        }
    }
</script>
    
<h3>View Property Details:</h3>
<p style="margin-left: 20px"><b>Filters:</b></p>
<form action="property_search.php" method="GET">
    <label style="width: 100px; float: left; text-align: right;">Property No:</label>  <input type="text" name="property_no">
    <br>
    <label style="width: 100px; float: left; text-align: right;">Type:</label>  <input type="text" name="type">
    <br>
    <label style="width: 100px; float: left; text-align: right;">City:</label>  <input type="text" name="city">
    <br>
    <label style="width: 100px; float: left; text-align: right;">Pincode:</label>  <input type="text" name="p_code">
    <br>
    <label style="width: 100px; float: left; text-align: right;">Rent:</label>  <input type="text" name="rent">
    <br><br>
    <input style="margin-left: 20px" type="submit" value="View">
</form>

<br><br>
<hr>
<br><br>

<h3>Add a new Property:</h3>
<form action="property_add.php" method="GET">
    <input type="submit" value="Add New Property"/>    
</form>

<br><br>
<hr>
<br><br>

<h3>Update Property details by Property No:</h3>
<form id="update_form" action="property_update_form.php" method="GET">
    <input type="text" name="property_no"/>
    <input type="submit" value="Update" onclick="return validateForm('update_form')"/>    
</form>

<br><br>
<hr>
<br><br>

<h3>Delete Property Details by Property No:</h3>
<form id="delete_form" action="property_delete.php" method="GET">
    <input type="text" name="property_no"/>
    <input type="submit" value="Delete" onclick="return validateForm('delete_form')"/>    
</form>

<br><br>

<?php

html_end();
?>