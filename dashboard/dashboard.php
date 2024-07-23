<?php
require_once '../config/session_user.php'; // Include session check

// Define the role-dashboard mappings
$role_dashboard = [
    'Admin' => '../dashboard/dashboard_admin.php',
    'Doctor' => '../dashboard/dashboard_doctor.php',
    'Nurse' => '../dashboard/dashboard_nurse.php',
    'Laboratory' => '../dashboard/dashboard_laboratory.php',
    'Pharmacy' => '../dashboard/dashboard_pharmacy.php',
    'Reception' => '../dashboard/dashboard_reception.php',
    'MTS' => '../dashboard/dashboard_mts.php',
    'Accounts' => '../dashboard/dashboard_accounts.php',
    'Echocardiographer' => '../dashboard/dashboard_echocardiographer.php',
    'SA' => '../dashboard/dashboard_sa.php'
];

echo "<h2>Welcome, $username</h2>";
echo "<p>Select your dashboard:</p>";
echo "<ul>";

foreach ($_SESSION['roles'] as $role) {
    $role = trim($role);
    if (isset($role_dashboard[$role])) {
        echo "<li><a href='" . $role_dashboard[$role] . "'>$role Dashboard</a></li>";
    }
}

echo "</ul>";
echo "<p><a href='../admin_cookies_referer/logout.php'>Logout</a></p>";
?>
