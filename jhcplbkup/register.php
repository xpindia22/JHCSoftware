<?php
$host = "localhost";
$user = "jhcpl";
$password = "jhcpl";
$db = "jhcpl";

// Create connection
$conn = new mysqli($host, $user, $password, $db);
print_r ($_POST);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into admin table
    $sql = "INSERT INTO admin (name, password) VALUES ('$name', '$hashed_password')";

    try {
        if ($conn->query($sql) === TRUE) {
            echo "Data saved successfully!<br>";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "<br><br>Username already exists.<br><br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
    <form action="" method="POST">
        <label for="name">Enter Name:</label>
        <input type="text" id="name" name="name" required><br> 
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Register User">
    </form>
</body>
</html>
