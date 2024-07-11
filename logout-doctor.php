<?php
session_start();
session_destroy();
header('Location: 004doctor_login.php');
exit;
?>