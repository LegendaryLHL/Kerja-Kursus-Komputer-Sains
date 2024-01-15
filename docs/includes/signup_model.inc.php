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
