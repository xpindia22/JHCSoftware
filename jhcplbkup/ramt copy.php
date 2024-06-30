<?php
//joins user_info and income ( source and amount columns)
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
        <tr>
            <th><a href="#" onclick="sortTable(0);">ID</a></th>
            <th><a href="#" onclick="sortTable(4);">Unit No</a></th>
            <th><a href="#" onclick="sortTable(6);">Date</a></th>
            <!-- Add other column headers here -->
    </tr>
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
//$sql = "SELECT * FROM user_info ORDER BY id";
$sql = "SELECT user_info.*, income.source, income.amount 
        FROM user_info 
        JOIN income ON user_info.id = income.patient_id
        ORDER BY user_info.unit_no;";

 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start table with CSS for borders
    echo "<table style='border-collapse: collapse; width: 100%;'>";

    // Print column headers
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Unit No</th><th>Diagnosis</th><th>Date</th><th>Mobile</th><th>Address</th><th>Notes<th>Source</th><th>Amount</th></tr>";

    while ($row = $result->fetch_assoc()) {
        // Start row
        echo "<tr style='border: 1px solid black;'>";
    
        // Print each column value with CSS for borders
        echo "<td style='border: 1px solid black;'>" . $row['id'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['name'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['age'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['sex'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['unit_no'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['diagnosis'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['date'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['mobile'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['address'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['notes'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['source'] . "</td>";
        echo "<td style='border: 1px solid black;'>" . $row['amount'] . "</td>";

        // End row
        echo "</tr>";
    }
    
    // End table
    echo "</table>";
}
?>
