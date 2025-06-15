<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

require_once "config_admin.php";

// Validate and sanitize ID
if (!isset($_GET["id"])) {
    header("Location: manage_drinks.php");
    exit();
}

$id = intval($_GET["id"]);

// note: it preforms deletion
$stmt = $conn->prepare("DELETE FROM drink_items WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: manage_drinks.php");
    exit();
} else {
    echo "Error deleting drink item: " . $conn->error;
}
?>
