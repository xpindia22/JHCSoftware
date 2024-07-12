<?php
session_start();
require_once '../config/conn.php'; // connect to the database.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT doctor_id, fname, lname, password FROM doctors WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        if (password_verify($password, $doctor['password'])) {
            $_SESSION['doctor_id'] = $doctor['doctor_id'];
            $_SESSION['doctor_fname'] = $doctor['fname'];
            $_SESSION['doctor_lname'] = $doctor['lname'];
            header("Location: 005_doctor_dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Doctor Login</title>
</head>
<body>
<h2>Doctor Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
</body>
</html>
