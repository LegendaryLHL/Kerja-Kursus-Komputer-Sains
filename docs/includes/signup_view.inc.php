<?php

declare(strict_types=1);

function checkSignupErrors()
{
    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="error">' . $error . '</p>';
        }

        unset($_SESSION['errors']);
    }
}
