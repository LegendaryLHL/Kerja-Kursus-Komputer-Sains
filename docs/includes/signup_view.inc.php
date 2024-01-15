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

        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    const workersContainer = document.getElementById("workers-container");
                    const addWorkerForm = document.getElementById("add-worker-form");
                    workersContainer.style.display = "none";
                    addWorkerForm.style.display = "block";
                });
              </script>';

        unset($_SESSION['errors_signup']);
    }
}
