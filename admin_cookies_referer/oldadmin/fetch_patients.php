<?php
require_once 'conn.php';

if (isset($_POST['doctor_id'])) {
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);

    // Fetch patients assigned to the selected doctor
    $sql = "SELECT id, name, unit_no, age, sex, mobile, diagnosis, date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes, address, created_at, visit_date
            FROM visits
            WHERE doctor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>
                <thead>
                    <tr>
                        <th>Visit ID</th>
                        <th>Name</th>
                        <th>Unit No</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Mobile</th>
                        <th>Diagnosis</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['unit_no']) . "</td>
                    <td>" . htmlspecialchars($row['age']) . "</td>
                    <td>" . htmlspecialchars($row['sex']) . "</td>
                    <td>" . htmlspecialchars($row['mobile']) . "</td>
                    <td>" . htmlspecialchars($row['diagnosis']) . "</td>
                    <td>" . htmlspecialchars($row['date']) . "</td>
                    <td>
                        <a href='edit_visit.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a>
                        <a href='delete_visit.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                    </td>
                </tr>";
        }
        echo "</tbody>
            </table>";
    } else {
        echo "<p>No patients found.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
