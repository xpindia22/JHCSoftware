<?php
//require 'css/style.css';
 

// require_once 'pwd.php'; // connect to the database.
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
    <title>Employee Registration Form</title>
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
 
    <h2>Medicine List</h2>
    <form method="POST" action="002_medicineRegprocess.php">
    <table> 
    <tbody>
    
    <tr><td><label for="med_generic">Generic Name:</label></td>
    <td><input type="text" id="med_generic" name="med_generic" value='Generic Name'></td></tr>
    <br>
    <tr><td><label for="med_trade">Trade name:</label></td>
    <td> <input type="text" id="med_trade" name="med_trade" value='Trade Name'></td></tr>

     <br>
    <tr><td><label for="price_onetab">Price One Tab:</label></td>
    <td><input type="number" id="price_onetab" name="price_onetab" value='1'></td></tr>
    <br>
    <tr><td> <label for="notes">Notes:</label></td>
    <td><input type="text" id="notes" name="notes" value='Notes'></td></tr>

    </tbody>
    </table>
    <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php if (!empty($error_message)) : ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>