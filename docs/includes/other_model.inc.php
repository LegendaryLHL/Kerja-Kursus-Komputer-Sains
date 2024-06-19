<?php

# meletakkan kunci rahsia baharu
function setKey(object $pdo, string $key)
{
    # jika tiada rekod dalam table other, maka masukkan rekod kosong kerana table other hanya boleh ada satu rekod yang boleh null
    if (!issetOther($pdo)) {
        insertOther($pdo);
    }
    $query = "UPDATE other SET secret_key = :new_secret_key;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":new_secret_key", $key);
    $stmt->execute();

    return;
}

# mendapatkan kunci rahsia
function getKey(object $pdo)
{
    # jika tiada rekod dalam table other, maka masukkan rekod kosong kerana table other hanya boleh ada satu rekod yang boleh null
    if (!issetOther($pdo)) {
        insertOther($pdo);
    }
    $query = "SELECT secret_key FROM other";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_COLUMN);
    if ($result == NULL) {
        $result = "No key1234";
    }
    return $result;
}

# menambah rekod kosong ke dalam table other
function insertOther(object $pdo)
{
    $query = "INSERT INTO other (longitude, latitude, secret_key) VALUES (NULL, NULL, NULL);";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}

# menyemak sama ada terdapat rekod dalam table other
function issetOther(object $pdo)
{
    $query = "SELECT * from other";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result > 0;
}
