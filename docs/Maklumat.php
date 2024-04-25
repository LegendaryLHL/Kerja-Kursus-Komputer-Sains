<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="css/Maklumat.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  require_once 'includes/check_user.php';
  require_once 'includes/config_session.inc.php';
  ?>

  <form id="form" class="container" action="includes/other.php" method="POST">
    <p>Tempat kerja adalah di: <span id="gps-location"></span></p>
    <?php if ($_SESSION['status'] == "majikan") { ?>
      <div id="change-coord">
        <input type="text" name="longitude" id="longitude-input" placeholder="longitude" />
        <input type="text" name="latitude" id="latitude-input" placeholder="latitude" />
        <button type="submit" id="coordinate-change-button">Tukar kordinate</button>
      </div>
      <div id="change-key">
        <input type="text" name="key" id="latitude-input" placeholder="kunci" />
        <button type="submit" id="key-change-button">Tukar Kunci</button>
      </div>
      <input type="hidden" name="request" id="request-input" />
    <?php } ?>
  </form>
  <script src="javascript/Maklumat.js"></script>
  <script src="javascript/common.js"></script>
</body>

</html>