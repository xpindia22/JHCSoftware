<?php
session_start();

// Check if the doctor is logged in
if (!isset($_SESSION['doctor_id']) || !isset($_SESSION['doctor_fname']) || !isset($_SESSION['doctor_lname'])) {
    // Redirect to login page if not logged in
    header("Location: 004_doctor_login.php");
    exit();
}

// Fetch the logged-in doctor's details from the session
$doctor_id = $_SESSION['doctor_id'];
$doctor_fname = $_SESSION['doctor_fname'];
$doctor_lname = $_SESSION['doctor_lname'];
?>
