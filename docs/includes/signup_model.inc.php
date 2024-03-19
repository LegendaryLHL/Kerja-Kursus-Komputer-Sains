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

function login(object $pdo, string $ic_number, string $password)
{
    $query = "SELECT * FROM majikan WHERE katalaluan_majikan = :password AND no_kp_majikan = :ic_number LIMIT 1;";
    $stmt = $pdo->prepare($query);

    $option = [
        'cost' => 12
    ];
    // temp
    //$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $option);
    $hashedPassword = $password;
    $stmt->bindParam(":ic_number", $ic_number);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $data = $result;
        $_SESSION['name'] = $data['nama'];
        $_SESSION['status'] = 'majikan';
        $_SESSION['ic_number'] = 'no_kp_majikan';
    } else {
        $query = "SELECT * FROM pekerja WHERE katalaluan_pekerja = :password AND no_kp_pekerja = :ic_number LIMIT 1;";
        $stmt = $pdo->prepare($query);

        $option = [
            'cost' => 12
        ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $option);
        $stmt->bindParam(":ic_number", $ic_number);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $data = $result;
            $_SESSION['name'] = $data['nama'];
            $_SESSION['status'] = 'pekerja';
            $_SESSION['ic_number'] = 'no_kp_pekerja';
        } else {
            $errors = [];
            $errors['failed_login'] = "Nombor kad pengenalan atau kata laluan salah!";
            $_SESSION['errors'] = $errors;
        }
    }
}
