<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ic_number = $_POST["ic-number"];
    $password = $_POST["password"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';

        $errors = [];

        require_once 'config_session.inc.php';


        if (empty($ic_number) || empty($password)) {
            $errors["empty_input"] = "Tolong mengisi semua ruang!";
        }
        if (!preg_match('/^[0-9]+$/', $ic_number)) {
            $errors["invalid_ic"] = "Nombor kad pengenalan hanya boleh guna nombor sahaja!";
        }

        if ($errors) {
            $_SESSION["errors"] = $errors;
            header("Location: ../index.php");
        } else {
            login($pdo, $ic_number, $password);
            if ($_SESSION["errors"]) {
                header("Location: ../index.php");
            } else {
                header("Location: ../AnalisisKehadiran.php");
            }
        }
    } catch (PDOException $e) {
        die("Login db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
