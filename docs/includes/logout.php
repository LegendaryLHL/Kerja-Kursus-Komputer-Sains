<?php
session_start();
session_unset();
session_destroy();

setcookie('ic_number', '', time() - 3600, "/");
setcookie('password', '', time() - 3600, "/");

header("Location: ../index.php");
