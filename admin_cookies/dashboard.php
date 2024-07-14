<?php
require_once 'session_user.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_COOKIE['username']); ?>!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>
