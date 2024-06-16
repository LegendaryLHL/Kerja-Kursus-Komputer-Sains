<?php
require_once 'includes/config_session.inc.php';
$currentFile = $_SERVER['PHP_SELF'];
$parts = explode('/', $currentFile);
$currentPage = end($parts);
?>
<nav class="navbar">
  <a href="./" class="brand-title">PkjKehadiran</a>
  <a class="toggle-button">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </a>
  <div class="navbar-links">
    <?php if (isset($_SESSION['status'])) { ?>
      <?php if ($_SESSION['status'] == "pekerja") { ?>
        <a href="IsiKehadiran.php" <?php if ($currentPage === 'IsiKehadiran.php') echo 'id="selected"' ?>>Isi Kehadiran</a>
      <?php } ?>
      <a href="AnalisisKehadiran.php" <?php if ($currentPage === 'AnalisisKehadiran.php') echo 'id="selected"' ?>>Analisis Kehadiran</a>
      <?php if ($_SESSION['status'] == "majikan") { ?>
        <a href="KonfigurasiPekerja.php" <?php if ($currentPage === 'KonfigurasiPekerja.php') echo 'id="selected"' ?>>Konfigurasi Pekerja</a>
        <a href="MuatNaikPekerja.php" <?php if ($currentPage === 'MuatNaikPekerja.php') echo 'id="selected"' ?>>Muat Naik Pekerja</a>
      <?php } ?>
      <div class="info-container">
        <a id="info-button">Info
          <span class="caret"></span>
        </a>
        <div id="info-content" class="content">
          <a href="Maklumat.php" <?php if ($currentPage === 'Maklumat.php') echo 'id="selected"' ?>>Maklumat</a>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="user">
    <a id="user-button">
      <i class="fas fa-user-alt"></i>
      <?php if (isset($_SESSION["name"])) {
        echo htmlspecialchars($_SESSION["name"]);
      } else {
        echo "Guest";
      } ?>
      <span class="caret"></span>
    </a>
    <div id="user-content" class="content">
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