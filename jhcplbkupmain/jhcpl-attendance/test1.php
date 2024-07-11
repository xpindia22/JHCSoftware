
<?php
require_once 'conn.php';
 
if (!$conn){
    echo "error connecting";
} else{
    echo "Connected <br>";
}
if (isset($_POST['submit'])){
$name=$_POST['name'];
$age=$_POST['age'];
$sex=$_POST['sex'];
}
$sql = "SELECT * FROM test ORDER BY id DESC";
 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>id</th><th>name</th> <th>age</th> <th>sex</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id']. "</td><td>" . $row['name']. "</td><td>" . $row['age']. "</td><td>" . $row['sex']. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
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
    table {
        color:blue;
        width:100%;
        text-align:left;
        padding:50px;
        table-layout: fixed;

    }
    tr,td,th{
        border:1px solid blueviolet;
        background-color: lightblue;
    }
        </style>
</head>
<body>
    
</body>
</html>