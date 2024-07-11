<?php
session_start();
session_destroy();
header('Location: 004_doctor_login.php');
exit;
?>