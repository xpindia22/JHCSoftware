<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sort by ID
$sql = "SELECT * FROM user_info ORDER BY id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start table with CSS for borders
    echo "<table style='border-collapse: collapse; width: 100%;'>";

    // Print column headers
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Unit No</th><th>Diagnosis</th><th>Date</th><th>Mobile</th><th>Address</th><th>Notes</th></tr>";

    while ($row = $result->fetch_assoc()) {
        // Start row
        echo "<tr style='border: 1px solid black;'>";

        // Print each column value with CSS for borders
        echo "<td style='border: 1px solid black;'>" . $row['id'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['name'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['age'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['sex'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['unit_no'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['diagnosis'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['date'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['mobile'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['address'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['notes'] . "</td>";

        // End row
        echo "</tr>";
    }

    // End table
    echo "</table>";
}
?>
