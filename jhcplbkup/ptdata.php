<!-- ptdata.php -->

<?php
$servername = "localhost"; // Change this to your MySQL server address
$username = "jhcpl"; // Your MySQL username
$password = "jhcpl"; // Your MySQL password
$dbname = "jhcpl"; // Your database name

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have form fields with appropriate names (e.g., 'first_name', 'last_name', etc.)
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
// ... (similarly for other fields)

// Insert data into the "ptinfo" table
$sql = "INSERT INTO ptinfo (`First Name`, `Last Name`, `DOB`, `Age`, `Sex`, `Mobile`, `Address`, `Chief Complaint`, `HPI`, `Examination`, `Diagnosis`, `Treatment`, `Investigations`, `ECG`, `ECHO`, `Billing`)
        VALUES ('$first_name', '$last_name', '2024-03-01', 30, 'Male', '1234567890', 'Sample Address', 'Sample Complaint', 'Sample HPI', 'Sample Examination', 'Sample Diagnosis', 'Sample Treatment', 'Sample Investigations', 'Sample ECG', 'Sample ECHO', 100.50)";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Patient Data Form</title>
</head>
<body>
    <form action="ptdata.php" method="post">
        <!-- Add input fields for other columns -->
        First Name: <input type="text" name="first_name"><br>
        Last Name: <input type="text" name="last_name"><br>
        <!-- ... (similarly for other fields) -->
        <input type="submit" value="Submit">
    </form>
</body>
</html>
