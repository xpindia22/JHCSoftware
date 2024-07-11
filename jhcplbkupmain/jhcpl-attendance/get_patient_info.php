<?php
// require 'header-jhcpl.php';
$host = "localhost";
$user = "jhcpl";
$pwd = "jhcpl";
$db = "open72";

// Create connection
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if 'pid' is set in $_GET
if (!isset($_GET['pid'])) {
  echo "No PID provided";
  exit;
}

$pid = $_GET['pid'];

$sql = "SELECT encounter, description , date FROM form_clinical_notes WHERE pid = $pid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start table with CSS for borders
    echo "<table style='border-collapse: collapse; width: 100%;'>";

    // Print column headers
    echo "<tr>
    <th>Encounter</th>
    <th>Date</th>
    <th>Description</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        // Start row
        echo "<tr style='border: 1px solid black;'>";
    
        // Print each column value with CSS for borders
        echo "<td style='border: 1px solid black;'>" . $row['encounter'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['date'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['description'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found for selected PID";
}
?>
