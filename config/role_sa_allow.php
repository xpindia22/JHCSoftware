<?php
 
// Check if the user has the Super Admin role
if (!in_array('SA', $_SESSION['roles'])) {
    echo '<font color="blue"><b>You need Super Admin privileges to access this file. Access is denied. <br> Contact Administrator to access this page.</b></font>';
    exit;
}
 
?>
