<?php
session_start();
require_once "config_admin.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_dashboard.php"); // next page after login
        exit();
    } else {
        $error = "Invalid login. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="admin_login.css">
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
      <a href="contact.php">Contact</a>
    </nav>
  </header>

  <div class="admin-container">
    <h2>Admin Login</h2>
    <?php if ($error): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="post" autocomplete="off">
      <label>Admin Login:</label>
      <input type="text" name="username" required autocomplete="off" title="Case-sensitive. Please enter exactly as registered."><br>
      <label>Password:</label>
      <input type="password" name="password" required autocomplete="new-password" title="Case-sensitive. Please enter exactly as registered."><br>
      <input type="submit" value="Login">
    </form>
  </div>
</body>
</html>
