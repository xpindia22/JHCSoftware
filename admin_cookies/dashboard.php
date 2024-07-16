<?php
// require_once 'session_user.php'; // Include session check

// The user is authenticated if this point is reached
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
    <p>Your User ID is: <?php echo htmlspecialchars($userid); ?>.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
