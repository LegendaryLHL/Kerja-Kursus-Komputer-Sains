<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="lib/all.min.css" />
  <link rel="stylesheet" type="text/css" href="css/TukarKunci.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  require_once 'includes/check_user.php';
  require_once 'includes/config_session.inc.php';
  require_once 'includes/dbh.inc.php';
  # menuliskan coordinate untuk digunakan dalam javascript
  require_once 'includes/signup_view.inc.php';
  processSucess();
  ?>

  <form id="form" class="container" action="includes/other.inc.php" method="POST">
    <!-- menyemak sama ada majikan -->
    <?php if ($_SESSION['status'] == "majikan") { ?>
      <!-- tempat tukar kunci-->
      <div id="change-key">
        <input type="text" name="key" id="latitude-input" placeholder="kunci kehadiran" />
        <button type="submit" id="key-change-button">Tukar Kunci</button>
      </div>
      <input type="hidden" name="request" id="request-input" />
    <?php } ?>
  </form>
  <script src="javascript/TukarKunci.js"></script>
  <script src="javascript/common.js"></script>
</body>

</html>