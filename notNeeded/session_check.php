<?php
session_start();
if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit;
}
?>
