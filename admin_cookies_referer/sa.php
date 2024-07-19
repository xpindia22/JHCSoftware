<?php
// require_once 'session_user.php'; // Ensure this path is correct for your project

// Check if the user has the Super Admin role
if (!in_array('SA', $_SESSION['roles'])) {
    echo "Access denied. Only Super Admin can access this page.";
    exit;
}

// Rest of your staff_register.php code
?>
