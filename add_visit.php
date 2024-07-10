<?php
require_once 'session_check.php';
require_once 'conn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'session_check.php';
require_once 'conn.php';

// Initialize variables
$unit_no = $name = $age = $sex = $mobile = $diagnosis = $doctor_id = $visit_date = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['select_doctor'])) {
        // Validate and sanitize inputs
        $unit_no = mysqli_real_escape_string($conn, $_POST['unit_no']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $sex = mysqli_real_escape_string($conn, $_POST['sex']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $diagnosis = mysqli_real_escape_string($conn, $_POST['diagnosis']);
        $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor']);
        $visit_date = mysqli_real_escape_string($conn, $_POST['visit_date']);

        // Insert into database
        $sql = "INSERT INTO visits (name, unit_no, age, sex, mobile, diagnosis, doctor_id, visit_date) 
                VALUES ('$name', '$unit_no', '$age', '$sex', '$mobile', '$diagnosis', '$doctor_id', '$visit_date')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>
