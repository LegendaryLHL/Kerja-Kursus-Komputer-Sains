<?php
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="lib/all.min.css" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/Profil.css" />
    <title>PkjKehadiran</title>
</head>

<body>
    <?php
    require_once 'navbar.php';
    require_once 'includes/check_user.php';
    require_once 'includes/dbh.inc.php';
    require_once 'includes/signup_model.inc.php';
    require_once 'includes/signup_view.inc.php';
    require_once 'includes/kehadiran_model.inc.php';
    processSucess();

    # mendapatkan adakah profil majikan atau pekerja
    $user = getPengguna($pdo, (isset($_GET["selected"]) && isset($_GET["id"])) ? $_GET["id"] : $_SESSION['id']);

    # jika tidak cari penguna balik
    if (!$user) {
        header("Location: ./Profil.php");
    }

    # data yang digunakan oleh javascript
    echo '<p style="display: none" id="status-web">' . ($user['adalah_majikan'] ? 'majikan' : 'pekerja') . '</p>';
    echo '<p style="display: none" id="id-web">' . $user['id_pengguna'] . '</p>';
    ?>
    <form id="form" action="includes/other.inc.php" class="container" method="POST">
        <div class=" worker-container">
            <div class="box">
                <p class="name"><?php echo $user["nama_pengguna"] ?></p>
            </div>
            <!-- analisis kesendirian jika ialah pekerja -->
            <?php if (!$user['adalah_majikan']) {
                $total = countAllHariBekerja($pdo, $user['id_pengguna'])['bilangan_hari_bekerja'];
                $count = countAllHariDatang($pdo, $user['id_pengguna'])['bilangan_hari_datang'];
                $overtime = countAllOvertime($pdo, $user['id_pengguna'])['bilangan_overtime'];
                $percent = $total == 0 ? 0 : round($count / $total * 100, 2);
            ?>
                <div class="box">
                    <h3>Pekerja telah bekerja:</h3>
                    <div id="progress">
                        <div id="left">
                            <p>Peratus: <?php echo $percent ?>%</p>
                            <p>Bilangan: <?php echo $count ?>/<?php echo $total ?> </p>
                        </div>
                        <p>Overtime: <?php echo $overtime ?> kali</p>
                    </div>
                </div>
            <?php } ?>
            <!-- tempat menukar maklumat pengguna -->
            <?php if ($_SESSION["status"] == "majikan") { ?>
                <div class="box">
                    <input type="text" name="new-password" id="password-field" placeholder="Kata laluan baharu" />
                    <button type="submit" id="password-button">Tukar kata laluan</button>
                </div>
                <?php if (
                    $user['id_pengguna'] == $_SESSION["id"]
                ) { ?>
                    <!-- tidak boleh menghapuskan sendiri dengan overide event listener lama-->
                    <button id="delete-button" onclick="alert('Anda tidak boleh hapus akaun sendiri!')">Hapuskan</button>
                <?php

                } else { ?>
                    <button type="submit" id="delete-button" onclick="submitCustom()">Hapuskan</button>
                <?php } ?>
                <input type="hidden" name="selected" id="selected-input" />
                <input type="hidden" name="id" id="id-input" />
                <input type="hidden" name="request" id="request-input" />
            <?php } ?>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="javascript/common.js"></script>
    <script src="javascript/Profil.js"></script>
</body>

</html>