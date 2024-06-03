<?php
    require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/header.css">

    <script src="https://kit.fontawesome.com/57a4458178.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main-container">
        <?php include('header.php'); ?>
        <main>
            <?php 
                if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'parent') 
                || !isset($_SESSION['userType'])) {
            ?>
            <section class="banner">
                <div class="cto-1">
                    <p>Lighten up the kids future with 'Iman</p>
                    <button class="btn-inquire" onclick="window.location.href='registerstudent.php';">Register Now</button>
                </div>
            </section>
            <?php
                }
            ?>
        </main>
        <!-- <section class="section-2">
            Section 2
        </section> -->
        <?php include('inc/footer.php'); ?>
    </div>
</body>

</html>