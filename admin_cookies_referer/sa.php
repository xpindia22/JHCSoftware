<?php
// require_once 'session_user.php'; // Ensure this path is correct for your project

// Check if the user has the Super Admin role
if (!in_array('SA', $_SESSION['roles'])) {
    echo '<font color="blue">Access denied. <br> Contact Administrator to access this page.</font>';
    exit;
}

// Rest of your staff_register.php code
?>
