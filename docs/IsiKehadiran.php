<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="css/IsiKehadiran.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  require_once 'includes/check_user.php';
  require_once 'includes/kehadiran_model.inc.php';
  require_once 'includes/signup_model.inc.php';
  require_once 'includes/dbh.inc.php';
  require_once 'includes/other_model.inc.php';

  # menuliskan coordinate untuk digunakan dalam javascript
  echo '<p style="display: none" id="longitude">' . getLong($pdo) . '</p>';
  echo '<p style="display: none" id="latitude">' . getLat($pdo) . '</p>';
  ?>
  <form id="kehadiran-form" action='includes/kehadiran.inc.php' method='POST'>
    <div class="info-box">
      <p class="date-box">Tarikh: <span id="date"></span></p>
      <?php
      # jika sudah ada kehadiran bermaksud papar skrin habis kerja
      $kehadiran = getKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja']);
      if ($kehadiran) {
        if ($kehadiran['ada_hadir'] == 0) {
          echo
          '<p>Tidak Bekerja</p>';
        } else {
          echo
          '<p>Habis kerja?</p>
            <input type="hidden" name="isFinish" value="true">
          </div>
          <button type="submit" id="submit-button">Habis</button>';
        }
      } else {
      ?>
        <!-- isi kehadiran jika menepati syarat -->
        <p>
          <span id="gps-location" data-tooltip="Sedang kira jarak...">
            Sedang cari GPS...
          </span>
        </p>
        <input type="text" id="key-input" name="key" onkeyup="keyInput()" placeholder="kunci..." style="display: none" autocomplete="off" />
        <input type="hidden" id="using-key" name="using-key" value="false">
        <input type="hidden" name="isFinish" value="false">
    </div>
    <div class="bullet-box">
      <div id="bullet-form">
        <p>Adakah anda hadir untuk bekerja?</p>
        <div class="question">
          <input type="radio" name="can-go-work" value="Saya boleh hadir" id="yes-radio" required />
          <label for="yes-radio">Saya boleh hadir</label>
        </div>
        <div class="question">
          <input type="radio" name="can-go-work" value="Saya tidak boleh hadir" id="no-radio" required />
          <label for="no-radio">Saya tidak boleh hadir</label>
        </div>
      </div>
    </div>
    <div class="reason-box">
      <label for="reason">Tuliskan sebab tidak hadir untuk bekerja</label>
      <input type="reason" id="reason" name="reason" placeholder="Jawapan anda" autocomplete="off" />
    </div>
  <?php
        processErrors();
        echo
        '<button type="submit" id="submit-button">Hantar</button>';
      }
  ?>
  </form>
  <script src="javascript/IsiKehadiran.js"></script>
  <script src="javascript/common.js"></script>
</body>

</html>