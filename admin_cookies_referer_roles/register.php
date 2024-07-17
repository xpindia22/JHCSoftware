<?php
require_once 'conn.php';
require_once 'session_user.php'; // Include session check

// Check if the user is an admin
if (strpos($_SESSION['role'], 'Admin') === false) {
    echo "Access denied. You do not have permission to access this page.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_BCRYPT);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    
    // Handle roles
    $roles = isset($_POST['roles']) ? implode(',', $_POST['roles']) : '';
    
    $sql = "INSERT INTO users (userid, username, password, department, email, phone, notes, role) 
            VALUES ('$userid', '$username', '$password', '$department', '$email', '$phone', '$notes', '$roles')";
    
    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
</head>
<body>
    <h2>Register User</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="userid">User id:</label>
        <input type="text" id="userid" name="userid" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="department">Department:</label>
        <input type="text" id="department" name="department"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br><br>
        
        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes"></textarea><br><br>
        
        <label for="roles">Roles:</label><br>
        <input type="checkbox" id="admin" name="roles[]" value="Admin">
        <label for="admin">Admin</label><br>
        <input type="checkbox" id="staff" name="roles[]" value="Staff">
        <label for="staff">Staff</label><br>
        <input type="checkbox" id="pharmacy" name="roles[]" value="Pharmacy">
        <label for="pharmacy">Pharmacy</label><br>
        <input type="checkbox" id="accounts" name="roles[]" value="Accounts">
        <label for="accounts">Accounts</label><br>
        <input type="checkbox" id="lab" name="roles[]" value="Lab">
        <label for="lab">Lab</label><br>
        <input type="checkbox" id="reception" name="roles[]" value="Reception">
        <label for="reception">Reception</label><br>
        <input type="checkbox" id="hr" name="roles[]" value="HR">
        <label for="hr">HR</label><br>
        <input type="checkbox" id="mts" name="roles[]" value="MTS">
        <label for="mts">MTS</label><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
