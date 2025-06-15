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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    $stmt = $conn->prepare("INSERT INTO drink_items (name, price, category) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $category);

    if ($stmt->execute()) {
        $msg = "Drink item added successfully!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Drink Item</title>
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
    <h1>Add New Drink</h1>

    <?php if ($msg): ?>
      <p style="color: green; font-style: italic;"><?= $msg ?></p>
    <?php endif; ?>

    <form method="POST">
      <label>Name:</label><br>
      <input type="text" name="name" required><br><br>

      <label>Price:</label><br>
      <input type="number" step="0.01" name="price" required><br><br>

      <label>Category:</label><br>
      <select name="category" required>
        <option value="">-- Select Category --</option>
        <option value="wines_teas">Wines & Teas</option>
        <option value="pops_juices">Pops & Juices</option>
      </select><br><br>

      <input type="submit" value="Add Drink">
    </form>

    <p><a href="admin_dashboard.php">← Back to Dashboard</a></p>
  </main>
</body>
</html>
