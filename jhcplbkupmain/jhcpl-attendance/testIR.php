<?php
require_once "conn.php";
require_once "css/testrecall1-2.css";

if ($conn->connect_error){
    die ( "connetion could not be established. $conn->connect_error");
} else {
    if (isset($_POST['submit'])){
        $name=$_POST['name'];
        $age=$_POST['age'];
        $sex=$_POST['sex'];            
        $sql2= "insert INTO test (name, age, sex) values ('$name', '$age', '$sex')";
        $result= ($conn->query($sql2));  
    }

    echo "
    <html><body><div>
    <form action=''  method='POST'>
    <label for ='name'>Name</label>
     <input type='text' id='name' name='name'>
    <br><br>
    <label for ='age'>Age</label>
    <input type='number' id='age' name='age'>
    <br><br>
     <label for ='sex'>Sex</label>
    <input type='text' id='sex' name='sex'>
    <input type='submit' name='submit' value= 'submit'>
    </form></div></body></html>";
             
    $sql = "SELECT * FROM test ORDER BY id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>NAME</th> <th>AGE</th> <th>SEX</th></tr>";

    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['id']. "</td><td>" . $row['name']. "</td><td>" . $row['age']. "</td><td>" . $row['sex']. "</td></tr>";
    }
    echo "</table>";
    } else {
    echo "0 results";
    }

    
}

$conn->close();
?>