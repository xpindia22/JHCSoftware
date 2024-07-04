
<?php
session_start();
session_regenerate_id();
require_once 'conn.php';

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}
echo"$userid <p><a href="logout.php">You are logged in as "$userid" , Logout</a></p>";
?>