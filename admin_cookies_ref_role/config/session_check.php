<?php
//this session works for creating a patient visit.
//But it will not work for Doctor login or seeing a patient data.
session_start();
session_regenerate_id();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}
$userid = $_SESSION['userid']; // retrieve the user ID from the session
// echo "<p><a href='logout.php'>You are logged in as $userid, Logout</a></p>";
?>