<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search criteria from form
$id = $_GET['id'];
$name = $_GET['name'];
$age = $_GET['age'];
$sex = $_GET['sex'];
$unit_no = $_GET['unit_no'];
$diagnosis = $_GET['diagnosis'];
$date = $_GET['date'];
$mobile = $_GET['mobile'];
$address = $_GET['address'];
$notes = $_GET['notes'];
// Construct the SQL query dynamically based on user input
$sql = "SELECT * FROM user_info WHERE 1=1"; // Start with a true condition

if (!empty($id)) {
    $sql .= " AND id = '$id'";
}
if (!empty($name)) {
    $sql .= " AND name LIKE '%$name%'";
}
// Repeat similar conditions for other columns...

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display search results (customize as needed)
        echo "ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['name'] . "<br>";
        // Repeat for other columns...
        echo "<hr>";
    }
} else {
    echo "No matching records found.";
}

$conn->close();
?>
