<?php
// Get the URL parameter from the rewritten URL
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Parse the URL and route to the appropriate script or handler
switch ($url) {
    case 'r':
        require_once 'register.php';
        break;
    case 'login':
        require_once 'login.php';
        break;
    case 'dashboard':
        require_once 'dashboard.php';
        break;
    // Add more cases as needed
    default:
        echo "Page not found";
        break;
}
?>
