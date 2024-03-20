<?php
require_once "config_session.inc.php";
if (!empty($_SESSION['status'])) {
    if ($_SESSION['status'] != "pekerja" && $_SESSION['status'] != "majikan") {
        die("<script> alert('Sila login tiada acess!'); 
        window.location.href='index.php'; </script>");
    }
} else {
    die("<script> alert('Sila login!'); 
    window.location.href='index.php'; </script>");
}
