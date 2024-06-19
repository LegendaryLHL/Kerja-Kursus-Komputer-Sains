<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="lib/all.min.css" />
  <link rel="stylesheet" type="text/css" href="css/Maklumat.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  require_once 'includes/check_user.php';
  require_once 'includes/config_session.inc.php';
  require_once 'includes/dbh.inc.php';
  require_once 'includes/other_model.inc.php';
  # menuliskan coordinate untuk digunakan dalam javascript
  echo '<p style="display: none" id="longitude">' . getLong($pdo) . '</p>';
  echo '<p style="display: none" id="latitude">' . getLat($pdo) . '</p>';
  ?>

  <form id="form" class="container" action="includes/other.inc.php" method="POST">
    <!-- memaparkan tempat bekerja -->
    <p>Tempat kerja adalah di: <span id="gps-location"></span></p>

    <!-- menyemak sama ada majikan -->
    <?php if ($_SESSION['status'] == "majikan") { ?>

      <!-- tempat tukar coordiante -->
      <div id="change-coord">
        <input type="text" name="longitude" id="longitude-input" placeholder="longitude" />
        <input type="text" name="latitude" id="latitude-input" placeholder="latitude" />
        <button type="submit" id="coordinate-change-button">Tukar kordinate</button>
      </div>

      <!-- tempat tukar kunci-->
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