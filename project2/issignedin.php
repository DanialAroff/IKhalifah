<?php
    if (!isset($_SESSION['signedin_ikhalifah']) || $_SESSION['signedin_ueventhub'] != 1) {
        header('location: signin.php');
        exit();
    }
?>