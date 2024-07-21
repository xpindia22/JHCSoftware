<?php
 
// Check if the user has the Super Admin role
if (!in_array('Admin', $_SESSION['roles'])) {
    echo '<font color="blue">Only Admin Access! Access denied. <br> Contact Administrator to access this page.</font>';
    exit;
}
 
?>
