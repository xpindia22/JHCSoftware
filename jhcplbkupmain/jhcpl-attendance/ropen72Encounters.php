<?php
require 'header-jhcpl.php';
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

//Fetch all pid and fname from patient_data table
// $sql = "SELECT pid, fname FROM patient_data";
// $result = $conn->query($sql);
//Fetch all pid and fname from patient_data table where an encounter exists
$sql = "SELECT patient_data.pid, patient_data.fname 
        FROM patient_data 
        INNER JOIN form_clinical_notes ON patient_data.pid = form_clinical_notes.pid 
        WHERE form_clinical_notes.encounter IS NOT NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sort Patient Info</title>
    <style>
        body {
            background-color: #f0f0f0;
        }
        #userTable tr:nth-child(even) {
            background-color: #d0d0d0;
        }
        #userTable tr:nth-child(odd) {
            background-color: #ffffff;
        }
        .body-class{
            margin: 50px;
        }
        table{
            text-align: left;
        }
    </style>
    <script type="text/javascript">
        function fetchPatientInfo(pid) {
            // Use AJAX to fetch encounters and descriptions for the selected pid
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_patient_info.php?pid=' + pid, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    // Update the patientInfo div with the fetched data
                    document.getElementById('patientInfo').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }
    </script>
</head>
<body class='body-class'>
 
<!-- Create a dropdown menu with pid and fname -->
<select id="patientSelect" onchange="fetchPatientInfo(this.value)">
    <?php while ($row = $result->fetch_assoc()): ?>
        <option value="<?php echo $row['pid']; ?>">
            <?php echo $row['pid'] . ' - ' . $row['fname']; ?>
        </option>
    <?php endwhile; ?>
</select>

<!-- Placeholder for encounters and descriptions -->
<div id="patientInfo"></div>

</body>
</html>
