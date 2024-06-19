<?php
require_once 'includes/config_session.inc.php';
# untuk mendapatkan nama fail semasa
$currentFile = $_SERVER['PHP_SELF'];
$parts = explode('/', $currentFile);
$currentPage = end($parts);
?>
<!-- header -->
<nav class="navbar">
  <a href="./" class="brand-title">PkjKehadiran</a>
  <a class="toggle-button">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </a>
  <!-- links -->
  <div class="navbar-links">
    <?php if (isset($_SESSION['status'])) { ?>
      <!-- pekerja sahaja -->
      <?php if ($_SESSION['status'] == "pekerja") { ?>
        <a href="IsiKehadiran.php" <?php if ($currentPage === 'IsiKehadiran.php') echo 'id="selected"' ?>>Isi Kehadiran</a>
      <?php } ?>
      <!-- majikan sahaja -->
      <a href="AnalisisKehadiran.php" <?php if ($currentPage === 'AnalisisKehadiran.php') echo 'id="selected"' ?>>Analisis Kehadiran</a>
      <?php if ($_SESSION['status'] == "majikan") { ?>
        <a href="KonfigurasiPekerja.php" <?php if ($currentPage === 'KonfigurasiPekerja.php') echo 'id="selected"' ?>>Konfigurasi Pekerja</a>
        <a href="MuatNaikPekerja.php" <?php if ($currentPage === 'MuatNaikPekerja.php') echo 'id="selected"' ?>>Muat Naik Pekerja</a>
        <a href="TukarKunci.php" <?php if ($currentPage === 'TukarKunci.php') echo 'id="selected"' ?>>Tukar Kunci</a>
      <?php } ?>
    <?php } ?>
  </div>
  <!-- user -->
  <div class="user">
    <a id="user-button">
      <i class="fas fa-user-alt"></i>
      <!-- letakkan nama jika ada login -->
      <?php if (isset($_SESSION["name"])) {
        echo htmlspecialchars($_SESSION["name"]);
      } else {
        echo "Guest";
      } ?>
      <span class="caret"></span>
    </a>
    <div id="user-content" class="content">
      <!-- meletakkan tempat page matlamat -->
      <a href=<?php if (isset($_SESSION["id"])) {
                echo "Profil.php?selected=" . $_SESSION['status'] . "&id=" . $_SESSION['id'];
              } else {
                echo "./";
              } ?> <?php
                    if (
                      $currentPage === 'Profil.php' && isset($_SESSION['status']) &&
                      isset($_GET['id']) && isset($_GET['selected']) &&
                      $_GET['selected'] == $_SESSION['status'] && $_GET['id'] == $_SESSION['id']
                    )
                      echo 'id="selected"'
                    ?>>
        Profil <i class="fa fa-pencil"></i></a>
      <a href="includes/logout.php">Log keluar <i class="fa fa-sign-in"></i></a>
    </div>
  </div>
</nav>