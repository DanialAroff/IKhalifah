<?php
    include_once('config.php');
    include('issignedin.php');

    $event;

    $action = '';
    // To prefill inputs
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'edit') {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $stmt = $conn->prepare("SELECT * FROM events WHERE event_id=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $event = $result->fetch_assoc();
        }
    }

    if (isset($_POST['submit']) ) {

        $eventId = mysqli_real_escape_string($conn, $_POST['eventId']);
        $eventName = mysqli_real_escape_string($conn, $_POST['eventName']);
        $venue = mysqli_real_escape_string($conn, $_POST['venue']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $date = date('Y-m-d', strtotime($date . " +0 days"));
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        // If eventId is true then it is an update
        if ($eventId) {
            if ($_FILES["eventImg"]["error"] == 0) {
                // Save image to folder
                $uploadDir = 'assets/img/events/';
                $targetFile = $uploadDir . basename($_FILES['eventImg']['name']);
    
                $move = move_uploaded_file($_FILES['eventImg']['tmp_name'], $targetFile);
                if ($move) {
                    $query = "UPDATE events SET
                        event_name=?, venue=?, date=?, description=?, img_path=?
                        WHERE event_id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssssss", $eventName, $venue, $date, $description, $targetFile, $eventId);
                    $result = $stmt->execute();
                    if ($result) {
                        header('location: index.php?success=1');
                        exit();
                    }
                } else {
                    // failed moving file
                }
            } else {
                $query = "UPDATE events SET
                event_name=?, venue=?, date=?, description=?
                WHERE event_id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssss", $eventName, $venue, $date, $description, $eventId);
                $result = $stmt->execute();
    
                if ($result) {
                    header('location: index.php?success=1');
                    exit();
                }
            }
        } 
        // Create new event
        else {
            $status = 2;
            $userId = $_SESSION['userId'];
            $username = $_SESSION['username'];
            if ($_FILES["eventImg"]["error"] == 0) {
                // Save image to folder
                $uploadDir = 'assets/img/events/';
                $targetFile = $uploadDir . basename($_FILES['eventImg']['name']);
    
                $move = move_uploaded_file($_FILES['eventImg']['tmp_name'], $targetFile);
                if ($move) {
                    $query = "INSERT INTO events (event_name, venue, date, description, img_path, status, organizer)
                    VALUES(?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssssss", $eventName, $venue, $date, $description, $targetFile, $status, $eventId);
                    $result = $stmt->execute();
                    if ($result) {
                        sendToApproval($conn, $userId, $username);
                        header('location: index.php?success=1');
                        exit();
                    }
                } else {
                    // failed moving file
                }
            } else {
                $query = "INSERT INTO events (event_name, venue, date, description, status, organizer)
                VALUES(?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssss", $eventName, $venue, $date, $description, $status, $userId);
                $result = $stmt->execute();
    
                if ($result) {
                    sendToApproval($conn, $userId, $username);
                    header('location: index.php?success=1');
                    exit();
                }
            }
        }

    }
    
    if ($action == '' && !isset($_POST['submit'])) {
        header('location: index.php');
    }

    function sendToApproval($conn, $userId, $username) {
        $lastId = mysqli_insert_id($conn);
        $query = "INSERT INTO approval (request_date, event_id, requestor, requestor_name)
            VALUES(NOW(), ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $lastId, $userId, $username);
        $stmt->execute();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/event-actions.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <h1 class="main-heading">Edit Event</h1>
        <form action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="eventId" value="<?= $_GET['id'] ?? '' ?>">
            <div class="form-group">
                <label for="eventName">Event Name</label>
                <input type="text" name="eventName" value="<?= $event['event_name'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" value="<?= ($event['date']) ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="venue">Venue</label>
                <input type="text" name="venue" value="<?= $event['venue'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="">Event Photo</label>
                <input type="file" name="eventImg" multiple="multiple" accept=".jpeg, .jpg, .png">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="" cols="30" rows="5"><?= trim($event['description'] ?? '') ?></textarea>
            </div>
            <div class="buttons">
                <a href="index.php" class="btn-back">Back</a>
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </main>
</body>
</html>