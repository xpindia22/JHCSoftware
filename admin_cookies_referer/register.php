<?php
require_once 'conn.php';
require_once 'session_user.php'; // Include session check

// Check if the user is an admin
if ($_SESSION['role'] !== 'admin') {
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
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    
    $sql = "INSERT INTO users (userid, username, password, department, email, phone, notes, role) 
            VALUES ('$userid', '$username', '$password', '$department', '$email', '$phone', '$notes', '$role')";
    
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
        
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
