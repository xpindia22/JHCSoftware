<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/conn.php'; // connect to the database.
require_once '../config/session_user.php'; // Include session check
// require_once 'role_admin_allow.php';

// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Display messages
echo "<h2>Welcome, $username</h2>";
echo "<p>Select your dashboard:</p>";
echo "<ul>";


?>

<p><a href='../admin_cookies_referer/staff_register.php'>Register Staff</a></p>
<br>
<p><a href='../admin_cookies_referer/blacklist.php'>Blacklist Staff</a></p>

<p><a href='logout.php'>Logout</a></p>
