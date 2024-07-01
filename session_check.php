<?php
session_start(); // Start the session

// Check if the user is logged in (you can adjust this condition based on your authentication logic)
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or display an error message
    header('Location: login.html'); // Example: Redirect to login.php
    exit;
}
?>
