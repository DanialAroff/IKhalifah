<?php
    include_once('config.php');
    $id = mysqli_real_escape_string($conn, $_GET['id']) ?? '';
    $status = mysqli_real_escape_string($conn, $_GET['status'] ?? '');

    $result = 0;
    if ($id && $status) {
        $stmt = $conn->prepare("UPDATE events SET status=? WHERE event_id=?");
        $stmt->bind_param("ss", $status, $id);
        $result = $stmt->execute();
    }

    header("location: index.php?res=$result");
?>