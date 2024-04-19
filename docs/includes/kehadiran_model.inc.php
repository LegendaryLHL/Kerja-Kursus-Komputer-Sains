<?php
function setKehadiran(object $pdo, int $id_hari, int $id_pekerja, int $ada_hadir)
{
    $query = "INSERT INTO kehadiran (id_hari, id_pekerja, ada_hadir) VALUES (:id_hari, :id_pekerja, :ada_hadir);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_hari", $id_hari);
    $stmt->bindParam(":id_pekerja", $id_pekerja);
    $stmt->bindParam(":ada_hadir", $ada_hadir);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function getKehadiran(object $pdo, int $id_hari, int $id_pekerja)
{
    $query = "SELECT * FROM kehadiran WHERE id_hari = :id_hari AND id_pekerja = :id_pekerja LIMIT 1;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_hari", $id_hari);
    $stmt->bindParam(":id_pekerja", $id_pekerja);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function setFinish(object $pdo, int $id_hari, int $id_pekerja, string $datetime)
{
    $query = "UPDATE kehadiran SET masa_tamat = :date_time WHERE id_hari = :id_hari AND id_pekerja = :id_pekerja;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_hari", $id_hari);
    $stmt->bindParam(":id_pekerja", $id_pekerja);
    $stmt->bindParam(":date_time", $datetime);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function getHari(object $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM hari ORDER BY tarikh DESC LIMIT 1");
    $stmt->execute();
    $lastHari = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$lastHari) {
        $stmt = $pdo->prepare("INSERT INTO hari (tarikh) VALUES (CURRENT_DATE)");
        $stmt->execute();
        $id_hari = $pdo->lastInsertId();
        return ['id_hari' => $id_hari, 'tarikh' => date('Y-m-d')];
    }

    $latestDate = new DateTime($lastHari['tarikh']);
    $currentDate = new DateTime();

    // change this when can change
    $nonWorkDays = ['Saturday', 'Sunday'];

    while ($latestDate->format('Y-m-d') < $currentDate->format('Y-m-d')) {
        $latestDate->modify('+1 day');
        $isNonWorkDay = in_array($latestDate->format('l'), $nonWorkDays);
        $stmt = $pdo->prepare("INSERT INTO hari (tarikh, adalah_hari_bekerja) VALUES (?, ?)");
        $stmt->execute([$latestDate->format('Y-m-d'), $isNonWorkDay ? 0 : 1]);
    }

    // Fetch and return the new latest hari
    $stmt = $pdo->prepare("SELECT id_hari, tarikh FROM hari ORDER BY tarikh DESC LIMIT 1");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function countHariBekerja(object $pdo, string $starting_date, string $ending_date, int $id_pekerja)
{
    $stmt = $pdo->prepare("SELECT 
        COUNT(*) AS bilangan_hari_bekerja
    FROM
        hari
    WHERE
        tarikh BETWEEN :starting_date AND :ending_date
            AND tarikh >= (SELECT created_at FROM pekerja WHERE id_pekerja = :id_pekerja)
            AND adalah_hari_bekerja = 1");
    $stmt->bindParam(":starting_date", $starting_date);
    $stmt->bindParam(":ending_date", $ending_date);
    $stmt->bindParam(":id_pekerja", $id_pekerja);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function countHariDatang(object $pdo, string $starting_date, string $ending_date, string $id_pekerja)
{
    $stmt = $pdo->prepare("SELECT 
        COUNT(*) AS bilangan_hari_datang
    FROM
        kehadiran JOIN hari ON kehadiran.id_hari = hari.id_hari
    WHERE
        id_pekerja = :id_pekerja
            AND hari.tarikh BETWEEN :starting_date AND :ending_date
            AND ada_hadir = 1");
    $stmt->bindParam(":id_pekerja", $id_pekerja);
    $stmt->bindParam(":starting_date", $starting_date);
    $stmt->bindParam(":ending_date", $ending_date);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}