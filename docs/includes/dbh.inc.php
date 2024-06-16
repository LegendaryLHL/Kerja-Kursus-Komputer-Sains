<?php

$host = 'localhost';
$dbname = 'hl_kehadiran';
$dbusername = 'root';
$dbpassword = '';

# mendapatkan database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("error " . $e->getMessage());
}
