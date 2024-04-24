<?php 
    include_once('config.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <?php
            if($_SESSION['user_type'] === 'user') { 
        ?>
        <section id="user">
            <section id="discover">
                <h2>Discover</h2>
                <div class="cards">
                    <?php
                        $query = "SELECT * FROM events WHERE status=1 AND approved=1";
                        $result;
                        try {
                            $result = mysqli_query($conn, $query);
                        } catch (Exception $e) {}
    
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="event-card" data-id="<?= $row['event_id'] ?>">
                        <a href="eventdetail.php?id=<?= $row['event_id'] ?>">
                            <div class="img-container">
                                <img src="<?= $row['img_path'] ?? 'assets/img/placeholder.webp' ?>" alt="">
                            </div>
                        </a>
                        <p class="title"><?= $row['event_name'] ?></p>
                        <p class="venue"><?= $row['venue'] ?></p>
                    </div>
                    <?php } ?>
                </div>
            </section>
            <!-- <section id="recentView">
                <h2>Recently Viewed</h2>
                <div class="cards">
                    <?php
                        $query = "SELECT * FROM events WHERE status=1";
                        $result;
                        try {
                            $result = mysqli_query($conn, $query);
                        } catch (Exception $e) {}
    
                        while ($row = mysqli_fetch_assoc($result)) {
    
                    ?>
                    <div class="event-card" data-id="<?= $row['event_id'] ?>">
                        <a href="eventdetail.php?">
                            <div class="img-container">
                                <img src="assets/img/placeholder.webp" alt="">
                            </div>
                        </a>
                        <p class="title">Event Name</p>
                        <p class="venue">Venue</p>
                    </div>
                    <?php } ?>
                </div>
            </section> -->
        </section>

        <?php } ?>

        <!-- Organizer -->
        <?php
            if($_SESSION['user_type'] === 'organizer') { 
        ?>
        <section id="organizer">
            <div>
                <h2>Events</h2>
                <a href="event-actions.php?action=new" class="btn-add-new"> + New Event</a>
            </div>
            <div class="cards">
                <?php
                    $query = "SELECT * FROM events";
                    $result;
                    try {
                        $result = mysqli_query($conn, $query);
                    } catch (Exception $e) {}

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['event_id'];
                ?>
                <div class="event-card">
                    <a href="event-actions.php?id=<?= $id ?>&action=edit">
                        <div class="img-container">
                            <span class="event-label">
                                <?php
                                    if ($row['approved'] == 0) echo 'Pending';
                                    else {
                                        if ($row['status'] == 1) {
                                            echo 'Show';
                                        } else {
                                            echo 'Hidden';
                                        }
                                    }
                                ?>
                            </span>
                            <img src="<?= $row['img_path'] ?? 'assets/img/placeholder.webp' ?>" alt="">
                        </div>
                    </a>
                    <p class="title"><?= $row['event_name'] ?></p>
                    <div class="actions">
                        <a href="event-actions.php?id=<?= $id ?>&action=edit">Edit</a>
                        <a href="changestatus.php?id=<?= $id ?>&status=1" class="add">
                            Add
                        </a>
                        <a href="changestatus.php?id=<?= $id ?>&status=2" class="remove">
                            <!-- Remove -->
                            <span class="material-symbols-outlined">
                            delete
                            </span>
                        </a>
                    </div>
                </div>
                <?php } ?>
                <dialog class="addDialog">

                </dialog>
                <dialog class="removeDialog">

                </dialog>
            </div>
        </section>
        <?php } ?>

        <?php 
            // Only show if user is an admin
            if($_SESSION['user_type'] === 'admin') { 
        ?>
        
        <section class="admin">
            <div class="container-f">
                <a href="reports.php">
                    <span class="material-symbols-outlined icon-f">
                        summarize
                    </span>
                    <p>Data and Reports</p>
                </a>
            </div>
            <div class="container-f">
                <a href="approvalrequest.php">
                    <span class="material-symbols-outlined icon-f">
                        select_check_box
                    </span>
                    <p>Approval Requests</p>
                </a>
            </div>
            <div class="container-f">
                <a href="teammembers.php">
                    <span class="material-symbols-outlined icon-f">
                        groups
                    </span>
                    <p>Team Members</p>
                </a>
            </div>
        </section>

        <?php } ?>
    </main>
    <script>
        const eventCards = document.querySelectorAll('.event-card');
    </script>
</body>
</html>