<?php
//This file will push the form data into the mysql database.
// - git push origin bkup:main

require '../header-jhcpl.php';//Header logo file
require_once '../config/conn.php'; // connect to the database.

$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$mobile = $_POST['mobile'];
$diagnosis = $_POST['diagnosis'];
$date = $_POST['date'];
$address = $_POST['address'];
$notes = $_POST['notes'];
$consultation = $_POST['consultation'];
$ecg = $_POST['ecg'];
$echo = $_POST['echo'];
$medicines = $_POST['medicines'];
$lab = $_POST['lab'];

// Get the maximum unit_no from the table
$result = $conn->query("SELECT MAX(unit_no) AS max_unit_no FROM user_info");
$row = $result->fetch_assoc();
$unit_no = $row['max_unit_no'] + 1;  // Increment the unit_no

$sql = "INSERT INTO user_info (name, age, sex, mobile, unit_no, diagnosis, date, address, notes, consultation, ecg, echo,medicines,lab)
        VALUES ('$name', $age, '$sex', '$mobile', $unit_no, '$diagnosis', '$date','$address','$notes','$consultation','$ecg','$echo','$medicines','$lab')";

if ($conn->query($sql) === TRUE) {
   echo "Data with Unit No: $unit_no saved successfully in User_Info!<br>";
   header('location: 003_regr.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
