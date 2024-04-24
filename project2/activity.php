<?php 
    include_once('config.php');
    include('issignedin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/activity.css">
</head>
<body>
    <?php include('header.php') ?>
    <main>
        <div class="tabs">
            <button class="tab-button active" id="tab-upcoming">Upcoming Event</button>
            <button class="tab-button" id="tab-history">Event History</button>
        </div>
        <section id="upcoming">
            <div class="cards">
                <?php 
                    $query = "SELECT * FROM events 
                        INNER JOIN event_register 
                        ON events.event_id = event_register.event_id
                        WHERE user_id=?;";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $_SESSION['userId']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()) {
                ?>
                <div class="event-card">
                    <div class="img-container">
                        <img src="<?= $row['img_path'] ?>" alt="">
                    </div>
                    <p class="title"><?= $row['event_name'] ?></p>
                    <p class="venue"><?= $row['venue'] ?></p>
                    <p class="ticket">
                        <?php
                            $eventId = $row['event_id'];
                            $userId = $row['user_id'];
                            $resultT; $noOfTicket;
                            try {
                                $resultT = mysqli_query($conn, "SELECT ticket 
                                FROM event_register WHERE event_id=$eventId AND user_id=$userId");
                                $noOfTicket = $resultT->fetch_row()[0];
                            } catch (Exception $e) {

                            }
                        ?>
                        <?= $noOfTicket ?> ticket(s)
                    </p>
                </div>
                <?php } ?>
            </div>
        </section>
        <section id="history">

        </section>
    </main>
    <script>
        const tabUpcoming = document.getElementById('tab-upcoming');
        const tabHistory = document.getElementById('tab-history');
        const sectionUpcoming = document.getElementById('upcoming');
        const sectionHistory = document.getElementById('history');

        tabUpcoming.addEventListener('click', e => {
            tabUpcoming.classList.add('active');
            tabHistory.classList.remove('active');

            sectionUpcoming.style.display = 'block';
            sectionHistory.style.display = 'none';
        });
        tabHistory.addEventListener('click', e => {
            tabHistory.classList.add('active');
            tabUpcoming.classList.remove('active');

            sectionHistory.style.display = 'block';
            sectionUpcoming.style.display = 'none';
        });
    </script>
</body>
</html>