<?php
 
// Check if the user has the Super Admin role
if (!in_array('SA', $_SESSION['roles'])) {
    echo '<font color="blue">Access denied. <br> Contact Administrator to access this page.</font>';
    exit;
}
 
?>
