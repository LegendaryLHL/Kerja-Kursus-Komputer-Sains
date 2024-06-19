<?php

declare(strict_types=1);

function processErrors()
{
    require_once "config_session.inc.php";
    # menyemak sama ada terdapat error
    if (isset($_SESSION["errors"])) {
        $errors = $_SESSION["errors"];
        $errorString = "";

        # jika terdapat error, paparkan error
        foreach ($errors as $error) {
            echo '<p class="error">' . $error . '</p>';
            $errorString .= $error . "\\n";
        }

        # memaparkan popup error
        echo "<script>
                setTimeout(function() {
                    alert('" . $errorString . "');
                }, 300);
              </script>";
        unset($_SESSION['errors']);
    }
}

function processSucess()
{
    require_once "config_session.inc.php";
    # menyemak sama ada terdapat success
    if (isset($_SESSION["success"])) {
        echo "<script>
                setTimeout(function() {
                    alert('" . $_SESSION["success"] . "');
                }, 300);
              </script>";
        unset($_SESSION['success']);
    }
}
