<?php
// contact.php - Sonia's Italian Fine Dine-In Restaurant Contact Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact | Sonia’s Fine Dine-In Restaurant</title>
  <link rel="stylesheet" href="contact.css" />
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="reservations.php">Reservations</a>
      <a href="admin_login.php">Admin login</a>
    </nav>
  </header>

  <main class="contact-container">
    <h2>Contact Us</h2>
    <p style="font-size: 12px; font-style: italic; margin-top: -10px; margin-bottom: 20px;">
      Let us know what you think. For reservations and customer inquiries.
    </p>
    <p class="contact-details">
      📍 101 Yorkville Avenue, Toronto, ON M5R 1C1, Canada<br>
      📞 (416) 867-5309<br>
      📧 <a href="mailto:Sonia-Italian-Restaurant@outlook.com">Sonia-Italian-Restaurant@outlook.com</a>
    </p>

    <div class="hours-container">
      <strong>Hours of Operation:</strong><br>
      <div class="hours-grid">
        <div>Saturday</div><div>11AM - 1AM</div>
        <div>Sunday</div><div>11AM - 12AM</div>
        <div>Monday</div><div>11AM - 12AM</div>
        <div>Tuesday</div><div>11AM - 1AM</div>
        <div>Wednesday</div><div>11AM - 1AM</div>
        <div>Thursday</div><div>11AM - 1AM</div>
        <div>Friday</div><div>11AM - 1AM</div>
      </div>
    </div>

    <div class="map-container">
      <?php
      // Google Map i embedded below using an <iframe> from Google Maps with the restaurant's location,
      // to make it look realistic
      ?>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2886.982487748776!2d-79.42002198450003!3d43.654260979121846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b349f7c02e317%3A0x20b22f3fdf75d9f1!2s101%20Yorkville%20Ave%2C%20Toronto%2C%20ON%20M5R%201C1%2C%20Canada!5e0!3m2!1sen!2sca!4v1718034701234"
        width="100%" height="350" style="border: 1px;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

    <section class="about-us">
      <h3>About Us</h3>
      <p>Sonia’s Italian Fine Dine-In Restaurant is nestled in the heart of Yorkville. We offer a rich experience of traditional Italian cuisine with modern elegance. Whether it's an intimate dinner or a special celebration, we bring the warmth and flavors right to your table.</p>
    </section>

    <section class="reviews">
      <h3>Customer Reviews</h3>
      <div class="review">
        <p><strong>⭐⭐⭐⭐⭐</strong> "Absolutely amazing! The risotto was perfection and the service was top-notch!" -Maria</p>
      </div>
      <div class="review">
        <p><strong>⭐⭐⭐⭐⭐</strong> "A charming place with unforgettable pasta. The ambiance was cozy and elegant." -Sophia</p>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Sonia’s Italian Fine Dine-In Restaurant</p>
    <p style="font-size: 12px; font-style: italic;">References: food photos generated from Gemini | Sonia's personal food collection photos</p>
  </footer>
</body>
</html>
