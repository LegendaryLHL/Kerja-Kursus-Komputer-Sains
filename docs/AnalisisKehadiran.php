<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="css/AnalisisKehadiran.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  require_once 'includes/check_user.php';
  ?>

  <form id="form">
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
              <input type="hidden" name="start_date" id="startDateInput">
              <input type="hidden" name="end_date" id="endDateInput">
              <input type="hidden" name="selected" id="selectedInput">
              <div id="isDefault" style="display: none;">
                <?php if (isset($_GET["start_date"])) {
                  echo "false";
                } else {
                  echo "true";
                } ?></div>
              <div id="selected" style="display:none;">
                <?php
                if (isset($_GET["selected"])) {
                  echo $_GET["selected"];
                } ?>
              </div>
              <div id="startDate" style=" display:none;">
                <?php
                if (isset($_GET["start_date"])) {
                  echo $_GET["start_date"];
                } ?>
              </div>
              <div class="selector">

                <select id="selector-dropdown">
                  <option value="day">Hari</option>
                  <option value="month">Bulan</option>
                  <option value="year">Tahun</option>
                </select>
              </div>
              <div class="button">
                <button class="realButton">Balik</button>
              </div>
              <div class="button">
                <button class="realButton">Depan</button>
              </div>
              <div class="calendar" id="calendar">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
            </div>

            <div id="search">
              <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari..." />
              <div id="search-box">
                <span><i class="fas fa-search fa-fw"></i></span>
              </div>
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
          <td> ' . $count . '</td>
          <td> ' . htmlspecialchars($pekerja['nama_pekerja']) . '</td>
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