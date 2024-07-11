<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$unit_no = $_POST['unit_no'];
$diagnosis = $_POST['diagnosis'];
$date = $_POST['date'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$notes = $_POST['notes'];
$sql = "INSERT INTO user_info (name, age, sex, unit_no, diagnosis, date, mobile, address, notes)
        VALUES ('$name', $age, '$sex', '$unit_no', '$diagnosis', '$date','$mobile','$address','$notes')";

if ($conn->query($sql) === TRUE) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
