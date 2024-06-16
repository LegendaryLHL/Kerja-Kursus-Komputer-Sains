<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    # request diset mengunakan javascript
    $request = $_POST["request"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'config_session.inc.php';
        require_once 'other_model.php';

        # mendapatkan apakah jenis request yang diperlukan dan melaksanakan fungsi yang ditentukan
        if ($request == "key") {
            # meletakkan kunci
            $value = $_POST["key"];
            setKey($pdo, $value);
            header("Location: ../Maklumat.php");
        } else if ($request == "coord") {
            # meletakkan coordinate
            $longitutde = $_POST["longitude"];
            $latitude = $_POST["latitude"];
            setCoord($pdo, $longitutde, $latitude);
            header("Location: ../Maklumat.php");
        } else if ($request == "delete") {
            # membuang majikan atau pekerja
            $selected = $_POST["selected"];
            $id = $_POST["id"];
            if ($selected == "majikan") {
                removeMajikan($pdo, $id);
            } else {
                removePekerja($pdo, $id);
            }
            header("Location: ../KonfigurasiPekerja.php");
        } else if ($request == "password") {
            # menukar kata laluan
            $selected = $_POST["selected"];
            $id = $_POST["id"];
            $new_pass = $_POST["new-password"];
            if ($selected == "majikan") {
                changePassMajikan($pdo, $id, $new_pass);
            } else {
                changePassPekerja($pdo, $id, $new_pass);
            }
            header("Location: ../profil.php");
        }
    } catch (PDOException $e) {
        die("Signup db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
