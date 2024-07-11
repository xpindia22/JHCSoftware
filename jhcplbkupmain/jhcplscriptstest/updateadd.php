<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['field'], $_POST['data'],  $_POST['date'],$_POST['id'])) {
    // Get the user input
    $field = $_POST['field'];
    $data = $_POST['data'];
    $id = $_POST['date'];
    $id = $_POST['id'];
    

    // Prepare a dynamic SQL query
    $sql = "UPDATE user_info SET $field = CONCAT($field, '$data') WHERE id = $id;";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!-- Create a form to get the user input -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br>Field name: <input type="text" name="field"><br><br>
    New data: <input type="text" name="data"><br><br>
    Date: <input type="date" name="date"><br><br>
    ID: <input type="number" name="id"><br><br>
    
    <input type="submit" name="submit" value="Update">
</form>
