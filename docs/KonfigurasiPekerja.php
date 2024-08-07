<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="lib/all.min.css" />
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
            <input type="text" id="searchInput" placeholder="Cari..." />
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
          # memaparkan pekerja dari database dengan query
          foreach (getAllPekerja($pdo, (isset($_GET['query']) ? $_GET['query'] : '%')) as $pekerja) {
            echo
            '<div class="worker-card">
                  <p class="worker-name">' . htmlspecialchars($pekerja['nama_pengguna']) . '</p>
                  <p class="worker-id" style="display: none;">' . htmlspecialchars($pekerja['id_pengguna']) . '</p>
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
            <input type="text" id="searchInput" placeholder="Cari..." />
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
          foreach (getAllMajikan($pdo, (isset($_GET['query']) ? $_GET['qeury'] : '%')) as $majikan) {
            echo
            '<div class="worker-card">
                  <p class="worker-name">' . htmlspecialchars($majikan['nama_pengguna']) . '</p>
                  <p class="worker-id" style="display: none;">' . htmlspecialchars($majikan['id_pengguna']) . '</p>
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