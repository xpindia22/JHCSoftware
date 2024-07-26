<?php
session_start();
require_once '../config/conn.php'; // connect to the database.

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['userid']) || !in_array('SA', $_SESSION['roles'])) {
    echo "Access denied. You do not have sufficient permissions.";
    exit();
}

// Define the super admin user IDs
$super_admin_userids = ['14', '15']; // Replace with your actual user IDs

// Initialize message variable
$message = "";

// Fetch all users for the dropdown
$sql = "SELECT userid, username, email, role FROM users";
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
    $roles = isset($_POST['roles']) ? $_POST['roles'] : [];
    $roles_str = implode(',', $roles);

    // Extract user details from the selected option
    list($userid, $username, $email) = explode(' | ', $selected_user);

    // Check if the user is the super admin
    if (in_array($userid, $super_admin_userids)) {
        if ($status === 'blacklist') {
            $message = "Error: You cannot blacklist the super admin.";
        } else {
            // Allow role changes but not blacklisting
            $sql = "UPDATE users SET role = ? WHERE userid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $roles_str, $userid);

            if ($stmt->execute()) {
                $message = "Roles for Super Admin with UserID '$userid' and Email '$email' have been successfully updated.";
            } else {
                $message = "Error updating roles: " . $conn->error;
            }
        }
    } else {
        $sql = "UPDATE users SET status = ?, role = ? WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $status, $roles_str, $userid);

        if ($stmt->execute()) {
            $message = "User with UserID '$userid' and Email '$email' has been successfully " . ($status === 'blacklist' ? 'blacklisted' : 'whitelisted') . " and roles updated.";
        } else {
            $message = "Error updating user status and roles: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User Status and Roles</title>
    <script>
        function populateRoles(selectedUser) {
            const rolesCheckboxes = document.querySelectorAll('input[name="roles[]"]');
            rolesCheckboxes.forEach(checkbox => checkbox.checked = false);
            
            if (selectedUser) {
                const userDetails = selectedUser.split(' | ');
                const userRoles = userDetails[3].split(',');

                userRoles.forEach(role => {
                    const checkbox = document.querySelector(`input[name="roles[]"][value="${role}"]`);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }
        }
    </script>
</head>
<body>
    <h2>Update User Status and Roles</h2>
    <?php if (!empty($message)) : ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="selected_user">Select User:</label>
        <select id="selected_user" name="selected_user" required onchange="populateRoles(this.value)">
            <option value="">Select a user</option>
            <?php foreach ($users as $user) : ?>
                <option value="<?php echo $user['userid'] . ' | ' . $user['username'] . ' | ' . $user['email'] . ' | ' . $user['role']; ?>">
                    <?php echo $user['userid'] . ' | ' . $user['username'] . ' | ' . $user['email']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="blacklist">Blacklist</option>
            <option value="whitelist">Whitelist</option>
        </select><br><br>
        
        <label for="roles">Roles:</label><br>
        <input type="checkbox" name="roles[]" value="SA"> Super Admin<br>
        <input type="checkbox" name="roles[]" value="Admin"> Admin<br>
        <input type="checkbox" name="roles[]" value="Doctor"> Doctor<br>
        <input type="checkbox" name="roles[]" value="Nurse"> Nurse<br>
        <input type="checkbox" name="roles[]" value="Laboratory"> Laboratory<br>
        <input type="checkbox" name="roles[]" value="Pharmacy"> Pharmacy<br>
        <input type="checkbox" name="roles[]" value="Reception"> Reception<br>
        <input type="checkbox" name="roles[]" value="MTS"> MTS<br>
        <input type="checkbox" name="roles[]" value="Miscellaneous"> Miscellaneous<br>
        <input type="checkbox" name="roles[]" value="Finance"> Finance<br><br>
        
        <input type="submit" value="Update Status">
    </form>
</body>
</html>
