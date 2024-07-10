<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'session_check.php';
require_once 'conn.php';

// Initialize variables
$unit_no = $name = $age = $sex = $mobile = $diagnosis = $doctor_id = $doctor_fname = $doctor_lname = $visit_date = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_doctor'])) {
    // Validate and sanitize inputs
    $unit_no = isset($_POST['unit_no']) ? mysqli_real_escape_string($conn, $_POST['unit_no']) : '';
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : '';
    $sex = isset($_POST['sex']) ? mysqli_real_escape_string($conn, $_POST['sex']) : '';
    $mobile = isset($_POST['mobile']) ? mysqli_real_escape_string($conn, $_POST['mobile']) : '';
    $diagnosis = isset($_POST['diagnosis']) ? mysqli_real_escape_string($conn, $_POST['diagnosis']) : '';
    $doctor_id = isset($_POST['doctor']) ? mysqli_real_escape_string($conn, $_POST['doctor']) : '';
    $visit_date = isset($_POST['visit_date']) ? mysqli_real_escape_string($conn, $_POST['visit_date']) : '';
    $created_at = isset($_POST['created_at']) ? mysqli_real_escape_string($conn, $_POST['created_at']) : '';
    // Fetch doctor's first and last names based on doctor_id
    $sql = "SELECT fname, lname FROM doctors WHERE doctor_id = '$doctor_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        $doctor_fname = $doctor['fname'];
        $doctor_lname = $doctor['lname'];
    } else {
        echo "Error: Doctor not found.";
        exit;
    }

    // Insert into database
    $sql = "INSERT INTO visits (name, unit_no, age, sex, mobile, diagnosis, doctor_id, doctor_fname, doctor_lname, visit_date) 
            VALUES ('$name', '$unit_no', '$age', '$sex', '$mobile', '$diagnosis', '$doctor_id', '$doctor_fname', '$doctor_lname', '$visit_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointmenrt created for Dr. $doctor_fname $doctor_lname, $doctor_id for $created_at";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
