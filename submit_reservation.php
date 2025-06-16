<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Sanitize inputs
  $first_name = htmlspecialchars(trim($_POST['first_name']));
  $last_name = htmlspecialchars(trim($_POST['last_name']));
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $phone = htmlspecialchars(trim($_POST['phone']));
  $party_size = htmlspecialchars(trim($_POST['party_size']));
  $time = htmlspecialchars(trim($_POST['time']));
  $date = htmlspecialchars(trim($_POST['date']));

  // Basic validation
  if ($first_name && $last_name && $email && $phone && $party_size && $time && $date) {

    // Store data in session for confirmation page
    $_SESSION['reservation'] = [
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'phone' => $phone,
      'party_size' => $party_size,
      'time' => $time,
      'date' => $date
    ];

    
    $formspree_url = "https://formspree.io/f/xyzjeqov"; 
    $post_data = http_build_query([
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'phone' => $phone,
      'party_size' => $party_size,
      'time' => $time,
      'date' => $date,
      '_replyto' => $email
    ]);

    // Send POST request to Formspree using file_get_contents
    $opts = [
      "http" => [
        "method"  => "POST",
        "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
        "content" => $post_data
      ]
    ];
    $context = stream_context_create($opts);
    @file_get_contents($formspree_url, false, $context); // ignore result

    // Redirect to confirmation page
    header("Location: confirmation.php");
    exit;
  } else {
    echo "⚠️ Please fill in all fields correctly.";
  }
} else {
  echo "⚠️ Invalid request method.";
}
?>
