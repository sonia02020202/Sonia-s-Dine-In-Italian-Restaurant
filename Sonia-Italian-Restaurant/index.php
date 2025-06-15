<?php
// index.php - Sonia's Home Page for the restaurant
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sonia’s Fine Dine-In Italian Restaurant</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
      <span class="shiny-text">Sonia's Italian Fine Dine-In Restaurant</span>
    </div>
    <nav>
      <a href="menu.php">Menu</a>
      <a href="reservations.php">Reservations</a>
      <a href="contact.php">Contact</a>
      <a href="admin_login.php">Admin Login</a>
    </nav>
  </header>

  <main>
    <div class="photo-banner">
      <img id="banner-image" src="img/homeplace.jpg" alt="Restaurant Image">
    </div>
    <div class="book-now">
      <a href="reservations.php" class="btn">Book Now</a>
    </div>
  </main>

  <script>
    const images = [
      'img/homeplace.jpg',
      'img/soniadelight.jpg',
      'img/pomodoro.jpg'
    ];

    let currentIndex = 0;
    const banner = document.getElementById('banner-image');

    setInterval(() => {
      banner.style.opacity = 0;
      setTimeout(() => {
        currentIndex = (currentIndex + 1) % images.length;
        banner.src = images[currentIndex];
        banner.style.opacity = 1;
      }, 900); // match fade-out time
    }, 3000); // show each image for 3 seconds
  </script>
</body>
</html>
