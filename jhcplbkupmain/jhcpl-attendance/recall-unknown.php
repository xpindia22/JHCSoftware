
<?php
// Database connection parameters
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM attendance");
    $stmt->execute();

    // Fetch all column names
    $column_names = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

    // Execute the statement again to reset the cursor
    $stmt->execute();

    // Fetch all rows
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        foreach ($column_names as $name) {
            echo $name . ": " . $row[$name] . "<br>";
        }
        echo "<hr>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
