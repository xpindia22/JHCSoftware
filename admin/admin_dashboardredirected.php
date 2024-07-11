<?php
session_start();
require_once 'session_check_admin.php'; // This file checks if the admin is logged in and fetches admin session details
require_once 'conn.php';

// Fetch all doctors
$sql = "SELECT doctor_id, fname, lname FROM doctors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Select a doctor to view their dashboard</h2>
    <form method='post' action='view_doctor_dashboard.php'>
        <select name='doctor_id'>
        <option value=''>Select doctor</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='".$row['doctor_id']."'>".$row['fname']." ".$row['lname']."</option>";
    }
    echo "</select>
        <input type='submit' value='View Dashboard'>
    </form>";
} else {
    echo "No doctors found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
</body>
</html>
