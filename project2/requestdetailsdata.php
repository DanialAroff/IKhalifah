<?php
    include_once('config.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM events WHERE event_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(array('error' => 'Request not found'));
        }
    }

    if (isset($_POST['approve'])) {
        $id = $_POST['id'];
        $query = "UPDATE events SET approved=1 WHERE event_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $result1 = $stmt->execute();

        $stmt->free_result();
        $stmt = $conn->prepare("UPDATE approval SET approved=1 WHERE event_id=?");
        $stmt->bind_param("s", $id);
        $result2 = $stmt->execute();

        // echo $result;
        header("location: approvalrequest.php?res=$result1");
    } else if (isset($_POST['reject'])) {
        $id = $_POST['id'];
        $query = "UPDATE events SET approved=2 WHERE event_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $result1 = $stmt->execute();

        $stmt->free_result();
        $stmt = $conn->prepare("UPDATE approval SET approved=2 WHERE event_id=?");
        $stmt->bind_param("s", $id);
        $result2 = $stmt->execute();

        // echo $result;
        header("location: approvalrequest.php?res=$result1");
    }

    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode(array("error"));
        }
    }
?>