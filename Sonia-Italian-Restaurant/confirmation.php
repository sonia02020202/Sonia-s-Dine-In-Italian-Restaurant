<?php
session_start();

if (!isset($_SESSION['reservation'])) {
  header("Location: reservations.php");
  exit;
}
// Retrieve the reservation array from the session
$res = $_SESSION['reservation'];
$first_name = htmlspecialchars($res['first_name']);
$date = date("F j, Y", strtotime($res['date']));
$time = htmlspecialchars($res['time']);
$party_size = intval($res['party_size']);

unset($_SESSION['reservation']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reservation Confirmed</title>
  <style>
    body {
      font-family: Georgia, serif;
      background-color: #fffaf0;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .confirmation-box {
      border: 2px solid black;
      padding: 40px;
      max-width: 600px;
      text-align: center;
      background-color: white;
    }
    .confirmation-box p {
      font-size: 18px;
      margin: 20px 0;
    }
    .checkmark {
      font-size: 36px;
      color: green;
    }
    .back-button a {
      display: inline-block;
      margin-top: 30px;
      padding: 10px 20px;
      background-color: #d2b48c;
      text-decoration: none;
      border-radius: 6px;
      color: black;
      font-size: 16px;
    }
    .back-button a:hover {
      background-color: #a97449;
    }
  </style>
</head>
<body>
  <div class="confirmation-box">
    <div class="checkmark">✔ Confirmed </div>
    <p>Thank you, <strong><?= $first_name ?></strong>!</p>
    <p>Your table for <strong><?= $party_size ?></strong> has been reserved on <strong><?= $date ?></strong> at <strong><?= $time ?></strong>.</p>
    <p>We look forward to serving you.</p>
    <div class="back-button">
      <a href="index.php">Back to Home</a>
    </div>
  </div>
</body>
</html>
