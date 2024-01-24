<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $ic_number = $_POST["ic-number"];
    $password = $_POST["password"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        $errors = [];

        if (isEmpty($name, $ic_number, $password)) {
            $errors["empty_input"] = "Tolong mengisi semua ruang!";
        }
        if (isNameExist($pdo, $name)) {
            $errors["name_taken"] = "Nama sudah didaftar, guna nama lain!";
        }
        if (!preg_match('/^[0-9]+$/', $ic_number)) {
            $errors["invalid_ic"] = "Nombor kad pengenalan hanya boleh guna nombor sahaja!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../KonfigurasiPekerja/TambahPekerja.php");
        } else {
            createUser($pdo, $name, $ic_number, $password);
            header("Location: ../konfigurasiPekerja");
        }
    } catch (PDOException $e) {
        die("Signup db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.html");
    die();
}
