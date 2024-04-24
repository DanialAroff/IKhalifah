<?php
    include_once('config.php');

    // Create new user/admin/organizer
    // $username = "admin";
    // $email = "admin1@mail.com";
    // $password = "admin123";
    // $user_type = "admin";
    $username = "organizer";
    $email = "test03@mail.com";
    $password = "123456";
    $user_type = "organizer";
    // exit();  

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password, user_type)
                VALUES ('$username', '$email', '$password', '$user_type')";

    try {
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "User $username created successfully";
        }
    } catch (Exception $e) {
        if (mysqli_errno($conn) == 1062) {
            echo "Duplicate entry.";
            // echo $e;
        }
    }
?>