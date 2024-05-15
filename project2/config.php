<?php
    session_start();

    define('base_url', 'http://localhost/lwm-043/IKhalifah/project2'); // change url according to project path

    // DB init
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ikhalifah";

    // Create connection
    $conn = mysqli_connect($server, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>