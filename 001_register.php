<?php
// require 'css/style.css';
 

require_once 'pwd.php'; // connect to the database.
require 'header-jhcpl.php';
require_once 'conn.php'; // connect to the database.
// Start the session at the beginning of your script
// session_start();

// // Check if the user is logged in
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     // If not, redirect them to the login page
//     header('Location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <style>
        body {
            background-color: #f0f0f0; /* Change this to your preferred soothing color */
        }
        #userTable tr:nth-child(even) {
            background-color: #d0d0d0; /* Change this to your preferred even row color */
        }
        #userTable tr:nth-child(odd) {
            background-color: #ffffff; /* Change this to your preferred odd row color */
        }
        .body-class{
            margin: 50px;
        }
        input[type="text"]{
            color:blue;
        }
    </style>
 
</head>
<body class='body-class'>
 
    <h2>User Registration</h2>
    <form method="POST" action="002_regprocess.php">
    <table> 
    <tbody>
    
    <tr><td><label for="name">Name:</label></td>
    <td><input type="text" id="name" name="name" value='Ronaldo CR7'></td></tr>
    
    <tr><td><label for="name">Age:</label></td>
    <td> <input type="text" id="age" name="age" value='33'></td></tr>

    <tr><td><label for="name">Sex:</label></td>
    <td> <input type="text" id="sex" name="sex" value='Male'></td></tr>

    <tr><td><label for="diagnosis">Diagnosis:</label></td>
    <td><input type="text" id="diagnosis" name="diagnosis" value='NO ILLNESS'></td></tr>

    <tr><td><label for="date">Date:</label></td>
    <td><input type="date" id="date" name="date"></td></tr>

    <tr><td><label for="mobile">Mobile:</label></td>
    <td><input type="text" id="mobile" name="mobile" value='12345678'></td></tr>

    <tr><td><label for="address">Address:</label></td>
    <td><input type="text" id="address" name="address" value='Patient Address' ></td></tr>

    <tr><td> <label for="notes">Notes:</label></td>
    <td><input type="text" id="notes" name="notes" value='Patient Notes'></td></tr>

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
</body>
</html>

<?php if (!empty($error_message)) : ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>