<?php
echo '<nav class="navbar">
      <a href="./" class="brand-title">PkjKehadiran</a>
      <a class="toggle-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </a>
      <div class="navbar-links">
        <a href="IsiKehadiran.php">Isi Kehadiran</a>
        <a href="AnalisisKehadiran.php">Analisis Kehadiran</a>
        <a href="KonfigurasiPekerja.php">Konfigurasi Pekerja</a>
        <div class="info-container">
          <a id="info-button"
            >Info
            <span class="caret"></span>
          </a>
          <div id="info-content" class="content">
            <a href="Maklumat.php">Maklumat</a>
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
          <a href="#">Profil <i class="fa fa-pencil"></i></a>
          <a href="#">Log keluar <i class="fa fa-sign-in"></i></a>
        </div>
      </div>
    </nav>';
