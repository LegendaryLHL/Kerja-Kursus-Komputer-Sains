<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // javascript set
    $request = $_POST["request"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'config_session.inc.php';
        require_once 'other_model.php';

        if ($request == "key") {
            $value = $_POST["key"];
            setKey($pdo, $value);
            header("Location: ../Maklumat.php");
        } else if ($request == "coord") {
            $longitutde = $_POST["longitude"];
            $latitude = $_POST["latitude"];
            setCoord($pdo, $longitutde, $latitude);
            header("Location: ../Maklumat.php");
        } else if ($request == "delete") {
            $selected = $_POST["selected"];
            $id = $_POST["id"];
            if ($selected == "majikan") {
                removeMajikanId($pdo, $id);
            } else {
                removePekerjaId($pdo, $id);
            }
            header("Location: ../profil.php");
        } else if ($request == "password") {
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
        echo "you are not suppose to be here";
    } catch (PDOException $e) {
        die("Signup db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
