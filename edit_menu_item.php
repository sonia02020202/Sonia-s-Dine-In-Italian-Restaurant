<?php
session_start();

// Restrict access if not logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

// Session will expire in 10 minutes for security reasons
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    session_unset();
    session_destroy();
    header("Location: admin_login.php?timeout=1");
    exit();
}
$_SESSION['last_activity'] = time(); // update last activity time

require_once "config_admin.php";

// Get item ID
if (!isset($_GET["id"])) {
    header("Location: manage_menu.php");
    exit();
}

$id = $_GET["id"];
$msg = "";

// Fetch existing item data
$stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    die("Menu item not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // If a new image was uploaded
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $imageName = $_FILES["image"]["name"];
        $imageTmp = $_FILES["image"]["tmp_name"];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($imageName);
        move_uploaded_file($imageTmp, $targetFile);
        $stmt = $conn->prepare("UPDATE menu_items SET name=?, description=?, price=?, image_path=? WHERE id=?");
        $stmt->bind_param("ssdsi", $name, $description, $price, $targetFile, $id);
    } else {
        $stmt = $conn->prepare("UPDATE menu_items SET name=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("ssdi", $name, $description, $price, $id);
    }

    if ($stmt->execute()) {
        $msg = "Item updated successfully!";
        
        $stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
    } else {
        $msg = "Update failed: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Menu Item</title>
  <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
  <main class="dashboard">
    <h1>Edit Menu Item</h1>

    <?php if ($msg): ?>
      <p style="color:green; font-style:italic;"><?= $msg ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <label>Name:</label><br>
      <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required><br><br>

      <label>Description:</label><br>
      <textarea name="description" rows="4" required><?= htmlspecialchars($item['description']) ?></textarea><br><br>

      <label>Price:</label><br>
      <input type="number" step="0.01" name="price" value="<?= $item['price'] ?>" required><br><br>

      <label>Current Image:</label><br>
      <img src="<?= $item['image_path'] ?>" alt="Current Image" style="max-width: 150px;"><br><br>

      <label>Upload New Image (optional):</label><br>
      <input type="file" name="image" accept="image/*"><br><br>

      <input type="submit" value="Update Item">
    </form>

    <p><a href="manage_menu.php">← Back to Menu Management</a></p>
  </main>
</body>
</html>
