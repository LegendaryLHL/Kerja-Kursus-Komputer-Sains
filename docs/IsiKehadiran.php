<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="lib/all.min.css" />
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
          if ($kehadiran['masa_tamat'] == null) {
            echo
            '<p>Habis kerja?</p>
            <input type="hidden" name="isFinish" value="true">
            </div>
            <button type="submit" id="submit-button">Habis</button>';
          } else {
            $dateTime = new DateTime($kehadiran['masa_tamat']);
            echo
            '<p>Sudah Tamat bekerja pada ' . $dateTime->format('H:i:s') . '</p>';
          }
        }
      } else {
      ?>
        <!-- isi kehadiran jika menepati syarat -->
        <p>
          Kunci Kehadiran
        </p>
        <input type="text" id="key-input" name="key" placeholder="kunci..." autocomplete="off" />
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