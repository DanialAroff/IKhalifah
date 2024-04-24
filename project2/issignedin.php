<?php
    if (!isset($_SESSION['signedin_ueventhub']) || $_SESSION['signedin_ueventhub'] != 1) {
        header('location: signin.php');
        exit();
    }
?>