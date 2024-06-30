<?php
//payments are added to index .php itself into user_info table
require 'authenticate.php';
session_start();

$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['username'], $_POST['password'])) {
    // Prepare a select statement
    $stmt = $conn->prepare("SELECT password FROM Users WHERE username = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();
    if (password_verify($_POST['password'], $password)) {
        // If the credentials are correct, start a new session
        $_SESSION['loggedin'] = true;
        header('Location: ' . htmlspecialchars($_SERVER['PHP_SELF']));
        exit;
    } else {
        // If the credentials are wrong, show an error message
        $error = 'Incorrect username or password!';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sort Patient Info</title>
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
<body>
    <table id="userTable">

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
    echo "<tr><th>ID</th><th>Name</th><th>Unit No</th><th>Date</th><th>Notes</th><th>Consultation</th><th>ECG</th><th>ECHO</th><th>MEDICINES</th><th>LAB</th><th>Total</th></tr>";

    while ($row = $result->fetch_assoc()) {
        // Calculate row-wise total
        $row_total = $row['consultation'] + $row['ecg'] + $row['echo'] + $row['medicines'] + $row['lab'];

        // Add to grand totals
        $grand_total_consultation += $row['consultation'];
        $grand_total_ecg += $row['ecg'];
        $grand_total_echo += $row['echo'];
        $grand_total_medicines += $row['medicines'];
        $grand_total_lab += $row['lab'];
        $grand_total += $row_total;

        // Start row
        echo "<tr style='border: 1px solid black;'>";
    
        // Print each column value with CSS for borders
        echo "<td style='border: 1px solid black;'>" . $row['id'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['name'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['unit_no'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['date'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['notes'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['consultation'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['ecg'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['echo'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['medicines'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['lab'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row_total . "</td>"; // Print row-wise total

        // End row
        echo "</tr>";
    }

    // Print grand totals row
    echo "<tr style='border: 1px solid black;'>";
    echo "<td colspan='4' style='border: 1px solid black;'>Grand Totals</td>";
    echo "<td style='border: 1px solid black;'></td>";
    echo "<td style='border: 1px solid black;'>" . $grand_total_consultation . "</td>";
    echo "<td style='border: 1px solid black;'>" . $grand_total_ecg . "</td>";
    echo "<td style='border: 1px solid black;'>" . $grand_total_echo . "</td>";
    echo "<td style='border: 1px solid black;'>" . $grand_total_medicines . "</td>";
    echo "<td style='border: 1px solid black;'>" . $grand_total_lab . "</td>";
    echo "<td style='border: 1px solid black;'>" . $grand_total . "</td>"; // Print grand total
    echo "</tr>";
    
    // End table
    echo "</table>";
}

?>
