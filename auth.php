<?php
// auth.php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!== true) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit;
}
?>