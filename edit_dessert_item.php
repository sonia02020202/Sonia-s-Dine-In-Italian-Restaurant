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

$msg = "";
$id = $_GET["id"] ?? null;

// Fetch existing data
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM dessert_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if (!$item) {
        die("Dessert item not found.");
    }
} else {
    die("Invalid request.");
}

// Update logic
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Handle image upload (optional)
    if (!empty($_FILES["image"]["name"])) {
        $imageName = $_FILES["image"]["name"];
        $imageTmp = $_FILES["image"]["tmp_name"];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($imageName);

        if (move_uploaded_file($imageTmp, $targetFile)) {
            $stmt = $conn->prepare("UPDATE dessert_items SET name=?, description=?, price=?, image=? WHERE id=?");
            $stmt->bind_param("ssdsi", $name, $description, $price, $targetFile, $id);
        } else {
            $msg = "Image upload failed.";
        }
    } else {
        $stmt = $conn->prepare("UPDATE dessert_items SET name=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("ssdi", $name, $description, $price, $id);
    }

    if ($stmt->execute()) {
        $msg = "Dessert item updated!";
        // Refresh data
        header("Location: manage_desserts.php");
        exit();
    } else {
        $msg = "Update failed: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Dessert</title>
  <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="admin_dashboard.php">Dashboard</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <main class="dashboard">
    <h1>Edit Dessert Item</h1>
    <?php if ($msg): ?>
      <p style="color: green; font-style: italic;"><?= $msg ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <label>Name:</label><br>
      <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required><br><br>

      <label>Description:</label><br>
      <textarea name="description" rows="4" required><?= htmlspecialchars($item['description']) ?></textarea><br><br>

      <label>Price:</label><br>
      <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($item['price']) ?>" required><br><br>

      <label>Upload New Image (optional):</label><br>
      <input type="file" name="image" accept="image/*"><br><br>

      <input type="submit" value="Update Dessert">
    </form>

    <p><a href="manage_desserts.php">← Back to Desserts List</a></p>
  </main>
</body>
</html>
