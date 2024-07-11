<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['name'] . "<br>";
        echo "Age: " . $row['age'] . "<br>";
        echo "Sex: " . $row['sex'] . "<br>";
        echo "Unit No: " . $row['unit_no'] . "<br>";
        echo "Diagnosis: " . $row['diagnosis'] . "<br>";
        echo "Mobile: " . $row['mobile'] . "<br>";
        echo "Address: " . $row['address'] . "<br>";
        echo "Notes: " . $row['notes'] . "<br>";
        echo "Date: " . $row['date'] . "<br><br>";}
    }
    ?>