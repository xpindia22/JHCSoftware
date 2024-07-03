<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// User is logged in, allow access to protected files
echo "Welcome, " . $_SESSION['email'] . "! You are now logged in.";
?>
<p><a href="?logout=1">Logout</a></p>