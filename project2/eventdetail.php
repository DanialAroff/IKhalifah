<?php
    include('config.php');
    include('issignedin.php');

    $eventId = mysqli_real_escape_string($conn, $_GET['id']) ?? "";
    $eventName; $venue; $date; $description; $image;

    if ($eventId) {
        $query = "SELECT * FROM events WHERE event_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $eventId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            $eventName = $row['event_name'];
            $venue = $row['venue'];
            $date = $row['date'];
            $description = $row['description'];
            $image = $row['img_path'];
            $status = $row['status'];
            $organizer = $row['organizer'];

            $query2 = mysqli_query($conn, "SELECT * FROM users WHERE user_id=$organizer");
            $user = $query2->fetch_assoc();

            $_SESSION['eventRegister'] = array(
                "eventId"=>$eventId,
                "eventName"=>$eventName,
                "venue"=>$venue,
                "date"=>$date,
                "description"=>$description,
                "imgPath"=>$image,
                "status"=>$status,
                "organizer"=>$user);
        }
    }

    // check if registered
    $isRegistered = false;
    $userId = $_SESSION['userId'];
    $query = mysqli_query($conn, "SELECT * FROM event_register WHERE event_id=$eventId AND user_id=$userId");
    $row = $query->num_rows;
    if ($row > 0) {
        $isRegistered = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event - <?= $eventName ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/eventdetail.css">
</head>
<body>
    <?php include('header.php') ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="img-container">
                    <img src="<?= $image ?? 'assets/img/placeholder.webp' ?>" alt="event image">
                </div>
                <div class="event-schedule">
                    <p class="font-l"><?= $eventName ?></p>
                    <p class="venue m-t">Venue: <?=  $venue ?? '?' ?></p>
                    <p class="date">Date: 
                        <?php
                            $dateObj = new DateTime($date);
                            echo $dateObj->format('d/m/Y');
                        ?>
                    </p>
                    <p class="m-t">
                        <?= empty($description) ? 'No description available.' : $description ?>
                    </p>
                    <div class="buttons">
                        <button class="btn-info">
                            <span class="material-symbols-outlined">
                                info
                            </span>
                        </button>
                        <button class="btn-contact">
                            <span class="material-symbols-outlined">
                                call
                            </span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <button class="btn-register <?= $isRegistered ? 'registered' : '' ?>">
            <a href="registerevent.php?id=<?= $eventId ?>">
                Register Now →
            </a>
        </button>
        <dialog class="dialog-location">

        </dialog>
        <dialog class="dialog-info">
            <div>
                <p class="heading">Guidelines</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam nulla aspernatur
                     maxime quo voluptatibus fuga necessitatibus quaerat accusamus dignissimos? Molestias!</p>
            </div>
            <div>
                <p class="heading">Cancellation</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, totam!</p>
            </div>
        </dialog>
        <dialog class="dialog-contact">
            <p class="heading">Contact Us</p>
            <p><?= $_SESSION['eventRegister']['organizer']['email'] ?></p>
            <a href="telno: <?= $_SESSION['eventRegister']['organizer']['phone_no'] ?>">+<?= $_SESSION['eventRegister']['organizer']['phone_no'] ?></a>
        </dialog>
    </main>
    <script>
        const locationBtn = document.querySelector('.btn-location');
        const infoBtn = document.querySelector('.btn-info');
        const contactBtn = document.querySelector('.btn-contact');
        console.log(infoBtn)
        
        const locationModal = document.querySelector('.dialog-location');
        const infoModal = document.querySelector('.dialog-info');
        const contactModal = document.querySelector('.dialog-contact');
        
        // locationBtn.addEventListener('click', () => {
        //     locationModal.showModal();
        // });
        infoBtn.addEventListener('click', () => {
            infoModal.showModal();
        });
        contactBtn.addEventListener('click', () => {
            contactModal.showModal();
        });
        // locationModal.addEventListener('click', () => {
        //     locationModal.close();
        // });
        infoModal.addEventListener('click', () => {
            infoModal.close();
        });
        contactModal.addEventListener('click', () => {
            contactModal.close();
        });
    </script>
</body>
</html>