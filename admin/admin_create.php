<?php
require_once 'conn.php';

// Initialize variables
$username = $password = "";
$username_err = $password_err = $success_msg = $error_msg = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $success_msg = "Admin user created successfully.";
            } else {
                $error_msg = "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Admin User</title>
    <style>
        .container {
            width: 300px;
            margin: 0 auto;
            padding-top: 50px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
        }
        .form-group .error {
            color: red;
            font-size: 0.9em;
        }
        .form-group .success {
            color: green;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Admin User</h2>
        <p>Please fill this form to create an admin account.</p>
        <?php 
        if (!empty($success_msg)) {
            echo '<div class="form-group success">' . $success_msg . '</div>';
        } elseif (!empty($error_msg)) {
            echo '<div class="form-group error">' . $error_msg . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span class="error"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </form>
    </div>    
</body>
</html>
