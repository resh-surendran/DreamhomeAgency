<?php
include 'base.php';

$title = "Add a New Branch";

html_begin($title, $title);
$link = dream_connect() or exit("Could not connect to the database!");

?>

<script>
    function validateFields() {
        if (document.branch_data.branch_no.value == "") {
            alert('Branch number is mandatory. This cannot be blank');
            return false;
        }
        if (document.branch_data.street.value == "") {
            alert('Street is mandatory. This cannot be blank');
            return false;
        }
        if (document.branch_data.area.value == "") {
            alert('Area is mandatory. This cannot be blank');
            return false;
        }
        if (document.branch_data.city.value == "") {
            alert('City is mandatory. This cannot be blank');
            return false;
        }
        if (document.branch_data.pincode.value == "") {
            alert('Pincode is mandatory. This cannot be blank');
            return false;
        }
        if (document.branch_data.tel_no.value == "") {
            alert('Telephone number is mandatory. This cannot be blank');
            return false;
        }
    }
</script>

<?php
display_branch_details_form(TRUE);
?>




