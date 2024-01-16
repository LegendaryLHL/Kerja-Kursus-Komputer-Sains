<?php

declare(strict_types=1);

function getName(object $pdo, string $name)
{
    $query = "SELECT nama_pekerja FROM pekerja WHERE nama_pekerja = :name;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getAllPekerja(object $pdo)
{
    $query = "SELECT * FROM pekerja";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function setUser(object $pdo, string $name, string $ic_number, string $password)
{
    $query = "INSERT INTO pekerja (nama_pekerja, katalaluan_pekerja, no_kp_pekerja) VALUES (:name, :password, :ic_number);";
    $stmt = $pdo->prepare($query);

    $option = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $option);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":ic_number", $ic_number);
    $stmt->bindParam(":password", $hashedPwd);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function removePekerja(string $name)
{
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    try {
        require_once 'dbh.inc.php';
        // Check if the worker exists
        $query = "SELECT nama_pekerja FROM pekerja WHERE nama_pekerja = :name;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // If the worker exists, remove them
        if ($result) {
            $deleteQuery = "DELETE FROM pekerja WHERE nama_pekerja = :name;";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindParam(":name", $name);
            $deleteStmt->execute();
        } else {
            echo 'Worker not found.';
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        die("db failed: " . $e->getMessage());
    }
}

// Check if the request is coming via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'removePekerja' && isset($_POST['nama_pekerja'])) {
        removePekerja($_POST['nama_pekerja']);
    } else {
        echo 'error';
    }
}
