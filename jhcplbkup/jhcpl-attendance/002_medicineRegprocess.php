<?php
ob_start(); // Start output buffering

require 'header-jhcpl.php';
require_once 'conn.php'; // connect to the database.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $med_generic = isset($_POST['med_generic']) ? $_POST['med_generic'] : '';
    $med_trade = isset($_POST['med_trade']) ? $_POST['med_trade'] : '';
    $price_onetab = isset($_POST['price_onetab']) ? $_POST['price_onetab'] : '';
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

    // Get the IP address of the client
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Get the hostname of the client
    $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);

    $sql = "INSERT INTO medicines (med_generic, med_trade, price_onetab, notes, ip_address, hostname)
                VALUES ('$med_generic', '$med_trade', '$price_onetab', '$notes', '$ip_address', '$hostname')";

    $result = $conn->query($sql);

    // if ($result) {
    //     echo "Data saved successfully in Attendance!<br>";
    //     // header('location: medicines.php');
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    
    if ($result) {
        echo "<h3>Data saved successfully <p>Generic Name: $med_generic<p>Trade Name: $med_trade<p>Price Of One Tab:  $price_onetab <p>Notes: $notes<br></h3m>";
        echo "<script type='text/javascript'>
                setTimeout(function () {
                    window.location.href= 'medicines.php'; // the redirect goes here
                },5000); // 5 seconds
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();

    // Redirect to the same page to prevent form resubmission on refresh
    // header('location: medicines.php');
    
    exit();
}

ob_end_flush(); // Send the buffered output
?>
