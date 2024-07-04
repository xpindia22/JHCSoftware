<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (fname, lname, userid, password, email, mobile_no, notes) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sssssss", $fname, $lname, $username, $password_hash, $email, $mobile_no, $notes);
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $mobile_no = $_POST["mobile_no"];
            $notes = $_POST["notes"];
            $stmt->execute();
            $stmt->close();
            header("Location: login.php");
            exit;
        }
    }
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname"><br><br>
    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname"><br><br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="mobile_no">Mobile No:</label>
    <input type="text" id="mobile_no" name="mobile_no"><br><br>
    <label for="notes">Notes:</label>
    <textarea id="notes" name="notes"></textarea><br><br>
    <input type="submit" value="Register">
</form>