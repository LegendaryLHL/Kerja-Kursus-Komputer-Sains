<?php
# membuang session dan cookie
session_start();
session_unset();
session_destroy();

setcookie('ic_number', '', time() - 3600, "/");
setcookie('password', '', time() - 3600, "/");

# balik he halaman utama
header("Location: ../index.php");
