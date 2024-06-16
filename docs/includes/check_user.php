<?php
require_once "config_session.inc.php";

# semak jika tidak login lagi
if (!empty($_SESSION['status'])) {

    # semak jika bukan pekerja atau majikan
    if ($_SESSION['status'] != "pekerja" && $_SESSION['status'] != "majikan") {

        # papar mesej dan redirect ke laman utama
        die("<script> alert('Sila login tiada acess!'); 
        window.location.href='index.php'; </script>");
    }
} else {
    # papar mesej dan redirect ke laman utama
    die("<script> alert('Sila login!'); 
    window.location.href='index.php'; </script>");
}
