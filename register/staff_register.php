<h2>Register Staff</h2>
<?php
require_once '../config/session_check.php';
require_once '../config/conn.php'; // connect to the database.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get staff's information from the registration form
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT); // Hash the password for security reasons

    // Get selected roles and create a comma-separated string
    $roles = isset($_POST['roles']) ? $_POST['roles'] : [];
    $role_str = implode(',', $roles);

    // Insert the staff's information into the users table
    $sql = "INSERT INTO users ( username, email, mobile, notes, password, role, department, qualification) VALUES ( '$username', '$email', '$mobile', '$notes', '$password', '$role_str', '$department', '$qualification')";

    if ($conn->query($sql) === TRUE) {
        echo "New staff registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!-- Registration form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <label for="mobile">Mobile:</label><br>
    <input type="tel" id="mobile" name="mobile" required><br>
    
    <label for="notes">Notes:</label><br>
    <textarea id="notes" name="notes"></textarea><br>
    
    <label for="qualification">qualification:</label><br>
    <textarea id="qualification" name="qualification"></textarea><br>

    <label for="department">department:</label><br>
    <textarea id="department" name="department"></textarea><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>

    <label for="roles">Roles:</label><br>
    <input type="checkbox" name="roles[]" value="Admin"> Admin<br>
    <input type="checkbox" name="roles[]" value="Doctor"> Doctor<br>
    <input type="checkbox" name="roles[]" value="Nurse"> Nurse<br>
    <input type="checkbox" name="roles[]" value="Laboratory"> Laboratory<br>
    <input type="checkbox" name="roles[]" value="Pharmacy"> Pharmacy<br>
    <input type="checkbox" name="roles[]" value="Reception"> Reception<br>
    <input type="checkbox" name="roles[]" value="MTS"> MTS<br>
    <input type="checkbox" name="roles[]" value="Accounts"> Accounts<br>
    <input type="checkbox" name="roles[]" value="Echocardiographer"> Echocardiographer<br>
    
    <input type="submit" value="Register">
</form>
