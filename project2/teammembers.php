<?php
    include('config.php');
    include('issignedin.php');
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
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/teammembers.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main class="p">
        <h1 class="main-heading">Meet the Team</h1>
        <section id="teamMembers">
            <div class="cards">
                <div class="event-card" data-id="">
                    <a href="eventdetail.html?">
                        <div class="img-container">
                            <img src="assets/img/placeholder.webp" alt="">
                        </div>
                    </a>
                    <p class="name">Name:</p>
                    <p class="event">Event in Charge:</p>
                </div>
                <div class="event-card" data-id="">
                    <a href="eventdetail.html?">
                        <div class="img-container">
                            <img src="assets/img/placeholder.webp" alt="">
                        </div>
                    </a>
                    <p class="name">Name:</p>
                    <p class="event">Event in Charge:</p>
                </div>
                <div class="event-card" data-id="">
                    <a href="eventdetail.html?">
                        <div class="img-container">
                            <img src="assets/img/placeholder.webp" alt="">
                        </div>
                    </a>
                    <p class="name">Name:</p>
                    <p class="event">Event in Charge:</p>
                </div>
                <div class="event-card" data-id="">
                    <a href="eventdetail.html?">
                        <div class="img-container">
                            <img src="assets/img/placeholder.webp" alt="">
                        </div>
                    </a>
                    <p class="name">Name:</p>
                    <p class="event">Event in Charge:</p>
                </div>
                <div class="event-card" data-id="">
                    <a href="eventdetail.html?">
                        <div class="img-container">
                            <img src="assets/img/placeholder.webp" alt="">
                        </div>
                    </a>
                    <p class="name">Name:</p>
                    <p class="event">Event in Charge:</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>