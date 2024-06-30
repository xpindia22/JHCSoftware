<?php
require 'header-jhcpl.php';
require_once 'conn.php'; // connect to the database.

$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$mobile = $_POST['mobile'];
$designation = $_POST['designation'];
$date = $_POST['date'];
$address = $_POST['address'];
$notes = $_POST['notes'];
$salary = $_POST['salary'];
$leaves_allowed = $_POST['leaves_allowed'];
 
 

// Get the maximum unit_no from the table
$result = $conn->query("SELECT MAX(unit_no) AS max_unit_no FROM attendance");
$row = $result->fetch_assoc();
$unit_no = $row['max_unit_no'] + 1;  // Increment the unit_no

$sql = "INSERT INTO attendance (name, age, sex, mobile, unit_no, designation, date, address, notes, salary, leaves_allowed)
        VALUES ('$name', $age, '$sex', '$mobile', $unit_no, '$designation', '$date','$address','$notes','$salary','$leaves_allowed')";

if ($conn->query($sql) === TRUE) {
   echo "Data with Unit No: $unit_no saved successfully in Attendance!<br>";
   header('location: 003_regr.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
