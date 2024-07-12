<?php
<<<<<<< HEAD
require_once 'conn.php';
=======
require_once './config/conn.php'; // connect to the database.
>>>>>>> work

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    
    $sql = "SELECT * FROM visits WHERE doctor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Patients List</h2>
        <table>
        <tr>
          <th>Visit ID</th>
          <th>Name</th>
          <th>Unit No</th>
          <th>Age</th>
          <th>Sex</th>
          <th>Mobile</th>
          <th>Diagnosis</th>
          <th>Date</th>
        </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["unit_no"] . "</td>
            <td>" . $row["age"] . "</td>
            <td>" . $row["sex"] . "</td>
            <td>" . $row["mobile"] . "</td>
            <td>" . $row["diagnosis"] . "</td>
            <td>" . $row["date"] . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "No patients found for the selected doctor.";
    }

    $stmt->close();
}
$conn->close();
?>
