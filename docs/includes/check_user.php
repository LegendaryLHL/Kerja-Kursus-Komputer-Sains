<?php
if (!empty($_SESSION['status'])) {
    if ($_SESSION['status'] != "pekerja") {
        die("<script> alert('Sila login!'); 
        window.location.href='../index.php'; </script>");
    }
} else {
    die("<script> alert('Sila login!'); 
    window.location.href='../index.php'; </script>");
}
