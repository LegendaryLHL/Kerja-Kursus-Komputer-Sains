<?php

declare(strict_types=1);

function checkSignupErrors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="error">' . $error . '</p>';
        }

        unset($_SESSION['errors_signup']);
    }
}


function printAllPekerja(object $pdo)
{
    foreach (getAllPekerja($pdo) as $pekerja) {
        echo
        '<div class="worker-card">
          <p class="worker-name">' . htmlspecialchars($pekerja['nama_pekerja']) . '</p>
          <button class="remove-button">Keluarkan</button>
        </div>';
    }
}
