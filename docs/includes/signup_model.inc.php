<?php

declare(strict_types=1);

# mendapatkan pekerja dengan nama
function getPenggunaNama(object $pdo, string $name)
{
    $query = "SELECT * FROM pengguna WHERE nama_pengguna = :name AND adalah_majikan = 0 LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan pekerja dengan no_kp
function getPenggunaNoKp(object $pdo, string $nokp)
{
    # query untuk mendapatkan pekerja dengan no_kp
    $query = "SELECT * FROM pengguna WHERE no_kp_pengguna = :nokp LIMIT 1;";

    # melaksanakan statement
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nokp", $nokp);
    $stmt->execute();

    # memulangkan hasil
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# mendapatkan pekerja dengan id
function getPengguna(object $pdo, int $id)
{
    $query = "SELECT * FROM pengguna WHERE id_pengguna = :id LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


# mendapatkan semua pekerja menguna query
function getAllPekerja(object $pdo, string $queryName = '%')
{
    # query untuk mendapatkan semua pekerja
    $query = "SELECT * FROM pengguna WHERE UPPER(nama_pengguna) LIKE :query AND adalah_majikan = 0;";
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
    $query = "SELECT * FROM pengguna WHERE UPPER(nama_pengguna) LIKE :query AND adalah_majikan = 1;";
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
    $query = "INSERT INTO pengguna (nama_pengguna, katalaluan_pengguna, no_kp_pengguna, adalah_majikan) VALUES (:name, :password, :ic_number, 0);";
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
    $query = "INSERT INTO pengguna (nama_pengguna, katalaluan_pengguna, no_kp_pengguna, adalah_majikan) VALUES (:name, :password, :ic_number, 1);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":ic_number", $ic_number);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# menukar kata laluan majikan
function changePass(object $pdo, int $id, string $new_pass)
{
    $query = "UPDATE pengguna SET katalaluan_pengguna = :new_pass WHERE id_pengguna = :id;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":new_pass", $new_pass);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

# membuang pekerja
function remove(object $pdo, int $id)
{
    try {
        # menyemak sama ada pekerja wujud
        $worker = getPengguna($pdo, $id);

        # jika pekerja wujud, maka buang pekerja itu
        if ($worker) {
            $deleteQuery = "DELETE FROM pengguna WHERE id_pengguna = :id;";
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
    $pengguna = getPenggunaNoKp($pdo, $ic_number);
    # jika majikan wujud dan kata laluan sama dengan yang dimasukkan sama ada dihash atau tidak
    if ($pengguna && $password == $pengguna["katalaluan_pengguna"]) {
        $_SESSION['name'] = $pengguna['nama_pengguna'];
        $_SESSION['status'] = $pengguna['adalah_majikan'] ? 'majikan' : 'pekerja';
        $_SESSION['ic_number'] = $ic_number;
        $_SESSION['id'] = $pengguna['id_pengguna'];
    } else {
        # tidak dapat cara majikan atau pekerja maka telah gagal login
        $errors = [];
        $errors['failed_login'] = "Nombor kad pengenalan atau kata laluan salah!";
        $_SESSION['errors'] = $errors;
    }


    # jika remember me diaktifkan maka set cookie untuk mengingati login
    if ($remember && !isset($_SESSION['errors'])) {
        setcookie('ic_number', $ic_number, time() + 60 * 60 * 24 * 30);
        setcookie('password', $password, time() + 60 * 60 * 24 * 30);
    }
}
