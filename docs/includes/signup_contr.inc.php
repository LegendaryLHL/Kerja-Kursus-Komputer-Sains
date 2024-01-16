<?php

declare(strict_types=1);

function isEmpty(string $name, string $ic_number, string $password)
{
    if (empty($name) || empty($ic_number) || empty($password)) {
        return true;
    }
    return false;
}

function isNameExist(object $pdo, string $name)
{
    if (getName($pdo, $name)) {
        return true;
    }
    return false;
}

function createUser(object $pdo, string $name, string $ic_number, string $password)
{
    setUser($pdo, $name, $ic_number, $password);
}
