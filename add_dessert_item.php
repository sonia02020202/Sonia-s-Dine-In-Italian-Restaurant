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
$_SESSION['last_activity'] = time(); // update the last activity time

require_once "config_admin.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Handle image upload
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $imageName = $_FILES["image"]["name"];
        $imageTmp = $_FILES["image"]["tmp_name"];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($imageName);

        if (move_uploaded_file($imageTmp, $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO dessert_items (name, description, price, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $name, $description, $price, $targetFile);

            if ($stmt->execute()) {
                $msg = "Dessert item added successfully!";
            } else {
                $msg = "Error: " . $conn->error;
            }
        } else {
            $msg = "Failed to upload image.";
        }
    } else {
        $msg = "Image upload error.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Dessert Item</title>
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
    <h1>Add New Dessert</h1>

    <?php if ($msg): ?>
      <p style="color: green; font-style: italic;"><?= $msg ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <label>Name:</label><br>
      <input type="text" name="name" required><br><br>

      <label>Description:</label><br>
      <textarea name="description" rows="4" required></textarea><br><br>

      <label>Price:</label><br>
      <input type="number" step="0.01" name="price" required><br><br>

      <label>Upload Image:</label><br>
      <input type="file" name="image" accept="image/*" required><br><br>

      <input type="submit" value="Add Dessert">
    </form>

    <p><a href="admin_dashboard.php">← Back to Dashboard</a></p>
  </main>
</body>
</html>
