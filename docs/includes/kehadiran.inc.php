<?php

# menyemak sama ada request method adalah POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    # mendapatkan ruang input can-go-work
    if (isset($_POST["can-go-work"])) {
        $can_go_work = $_POST["can-go-work"];
    }

    try {
        # menyertakan fail-fail yang diperlukan
        require_once 'dbh.inc.php';
        require_once 'kehadiran_model.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'config_session.inc.php';
        require_once 'other_model.php';

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
            # menuju ke laman profil
            header("Location: ../Profil.php");
            die();
        }

        # memulangakan error
        $errors = [];
        # ruang input kosong
        if (empty($can_go_work)) {
            $errors["empty_input"] = "Tolong mengisi semua ruang!";
        }
        # kehadiran sudah diisi
        if (getKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja'])) {
            $errors["kehadiran_fillled"] = "Kehadiran sudah diisi!";
        }
        # mengunakan kunci tetapi kunci salah
        if ($_POST["using-key"] == "true" && $_POST["key"] != getKey($pdo)) {
            $errors["wrong_key"] = "Kunci salah!";
        }

        # jika tatasusunan errors bukan kosong maka kembali ke laman IsiKehadiran
        if ($errors) {
            $_SESSION["errors"] = $errors;
            header("Location: ../IsiKehadiran.php");
        } else {
            $ada_hadir = 0;
            if ($can_go_work == 'Saya boleh hadir') {
                $ada_hadir = 1;
            }
            # tiada error, maka masukkan kehadiran
            setKehadiran($pdo, getHari($pdo)['id_hari'], getPekerja($pdo, $_SESSION["name"])['id_pekerja'], $ada_hadir);
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
