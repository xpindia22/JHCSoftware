<?php
 
// Check if the user has the Super Admin role
if (!in_array('Doctor', $_SESSION['roles'])) {
    echo '<font color="blue">Only Doctors Alloed! Access denied. <br> Contact Administrator to access this page.</font>';
    exit;
}
 
?>
