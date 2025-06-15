<?php
session_start();

// Restrict access if not logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

// Session will expire in 10 minutes for security reasons
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    session_unset();
    session_destroy();
    header("Location: admin_login.php?timeout=1");
    exit();
}
$_SESSION['last_activity'] = time(); // update last activity time

require_once "config_admin.php";

// Fetch dessert items from database
$result = $conn->query("SELECT * FROM dessert_items ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Desserts</title>
  <link rel="stylesheet" href="admin_dashboard.css">
  <style>
    .menu-list {
      max-width: 900px;
      margin: 50px auto;
      padding: 40px;
      background: white;
      border: 2px solid black;
    }

    .menu-list h1 {
      text-align: center;
      font-style: italic;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-family: Georgia, serif;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
      vertical-align: middle;
    }

    th {
      background-color: #d2b48c;
      color: white;
      font-style: italic;
    }

    td img {
      max-width: 100px;
      height: auto;
      border-radius: 4px;
    }

    .actions {
      white-space: nowrap;
    }

    .actions a {
      display: inline-block;
      margin-right: 10px;
      text-decoration: none;
      color: white;
      background: #a97449;
      padding: 6px 12px;
      border-radius: 4px;
      font-style: italic;
    }

    .actions a.delete {
      background: #800020;
    }

    @media (max-width: 768px) {
      .menu-list {
        width: 95%;
        padding: 20px;
      }

      table, thead, tbody, th, td, tr {
        display: block;
      }

      th, td {
        padding: 10px;
      }

      td img {
        max-width: 100%;
      }

      .actions a {
        display: block;
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="admin_dashboard.php">Dashboard</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <div class="menu-list">
    <h1>Manage Desserts</h1>

    <?php if ($result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Dessert Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td>
                <?php
                  $imagePath = htmlspecialchars($row['image']);
                  $fullPath = file_exists($imagePath) ? $imagePath : 'img/default.jpg';
                ?>
                <img src="<?= $fullPath ?>" alt="<?= htmlspecialchars($row['name']) ?>">
              </td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['description']) ?></td>
              <td>$<?= htmlspecialchars($row['price']) ?></td>
              <td class="actions">
                <a href="edit_dessert_item.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete_dessert_item.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this dessert?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p style="text-align:center; font-style:italic;">No dessert items found. Start by adding one.</p>
    <?php endif; ?>

    <p style="text-align:center; margin-top:30px;">
      <a href="add_dessert_item.php">+ Add New Dessert</a><br><br>
      <a href="admin_dashboard.php">← Back to Dashboard</a>
    </p>
  </div>
</body>
</html>
