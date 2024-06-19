<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="lib/all.min.css" />
  <link rel="stylesheet" type="text/css" href="css/AnalisisKehadiran.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="stylesheet" href="lib/flatpickr.min.css">
  <script src="lib/flatpickr.js"></script>
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  require_once 'includes/check_user.php';
  require_once 'includes/signup_view.inc.php';
  processSucess();
  ?>

  <form id="form">
    <!-- jadual untuk menganalisis kehadiran -->
    <table id="attendanceTable">
      <tr>
        <th colspan="3" id="title-row">
          <div id="title-container">
            <div id="left-container">
              <div id="date-segment">
                <span id="day-segment-value">1</span>
                <span id="month-segment-value">Januari</span>
                <span id="year-segment-value">2024</span>
              </div>
              <div class="selector no-print">
                <select id="selector-dropdown">
                  <option value="day">Hari</option>
                  <option value="month">Bulan</option>
                  <option value="year">Tahun</option>
                </select>
              </div>
              <div class="button no-print">
                <button class="realButton">Balik</button>
              </div>
              <div class="button no-print">
                <button class="realButton">Depan</button>
              </div>
              <div class="calendar no-print" id="calendar">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <input type="text" id="date-picker">
              </div>
              <!-- butang untuk membesar, menperkecilkan dan mencetak-->
              <div class="teachers no-print" onclick="fontChange(1)">+</div>
              <div class=" teachers no-print" onclick="fontChange(-1)">-</div>
              <div class=" teachers no-print" onclick="resetFont()">set balik</div>
              <div class="teachers no-print" onclick="print()">cetak</div>
            </div>

            <div class="no-print" id="search">
              <input type="text" id="search-input" onkeyup="searchTable()" placeholder="Cari..." />
              <div id="search-box">
                <span><i class="fas fa-search fa-fw"></i></span>
              </div>
            </div>
        </th>
      </tr>
      <tr>
        <th>Bil</th>
        <th>Nama</th>
        <th>Kehadiran</th>
      </tr>
      <?php
      # mengisi jadual dengan data
      try {
        require_once 'includes/dbh.inc.php';
        require_once 'includes/signup_model.inc.php';
        require_once 'includes/kehadiran_model.inc.php';
        $count = 1;
        $start_date;
        $end_date;
        if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
          $start_date = $_GET['start_date'];
          $end_date = $_GET['end_date'];
        } else {
          $start_date = date('Y-m-d');
          $end_date = date('Y-m-d');
        }
        foreach (getAllPekerja($pdo) as $pekerja) {
          $id_pekerja = getPekerja($pdo, $pekerja['nama_pekerja'])['id_pekerja'];
          echo
          '<tr class="data-row">
          <td>' . $count . '</td>
          <td>' .
            htmlspecialchars($pekerja['nama_pekerja']) .
            '<p class="worker-id" style="display: none;">' . htmlspecialchars($pekerja['id_pekerja']) . '</p> 
          </td>
          <td>' . countHariDatang($pdo, $start_date, $end_date, $id_pekerja)['bilangan_hari_datang'] . '/' . countHariBekerja($pdo, $start_date, $end_date, $id_pekerja)['bilangan_hari_bekerja'] . ' </td>';
          $count++;
        }
      } catch (PDOException $e) {
        die("Analisis db failed: " . $e->getMessage());
      }
      ?>
    </table>
  </form>
  <script src="javascript/AnalisisKehadiran.js"></script>
  <script src="javascript/common.js"></script>
</body>

</html>