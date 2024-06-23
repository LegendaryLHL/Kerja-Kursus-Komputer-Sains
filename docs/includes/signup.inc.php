<?php

# menyemak sama ada request method adalah POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    # mendapatkan ruang input nama, ic-number, password dan jenis majikan atau pekerja
    $name = $_POST["name"];
    $ic_number = $_POST["ic-number"];
    $password = $_POST["password"];
    $is_majikan = $_POST["majikan-button"];

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        # mendapatkan error
        $errors = [];
        if (empty($name) || empty($ic_number) || empty($password)) {
            $errors["empty_input"] = "Tolong mengisi semua ruang!";
        }
        if (isNameExist($pdo, $name)) {
            $errors["name_taken"] = "Nama sudah didaftar, guna nama lain!";
        }
        # menyemak sama ada nombor kad pengenalan adalah 12 digit dan hanya nombor
        if (strlen($ic_number) != 12) {
            $errors["invalid_ic_length"] = "Nombor kad pengenalan perlu 12 digit!";
        }
        if (isNoKpExist($pdo, $ic_number)) {
            $errors["ic_taken"] = "Nombor kad pengenalan sudah daftar!";
        }
        if (!preg_match('/^[0-9]+$/', $ic_number)) {
            $errors["invalid_ic"] = "Nombor kad pengenalan hanya boleh guna nombor sahaja!";
        }

        require_once 'config_session.inc.php';
        # jika error wujud maka boleh diproses
        if ($errors) {
            $_SESSION["errors"] = $errors;
            header("Location: ../TambahPekerja.php");
        } else {
            # jika jenis majikan dipilih yang diset dengan javascript
            if (isset($_POST["selected"]) && $_POST["selected"] == "majikan") {
                setMajikan($pdo, $name, $ic_number, $password);
                $_SESSION["success"] = "Majikan " . $name . " berjaya didaftar!";
                header("Location: ../konfigurasiPekerja.php?selected=majikan");
            } else {
                setPekerja($pdo, $name, $ic_number, $password);
                $_SESSION["success"] = "Pekerja " . $name . " berjaya didaftar!";
                header("Location: ../konfigurasiPekerja.php?selected=pekerja");
            }
        }
    } catch (PDOException $e) {
        die("Signup db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
