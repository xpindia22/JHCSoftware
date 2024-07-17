<?php
session_start();
require_once 'conn.php';

// Function to route to different pages
function route($path) {
    switch ($path) {
        case 'dashboard':
            require 'dashboard.php';
            break;
        case 'register':
            require 'register.php';
            break;
        default:
            echo "Page not found.";
            break;
    }
}

// Check if user is authenticated via cookies
if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username'])) {
    // Store the requested URL and redirect to login
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's details from cookies
$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];

// Validate session and cookies
if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username) {
    // Redirect to login if session and cookie values mismatch
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Fetch user role from session
$role = $_SESSION['role'];

// Extract the path from the URL
$path = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
route($path);

?>
