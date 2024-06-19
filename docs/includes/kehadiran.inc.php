<?php

# menyemak sama ada request method adalah POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    try {
        # menyertakan fail-fail yang diperlukan
        require_once 'dbh.inc.php';
        require_once 'kehadiran_model.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'config_session.inc.php';
        require_once 'other_model.inc.php';

        # menyemak sama ada request adalah untuk menamatkan kehadiran
        if ($_POST["isFinish"] == "true") {
            # menyemak sama ada kehadiran sudah diisi
            if (getKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION['name'])['id_pekerja'])['ada_hadir'] == 0) {
                # tidak diisi kehadiran balik
                header("Location: ../IsiKehadiran.php");
                die();
            }

            # menentukan masa tamat
            $datetime = date("Y-m-d H:i:s");
            # mengemaskini masa tamat kehadiran
            setFinish($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja'], $datetime);
            $_SESSION["success"] = "Kehadiran masa tamat " . $datetime . " berjaya diisi!";
            # menuju ke laman profil
            header("Location: ../Profil.php");
            die();
        }

        # memulangakan error
        $errors = [];

        # kehadiran sudah diisi
        if (getKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja'])) {
            $errors["kehadiran_fillled"] = "Kehadiran sudah diisi!";
        }
        # ruang input kosong
        if (empty($_POST["can-go-work"])) {
            $errors["empty_input"] = "Tolong mengisi sama ada boleh bekerja atau tidak!";
            $_SESSION["errors"] = $errors;
            header("Location: ../IsiKehadiran.php");
            die();
        }
        # mendapatkan ruang input can-go-work
        $can_work = $_POST["can-go-work"] == "Saya boleh hadir";
        # mengunakan kunci tetapi kunci salah
        if ($can_work && $_POST["key"] != getKey($pdo)) {
            $errors["wrong_key"] = "Kunci salah!";
        }

        # jika tatasusunan errors bukan kosong maka kembali ke laman IsiKehadiran
        if ($errors) {
            $_SESSION["errors"] = $errors;
            header("Location: ../IsiKehadiran.php");
        } else {
            # tiada error, maka masukkan kehadiran
            setKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja'], $can_work ? 1 : 0);
            $_SESSION["success"] = "Kehadiran berjaya diisi!";
            header("Location: ../AnalisisKehadiran.php");
        }
    } catch (PDOException $e) {
        # papar error jika sql gagal
        die("Kehadiran db failed: " . $e->getMessage());
    }
} else {
    # papar error jika request method bukan POST
    header("Location: ../index.php");
    die();
}
