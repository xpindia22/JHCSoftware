<?php
require_once '../config/session_user.php';
require_once '../config/conn.php'; // Connect to the database.

// Get the selected doctor ID from the form
$doctor_id = isset($_POST['doctor']) ? mysqli_real_escape_string($conn, $_POST['doctor']) : '';
$unit_no = mysqli_real_escape_string($conn, $_POST['unit_no']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$sex = mysqli_real_escape_string($conn, $_POST['sex']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$diagnosis = mysqli_real_escape_string($conn, $_POST['diagnosis']);
$date = mysqli_real_escape_string($conn, $_POST['date']);

// Check if the doctor exists and has the "Doctor" role
$sql = "SELECT userid, username FROM users WHERE userid = '$doctor_id' AND FIND_IN_SET('Doctor', role)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $doctor = $result->fetch_assoc();
    
    // Insert visit into the database
    // Ensure the column names match your 'visits' table schema
    $sql = "INSERT INTO visits (unit_no, name, age, sex, mobile, diagnosis, doctor_username, visit_date) 
            VALUES ('$unit_no', '$name', '$age', '$sex', '$mobile', '$diagnosis', '{$doctor['username']}', '$date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Visit recorded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Doctor not found or user is not assigned as a Doctor.";
}

$conn->close();
?>
