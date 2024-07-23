<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

<<<<<<< HEAD:admin_cookies_referer/dashboard_doctor.php
require_once 'conn.php';
require_once 'session_user.php'; // Include session check
require_once 'role_doctor_allow.php';
=======
require_once '../config/conn.php'; // connect to the database.
require_once '../config/session_user.php'; // Include session check
// require_once 'role_nurse_allow.php';
>>>>>>> work:dashboard/dashboard_nurse.php

// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Display messages
echo "<h2>Welcome, $username</h2>";
echo "<p>Select your dashboard:</p>";
echo "<ul>";


?>
<p><a href='../register/001_create_pt_appointment.php'>Create Patient Appointment</a></p>
<br>
<p><a href='../admin_cookies_referer/edit_pt.php'>Edit Patient Record</a></p>
<p><a href='logout.php'>Logout</a></p>
