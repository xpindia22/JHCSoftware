<?php
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get doctor's information from the registration form
  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $notes = $_POST['notes'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security reasons

  // Insert the doctor's information into the doctors table
  $sql = "INSERT INTO doctors (username, fname, lname, email, mobile, notes, password) VALUES ('$username', '$fname', '$lname', '$email', '$mobile', '$notes', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "New doctor registered successfully";
  } else {
    echo "Error: ". $sql. "<br>". $conn->error;
  }

  // Close the connection
  $conn->close();
}
?>

<!-- Registration form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <label for="username">Username:</label><br>
  <input type="text" id="username" name="username" required><br>
  <label for="fname">First Name:</label><br>
  <input type="text" id="fname" name="fname" required><br>
  <label for="lname">Last Name:</label><br>
  <input type="text" id="lname" name="lname" required><br>
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" required><br>
  <label for="mobile">Mobile:</label><br>
  <input type="tel" id="mobile" name="mobile" required><br>
  <label for="notes">Notes:</label><br>
  <textarea id="notes" name="notes"></textarea><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" required><br>
  <input type="submit" value="Register">
</form>