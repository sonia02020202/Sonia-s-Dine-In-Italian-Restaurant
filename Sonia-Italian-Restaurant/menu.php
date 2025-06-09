<?php
// menu.php - The first menu page 1
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menu - Sonia’s Fine Dine-In</title>
  <link rel="stylesheet" href="menu.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/logo.jpg" alt="Restaurant Logo" style="height: 60px;">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="reservation.php">Reservations</a>
      <a href="contact.php">Contact</a>
      <a href="admin_login.php">Admin Login</a>
    </nav>
  </header>

  <main class="menu-section">
    <h1 style="text-align: center; font-style: italic; margin-top: 40px;">Our Menu</h1>
    <div class="menu-grid">
      <?php
        $menu_items = [
          ["img/soniadelight.jpg", "<b>Sonia Delight</b></br>*Chef's Choice - A penne dish made with white sauce, spinach, bell peppers, onions and garlic", "$48.00"],
          ["img/pizza.jpg", "<b>Pizza</b><br> Your choice of any 3 toppings chose from onions, green peppers, banana peppers, pepperoni tomatoes or bacon", "$45.00"],
          ["img/fettuccine.jpg", "<b>Fettuccine Alfredo</b></br> A traditional dish made with simple ingredients tossed with butter and Parmesan cheese topped with parsely", "$42.00"],
          ["img/risotto.jpg", "<b>Risotto</b><br> Cooked in white wine, with mushrooms and onions garnished topped off with chives", "$53.00"],
          ["img/lingpesto.jpg", "<b>Linguini Pesto</b><br> Linguini pasta service with pesto sauce made with fresh basil, garlic, pine nuts, olive oil and Parmesan cheese", "$49.00"],
          ["img/cacio.jpg", "<b>Cacio e Pepe</b><br> Your choice of Speghetti or Linguini pasta cooked with black pepper and Pecorino Romano cheese", "$47.00"],
          ["img/gnocchi.jpg", "<b>Gnocchi</b><br> Potato dumplings cooked in a tomato sauce and garnished with fresh basil", "$40.00"],
          ["img/pennevodka.jpg", "<b>Penne alla Vodka</b><br> Penne pasta cooked in a vodka sauce, pancetta and garnished with both parlsey and basil", "$52.00"],
          ["img/pollopesto.jpg", "<b>Pollo Pesto Penne</b><br> A delicious dish served with creamy pesto sauce with sundried tomatoes, spinach and chicken", "$55.00"],
          ["img/pomodoro.jpg", "<b>Speghetti al Pomodoro</b><br> Speghetti with tomato sauce cooked with onions, garlic and garnished with basil - a in house favourite ", "$49.00"],
          ["img/veggieburger.jpg", "<b>Veggie Burger</b><br> Real vegetable patty made with checkpeas, deep fried on a toasted bun with mayo, lettuce, onions, tomato and side of fries", "$50.00"],
          ["img/vegsauceling.jpg", "<b>Sonia`s Vegtable Pasta Sauce</b><br> *chef's choice - homemade leek, tomatoes, onions, garlic, carrots, celery, sweet peppers and cashew nuts blended to create a creamy sauce served your choice Linguini or Speghetti", "$59.00"]
        ];
        foreach ($menu_items as $item) {
          echo "<div class='menu-item'>
                  <img src='{$item[0]}' alt='{$item[1]}'>
                  <p class='dish-name'>{$item[1]}</p>
                  <p class='price'>{$item[2]}</p>
                </div>";
        }
      ?>
    </div>

    <div class="desserts-link">
      <a href="desserts.php">Drinks & Desserts</a>
    </div>
  </main>
</body>
</html>
