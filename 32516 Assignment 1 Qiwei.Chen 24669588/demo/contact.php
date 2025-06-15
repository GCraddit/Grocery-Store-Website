<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - GCStore</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>
<?php include("categoryview.php"); ?>

<div class="container">
  <h2>Contact the Developer</h2>

  <p>If you have any questions, suggestions, or issues, feel free to get in touch.</p>

  <form action="#" method="POST">
    <label for="name">Your Name:</label>
    <input type="text" name="name" required>

    <label for="email">Your Email:</label>
    <input type="email" name="email" required>

    <label for="message">Message:</label>
    <textarea name="message" rows="5" required></textarea>

    <button type="submit" class="btn">Send Message</button>
  </form>

  <p style="margin-top: 20px;">📧 Or email us directly: <strong>developer@gcstore.com</strong></p>
</div>

</body>
</html>
