<?php
// logout.php - Ends the session and displays a goodbye message briefly
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logging Out</title>
  <meta http-equiv="refresh" content="2;url=admin_login.php">
  <style>
    body {
      font-family: Georgia, serif;
      text-align: center;
      padding-top: 100px;
      background-color: #fffaf0;
    }
    h1 {
      color: #800020;
      font-style: italic;
    }
  </style>
</head>
<body>
  <h1>🍝🍷 Goodbye!👋</h1>
  <p>You are now leaving Sonia's admin and being redirected...</p>
</body>
</html>
