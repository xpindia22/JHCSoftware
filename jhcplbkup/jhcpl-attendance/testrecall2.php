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

<?php 

// $host = "localhost";
// $user = "jhcpl";
// $pwd = "jhcpl";
// $db = "jhcpl";
// $conn=new mysqli($host,$user,$pwd,$db);


// if (isset($_POST['name'])) {
//     $name=$_POST['name'];
//     $age=$_POST['age'];
//     $sex=$_POST['sex'];
//     $hostname=gethostname();

//     if (empty($name) or empty($age) or empty($sex)) {
//         echo "<span style='color:red; border: 2px dotted green;'>Please fill in all fields.</span>";
//     } else{
//         // Insert data into the database
//         $stmt= $conn->prepare("INSERT INTO test (name, age, sex,hostname) VALUES (?,?,?,?)");
//         $stmt->bind_param("ssss",$name,$age,$sex, $hostname);
//         $stmt->execute();
//         if ($stmt){
//             $last_id = $conn->insert_id; // Get the last inserted ID
//             echo "Data Inserted:<br>ID: $last_id,<br>Name: $name,<br> Age: $age,<br>Sex:  $sex Inserted OK!";
//         }   else{
//             echo "Data Not Inserted";
//         }

//         //display results from database...
//         $sql = "SELECT * FROM test";
//         $result = $conn->query($sql);

// // if ($result->num_rows > 0) {
// //     echo "<table>";
// //     echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Hostname</th></tr>";
    
// //     // Output data of each row
// //     while($row = $result->fetch_assoc()) {
// //         echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["age"]. "</td><td>" . $row["sex"]. "</td><td>" . $row["hostname"]. "</td></tr>";
// //     }
    
// //     echo "</table>";
// // } else {
// //     echo "0 results";
// // }
//  // ... PHP and HTML above ...

//  if ($result->num_rows > 0) {
//     echo "<table>";
//     echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Hostname</th></tr>";
    
//     // Output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "<tr>
//         <td><a href='update.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>
//         <td>" . $row["name"] . "</td>
//         <td>" . $row["age"] . "</td>
//         <td>" . $row["sex"] . "</td>
//         <td>" . $row["hostname"] . "</td>
//         </tr>";
//     }
    
//     echo "</table>";
// } else {
//     echo "0 results";
// }

 



// //delete data with wild card.
// $sqld = "DELETE FROM test WHERE name LIKE 'x%'";
// $resultd = $conn->query($sqld);
// if ($resultd){
//     echo"data rows with empty names deleted";
// }
//         $stmt->close();
//         $conn-> close();
//     }
// }



?>
