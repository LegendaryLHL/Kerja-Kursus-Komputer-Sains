<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    # request diset mengunakan javascript
    $request = $_POST["request"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'config_session.inc.php';
        require_once 'other_model.inc.php';

        # mendapatkan apakah jenis request yang diperlukan dan melaksanakan fungsi yang ditentukan
        if ($request == "key") {
            # meletakkan kunci
            $value = $_POST["key"];
            setKey($pdo, $value);
            $_SESSION["success"] = "Kunci berjaya ditukar!";
            header("Location: ../TukarKunci.php");
        } else if ($request == "delete") {
            # membuang majikan atau pekerja
            $selected = $_POST["selected"];
            $id = $_POST["id"];
            if ($selected == "majikan") {
                removeMajikan($pdo, $id);
                $_SESSION["success"] = "Majikan berjaya dipadam!";
                header("Location: ../KonfigurasiPekerja.php?selected=majikan");
            } else {
                removePekerja($pdo, $id);
                $_SESSION["success"] = "Pekerja berjaya dipadam!";
                header("Location: ../KonfigurasiPekerja.php?selected=pekerja");
            }
        } else if ($request == "password") {
            # menukar kata laluan
            $selected = $_POST["selected"];
            $id = $_POST["id"];
            $new_pass = $_POST["new-password"];
            if ($selected == "majikan") {
                changePassMajikan($pdo, $id, $new_pass);
                $_SESSION["success"] = "Kata laluan berjaya ditukar!";
                header("Location: ../Profil.php?selected=majikan&id=" . $id);
            } else {
                changePassPekerja($pdo, $id, $new_pass);
                $_SESSION["success"] = "Kata laluan berjaya ditukar!";
                header("Location: ../Profil.php?selected=pekerja&id=" . $id);
            }
        }
    } catch (PDOException $e) {
        die("Signup db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
