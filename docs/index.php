<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';

if (!empty($_SESSION['status'])) {
  header("Location: AnalisisKehadiran.php");
} else if (isset($_COOKIE['ic_number']) && isset($_COOKIE['password'])) {
  $ic_number = $_COOKIE['ic_number'];
  $password = $_COOKIE['password'];

  require_once 'includes/dbh.inc.php';
  require_once 'includes/signup_model.inc.php';
  login($pdo, $ic_number, $password, true);
  if (!isset($_SESSION["errors"])) {
    header("Location: AnalisisKehadiran.php");
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  ?>

  <div class="login-container">
    <h2>Log Masuk</h2>
    <form id="login-form" action='includes/login.inc.php' method='POST'>
      <label for="ic-number">Nombor Kad Pengenalan</label>
      <input type="number" id="ic-number" name="ic-number" required />

      <label for="password">Katalaluan</label>
      <input type="password" id="password" name="password" required />

      <div class="remember-me">
        <input type="checkbox" id="remember-me" name="remember-me" />
        <label for="remember-me">Ingat saya di komputer ini</label>
      </div>

      <?php
      processErrors();
      ?>
      <button type="submit">Log Masuk</button>
    </form>
  </div>
  <script src="javascript/common.js"></script>
</body>

</html>