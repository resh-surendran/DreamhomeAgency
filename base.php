<?php

function dream_connect() {
    $conn_id = mysqli_connect("localhost", "root", "password", "dreamhome");
    if (!$conn_id) {
        return FALSE;
    }
    return $conn_id;
}

function html_begin($title, $header) {
    print ("<html>\n");
    print ("<head>\n");
    if ($title != "")
        print ("<title>$title</title>\n");
    print ("<head>\n");
    print ("<body bgcolor=\"yellow\" style=\"margin: 20px\">\n");
    if ($header != "")
        print ("<h2 style=\"text-align: center\">$title</h2>\n");
    print("<h4 style=\"text-align: right\"> <a href=\"index.php\">Go to Homepage</a></h4>");
}

function html_end() {
    print ("</body></html>\n");
}

function display_result_table($headings, $result_pointer) {
    print ("<table style=\"border: 1px solid black\";>\n"); # begin table
    
    #display headings for the table
    print("<tr>\n");
    foreach ($headings as $field) {
        print("<td style=\"border: 1px solid black\";><b>$field</b></td>\n");        
    }
    print("</tr>\n");

# read & display results of query, then clean up
# ROW_PRINT_LOOP
    $numFields = mysqli_num_fields($result_pointer);

    while ($row = mysqli_fetch_row($result_pointer)) {
        print ("<tr>\n"); # begin table row
        for ($i = 0; $i < $numFields; $i++) {
# escape any special characters and print table cell
            printf("<td style=\"border: 1px solid black\";>%s</td>\n", htmlspecialchars($row[$i]));
        }
        print ("</tr>\n"); # end table row
    }
# ROW_PRINT_LOOP
    mysqli_free_result($result_pointer);
    print ("</table>\n"); # end table
}

function get_branch_list() {
    $link = dream_connect();
    $query = "select Bno from branch order by Bno";
    $branchquery = mysqli_query($link, $query)
            or die("Cannot find branch identifiers");
    $i = 0;
    $branchlist = [];
    while ($row = mysqli_fetch_row($branchquery)) {
        $branchlist[$i] = $row[0];
        $i++;
    }
    mysqli_free_result($branchquery);
    return $branchlist;
}

function staff_details_form($isNew, $staffDetails = []) {
    
    $actionField = $isNew ? "staff_store.php" : "staff_update.php";
    print("<form name=\"staff_data\" action=\"$actionField\" method=\"POST\">"
            . "<label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Staff number: </label>"
            . " <input type=\"text\" name=\"staff_no\""
            . (!$isNew ? (" value=\"" . $staffDetails['staff_num'] . "\" style=\"background-color: lightgray\" readonly") : "") . ">");
    print( "<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">First name: </label>"
            . " <input type=\"text\" name=\"first_name\" " . (!$isNew ? "value=\"" . $staffDetails['f_name'] . "\" style=\"background-color: lightgray\" readonly" : "") . ">");
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Last name: </label>"
            . " <input type=\"text\" name=\"last_name\" " . (!$isNew ? "value=\"" . $staffDetails['l_name'] . "\" style=\"background-color: lightgray\" readonly" : "") . ">");
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Address: </label>"
            . " <input type=\"text\" name=\"address\" " . (!$isNew ? "value=\"" . $staffDetails['address'] . "\"" : "") . ">");
    print ("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Telephone Number:</label>"
            . " <input type=\"text\" name=\"tel_no\" " . (!$isNew ? "value=\"" . $staffDetails['tel_no'] . "\"" : "") . ">");
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Position: </label>"
            . " <input type=\"text\" name=\"position\" " . (!$isNew ? "value=\"" . $staffDetails['position'] . "\" style=\"background-color: lightgray\" readonly" : "") . ">");
    $isFemale = FALSE;
    if (!$isNew && $staffDetails['sex'] == 'F') {
        $isFemale = TRUE;
    }
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Sex: </label>"
    . "<input type=\"radio\" name=\"sex\" value=\"M\" " . ((!$isFemale) ? "checked=\"checked\"" : "") . "> Male"
    . "<input type=\"radio\" name=\"sex\" value=\"F\" " . (($isFemale) ? "checked=\"checked\"" : "") . ">Female");
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Date of Birth: </label>"
        . " <input type=\"date\" name=\"dob\" " . (!$isNew ? "value=\"" . $staffDetails['dob'] . "\" style=\"background-color: lightgray\" readonly" : "") . ">");
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Salary: </label>"
            . " <input type=\"number\" name=\"salary\" " . (!$isNew ? "value=\"" . $staffDetails['salary'] . "\"" : "") . ">");
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">NIN: </label>"
            . " <input type=\"text\" name=\"nin\" " . (!$isNew ? "value=\"" . $staffDetails['nin'] . "\" style=\"background-color: lightgray\" readonly" : "") . ">");
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Branch: </label>");
    if ($isNew) {
        $branchlist = get_branch_list();
        print(" <select name=\"branch_num\">");
        foreach ($branchlist as $bid) {
            print ("<option value=\"$bid\">$bid</option>\n");
        }
        print("</select>");
    } else {
        print("<input type=\"text\" name=\"branch_num\" value=\"" . $staffDetails['b_no'] . "\"  style=\"background-color: lightgray\" readonly>");
    }
    print("<br><br>
    <input type=\"submit\" style=\"margin-left: 20px\" value=\"" .($isNew ? "Add" : "Update") . "\" onclick=\"return checkform()\">
</form>");

}

function display_branch_details_form($isNew, $branchDetails = []) {
    $actionField = $isNew ? "branch_store.php" : "branch_update.php";
    print("<form name=\"branch_data\" action=\"$actionField\" method=\"POST\">"
            . "<label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Branch number: </label>"
            . " <input type=\"text\" name=\"branch_no\""
            . (!$isNew ? (" value=\"" . $branchDetails['branch_no'] . "\" style=\"background-color: lightgray\" readonly") : "") . ">");
    $fields = ["Street", "Area", "City", "Pincode", "Tel Number", "Fax Number"];
    foreach ($fields as $field) {
        $name = str_replace(" ", "_", strtolower($field));
        print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">$field: </label>"
            . " <input type=\"text\" name=\"$name\" " . (!$isNew ? "value=\"" . $branchDetails[$name] . "\"" : "") . ">");
    }
    print("<br><br>"
        . "<input type=\"submit\" style=\"margin-left: 20px\" value=\"" .($isNew ? "Add" : "Update") . "\" onclick=\"return validateFields()\">"
        . "</form>");
}

function get_staff_list() {
    $link = dream_connect();
    $query = "select Sno from staff order by Sno";
    $result = mysqli_query($link, $query)
            or die("Cannot find staff identifiers");
    $i = 0;
    $stafflist = [];
    while ($row = mysqli_fetch_row($result)) {
        $stafflist[$i] = $row[0];
        $i++;
    }
    mysqli_free_result($result);
    return $stafflist;
}

function get_owner_list() {
    $link = dream_connect();
    $query = "select Ono from owner order by Ono";
    $result = mysqli_query($link, $query)
            or die("Cannot find owner identifiers");
    $i = 0;
    $ownerlist = [];
    while ($row = mysqli_fetch_row($result)) {
        $ownerlist[$i] = $row[0];
        $i++;
    }
    mysqli_free_result($result);
    return $ownerlist;
}

function display_property_details_form($isNew, $propertyDetails = []) {
    $actionField = $isNew ? "property_store.php" : "property_update.php";
    print("<form name=\"property_data\" action=\"$actionField\" method=\"POST\">"
            . "<label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Property number: </label>"
            . " <input type=\"text\" name=\"property_no\""
            . (!$isNew ? (" value=\"" . $propertyDetails['property_no'] . "\" style=\"background-color: lightgray\" readonly") : "") . ">");
    $fields = ["Street", "Area", "City", "Pincode", "Type", "Rooms"];
    foreach ($fields as $field) {
        $name = str_replace(" ", "_", strtolower($field));
        print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">$field: </label>"
            . " <input type=\"text\" name=\"$name\" " 
            . (!$isNew ? "value=\"" . $propertyDetails[$name] . "\" style=\"background-color: lightgray\" readonly" : "")
            . ">");
    }
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Rent: </label>"
            . " <input type=\"text\" name=\"rent\" " . (!$isNew ? "value=\"" . $propertyDetails['rent'] . "\"" : "") . ">");
    if ($isNew) {
        //Display owners list
        print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Owner: </label>");
        $ownerlist = get_owner_list();
        print(" <select name=\"owner_num\">");
        foreach ($ownerlist as $o_no) {
            print ("<option value=\"$o_no\">$o_no</option>\n");
        }
        print("</select>");

        //Display branches list
        print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Branch: </label>");
        $branchlist = get_branch_list();
        print(" <select name=\"branch_num\">");
        foreach ($branchlist as $bid) {
            print ("<option value=\"$bid\">$bid</option>\n");
        }
        print("</select>");
    } else {
        //Display owner of the property
        print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Owner: </label>");
        print("<input type=\"text\" name=\"owner_num\" value=\"" . $propertyDetails['o_no'] . "\"  style=\"background-color: lightgray\" readonly>");
        
        //Display selected branch
        print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Branch: </label>");
        print("<input type=\"text\" name=\"branch_num\" value=\"" . $propertyDetails['b_no'] . "\"  style=\"background-color: lightgray\" readonly>");
    }
    
    //Display staff list
    print("<br> <label style=\"width: 150px; float: left; text-align: right; font-weight: bold\">Staff Member: </label>");
    $stafflist = get_staff_list();
    print(" <select name=\"staff_num\">");
    foreach ($stafflist as $s_no) {
        if (!$isNew && $s_no == $propertyDetails['s_no']) {
            print ("<option value=\"$s_no\" selected=\"selected\" >$s_no</option>\n");
        } else {
            print ("<option value=\"$s_no\">$s_no</option>\n");
        }
    }
    print("</select>");

    print("<br><br>"
        . "<input type=\"submit\" style=\"margin-left: 20px\" value=\"" .($isNew ? "Add" : "Update") . "\" onclick=\"return validateFields()\">"
        . "</form>");
}

?>
