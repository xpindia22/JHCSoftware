<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Display protected content
echo "Welcome, " . $_SESSION["userid"] . "! You have access to this folder.";
?>