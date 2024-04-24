<?php 
    include('config.php');
    // Send user back to eventdetail if this page is accessed directly
    if (isset($_GET['id']) || isset($_POST['id'])) {
        $eventId = $_GET['id'] ?? $_POST['id'];
        if (!isset($_SESSION['eventRegister']) && $_SESSION['eventRegister']['eventId'] != $eventId) {
            header('location: eventdetail.php?err=1');
            exit();
        }
        $eventArr = $_SESSION['eventRegister'];
    }

    $phase = "details";
    if (isset($_POST['phase']) && isset($_POST['submit'])) {
        $phase = $_POST['phase'];
        if ($phase == 'details') {
            $ticket = $_POST['ticket'] ?? 1;

            $eventId = $_SESSION['eventRegister']['eventId'];
            $userId = $_SESSION['userId'];
            $status = $_SESSION['eventRegister']['status'];
            $stmt = $conn->prepare("INSERT INTO event_register (event_id, user_id, ticket, status)
                VALUES(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $eventId, $userId, $ticket, $status);
            $result = $stmt->execute();

            if ($result) $phase = 'complete';
            $phase = 'complete';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/registerevent.css">
</head>
<body>
    <?php include('header.php') ?>
    <main>
        <div class="container">
            <div class="progress-tab">
                <ul>
                    <li class="<?= $phase == 'details' ? 'active' : '' ?>"><div class="step">1</div>Details</li>
                    <li class="<?= $phase == 'complete' ? 'active' : '' ?>"><div class="step">2</div>Complete</li>
                </ul>
            </div>
            <?php if ($phase == "details") { ?>
                <form method="POST">
                    <input type="hidden" name="phase" value="details">
                    <div class="img-container">
                        <img src="<?= $eventArr['imgPath'] ?>" alt="event photo">
                    </div>
                    <div class="details">
                        <div>
                            <div class="font-l"><?= $eventArr['eventName'] ?></div>
                            <div><?= $eventArr['venue'] ?></div>
                            <div>
                            <?php
                                $date = $eventArr['date'];
                                $dateObj = new DateTime($date);
                                echo $dateObj->format('d/m/Y');
                            ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ticketNo">No. of ticket</label>
                            <input type="number" name="ticketNo" id="ticketNo" min="1" max="10" value="1">
                        </div>
                        <div class="buttons">
                            <button name="submit" class="btn-register">Confirm</button>
                        </div>
                    </div>
                </form>
            
            <?php } else if ($phase == "complete") { ?>
                <div class="ty">
                    <h2>Thank you</h2>
                    <p>You successfully registered for the event</p>
                    <a href="index.php">Back to home page</a>
                </div>
                <!-- <h2>Payment details</h2>
                <form method="POST">
                    <input type="hidden" name="phase" value="payment">
                    <div class="form-group">
                        <label for="cardNumber">Card Number</label>
                        <input type="number" name="cardNumber">
                    </div>
                    <div class="form-group">
                        <label for="expiry">Expiry</label>
                        <input type="text" name="expiry">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="number" name="cvv">
                    </div>
                </form> -->
            <?php } ?>
        </div>
    </main>
</body>
</html>