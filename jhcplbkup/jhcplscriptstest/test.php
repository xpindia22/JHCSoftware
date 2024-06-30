<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Assuming you have form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$unit_no = $_POST['unit_no'];

// Insert into db1
$sql = "INSERT INTO db1 (unit_no, fname, lname) VALUES ('$unit_no', '$fname', '$lname')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully in db1";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Get the last inserted id
$last_id = $conn->insert_id;

// Insert into db2
$sql = "INSERT INTO db2 (id, fname, lname) VALUES ('$last_id', '$fname', '$lname')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully in db2";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
