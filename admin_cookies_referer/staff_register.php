<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'conn.php';
require_once 'session_user.php'; // Include session check
require_once 'role_sa_allow.php';
// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



// Function to suggest a new username
function suggest_username($username, $conn) {
    $suggested_username = $username;
    $i = 1;
    while (true) {
        $suggested_username = $username . $i;
        $sql = "SELECT 1 FROM users WHERE username = '$suggested_username'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            break;
        }
        $i++;
    }
    return $suggested_username;
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_BCRYPT);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    
    // Collect selected roles
    $roles = isset($_POST['roles']) ? $_POST['roles'] : [];
    $roles_str = implode(',', $roles);

    // Check for existing email
    $sql = "SELECT 1 FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Email already exists
        $error_message = "The email address '$email' is already in use. Please use a different email address.";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO users (username, password, department, email, mobile, notes, qualification, role) 
                VALUES ('$username', '$password', '$department', '$email', '$mobile', '$notes', '$qualification', '$roles_str')";
        
        if ($conn->query($sql) === TRUE) {
            echo "User registered successfully.";
        } else {
            $error_message = "An error occurred while registering the user. Please try again.";
        }
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
    <h2>Register Staff</h2>
    <?php if (!empty($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="Admin">Admin</option>
            <option value="Doctor">Doctor</option>
            <option value="Nursing">Nursing</option>
            <option value="Reception">Reception</option>
            <option value="Pharmacy">Pharmacy</option>
            <option value="Laboratory">Laboratory</option>
            <option value="MTS">MTS</option>
            <option value="Accounts">Accounts</option>
        </select><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile"><br><br>
        
        <label for="qualification">Qualification:</label>
        <input type="text" id="qualification" name="qualification"><br><br>
        
        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes"></textarea><br><br>
        
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
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
