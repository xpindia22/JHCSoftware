<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->close();
?>

<!-- Your existing HTML code goes here... -->

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
    </style>
    <script type="text/javascript">
        // Your existing JavaScript code...
    </script>
</head>
<body>
    <h1>User Registration</h1>
    <form method="POST" action="process.php">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id"  style="margin-left: 68px;"><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value='Patient' required style="margin-left: 48px;"><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required style="margin-left: 58px;"><br><br>

        <label for="sex">Sex:</label>
        <input type="radio" id="male" name="sex" value="Male" >
        <label for="male">Male</label>
        <input type="radio" id="female" name="sex" value="Female">
        <label for="female">Female</label><br><br>

        <label for="unit_no">Unit No:</label>
        <input type="text" id="unit_no" name="unit_no"  style="margin-left: 38px;"><br><br>

        <label for="diagnosis">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis" value='Patient Diagnosis' required style="margin-left: 48px;"><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required style="margin-left: 58px;"><br><br>

        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" value="0000000000" required style="margin-left: 48px;"><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value='Patient Address'required style="margin-left: 48px;"><br><br>

        <label for="notes">Notes:</label>
        <input type="text" id="notes" name="notes" value='Patient Notes' required style="margin-left: 48px;"><br><br>

        <label for="consultation">Consultation:</label>
        <input type="number" id="consultation" name="consultation" value="500" required style="margin-left: 48px;"><br><br>

        <label for="ecg">ECG:</label>
        <input type="number" id="ecg" name="ecg" value="500" required style="margin-left: 48px;"><br><br>

        <label for="echo">ECHO:</label>
        <input type="number" id="echo" name="echo" value="3000" required style="margin-left: 48px;"><br><br>

        <label for="medicines">Medicines:</label>
        <input type="number" id="medicines" name="medicines" value="0" required style="margin-left: 48px;"><br><br>

        <label for="lab">Lab:</label>
        <input type="number" id="lab" name="lab" value="0" required style="margin-left: 48px;"><br><br>
 
        <input type="submit" value="Submit">
    </form>
</body>
</html>


<?php if (!empty($error_message)) : ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>
