<?php
session_start();
require_once 'conn.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['userid']) || !in_array('SA', $_SESSION['roles'])) {
    echo "Access denied. You do not have sufficient permissions.";
    exit();
}

// Initialize message variable
$message = "";

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = mysqli_real_escape_string($conn, $_POST['identifier']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $identifier_type = mysqli_real_escape_string($conn, $_POST['identifier_type']);

    // Determine the column to update based on the identifier type
    if ($identifier_type == 'email') {
        $sql = "UPDATE users SET status = ? WHERE email = ?";
    } else {
        $sql = "UPDATE users SET status = ? WHERE userid = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $status, $identifier);

    if ($stmt->execute()) {
        $message = "User with $identifier_type '$identifier' has been successfully $status" . "ed.";
    } else {
        $message = "Error updating user status: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User Status</title>
</head>
<body>
    <h2>Update User Status</h2>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="identifier_type">Identifier Type:</label>
        <select id="identifier_type" name="identifier_type" required>
            <option value="email">Email</option>
            <option value="userid">User ID</option>
        </select><br><br>
        
        <label for="identifier">Email/User ID:</label>
        <input type="text" id="identifier" name="identifier" required><br><br>
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="blacklist">Blacklist</option>
            <option value="whitelist">Whitelist</option>
        </select><br><br>
        
        <input type="submit" value="Update Status">
    </form>
</body>
</html>
