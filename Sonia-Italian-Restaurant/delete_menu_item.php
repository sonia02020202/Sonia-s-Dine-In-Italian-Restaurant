<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

require_once "config_admin.php";

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    //  fetch the image path  so thta I can delete the image file also
    $stmt = $conn->prepare("SELECT image FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    // Delete the database row
    $deleteStmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();
    $deleteStmt->close();

    // Delete the image file if it exists and is in the uploads folder 
    if ($imagePath && file_exists($imagePath) && strpos($imagePath, 'uploads/') === 0) {
        unlink($imagePath);
    }
}

header("Location: manage_menu.php");
exit();
?>
