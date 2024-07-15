<?php
require_once 'session_admin.php'; // Include session check for admin
require_once 'conn.php';

// Fetch all doctors
$sql = "SELECT doctor_id, fname, lname FROM doctors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 50px;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f2f2f2;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #ddd;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
        }
        .form-group select, .form-group input {
            width: 100%;
            padding: 8px;
        }
        .form-group .error {
            color: red;
            font-size: 0.9em;
        }
        .form-group .success {
            color: green;
            font-size: 0.9em;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#doctor_select').change(function() {
                var doctor_id = $(this).val();
                if (doctor_id) {
                    $.ajax({
                        type: 'POST',
                        url: 'fetch_patients.php',
                        data: {doctor_id: doctor_id},
                        success: function(response) {
                            $('#patient_list').html(response);
                        }
                    });
                } else {
                    $('#patient_list').html('');
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="doctor_select">Select Doctor</label>
                <select id="doctor_select" name="doctor_id">
                    <option value="">Select a doctor</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['doctor_id']) . "'>" . htmlspecialchars($row['fname'] . " " . $row['lname']) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </form>
        <div id="patient_list">
            <!-- Patient list will be displayed here -->
        </div>
        <a href="logout_admin.php">Logout</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>

<a href="logout_admin.php">Logout</a>
