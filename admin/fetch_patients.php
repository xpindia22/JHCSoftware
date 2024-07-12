<?php
require_once '../config/session_admin.php'; // Include session check for admin
require_once '../config/conn.php'; // connect to the database.
if (isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];

    $sql = "SELECT * FROM visits WHERE doctor_id = '$doctor_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Visit ID</th>
                    <th>Name</th>
                    <th>Unit No</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Mobile</th>
                    <th>Diagnosis</th>
                    <th>Date</th>
                    <th>CC</th>
                    <th>HPI</th>
                    <th>PMH</th>
                    <th>OBG</th>
                    <th>Exam</th>
                    <th>Medicines</th>
                    <th>Lab</th>
                    <th>Notes</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Visit Date</th>
                    <th>Actions</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['unit_no'] . "</td>
                    <td>" . $row['age'] . "</td>
                    <td>" . $row['sex'] . "</td>
                    <td>" . $row['mobile'] . "</td>
                    <td>" . $row['diagnosis'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['cc'] . "</td>
                    <td>" . $row['hpi'] . "</td>
                    <td>" . $row['pmh'] . "</td>
                    <td>" . $row['obg'] . "</td>
                    <td>" . $row['exam'] . "</td>
                    <td>" . $row['medicines'] . "</td>
                    <td>" . $row['lab'] . "</td>
                    <td>" . $row['notes'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                    <td>" . $row['visit_date'] . "</td>
                    <td>
                        <a href='edit_visit.php?id=" . $row['id'] . "'>Edit</a> |
                        <a href='delete_visit.php?id=" . $row['id'] . "'>Delete</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No visits found for this doctor.";
    }
} else {
    echo "No doctor selected.";
}
?>
