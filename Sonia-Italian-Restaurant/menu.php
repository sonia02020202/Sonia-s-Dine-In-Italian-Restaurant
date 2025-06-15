<?php
// menu.php - The first menu page 1
require_once "config_admin.php";

// Fetch all menu items from the database
$result = $conn->query("SELECT * FROM menu_items ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu - Sonia’s Fine Dine-In Restaurant</title>
  <link rel="stylesheet" href="menu.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="reservations.php">Reservations</a>
      <a href="contact.php">Contact</a>
      <a href="admin_login.php">Admin Login</a>
    </nav>
  </header>

  <main class="menu-section">
    <h1 style="text-align: center; font-style: italic; margin-top: 40px;">Our Menu</h1>
    <div class="menu-grid">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="menu-item">
          <img src="<?= htmlspecialchars($row['image']) ?>" alt="Dish Image">
          <p class='dish-name' style="font-style: italic;"><b><?= htmlspecialchars($row['name']) ?></b></p>
          <p style="font-style: italic;"><?= htmlspecialchars($row['description']) ?></p>
          <p class='price' style="font-style: italic; font-weight: bold;">$<?= htmlspecialchars($row['price']) ?></p>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="desserts-link">
      <a href="desserts.php">Drinks & Desserts</a>
    </div>
  </main>
</body>
</html>
