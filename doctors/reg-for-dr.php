
<?php
require_once 'session_doctor.php';
// require 'header-jhcpl.php';
require_once 'conn.php';
 
// rest of the PHP code
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sort Patient Info</title>
    <style>
        body {
            background-color: #f0f0f0; /* Change this to your preferred soothing color */
        }
        #userTable tr:nth-child(even) {
            background-color: #d0d0d0; /* Change this to your preferred even row color */
        }
        #userTable tr:nth-child(odd) {
            background-color: #ffffff; /* Change this to your preferred odd row color */
        }
        .body-class{
            margin: 50px;
        }
    </style>
    <script type="text/javascript">
        // Your existing JavaScript code...
    </script>
    <script type="text/javascript">
        function sortTable(column) {
            var table = document.getElementById("userTable");
            var rows = Array.from(table.getElementsByTagName("tr"));
            var headerRow = rows.shift(); // Remove header row

            rows.sort(function(a, b) {
                var aValue = a.cells[column].textContent;
                var bValue = b.cells[column].textContent;
                return aValue.localeCompare(bValue);
            });

            // Reverse the order if already sorted in ascending
            if (table.getAttribute("data-sorted") === column.toString()) {
                rows.reverse();
                table.removeAttribute("data-sorted");
            } else {
                table.setAttribute("data-sorted", column.toString());
            }

            // Re-insert rows into the table
            table.innerHTML = "";
            table.appendChild(headerRow);
            rows.forEach(function(row) {
                table.appendChild(row);
            });
        }
    </script>
</head>
<body class='body-class'>
 
<?php
 
// Sort by ID
// $sql = "SELECT * FROM visits ORDER BY doctor_id DESC";
$sql = "SELECT * FROM visits where doctor_id =2";

$result = $conn->query($sql);

$grand_total_consultation = 0;
$grand_total_ecg = 0;
$grand_total_echo = 0;
$grand_total_medicines = 0;
$grand_total_lab = 0;
$grand_total = 0;

if ($result->num_rows > 0) {
    // Start table with CSS for borders
    echo "<table style='border-collapse: collapse; width: 100%;'>";

    // Print column headers
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Unit No</th><th>Diagnosis</th><th>Date</th><th>Mobile</th><th>Address</th><th>Notes<th>Consultation</th><th>ECG</th><th>ECHO</th><th>MEDICINES</th><th>LAB</th><th>Total</th></tr>";

    while ($row = $result->fetch_assoc()) {
 

        // Start row
        echo "<tr style='border: 1px solid black;'>";
    
        // Print each column value with CSS for borders

        echo "<td style='border: 1px solid black;'>" . $row['id'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['name'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['age'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['sex'] . "</td>";
        echo " <td><a href='004_createconsultation.php?id=".$row["unit_no"]."'>".$row["unit_no"]."</a></td>";

        echo "<td style='border: 1px solid black;'>" . $row['diagnosis'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['date'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['mobile'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['address'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['notes'] . "</td>";
 
    

        // End row
        echo "</tr>";
    }

    // // Print grand totals row
    // echo "<tr style='border: 1px solid black;'>";
    // echo "<td colspan='10' style='border: 1px solid black;'><b>Grand Total</b></td>";
    // echo "<td style='border: 1px solid black;'>" . $grand_total_consultation . "</td>";
    // echo "<td style='border: 1px solid black;'>" . $grand_total_ecg . "</td>";
    // echo "<td style='border: 1px solid black;'>" . $grand_total_echo . "</td>";
    // echo "<td style='border: 1px solid black;'>" . $grand_total_medicines . "</td>";
    // echo "<td style='border: 1px solid black;'>" . $grand_total_lab . "</td>";
    // echo "<td style='border: 1px solid black;'>" . $grand_total . "</td>"; // Print grand total
    // echo "</tr>";
    
    // End table
    echo "</table>";

 
}
?>
