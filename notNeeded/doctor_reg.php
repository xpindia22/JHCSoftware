<?php
// Configuration
$db_host = 'localhost';
$db_username = 'mydb';
$db_password = 'mydb';
$db_name = 'mydb';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// HTML Form
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname"><br><br>
    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname"><br><br>
    <label for="qualification">Qualification:</label>
    <input type="text" id="qualification" name="qualification"><br><br>
    <label for="speciality">Speciality:</label>
    <input type="text" id="speciality" name="speciality"><br><br>
    <label for="mobile">Mobile:</label>
    <input type="text" id="mobile" name="mobile"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <label for="notes">Notes:</label>
    <textarea id="notes" name="notes"></textarea><br><br>
    <input type="submit" value="Submit">
</form>

<?php
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $qualification = $_POST['qualification'];
    $speciality = $_POST['speciality'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $notes = $_POST['notes'];

    // Hash the password using password_hash()
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO doctors (fname, lname, qualification, speciality, mobile, email, password, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $fname, $lname, $qualification, $speciality, $mobile, $email, $hashed_password, $notes);
    $stmt->execute();

    echo "Doctor added successfully!";
}

// Close connection
$conn->close();
?>