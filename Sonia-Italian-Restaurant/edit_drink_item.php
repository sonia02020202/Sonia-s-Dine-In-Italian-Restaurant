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

if (!isset($_GET["id"])) {
    header("Location: manage_drinks.php");
    exit();
}

$id = intval($_GET["id"]);
$msg = "";

// Fetch current drink info
$stmt = $conn->prepare("SELECT * FROM drink_items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$drink = $result->fetch_assoc();

if (!$drink) {
    echo "Drink not found.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];

    $update = $conn->prepare("UPDATE drink_items SET name = ?, price = ? WHERE id = ?");
    $update->bind_param("sdi", $name, $price, $id);

    if ($update->execute()) {
        $msg = "Drink item updated successfully!";
        // Refresh the drink data
        $drink["name"] = $name;
        $drink["price"] = $price;
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Drink Item</title>
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
    <h1>Edit Drink</h1>

    <?php if ($msg): ?>
      <p style="color: green; font-style: italic;"><?= $msg ?></p>
    <?php endif; ?>

    <form method="POST">
      <label>Drink Name:</label><br>
      <input type="text" name="name" value="<?= htmlspecialchars($drink['name']) ?>" required><br><br>

      <label>Price:</label><br>
      <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($drink['price']) ?>" required><br><br>

      <input type="submit" value="Update Drink">
    </form>

    <p style="text-align:center; margin-top:30px;">
      <a href="manage_drinks.php">← Back to Manage Drinks</a>
    </p>
  </main>
</body>
</html>
