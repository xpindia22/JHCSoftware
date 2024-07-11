<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from second form
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    $cc = $_POST['cc'];
    $hpi = $_POST['hpi'];
    $pmh = $_POST['pmh'];
    $obg = $_POST['obg'];
    $exam = $_POST['exam'];
    $treatment = $_POST['treatment'];
    $medicines = $_POST['medicines'];
    $lab = $_POST['lab'];
    $notes = $_POST['notes'];
    // Insert data into visits table
    $sql = "INSERT INTO visits (unit_no, name, age, sex, diagnosis, date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes)
            VALUES ('$unit_no', '$name', '$age', '$sex', '$diagnosis', '$date', '$cc', '$hpi', '$pmh', '$obg', '$exam', '$treatment', '$medicines', '$lab','$notes')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 
$conn->close();
?>