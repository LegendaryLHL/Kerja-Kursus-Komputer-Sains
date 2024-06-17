<?php

# menyemak sama ada request method adalah POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    # mendapatkan ruang input nama, ic-number, password dan jenis majikan atau pekerja

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        require_once 'config_session.inc.php';
        # mendapatkan error fail
        $errors = [];
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
            $errors["empty_input"] = "Tolong pilih fail!";
            $_SESSION["errors"] = $errors;
            header("Location: ../MuatNaikPekerja.php");
            die();
        }

        # menyemak sama ada ialah txt file
        if (pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION) !== "txt") {
            $errors["invalid_file"] = "Fail yang dimuatnaik perlu berformat txt!";
            $_SESSION["errors"] = $errors;
            header("Location: ../MuatNaikPekerja.php");
        } else {
            $file = fopen($_FILES["file"]["tmp_name"], "r");
            $count = 0;

            # menguna fgets untuk membaca baris ke baris sampai habis
            while (!feof($file)) {
                $line = fgets($file);
                $count++;
                $lineArray = explode("|", $line);

                # menyemak sama ada format fail betul
                if (count($lineArray) != 3) {
                    $errors["invalid_format"] = "Format fail tidak betul! Tolong menggunakan format nama|katalaluan|nokp sebaris! Baris ke-" . $count;
                    $_SESSION["errors"] = $errors;
                    header("Location: ../MuatNaikPekerja.php");
                    die();
                }
                $name = $lineArray[0];
                $password = $lineArray[1];
                # trim kerana ada \n
                $ic_number = trim($lineArray[2]);

                # mendapatkan error masa signup
                if (empty($name) || empty($ic_number) || empty($password)) {
                    $errors["empty_input"] = "Tolong mengisi semua ruang! Baris ke-" . $count;
                }
                if (isNameExist($pdo, $name)) {
                    $errors["name_taken"] = "Nama sudah didaftar, guna nama lain! Baris ke-" . $count;
                }
                if (isNoKpExist($pdo, $ic_number)) {
                    $errors["ic_taken"] = "Nombor kad pengenalan sudah daftar! Baris ke-" . $count;
                }
                if (!preg_match('/^[0-9]+$/', $ic_number)) {
                    $errors["invalid_ic"] = "Nombor kad pengenalan hanya boleh guna nombor sahaja! Baris ke-" . $count;
                    echo $ic_number;
                    die();
                }

                # jika error wujud maka boleh diproses
                if ($errors) {
                    $_SESSION["errors"] = $errors;
                    header("Location: ../MuatNaikPekerja.php");
                    die();
                } else {
                    setPekerja($pdo, $name, $ic_number, $password);
                }
            }
            fclose($file);
            header("Location: ../KonfigurasiPekerja.php?selected=pekerja");
        }
    } catch (PDOException $e) {
        die("Signup db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
