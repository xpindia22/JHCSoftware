<?php
require_once 'session_doctor.php';
require_once 'conn.php';

// Fetch doctor ID from session
$doctor_id = $_SESSION['doctor_id'];

// Fetch visits assigned to the logged-in doctor
$sql = "SELECT * FROM visits WHERE doctor_id = '$doctor_id' ORDER BY visit_date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Doctor Dashboard</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        background-color: #f2f2f2;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        background-color: #add8e6;
    }

    tr:nth-child(even) {
        background-color: #ddd;
    }
    .body-class {
        margin: 50px;
    }
</style>
</head>
<body class='body-class'>
<h2>Welcome, Dr. <?php echo $_SESSION['username']; ?></h2>
<h3>Assigned Consultations</h3>

<?php
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Unit No</th>
                <th>Name</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Mobile</th>
                <th>Diagnosis</th>
                <th>Visit Date</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['unit_no']}</td>
                <td>{$row['name']}</td>
                <td>{$row['age']}</td>
                <td>{$row['sex']}</td>
                <td>{$row['mobile']}</td>
                <td>{$row['diagnosis']}</td>
                <td>{$row['visit_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No consultations found.";
}

$conn->close();
?>

</body>
</html>
