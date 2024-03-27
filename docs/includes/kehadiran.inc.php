<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $can_go_work = $_POST["can-go-work"];

    try {
        require_once 'dbh.inc.php';
        require_once 'kehadiran_model.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'config_session.inc.php';

        $errors = [];

        if (empty($can_go_work)) {
            $errors["empty_input"] = "Tolong mengisi semua ruang!";
        }
        if (getKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja'])) {
            $errors["kehadiran_fillled"] = "Kehadiran sudah diisi!";
        }


        if ($errors) {
            $_SESSION["errors"] = $errors;
            header("Location: ../IsiKehadiran.php");
        } else {
            $ada_hadir = 0;
            if ($can_go_work == 'Saya boleh hadir') {
                $ada_hadir = 1;
            }
            setKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja'], $ada_hadir);
            header("Location: ../AnalisisKehadiran.php");
        }
    } catch (PDOException $e) {
        die("Kehadiran db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
