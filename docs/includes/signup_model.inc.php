<?php

declare(strict_types=1);

# mendapatkan pekerja dengan nama
function getPekerja(object $pdo, string $name)
{
    $query = "SELECT * FROM pekerja WHERE nama_pekerja = :name LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan pekerja dengan no_kp
function getPekerjaNoKp(object $pdo, string $nokp)
{
    # query untuk mendapatkan pekerja dengan no_kp
    $query = "SELECT * FROM pekerja WHERE no_kp_pekerja = :nokp LIMIT 1;";

    # melaksanakan statement
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nokp", $nokp);
    $stmt->execute();

    # memulangkan hasil
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan majikan dengan nama
function getMajikan(object $pdo, string $name)
{
    $query = "SELECT * FROM majikan WHERE nama_majikan = :name LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan pekerja dengan id
function getPekerjaId(object $pdo, int $id)
{
    $query = "SELECT * FROM pekerja WHERE id_pekerja = :id LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan majikan dengan id
function getMajikanId(object $pdo, int $id)
{
    $query = "SELECT * FROM majikan WHERE id_majikan = :id LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan majikan dengan no_kp
function getMajikanNoKp(object $pdo, string $nokp)
{
    $query = "SELECT * FROM majikan WHERE no_kp_majikan = :nokp LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nokp", $nokp);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan semua pekerja menguna query
function getAllPekerja(object $pdo, string $queryName = '%')
{
    # query untuk mendapatkan semua pekerja
    $query = "SELECT * FROM pekerja WHERE UPPER(nama_pekerja) LIKE :query;";
    $stmt = $pdo->prepare($query);
    # mengikat parameter mencari pekerja dengan nama yang sama
    $searchQuery = '%' . strtoupper($queryName) . '%';
    $stmt->bindParam(":query", $searchQuery);
    $stmt->execute();

    # memulangkan hasil
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan semua majikan menguna query
function getAllMajikan(object $pdo, string $queryName = '%')
{
    $query = "SELECT * FROM majikan WHERE UPPER(nama_majikan) LIKE :query;";
    $stmt = $pdo->prepare($query);
    $searchQuery = '%' . strtoupper($queryName) . '%';
    $stmt->bindParam(":query", $searchQuery);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

# menambah pekerja
function setPekerja(object $pdo, string $name, string $ic_number, string $password)
{
    # query untuk memasukkan pekerja
    $query = "INSERT INTO pekerja (nama_pekerja, katalaluan_pekerja, no_kp_pekerja) VALUES (:name, :password, :ic_number);";
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":ic_number", $ic_number);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# menambah majikan
function setMajikan(object $pdo, string $name, string $ic_number, string $password)
{
    $query = "INSERT INTO majikan (nama_majikan, katalaluan_majikan, no_kp_majikan) VALUES (:name, :password, :ic_number);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":ic_number", $ic_number);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# menukar kata laluan majikan
function changePassMajikan(object $pdo, int $id, string $new_pass)
{
    $query = "UPDATE majikan SET katalaluan_majikan = :new_pass WHERE id_majikan = :id;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":new_pass", $new_pass);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# menukar kata laluan pekerja
function changePassPekerja(object $pdo, int $id, string $new_pass)
{
    $query = "UPDATE pekerja SET katalaluan_pekerja = :new_pass WHERE id_pekerja = :id;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":new_pass", $new_pass);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# membuang pekerja
function removePekerja(object $pdo, int $id)
{
    try {
        # menyemak sama ada pekerja wujud
        $worker = getPekerjaId($pdo, $id);

        # jika pekerja wujud, maka buang pekerja itu
        if ($worker) {
            $deleteQuery = "DELETE FROM pekerja WHERE id_pekerja = :id;";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindParam(":id", $id);
            $deleteStmt->execute();
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        die("db failed: " . $e->getMessage());
    }
}

# membuang majikan
function removeMajikan(object $pdo, int $id)
{
    try {
        # menyemak sama ada majikan wujud
        $employer = getMajikanId($pdo, $id);

        # jika pekerja wujud, maka buang majikan itu
        if ($employer) {
            $deleteQuery = "DELETE FROM majikan WHERE id_majikan = :id;";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindParam(":id", $id);
            $deleteStmt->execute();
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        die("db failed: " . $e->getMessage());
    }
}

# fungsi untuk membantu login
function login(object $pdo, string $ic_number, string $password, bool $remember)
{
    # mendapatkan majikan
    $majikan = getMajikanNoKp($pdo, $ic_number);
    # jika majikan wujud dan kata laluan sama dengan yang dimasukkan sama ada dihash atau tidak
    if ($majikan && (password_verify($password, $majikan["katalaluan_majikan"]) || $password == $majikan["katalaluan_majikan"])) {
        $_SESSION['name'] = $majikan['nama_majikan'];
        $_SESSION['status'] = 'majikan';
        $_SESSION['ic_number'] = $ic_number;
        $_SESSION['id'] = $majikan['id_majikan'];
    } else {
        # kalau tidak cari majikan cari untuk pekerja
        $pekerja = getPekerjaNoKp($pdo, $ic_number);
        if ($pekerja && $password == $pekerja["katalaluan_pekerja"]) {
            $_SESSION['name'] = $pekerja['nama_pekerja'];
            $_SESSION['status'] = 'pekerja';
            $_SESSION['ic_number'] = $ic_number;
            $_SESSION['id'] = $pekerja['id_pekerja'];
        } else {
            # tidak dapat cara majikan atau pekerja maka telah gagal login
            $errors = [];
            $errors['failed_login'] = "Nombor kad pengenalan atau kata laluan salah!";
            $_SESSION['errors'] = $errors;
        }
    }

    # jika remember me diaktifkan maka set cookie untuk mengingati login
    if ($remember && !isset($_SESSION['errors'])) {
        setcookie('ic_number', $ic_number, time() + 60 * 60 * 24 * 30);
        setcookie('password', $password, time() + 60 * 60 * 24 * 30);
    }
}
