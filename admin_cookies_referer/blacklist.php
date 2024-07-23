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

// Fetch all users for the dropdown
$sql = "SELECT userid, username, email FROM users";
$result = $conn->query($sql);
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_user = mysqli_real_escape_string($conn, $_POST['selected_user']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Extract user details from the selected option
    list($userid, $username, $email) = explode(' | ', $selected_user);

    $sql = "UPDATE users SET status = ? WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $status, $userid);

    if ($stmt->execute()) {
        $message = "User with UserID '$userid' and Email '$email' has been successfully $status" . "ed.";
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
        <label for="selected_user">Select User:</label>
        <select id="selected_user" name="selected_user" required>
            <?php foreach ($users as $user) : ?>
                <option value="<?php echo $user['userid'] . ' | ' . $user['username'] . ' | ' . $user['email']; ?>">
                    <?php echo $user['userid'] . ' | ' . $user['username'] . ' | ' . $user['email']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="blacklist">Blacklist</option>
            <option value="whitelist">Whitelist</option>
        </select><br><br>
        
        <input type="submit" value="Update Status">
    </form>
</body>
</html>
