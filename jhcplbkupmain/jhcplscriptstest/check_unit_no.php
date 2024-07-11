<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$unit_no = $_POST['unit_no'];

$stmt = $conn->prepare("SELECT * FROM user_info WHERE unit_no = ?");
$stmt->bind_param("s", $unit_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo 'exists';
}

$conn->close();
?>
