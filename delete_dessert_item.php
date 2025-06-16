<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

require_once "config_admin.php";

// Validate and get the dessert ID
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // First get the image path to delete the file
    $stmt = $conn->prepare("SELECT image FROM dessert_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    if ($stmt->fetch()) {
        // Delete image file if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    $stmt->close();

    // Delete the dessert item i want
    $stmt = $conn->prepare("DELETE FROM dessert_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to manage desserts
header("Location: manage_desserts.php");
exit();
?>
