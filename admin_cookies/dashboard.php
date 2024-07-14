<?php
require_once 'session_user.php'; // Include session check

// The user is authenticated if this point is reached
echo "Welcome, " . htmlspecialchars($username) . "!<br>";
echo "Your User ID is: " . htmlspecialchars($userid) . ".";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard</h2>
    <p>Welcome to your dashboard, <?php echo htmlspecialchars($username); ?>.</p>
</body>
</html>
