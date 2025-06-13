<?php
// Admin login credentials
define('ADMIN_USERNAME', 'sonia');
define('ADMIN_PASSWORD', 'foodie123');

// MySQL database connection (for MAMP)
$servername = "localhost";
$db_username = "root";
$db_password = "root"; // default for MAMP
$database = "restaurant_db"; // 

// CreateA connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
