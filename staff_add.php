<?php
include 'base.php';

$title = "Add a New Staff Member";

html_begin($title, $title);
$link = dream_connect() or exit("Could not connect to the database!");

?>

<script>
    function checkform() {
        console.log("In function");
        if (document.staff_data.staff_no.value == "") {
            alert('Staff number is mandatory. This cannot be blank');
            return false;
        }
        if (document.staff_data.first_name.value == "") {
            alert('First name is mandatory. This cannot be blank');
            return false;
        }
        if (document.staff_data.last_name.value == "") {
            alert('Last Name is mandatory. This cannot be blank');
            return false;
        }
        if (document.staff_data.address.value == "") {
            alert('Address is mandatory. This cannot be blank');
            return false;
        }
        if (document.staff_data.position.value == "") {
            alert('Position is mandatory. This cannot be blank');
            return false;
        }
        if (document.staff_data.tel_no.value == "") {
            alert('Telephone number is mandatory. This cannot be blank');
            return false;
//        } else {
//            var value = document.staff_data.tel_no.value;
//            if (value.match(/[0-9]{4}-[0-9]{3}-[0-9]{4}/g) == null) {
//                alert("Telephone number should be of the format 'xxxx-xxx-xxxx'");
//                return false;
//            }
        }
        if (document.staff_data.dob.value == "") {
            alert('Date of Birth is mandatory. This cannot be blank');
            return false;
        }
        if (document.staff_data.salary.value == "") {
            alert('Salary is mandatory. This cannot be blank');
            return false;
        }
        if (document.staff_data.branch_num.selectedIndex == "") {
            document.staff_data.branch_num.selectedIndex = 0;
        }
    }
</script>

<?php
staff_details_form(TRUE);
?>



