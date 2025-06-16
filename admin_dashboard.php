<?php
session_start();

// Restrict access if not logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Session will expire in 10 minutes for security
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    session_unset();
    session_destroy();
    header("Location: admin_login.php?timeout=1");
    exit();
}
$_SESSION['last_activity'] = time(); // update last activity time
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <main class="dashboard">
    <h1>Welcome to Admin Dashboard</h1>
    <p>Choose what you want to manage:</p>
    <ul>
      <li><a href="manage_menu.php">Manage Menu</a></li>
      <li><a href="manage_desserts.php">Manage Desserts</a></li>
      <li><a href="manage_drinks.php">Manage Drinks</a></li>
    </ul>
  </main>
</body>
</html>
