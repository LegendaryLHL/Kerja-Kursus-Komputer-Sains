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
                }, 500);
              </script>";
        unset($_SESSION['errors']);
    }
}
