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
    <link rel="stylesheet" href="css/events.css">

    <script src="https://kit.fontawesome.com/57a4458178.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main-container">
        <?php include('header.php'); ?>
        <main>
            <div class="container">
                <h1 class="page-title text-header">
                    Events
                </h1>
                <div class="content">
                    <?php
                        $query = "SELECT * FROM events";
                        $res = mysqli_query($conn, $query);
                        if ($res) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $date = date_create($row['event_date']);
                    ?>
                        <div class="event-card">
                            <div class="event-photo">
                                <img src="" alt="">
                            </div>
                            <div class="event-info">
                                <div class="event-title"><?= $row['title']; ?></div>
                                <div class="event-date"><?= date_format($date, "d/m/Y"); ?></div>
                                <div><a href="">Learn more</a></div>
                            </div>
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
        <?php include('inc/footer.php'); ?>
    </div>
</body>

</html>