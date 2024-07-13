<?php
// admin_dashboard.php

require_once '../config/conn.php'; // connect to the database.

// Query to get visit details
$sql = "SELECT id, name, doctor_fname, doctor_lname, visit_date FROM visits";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Visit ID</th><th>Patient Name</th><th>Doctor Name</th><th>Visit Date</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='details.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["doctor_fname"] . " " . $row["doctor_lname"] . "</td>";
        echo "<td>" . $row["visit_date"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
