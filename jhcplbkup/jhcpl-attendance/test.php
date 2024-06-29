<?php
echo "Hello PHP<br>";

$host="localhost";
$user = "jhcpl";
$pwd="jhcpl";
$db="jhcpl";

$conn= new mysqli($host,$user,$pwd,$db);

if (!$conn){
    echo "error connecting";
} else{
    echo "Connected <br>";
}
if (isset($_POST['name'])){

$name=$_POST['name'];
$age=$_POST['age'];
$sex=$_POST['sex'];

$sql= "insert INTO test (name, age, sex) values ('$name', '$age', '$sex')";

$result= ($conn->query($sql));

if ($result){
    echo "ok";
   } else {
echo "Failed to insert data";    
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
body {
    background-color: lightblue;
    color:blue;
    margin:2px solid blue;
}
input{
    color:green;
    background-color: pink;
}

table{
    color:black;
    padding:10px;
    text-align: left;
    margin:red;
    width:100%;
    table-layout: fixed;
}
td,tr,td,th{
    border: 1px solid black;
    text-align: left;
    padding: 10px;
}
</style>

</head>
<body>
    <form action="" method="POST">
 <label for ="name">Name</label>
    <input type="text" id="name" name="name">
<br><br>

    <label for ="age">Age</label>
    <input type="number" id="age" name="age">
<br><br>
    <label for ="sex">Sex</label>
    <input type="text" id="sex" name="sex">
<input type="submit" value= "Click Here">
    </form>
</body>
</html>