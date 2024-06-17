<?php
# menyemak sama ada request method adalah POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    # mendapatkan ruang input ic-number dan password
    $ic_number = $_POST["ic-number"];
    $password = $_POST["password"];

    try {
        # menyertakan fail-fail yang diperlukan
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'config_session.inc.php';

        # mengenalpasti error
        $errors = [];
        # ruang input kosong
        if (empty($ic_number) || empty($password)) {
            $errors["empty_input"] = "Tolong mengisi semua ruang!";
        }
        # ic number tidak sah
        if (!preg_match('/^[0-9]+$/', $ic_number)) {
            $errors["invalid_ic"] = "Nombor kad pengenalan hanya boleh guna nombor sahaja!";
        }

        # jika error memulangkan 
        if ($errors) {
            $_SESSION["errors"] = $errors;
            header("Location: ../index.php");
        } else {
            # tiada error maka log masuk
            login($pdo, $ic_number, $password, isset($_POST["remember-me"]));

            # menyemak sama ada error daripada login
            if (isset($_SESSION["errors"])) {
                header("Location: ../index.php");
            } else {
                header("Location: ../AnalisisKehadiran.php");
            }
        }
    } catch (PDOException $e) {
        $errors = [];
        $errors["db_error"] = $e->getMessage();
        $_SESSION["errors"] = $errors;
        die("Login db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
