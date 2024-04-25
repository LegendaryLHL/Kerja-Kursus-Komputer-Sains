<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // javascript set
    $request = $_POST["request"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';

        if ($request == "key") {
            $value = $_POST["key"];
            echo "key";
        } else if ($request == "coord") {
            $longitutde = $_POST["longitude"];
            $latitude = $_POST["latitude"];
            echo "coord";
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
            echo "password";
        }
    } catch (PDOException $e) {
        die("Signup db failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
