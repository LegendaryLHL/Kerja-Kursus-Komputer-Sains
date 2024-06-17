<?php

declare(strict_types=1);

# fungsi-fungsi yang digunakan untuk menyemak pendaftaran

function isNameExist(object $pdo, string $name)
{
    if (getPekerja($pdo, $name) || getMajikan($pdo, $name)) {
        return true;
    }
    return false;
}

function isNoKpExist(object $pdo, string $ic_number)
{
    if (getPekerjaNoKp($pdo, $ic_number) || getMajikanNoKp($pdo, $ic_number)) {
        return true;
    }
    return false;
}
