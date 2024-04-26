<?php

declare(strict_types=1);

function getPekerja(object $pdo, string $name)
{
    $query = "SELECT * FROM pekerja WHERE nama_pekerja = :name LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getPekerjaNoKp(object $pdo, string $nokp)
{
    $query = "SELECT * FROM pekerja WHERE no_kp_pekerja = :nokp LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nokp", $nokp);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getMajikan(object $pdo, string $name)
{
    $query = "SELECT * FROM majikan WHERE nama_majikan = :name LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function getPekerjaId(object $pdo, int $id)
{
    $query = "SELECT * FROM pekerja WHERE id_pekerja = :id LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function getMajikanId(object $pdo, int $id)
{
    $query = "SELECT * FROM majikan WHERE id_majikan = :id LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getMajikanNoKp(object $pdo, string $nokp)
{
    $query = "SELECT * FROM majikan WHERE no_kp_majikan = :nokp LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nokp", $nokp);
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
function getAllMajikan(object $pdo)
{
    $query = "SELECT * FROM majikan";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function setPekerja(object $pdo, string $name, string $ic_number, string $password)
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

function setMajikan(object $pdo, string $name, string $ic_number, string $password)
{
    $query = "INSERT INTO majikan (nama_majikan, katalaluan_majikan, no_kp_majikan) VALUES (:name, :password, :ic_number);";
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
function changePassMajikan(object $pdo, int $id, string $new_pass)
{
    $query = "UPDATE majikan SET katalaluan_majikan = :new_pass WHERE id_majikan = :id;";
    $stmt = $pdo->prepare($query);

    $option = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($new_pass, PASSWORD_BCRYPT, $option);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":new_pass", $hashedPwd);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function changePassPekerja(object $pdo, int $id, string $new_pass)
{
    $query = "UPDATE pekerja SET katalaluan_pekerja = :new_pass WHERE id_pekerja = :id;";
    $stmt = $pdo->prepare($query);

    $option = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($new_pass, PASSWORD_BCRYPT, $option);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":new_pass", $hashedPwd);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function removePekerja(object $pdo, string $name)
{
    try {
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
function removePekerjaId(object $pdo, int $id)
{
    try {
        // Check if the worker exists
        $worker = getPekerjaId($pdo, $id);

        // If the worker exists, remove them
        if ($worker) {
            $deleteQuery = "DELETE FROM pekerja WHERE id_pekerja = :id;";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindParam(":id", $id);
            $deleteStmt->execute();
        } else {
            echo 'Worker not found.';
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        die("db failed: " . $e->getMessage());
    }
}
function removeMajikanId(object $pdo, int $id)
{
    try {
        // Check if the worker exists
        $employer = getMajikanId($pdo, $id);

        // If the worker exists, remove them
        if ($employer) {
            $deleteQuery = "DELETE FROM majikan WHERE id_majikan = :id;";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindParam(":id", $id);
            $deleteStmt->execute();
        } else {
            echo 'Employer not found.';
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        die("db failed: " . $e->getMessage());
    }
}

function login(object $pdo, string $ic_number, string $password)
{
    $majikan = getMajikanNoKp($pdo, $ic_number);
    if ($majikan && (password_verify($password, $majikan["katalaluan_majikan"]) || $password == $majikan["katalaluan_majikan"])) {
        $_SESSION['name'] = $majikan['nama_majikan'];
        $_SESSION['status'] = 'majikan';
        $_SESSION['ic_number'] = $ic_number;
        $_SESSION['id'] = $majikan['id_majikan'];
    } else {
        $pekerja = getPekerjaNoKp($pdo, $ic_number);
        if ($pekerja && (password_verify($password, $pekerja["katalaluan_pekerja"]) || $password == $pekerja["katalaluan_pekerja"])) {
            $_SESSION['name'] = $pekerja['nama_pekerja'];
            $_SESSION['status'] = 'pekerja';
            $_SESSION['ic_number'] = $ic_number;
            $_SESSION['id'] = $pekerja['id_pekerja'];
        } else {
            $errors = [];
            $errors['failed_login'] = "Nombor kad pengenalan atau kata laluan salah!";
            $_SESSION['errors'] = $errors;
        }
    }
}
