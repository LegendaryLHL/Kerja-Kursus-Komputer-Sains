<?php
if (!empty($_SESSION['status'])) {
    if ($_SESSION['status'] != "majikan") {
        die("<script> alert('Tidak mencapai tahap majikan!'); 
        window.location.href='../index.php'; </script>");
    }
} else {
    die("<script> alert('Sila login!'); 
    window.location.href='../index.php'; </script>");
}
