<?php
    function addToPage($conn, $id) {
        $stmt = $conn->prepare("UPDATE events SET status=1 WHERE eventId=?");
        $stmt->bind_param("s", $id);
    }
?>