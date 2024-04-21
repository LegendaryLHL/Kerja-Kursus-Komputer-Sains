<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;

session_set_cookie_params([
    'lifetime' => 18000,
    'domain' => $domain,
    'path' => '/',
    'secure' => false, // less secure
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

if (!isset($_SESSION["last_regeneration"])) {
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
} else {
    $interval = 60 * 30;
    if (time() - $_SESSION["last_regeneration"] >= 60 * 30) {
        session_regenerate_id();
        $_SESSION["last_regeneration"] = time();
    }
}
