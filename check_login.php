<?php
session_start();
session_regenerate_id();
require_once 'conn.php';

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}

?>

<p><a href="logout.php">Logout</a></p>