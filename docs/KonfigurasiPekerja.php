<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="stylesheet" type="text/css" href="css/KonfigurasiPekerja.css" />
  <title>PkjKehadiran</title>
</head>

<body>
  <?php
  require_once 'navbar.php';
  require_once 'includes/check_admin.php';
  ?>

  <div class="container">
    <?php

    require_once 'includes/signup_view.inc.php';
    processSucess();
    # jika jenis sudah dipilih
    if (isset($_GET["selected"])) {
      # memapar skrin untuk mengkonfigurasi pekerja
      if ($_GET["selected"] == "pekerja") {
        echo
        '<div id="workers-container">
          <div id="search-container">
            <input type="text" id="searchInput" onkeyup="searchGrid()" placeholder="Cari..." />
            <div id="search-box">
              <span><i class="fas fa-search fa-fw"></i></span>
            </div>
          </div>
          <div class="worker-grid">
            <button id="add-worker-button">
              <i class="fas fa-plus"></i>
              Tambah Pekerja
            </button>';
        try {
          require_once 'includes/dbh.inc.php';
          require_once 'includes/signup_model.inc.php';
          # memaparkan pekerja dari database
          foreach (getAllPekerja($pdo) as $pekerja) {
            echo
            '<div class="worker-card">
                  <p class="worker-name">' . htmlspecialchars($pekerja['nama_pekerja']) . '</p>
                  <p class="worker-id" style="display: none;">' . htmlspecialchars($pekerja['id_pekerja']) . '</p>
                </div>';
          }
        } catch (PDOException $e) {
          die("Signup db failed: " . $e->getMessage());
        }
        echo '</div>';
      } else {
        # memapar skrin untuk mengkonfigurasi majikan
        echo
        '<div id="workers-container">
          <div id="search-container">
            <input type="text" id="searchInput" onkeyup="searchGrid()" placeholder="Cari..." />
            <div id="search-box">
              <span><i class="fas fa-search fa-fw"></i></span>
            </div>
          </div>
          <div class="worker-grid">
            <button id="add-employer-button">
              <i class="fas fa-plus"></i>
              Tambah Majikan
            </button>';
        try {
          require_once 'includes/dbh.inc.php';
          require_once 'includes/signup_model.inc.php';
          # memapar majikan dari database
          foreach (getAllMajikan($pdo) as $majikan) {
            echo
            '<div class="worker-card">
                  <p class="worker-name">' . htmlspecialchars($majikan['nama_majikan']) . '</p>
                  <p class="worker-id" style="display: none;">' . htmlspecialchars($majikan['id_majikan']) . '</p>
                </div>';
          }
        } catch (PDOException $e) {
          die("Signup db failed: " . $e->getMessage());
        }
      }
    } else {
      # tempat untuk pilih jenis konfigurasi
      echo
      '<div id="workers-container">
          <div class="worker-grid">
            <button id="select-worker-button">
              <i class="fas fa-plus"></i>
              Konfigurasi Pekerja
            </button>
            <button id="select-employer-button">
              <i class="fas fa-plus"></i>
              Konfigurasi Majikan
            </button>
          </div>
      </div>';
    }
    ?>

  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="javascript/common.js"></script>
  <script src="javascript/KonfigurasiPekerja.js"></script>
</body>

</html>