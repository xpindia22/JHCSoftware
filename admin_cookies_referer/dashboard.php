<?php
require_once 'session_user.php';

// Define the role-dashboard mappings
$role_dashboard = [
    'Admin' => 'dashboard_admin.php',
    'Doctor' => 'dashboard_doctor.php',
    'Nurse' => 'dashboard_nurse.php',
    'Laboratory' => 'dashboard_laboratory.php',
    'Pharmacy' => 'dashboard_pharmacy.php',
    'Reception' => 'dashboard_reception.php',
    'MTS' => 'dashboard_mts.php',
    'Accounts' => 'dashboard_accounts.php',
    'Echocardiographer' => 'dashboard_echocardiographer.php'
    'SA' => 'dashboard_sa.php'
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
echo "<p><a href='logout.php'>Logout</a></p>";
?>
