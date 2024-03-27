<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/TambahPekerja.css" />
    <title>PkjKehadiran</title>
</head>

<body>
    <?php
    require_once 'navbar.php';
    require_once 'includes/check_admin.php';
    ?>

    <div class="container">
        <form action="includes/signup.inc.php" method="post" id="add-worker-form">
            <div class="info-box">
                <p class="title-box">Tambah Pekerja</p>
            </div>
            <div class="form-box">
                <div id="form-form">
                    <label for="nama">Nama</label>
                    <input type="name" id="nama" name="name" placeholder="Jawapan anda" />
                    <label for="nombor-kad-pengenalan">Nombor Kad Pengenalan</label>
                    <input type="number" id="nombor-kad-pengenalan" name="ic-number" placeholder="Jawapan anda" />
                    <label for="kata-laluan">Kata Laluan</label>
                    <input type="password" id="kata-laluan" name="password" placeholder="Jawapan anda" />
                </div>
            </div>

            <div class="majikan-button">
                <input type="checkbox" id="majikan-button" name="majikan-button" />
                <label for="majikan-button">Adalah majikan?</label>
            </div>

            <?php
            checkSignupErrors();
            ?>
            <button id="submit-button" type="submit">Hantar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="javascript/common.js"></script>
</body>

</html>