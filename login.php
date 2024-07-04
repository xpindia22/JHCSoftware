<?php
// Connect to database
$conn = mysqli_connect("localhost", "mydb", "mydb", "mydb");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];
    $password = md5($_POST["password"]);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE userid = '$userid' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User authenticated, start session
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["userid"] = $userid;
        header("Location: protected_folder/index.php");
        exit;
    } else {
        echo "Invalid username or password";
    }
}

mysqli_close($conn);
?>

<!-- Login form -->
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="userid">Username:</label>
    <input type="text" id="userid" name="userid"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>