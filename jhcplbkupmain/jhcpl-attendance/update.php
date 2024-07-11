<?php
// update.php
$host = "localhost";
$user = "jhcpl";
$pwd = "jhcpl";
$db = "jhcpl";
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null; // Get the ID from the URL

if ($id) {
    // Fetch the record from the database
    $stmt = $conn->prepare("SELECT * FROM test WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update the record
        $name = $_POST['name'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        
        $updateStmt = $conn->prepare("UPDATE test SET name = ?, age = ?, sex = ? WHERE id = ?");
        $updateStmt->bind_param("sssi", $name, $age, $sex, $id);
        $updateStmt->execute();
        
        if ($updateStmt->affected_rows > 0) {
            //echo "Record updated successfully";
                    //display results from database...
        $sql = "SELECT * FROM test";
        $result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Hostname</th></tr>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["age"]. "</td><td>" . $row["sex"]. "</td><td>" . $row["hostname"]. "</td></tr>";
    }
    
    echo "</table>";
} else {
    echo "0 results";
}
 ... PHP and HTML above ...

 if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Hostname</th></tr>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td><a href='update.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>
        <td>" . $row["name"] . "</td>
        <td>" . $row["age"] . "</td>
        <td>" . $row["sex"] . "</td>
        <td>" . $row["hostname"] . "</td>
        </tr>";
    }
    
    echo "</table>";
} else {
    echo "0 results";
}
        } else {
            echo "No changes made or update failed";
        }
    }
    
    // Display the form with the current values
    // echo "<form action='' method='POST'>";
    // echo "<input type='text' name='name' value='" . $row['name'] . "' />";
    // echo "<input type='text' name='age' value='" . $row['age'] . "' />";
    // echo "<input type='text' name='sex' value='" . $row['sex'] . "' />";
    // echo "<input type='submit' value='Update' />";
    // echo "</form>";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {
    background-color: #f0f0f0; /* Change this to your desired color */
    color:blue;
}
 
table {
    table-layout: fixed;
}
td {
    padding: 0px;
    border-bottom: 1px solid green; /* Adjust color as needed */
}
.echo{
    color:red;
}
table{
    width:100%;
    table-layout: auto;
    text-align: left;
    padding:10px;
    border:2px solid green;
}
td:hover{
    background-color: lightgrey;
}
  </style>
</head>
<body>
<form action="" method = "POST">
    <div class='div1';><table>
        <tr>
            <td><label for ="name">Name</label></td>
            <td><input type="text" id="name" name="name"></td>
        </tr>
        <tr>
            <td><label for ="age">Age</label></td>
            <td><input type="text" id="age" name="age" value="33"></td>
        </tr>
        <tr>
            <td><label for ="sex">Sex</label></td>
            <td><input type="text" id="sex" name="sex" value="Male"></td>
        </tr>
    </table><br>
    <input type="submit" name='submit' value="Submit">
</form></div>
</body>
</html>