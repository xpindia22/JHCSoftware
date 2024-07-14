<?php
// Clear cookies
setcookie('admin_id', '', time() - 3600, "/");
setcookie('admin_username', '', time() - 3600, "/");

// Redirect to login page
header("Location: admin_login.php");
exit();
?>
