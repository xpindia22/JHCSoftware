<?php
// require_once "conn.php";
require_once "css/testrecall1-2.css";

//connect to the database.
$host="localhost";
$user="jhcpl";
$pwd="jhcpl";
$db="jhcpl";

// Create connection
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error){
    die ( "connetion could not be established. $conn->connect_error");
}

// Check if form was submitted
if (isset($_POST['submit'])){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name=$_POST['name'];
    $age=$_POST['age'];
    $sex=$_POST['sex'];    

    if (!empty($id)) {
        // Update existing record
        $sql2 = "UPDATE test SET name='$name', age='$age', sex='$sex' WHERE id=$id";
    } else {
        // Insert new record
        $sql2 = "INSERT INTO test (name, age, sex) VALUES ('$name', '$age', '$sex')";
    }

    $result = $conn->query($sql2);  
}

// Check if edit button was clicked
if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $sql = "SELECT * FROM test WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Check if delete button was clicked
if (isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sql = "DELETE FROM test WHERE id=$id";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="3"> -->
    <title>Document</title>
    
</head>
<body>
    <div>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>">
            <br><br>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="<?php echo isset($row['age']) ? $row['age'] : ''; ?>">
            <br><br>

            <label for="sex">Sex</label>
            <input type="text" id="sex" name="sex" value="<?php echo isset($row['sex']) ? $row['sex'] : ''; ?>">
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM test ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>NAME</th> <th>AGE</th> <th>SEX</th><th>ACTION</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id']. "</td><td>" . $row['name']. "</td><td>" . $row['age']. "</td><td>" . $row['sex']. "</td><td><a href='?edit=".$row['id']."'>Edit</a> | <a href='?delete=".$row['id']."'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
