<?php
include 'base.php';

$title = "Add a New Property";

html_begin($title, $title);
$link = dream_connect() or exit("Could not connect to the database!");

?>

<script>
    function validateFields() {
        if (document.property_data.property_no.value == "") {
            alert('Property number is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.street.value == "") {
            alert('Street is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.area.value == "") {
            alert('Area is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.city.value == "") {
            alert('City is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.pincode.value == "") {
            alert('Pincode is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.type.value == "") {
            alert('Type is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.rooms.value == "") {
            alert('Rooms is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.rent.value == "") {
            alert('Rent is mandatory. This cannot be blank');
            return false;
        }
        if (document.property_data.owner_num.selectedIndex == "") {
            document.property_data.owner_num.selectedIndex = 0;
        }
        if (document.property_data.staff_num.selectedIndex == "") {
            document.property_data.staff_num.selectedIndex = 0;
        }
        if (document.property_data.branch_num.selectedIndex == "") {
            document.property_data.branch_num.selectedIndex = 0;
        }
    }
</script>

<?php
display_property_details_form(TRUE);
?>




