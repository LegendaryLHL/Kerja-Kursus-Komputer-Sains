<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_model.inc.php';
require_once 'includes/signup_view.inc.php';
?>

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
  <nav class="navbar">
    <a href="index.html" class="brand-title">PkjKehadiran</a>
    <a class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <a href="IsiKehadiran.html">Isi Kehadiran</a>
      <a href="AnalisisKehadiran.html">Analisis Kehadiran</a>
      <a href="KonfigurasiPekerja.php" id="selected">Konfigurasi Pekerja</a>
      <div class="info-container">
        <a id="info-button">Info
          <span class="caret"></span>
        </a>
        <div id="info-content" class="content">
          <a href="Maklumat.html">Maklumat</a>
          <a href="#">Bantuan</a>
        </div>
      </div>
    </div>
    <div class="user">
      <a href="#" id="user-button">
        <i class="fas fa-user-alt"></i>
        Guest
        <span class="caret"></span>
      </a>
      <div id="user-content" class="content">
        <a href="#">Log keluar <i class="fa fa-sign-in"></i></a>
        <a href="#">Profil <i class="fa fa-pencil"></i></a>
      </div>
    </div>
  </nav>

  <div class="container">
    <div id="workers-container">
      <div id="search-container">
        <input type="text" id="searchInput" onkeyup="searchGrid()" placeholder="Cari..." />
        <div id="search-box">
          <span><i class="fas fa-search fa-fw"></i></span>
        </div>
      </div>
      <div class="worker-grid">
        <button class="add-worker-button">
          <i class="fas fa-plus"></i>
          Tambah Pekerja
        </button>
        <?php
        try {
          require_once 'includes/dbh.inc.php';
          printAllPekerja($pdo);
        } catch (PDOException $e) {
          die("Signup db failed: " . $e->getMessage());
        }
        ?>
      </div>
    </div>
    <form action="includes/signup.inc.php" method="post" id="add-worker-form">
      <div class="add-worker-container">
        <div class="info-box">
          <p class="title-box">Tambah Pekerja</p>
        </div>
        <div class="form-box">
          <div id="form-form">
            <label for="nama">Nama</label>
            <input type="name" id="nama" name="name" placeholder="Jawapan anda" />
            <label for="nombor-kad-pengenalan">Nombor Kad Pengenalan</label>
            <input type="ic-number" id="nombor-kad-pengenalan" name="ic-number" placeholder="Jawapan anda" />
            <label for="kata-laluan">Kata Laluan</label>
            <input type="password" id="kata-laluan" name="password" placeholder="Jawapan anda" />
          </div>
        </div>

        <?php
        checkSignupErrors();
        ?>
        <button id="submit-button" type="submit">Hantar</button>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="javascript/common.js"></script>
  <script src="javascript/KonfigurasiPekerja.js"></script>
</body>

</html>