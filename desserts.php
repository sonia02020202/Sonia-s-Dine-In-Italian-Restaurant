<?php
// desserts.php - Sonia’s Desserts & Drinks Page for the restaurant
require_once "config_admin.php";

// Fetch drinks grouped by category
$wines_teas = $conn->query("SELECT * FROM drink_items WHERE category = 'wines_teas' ORDER BY id ASC");
$pops_juices = $conn->query("SELECT * FROM drink_items WHERE category = 'pops_juices' ORDER BY id ASC");

// Fetch desserts from the dessert_items table to be displayed in the desserts section
$desserts = $conn->query("SELECT * FROM dessert_items ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Desserts & Drinks - Sonia’s Fine Dine-In Restaurant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="desserts.css">
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

  <main class="desserts-page">
    <h1>Drinks</h1>

    <div class="drinks-section">
      <div class="column">
        <h2>Wines & Teas</h2>
        <img src="img/redwine.jpg" alt="Wine" class="drink-img">
        <ul>
          <?php while ($row = $wines_teas->fetch_assoc()): ?>
            <!-- Escape special characters to prevent XSS attacks -->
            <li><?= htmlspecialchars($row['name']) ?> - $<?= htmlspecialchars($row['price']) ?></li>
          <?php endwhile; ?>
        </ul>
      </div>
      <div class="column">
        <h2>Pops & Juices</h2>
        <img src="img/juice.jpg" alt="Juice" class="drink-img">
        <ul>
          <?php while ($row = $pops_juices->fetch_assoc()): ?>
            <!-- special characters to prevent XSS attacks -->
            <li><?= htmlspecialchars($row['name']) ?> - $<?= htmlspecialchars($row['price']) ?></li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

    <!-- Desserts section: displays all desserts from the database with image, name, price, and optional description -->
    <div class="dessert-section">
      <h1>Desserts</h1>
      <div class="dessert-grid">
        <?php while ($row = $desserts->fetch_assoc()): ?>
          <div class="dessert-item">
            <!--  image path & name for safety -->
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">

            <!-- Display dessert name and price safely -->
            <p><strong><?= htmlspecialchars($row['name']) ?></strong> - $<?= htmlspecialchars($row['price']) ?></p>

            <?php if (!empty($row['description'])): ?>
              <!-- Display dessert description if available, using htmlspecialchars for XSS protection -->
              <p class="description" style="font-style: italic; font-size: 15px; color: #444;">
                <?= htmlspecialchars($row['description']) ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>

    <div class="back-link">
      <a href="menu.php">← Back to Menu</a>
    </div>
  </main>
</body>
</html>
