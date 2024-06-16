<?php
require_once "config_session.inc.php";

# semak jika tidak login lagi
if (!empty($_SESSION['status'])) {

    # semak jika bukan majikan
    if ($_SESSION['status'] != "majikan") {

        # papar mesej dan redirect ke laman utama
        die("<script> alert('Tidak mencapai tahap majikan!'); 
        window.location.href='index.php'; </script>");
    }
} else {

    # papar mesej dan redirect ke laman utama
    die("<script> alert('Sila login!'); 
    window.location.href='index.php'; </script>");
}
