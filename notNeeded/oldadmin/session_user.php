<?php
if (!isset($_COOKIE['user_id']) || !isset($_COOKIE['username'])) {
    // Redirect to login page if not authenticated
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's details from cookies
$user_id = $_COOKIE['user_id'];
$username = $_COOKIE['username'];
?>
