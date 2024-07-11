<?php
require_once 'login.php'; // connect to the database.
require 'header-jhcpl.php';
require_once 'conn.php'; // connect to the database.

// Start the session
session_start();

// Check if the form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Validate the username and password
  // ...

  // If valid, set the session variable and redirect
  if ($isValid) {
    $_SESSION['username'] = $username;
    header('Location: login-reg.php');
    echo '
 
 
    <h2>User Registration</h2>
    <form method="POST" action="002_regprocess.php">
    <table> 
    <tbody>
    
    // <tr><td><label for="name">Name:</label></td>
    // <td><input type="text" id="name" name="name" ></td></tr>
    
    <tr><td><label for="name">Age:</label></td>
    <td> <input type="text" id="age" name="age"</td></tr>

    <tr><td><label for="name">Sex:</label></td>
    <td> <input type="text" id="sex" name="sex"></td></tr>

    <tr><td><label for="diagnosis">Diagnosis:</label></td>
    <td><input type="text" id="diagnosis" name="diagnosis"></td></tr>

    <tr><td><label for="date">Date:</label></td>
    <td><input type="date" id="date" name="date"></td></tr>

    <tr><td><label for="mobile">Mobile:</label></td>
    <td><input type="text" id="mobile" name="mobile"></td></tr>

    <tr><td><label for="address">Address:</label></td>
    <td><input type="text" id="address" name="address"  ></td></tr>

    <tr><td> <label for="notes">Notes:</label></td>
    <td><input type="text" id="notes" name="notes" ></td></tr>

    <tr><td><label for="consultation">Consultation:</label></td>
    <td><input type="number" id="consultation" name="consultation" value="500" ></td></tr>

    <tr><td><label for="ecg">ECG:</label></td>
    <td><input type="number" id="ecg" name="ecg" value="500" ></td></tr>

    <tr><td><label for="echo">ECHO:</label></td>
    <td><input type="number" id="echo" name="echo" value="3000" ></td></tr>

    <tr><td><label for="medicines">Medicines:</label></td>
    <td><input type="number" id="medicines" name="medicines" value="2000"></td></tr>

    <tr><td> <label for="lab">Lab:</label></td>
    <td><input type="number" id="lab" name="lab" value="3000"></td></tr>


    </tbody>
    </table>
    <input type="submit" value="Submit">
    </form>
 
    ';
    exit();
  }
}
 
?>


