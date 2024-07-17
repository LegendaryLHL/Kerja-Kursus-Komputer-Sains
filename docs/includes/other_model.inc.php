<?php

# meletakkan kunci rahsia baharu
function setKey(object $pdo, string $key, int $id_majikan)
{
    # jika tiada rekod dalam table other, maka masukkan rekod kerana kunci_kehadiran ada satu rekod sahaja
    $query = "";
    if (!issetKunciKehadiran($pdo)) {
        $query = "INSERT INTO kunci_kehadiran (kunci, id_pengguna) VALUES (:new_secret_key, :id_pengguna);";
    } else {
        $query = "UPDATE kunci_kehadiran SET kunci = :new_secret_key, id_pengguna = :id_pengguna;";
    }
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_pengguna", $id_majikan);
    $stmt->bindParam(":new_secret_key", $key);
    $stmt->execute();

    return;
}

# mendapatkan kunci rahsia
function getKey(object $pdo)
{
    $query = "SELECT kunci FROM kunci_kehadiran";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_COLUMN);
    return $result;
}

# menyemak sama ada terdapat rekod dalam table other
function issetKunciKehadiran(object $pdo)
{
    $query = "SELECT * from kunci_kehadiran";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result > 0;
}
