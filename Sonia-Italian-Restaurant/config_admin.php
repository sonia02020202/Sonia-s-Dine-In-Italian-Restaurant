<?php
// Admin login credentials
define('ADMIN_USERNAME', 'sonia');
define('ADMIN_PASSWORD', 'foodie123');

// MySQL database connection (for InfinityFree)
$servername = "sql311.infinityfree.com";
$db_username = "if0_39239359";
$db_password = "Sonia20252025"; 
$database = "if0_39239359_sonia";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
