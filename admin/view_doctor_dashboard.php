<?php
session_start();
require_once 'session_check_admin.php'; // This file checks if the admin is logged in and fetches admin session details
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['doctor_id'])) {
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);

    // Fetch the selected doctor's details
    $sql = "SELECT doctor_id, fname, lname FROM doctors WHERE doctor_id = '$doctor_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        $_SESSION['doctor_id'] = $doctor['doctor_id'];
        $_SESSION['doctor_fname'] = $doctor['fname'];
        $_SESSION['doctor_lname'] = $doctor['lname'];
        header("Location: 005_doctor_dashboard.php");
        exit();
    } else {
        echo "Doctor not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
