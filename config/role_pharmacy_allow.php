<?php
 
// Check if the user has the Pharmacy role
if (!in_array('Pharmacy', $_SESSION['roles'])) {
    echo '<font color="blue">Only Pharmacy Access!. <br> Contact Administrator to access this page.</font>';
    exit;
}
 
?>
