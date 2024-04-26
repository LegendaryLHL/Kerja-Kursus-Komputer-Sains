<?php
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    if (isset($_GET["selected"]) && isset($_GET["id"])) {
        if ($_GET["selected"] == "majikan") {
            $user = getMajikanId($pdo, $_GET['id']);
            $is_majikan = true;
        } else {
            $user = getPekerjaId($pdo, $_GET['id']);
            $is_majikan = false;
        }
    } else {
        if ($_SESSION['status'] == "majikan") {
            $user = getMajikanId($pdo, $_SESSION['id']);
            $is_majikan = true;
        } else {
            $user = getPekerjaId($pdo, $_SESSION['id']);
            $is_majikan = false;
        }
    }
    if (!$user) {
        header("Location: ./Profil.php");
    }
    echo '<p style="display: none" id="status-web">' . ($is_majikan ? 'majikan' : 'pekerja') . '</p>';
    echo '<p style="display: none" id="id-web">' . $user['id_' . ($is_majikan ? 'majikan' : 'pekerja')] . '</p>';
    ?>
    <form id="form" action="includes/other.php" class="container" method="POST">
        <div class=" worker-container">
            <div class="box">
                <p class="name"><?php echo $is_majikan ? $user["nama_majikan"] : $user["nama_pekerja"] ?></p>
            </div>
            <?php if ($_SESSION["status"] == "majikan") { ?>
                <div class="box">
                    <input type="text" name="new-password" id="password-field" placeholder="Kata laluan baharu" />
                    <button type="submit" id="password-button">Tukar kata laluan</button>
                </div>
                <?php if (!(($is_majikan ? 'majikan' : 'pekerja') == $_SESSION["status"] &&
                    $user['id_' . ($is_majikan ? 'majikan' : 'pekerja')] == $_SESSION["id"]
                )) { ?>
                    <button type="submit" id="delete-button">Keluarkan</button>
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