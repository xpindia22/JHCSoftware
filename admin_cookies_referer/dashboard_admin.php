<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'conn.php';
require_once 'session_user.php'; // Include session check
require_once 'sa.php';
// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


<p><a href='../admin_cookies_referer/staff_register.php'>Register Staff</a></p>

<br>

<p><a href='logout.php'>Logout</a></p>

?>