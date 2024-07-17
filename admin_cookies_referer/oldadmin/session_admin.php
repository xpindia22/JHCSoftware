<?php
if (!isset($_COOKIE['admin_id']) || !isset($_COOKIE['admin_username'])) {
    // Redirect to login page if not authenticated
    header("Location: admin_login.php");
    exit();
}

// Fetch the logged-in admin's details from cookies
$admin_id = $_COOKIE['admin_id'];
$admin_username = $_COOKIE['admin_username'];
?>
