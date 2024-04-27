<?php
function setKey(object $pdo, string $key)
{
    if (!issetOther($pdo)) {
        insertOther($pdo);
    }
    $query = "UPDATE other SET secret_key = :new_secret_key;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":new_secret_key", $key);
    $stmt->execute();

    return;
}
function setCoord(object $pdo, float $long, float $lat)
{
    if (!issetOther($pdo)) {
        insertOther($pdo);
    }
    $query = "UPDATE other SET longitude = :long, latitude = :lat;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":long", $long);
    $stmt->bindParam(":lat", $lat);
    $stmt->execute();

    return;
}

function getKey(object $pdo)
{
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
function getLat(object $pdo)
{
    if (!issetOther($pdo)) {
        insertOther($pdo);
    }
    $query = "SELECT latitude FROM other";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_COLUMN);
    if ($result == NULL) {
        $result = 2.984373436275586;
    }
    return $result;
}
function getLong(object $pdo)
{
    if (!issetOther($pdo)) {
        insertOther($pdo);
    }
    $query = "SELECT longitude FROM other";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_COLUMN);
    if ($result == NULL) {
        $result = 101.5413571958214;
    }
    return $result;
}
function insertOther(object $pdo)
{
    $query = "INSERT INTO other (longitude, latitude, secret_key) VALUES (NULL, NULL, NULL);";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}

function issetOther(object $pdo)
{
    $query = "SELECT * from other";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result > 0;
}
