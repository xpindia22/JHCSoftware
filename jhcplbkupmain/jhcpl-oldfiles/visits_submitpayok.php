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
    
    $name = $_POST['name'];
    $unit_no = $_POST['unit_no'];
    $billid = $_POST['billid'];
    $date = $_POST['date'];
    $consultation = $_POST['consultation'];
    $ecg = $_POST['ecg'];
    $echo = $_POST['echo'];
    $medicines = $_POST['medicines'];
    $lab = $_POST['lab'];
    $others = $_POST['others'];
    $concession = $_POST['concession'];
    $lab = $_POST['lab'];
    //$total = $_POST['total'];
    $total = floatval($consultation) + floatval($ecg) + floatval($echo) + floatval($medicines) + floatval($lab) + floatval($others) - floatval($concession);
 
    
    // Insert data into visits table
    $sql = "INSERT INTO payments ( unit_no, name,  billid,date, consultation, ecg, echo, medicines, lab, others, concession, total)
            VALUES ('$unit_no', '$name', '$billid','$date', '$consultation', '$ecg', '$echo', '$medicines', '$lab', '$others', '$concession', '$total')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 
$conn->close();
?>