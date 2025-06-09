<?php
// desserts.php - Sonia’s Desserts & Drinks Page for the restaurant
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Desserts & Drinks - Sonia’s Fine Dine-In</title>
  <link rel="stylesheet" href="desserts.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="reservation.php">Reservations</a>
      <a href="contact.php">Contact</a>
      <a href="admin_login.php">Admin Login</a>
    </nav>
  </header>

  <main class="desserts-page">
    <h1>Desserts & Drinks</h1>

    <div class="drinks-section">
      <div class="column">
        <h2>Wines & Teas</h2>
        <img src="img/redwine.jpg" alt="Wine" class="drink-img">
        <ul>
          <li>Barolo - $19.90</li>
          <li>Pinot Grigio - $18.00</li>
          <li>Merlot - $16.50</li>
          <li>Shiraz - $17.75</li>
          <li>Rosé - $20.00</li>
          <li>Chardonnay - $19.00</li>
          <li>Green Tea - $10.00</li>
          <li>Chamomile Tea $10.00</li>
        </ul>
      </div>
      <div class="column">
        <h2>Pops & Juices</h2>
        <img src="img/juice.jpg" alt="Pop" class="drink-img">
        <ul>
          <li>Fiji Water - $5.75</li>
          <li>Coke - $5.25</li>
          <li>Diet coke - $5.50</li>
          <li>Sprite - $4.75</li>
          <li>gingerale - $5.50
          <li>Apple Juice - $5.00</li>
          <li>Orange Juice - $4.80</li>
          <li>Iced Tea - $4.25</li>
        </ul>
      </div>
    </div>

    <div class="dessert-section">
      <h2>Desserts</h2>
      <div class="dessert-grid">
        <div class="dessert-item">
          <p><strong>Cannoli</strong> - $20.00</p>
          <img src="img/canoli.jpg" alt="Cannoli">
        </div>
        <div class="dessert-item">
          <p><strong>Tiramisu</strong> - $25.00</p>
          <img src="img/tiramisu.jpg" alt="Tiramisu">
        </div>
        <div class="dessert-item">
          <p><strong>Strawberry Cake</strong> - $25.00</p>
          <img src="img/strawberry.jpg" alt="Strawberry Shortcake">
        </div>
        <div class="dessert-item">
          <p><strong>Chocolate Pannacotta</strong> - $20.00</p>
          <img src="img/chocolatepannacotta.jpg" alt="Chocolate Pudding">
        </div>
      </div>
    </div>
   <div class="back-link">
      <a href="menu.php">← Back to Menu</a>
    </div>
  </main>
</body>
</html>

