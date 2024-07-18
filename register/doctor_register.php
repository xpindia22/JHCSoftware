<h2>Register A Doctor</h2>
<?php
require_once '../config/session_check.php';
require_once '../config/conn.php'; // connect to the database.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get doctor's information from the registration form
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT); // Hash the password for security reasons

    // Insert the doctor's information into the users table
    $sql = "INSERT INTO users (userid, username, email, mobile, notes, department, specialization, password) 
            VALUES ('$userid', '$username', '$email', '$mobile', '$notes', '$department', '$specialization', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New doctor registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!-- Registration form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="userid">User ID:</label><br>
    <input type="text" id="userid" name="userid" required><br>
    
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <label for="mobile">Mobile:</label><br>
    <input type="tel" id="mobile" name="mobile" required><br>
    
    <label for="notes">Notes:</label><br>
    <textarea id="notes" name="notes"></textarea><br>
    
    <label for="department">Department:</label><br>
    <select id="department" name="department" required>
        <option value="Internal Medicine">Internal Medicine</option>
        <option value="Cardiology">Cardiology</option>
        <option value="Dietary">Dietary</option>
        <option value="Gynecology">Gynecology</option>
        <option value="Paediatrics">Paediatrics</option>
        <option value="Orthopedics">Orthopedics</option>
    </select><br><br>
    
    <label for="specialization">Specialization:</label><br>
    <input type="text" id="specialization" name="specialization" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <input type="submit" value="Register">
</form>
