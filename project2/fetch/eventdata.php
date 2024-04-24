<?php
    include('./config.php');

    function getAllEvents($conn) {
        $result = mysqli_query($conn, 'SELECT * FROM events');
        $arr = $result->fetch_all();
        return $arr;
    }

    function getEvent($conn, $id) {
        $id = mysqli_real_escape_string($conn, $id);
        $stmt = $conn->prepare('SELECT * FROM events WHERE event_id=?');
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
?>