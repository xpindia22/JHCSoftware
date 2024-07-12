<?php
session_start();
require_once '../config/session_admin.php'; // Include session check for admin
// require_once '../config/session_doctor.php'; // Include session check for admin
require_once '../config/conn.php'; // connect to the database.

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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group select, .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
                            echo "<option value='" . $row['doctor_id'] . "'>" . $row['fname'] . " " . $row['lname'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </form>
        <div id="patient_list">
            <!-- Patient list will be displayed here -->
        </div>
    </div>
</body>
</html>
