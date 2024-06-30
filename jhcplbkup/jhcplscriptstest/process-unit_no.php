<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$diagnosis = $_POST['diagnosis'];
$date = $_POST['date'];
$mobile = $_POST['mobile'];
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

$sql = "INSERT INTO user_info (name, age, sex, unit_no, diagnosis, date, mobile, address, notes, consultation, ecg, echo,medicines,lab)
        VALUES ('$name', $age, '$sex', $unit_no, '$diagnosis', '$date','$mobile','$address','$notes','$consultation','$ecg','$echo','$medicines','$lab')";

if ($conn->query($sql) === TRUE) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
