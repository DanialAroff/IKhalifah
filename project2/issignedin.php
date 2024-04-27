<?php
    if (!isset($_SESSION['signedin_ikhalifah']) || $_SESSION['signedin_ikhalifah'] != 1) {
        header('location: signin');
        exit();
    }
?>