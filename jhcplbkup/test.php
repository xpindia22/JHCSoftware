<?php
require 'pwd.php';
// require 'css/style.css';



?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
        <!-- <link rel='stylesheet'href='style.css'> -->

    <title>Document</title>
    <style>
/* style.css */

/* Adjust table width */
table {
    width: 100%;
    border-collapse: collapse;
}

/* Adjust input width */
input[type="text"]
width: calc(100% 30px); /* Subtract padding */
    padding: 5px;
    margin: 5px;,
input[type="date"]
width: calc(100% 30px); /* Subtract padding */
    padding: 5px;
    margin: 5px;,
input[type="number"] {
    width: calc(100% 30px); /* Subtract padding */
    padding: 5px;
    margin: 5px;
}

/* Center table within the container */
.testcontainer {
    margin: 0 auto;
}

/* Style submit button */
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Additional styles */
.container1 {
    background-color: skyblue;
    color: blue;
    text-align: center;
    padding: 10px;
}

         .body-class{
            margin: 50px;
        }
         </style>
</head>
<body class='body-class font-green'>
    <div class='testcontainer'>
        <table>
    <div class='container1'><center><span class='container3'>JAMES HEALTH CARE PRIVATE LIMITED. </span></div>
<table>
<tbody>
<tr><td><label for="name">Name:</label></td>
    <td><input type="text" id="name" name="name" value='Enter Name'></td></tr>
    
    <tr><td><label for="name">Age:</label></td>
    <td> <input type="text" id="age" name="age" value='33'></td></tr>

    <tr><td><label for="name">Sex:</label></td>
    <td> <input type="text" id="sex" name="sex" value='Male'></td></tr>

    <tr><td><label for="diagnosis">Diagnosis:</label></td>
    <td><input type="text" id="diagnosis" name="diagnosis" value='DM, HYPERTENSION'></td></tr>

    <tr><td><label for="date">Date:</label></td>
    <td><input type="date" id="date" name="date"></td></tr>

    <tr><td><label for="mobile">Mobile:</label></td>
    <td><input type="text" id="mobile" name="mobile" value='12345678'></td></tr>

    <tr><td><label for="address">Address:</label></td>
    <td><input type="text" id="address" name="address" value='Patient Address' ></td></tr>

    <tr><td> <label for="notes">Notes:</label></td>
    <td><input type="text" id="notes" name="notes" value='Patient Notes'></td></tr>

    <tr><td><label for="consultation">Consultation:</label></td>
    <td><input type="number" id="consultation" name="consultation" value="500" ></td></tr>

    <tr><td><label for="ecg">ECG:</label></td>
    <td><input type="number" id="ecg" name="ecg" value="500" ></td></tr>

    <tr><td><label for="echo">ECHO:</label></td>
    <td><input type="number" id="echo" name="echo" value="3000" ></td></tr>

    <tr><td><label for="medicines">Medicines:</label></td>
    <td><input type="number" id="medicines" name="medicines" value="2000"></td></tr>

    <tr><td> <label for="lab">Lab:</label></td>
    <td><input type="number" id="lab" name="lab" value="3000"></td></tr>

    </tbody></table>
<input type='submit' value'submit'>
</body>
</html>
