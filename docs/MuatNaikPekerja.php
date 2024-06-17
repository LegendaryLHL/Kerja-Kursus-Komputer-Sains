<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/MuatNaikPekerja.css" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <title>PkjKehadiran</title>
</head>

<body>
    <?php
    require_once 'navbar.php';
    require_once 'includes/check_admin.php';
    require_once 'includes/signup_view.inc.php';
    ?>

    <form id="form" action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
        <div class="container">
            <p>Sila pilih fail yang ingin dimuatnaik:</p>
            <input type="file" name="file" id="file" required />
        </div>
        <?php
        processErrors();
        ?>
        <button id="submit-button" type="submit">Hantar</button>
    </form>
    <script src="javascript/common.js"></script>
</body>

</html>