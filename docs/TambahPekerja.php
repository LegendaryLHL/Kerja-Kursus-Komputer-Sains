<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="lib/all.min.css" />
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
                <!-- memaparkan jenis tambah -->
                <p class="title-box">Tambah <?php echo isset($_GET['selected']) ? htmlspecialchars($_GET['selected']) : "Pekerja" ?></p>
            </div>

            <!-- borang menambah pengguna-->
            <div class="form-box">
                <div id="form-form">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="name" placeholder="Nama" required />
                    <label for="nombor-kad-pengenalan">Nombor Kad Pengenalan</label>
                    <input type="number" id="nombor-kad-pengenalan" name="ic-number" placeholder="Nombor Kad Pengenalan" required />
                    <label for="kata-laluan">Kata Laluan</label>
                    <input type="password" id="kata-laluan" name="password" placeholder="Kata Lalauan" required />
                </div>
            </div>

            <!-- memberitahu jenis tambahan-->
            <input type="hidden" name="selected" <?php if (isset($_GET['selected'])) echo 'value="' . htmlspecialchars($_GET['selected']) . '"'; ?> />

            <?php
            # memaparkan error
            processErrors();
            ?>
            <button id="submit-button" type="submit">Hantar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="javascript/common.js"></script>
</body>

</html>