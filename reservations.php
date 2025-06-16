<?php
// reservations.php - Sonia's Reservation Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation | Sonia’s Fine Dine-In Restaurant</title>
  <link rel="stylesheet" href="reservations.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="contact.php">Contact</a>
      <a href="admin_login.php">Admin login</a>
    </nav>
  </header>

  <main class="reservation-page">
    <h2>Book Your Reservation</h2>

    <form class="reservation-form" id="reservationForm" action="submit_reservation.php" method="POST" novalidate>

      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" placeholder="Sonia" pattern="[A-Za-z\s]+" title="Only letters and spaces allowed" required>

      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" placeholder="Serrano" pattern="[A-Za-z\s]+" title="Only letters and spaces allowed" required>

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" placeholder="sonia@example.com" required>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" placeholder="000-000-0000" pattern="\d{3}-\d{3}-\d{4}" title="Phone format: 000-000-0000" required>

<!-- Party size dropdown from 1 to 10 guests to prevent over crowding -->

      <label for="party_size">Party Size:</label>
      <select id="party_size" name="party_size" required>
        <option value="">Select party size</option>
        <?php for ($i = 1; $i <= 10; $i++): ?>
          <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
      </select>

 <!-- Time selection options from 11:00 AM to 10:30 PM, in 30-minute increments -->
      <label for="time">Time:</label>
      <select id="time" name="time" required>
        <option value="">Select time</option>
        <?php
          $start = strtotime("11:00 AM");
          $end = strtotime("10:30 PM");
          for ($time = $start; $time <= $end; $time += 30 * 60) {
            $label = date("g:i A", $time);
            echo "<option value=\"$label\">$label</option>";
          }
        ?>
      </select>

      <label for="date">Date:</label>
      <input type="date" id="date" name="date" required>

      <button type="submit">Submit Reservation</button>
    </form>

    <div class="reservation-note">
      <p>Reservations over 11+ people must contact the restaurant directly by phone or email Sonia-Italian-Restaurant@outlook.com . Please allow us to contact you within 24 hours by email. No exceptions on reserverations after 10:35PM. Thank you.</p>
    </div>
  </main>

  <script>
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
      let isValid = true;
      const form = e.target;
      const fields = ['first_name', 'last_name', 'email', 'phone', 'party_size', 'time', 'date'];

 // Check all required fields and highlight if invalid     
      fields.forEach(id => {
        const field = document.getElementById(id);
        field.style.border = ""; // Reset border
        if (!field.checkValidity()) {
          field.style.border = "2px solid red";
          isValid = false;
        }
      });

// added  logic to block past dates 
      const dateInput = document.getElementById('date');
      const selectedDate = new Date(dateInput.value);
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      if (selectedDate < today) {
        dateInput.style.border = "2px solid red";
        alert("Invalid date: Please select a future date.");
        isValid = false;
      }
      
   // Stop form from submission if validation fails
      if (!isValid) {
        e.preventDefault(); // Prevent form submission
        alert("Please correct the highlighted fields.");
      }
    });
  </script>
</body>
</html>
