<?php
//require 'css/style.css';
require 'css/table-co1.css';
require 'css/navbar.css';
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="body-margin50px bg-lightblue ">
    <div class="navbar">
        <a href="#home">Home</a>
        <a href="001_register.php">Register Patient</a>
        <a href="004_new-revisit.php">Appointments</a>
        <a href="005_visitsAddEdit.php">Medical Record</a>
    </div>
    
    <header><h2 class="bg-aquamarine"><center><span class="header-border-red">Header Lightblue</span></center></h2></header>

    <table class="text-blue padding10px width50 border-collapse bg-lightgrey border-spacing border-red class-higlight">
        <thead>
            <tr> 
                <th class="td-border-red">Name</th>
                <th class="td-border-red">Age</th>
                <th class="td-border-red">Sex</th>
            </tr>
        </thead>
        <tbody>
            <tr class="td-border-red">
                <td class="td-border-red"> Ronaldo CR7</td>
                <td class="td-border-red">22 </td>
                <td class="td-border-red">Male </td>
            </tr>
            <tr class="td-border-red">
                <td class="td-border-red"> Pele</td>
                <td class="td-border-red">14 </td>
                <td class="td-border-red">Male </td>
            </tr>
            <tr class="td-border-red">
                <td class="td-border-red">Ginting</td>
                <td class="td-border-red">14 </td>
                <td class="td-border-red">Male </td>  
            </tr>
            <tr class="td-border-red">
                <td class="td-border-red"> Srikant Kadambi</td>
                <td class="td-border-red">22 </td>
                <td class="td-border-red">Female </td>
            </tr>
        </tbody>
    </table> 
    <br><br><br><br>
    <br><br><br><br><br><br>
    <footer>Footer links go here...</footer>
</body>
</html>
';
?>
