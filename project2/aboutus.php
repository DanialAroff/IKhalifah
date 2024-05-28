<?php
include_once('config.php');
include('issignedin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>i-Khalifah - About Us</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/header.css">

    <script src="https://kit.fontawesome.com/57a4458178.js" crossorigin="anonymous"></script>
    <style>
        main {
            margin: 1.75rem;
            padding: 1.5rem;
            background-color: #F1F1F1;
            background-color: #FEFEFE;
            border-radius: 4px;
        }

        main p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <?php include('header.php'); ?>
        <main>
            <h1 class="page-title">
                About Us
            </h1>
            <p>
                <strong>Khalifah Garden Kindergarten</strong> is a nurturing and stimulating learning environment where children blossom and grow. We provide a play-based curriculum that fosters curiosity, creativity, and a love for learning.
            </p>
            <p>
                At Khalifah Garden Kindergarten, we believe in nurturing the whole child – intellectually, socially,
                emotionally, and physically. Our dedicated teachers create a warm and welcoming environment where children feel safe to explore, discover, and learn through play.
            </p>
            <p>
                Khalifah Garden Kindergarten is a place where children can make lifelong friendships, develop a love for learning, and prepare for a successful future.
            </p>
        </main>
        <?php include('inc/footer.php'); ?>
    </div>
</body>

</html>