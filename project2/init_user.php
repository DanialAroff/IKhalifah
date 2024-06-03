<?php
    include_once('config.php');

    // Check if at least one row of user exist
    $resultCheck = mysqli_query($conn, 'SELECT COUNT(user_id) AS row_count FROM users');
    if ($resultCheck) {
        $row = mysqli_fetch_assoc($resultCheck);
        if ($row['row_count'] > 0) {
            echo "A user exist.";
        } else {
            // echo "users table is empty. <br>";

            // Create new user/admin/organizer
            // $username = "admin";
            // $email = "admin1@mail.com";
            // $password = "admin123";
            // $user_type = "admin";
            $username = "user1";
            $email = "user1@gmail.com";
            $password = "user123";
            $user_type = "user1";

            $password = password_hash($password, PASSWORD_DEFAULT);
            $prefix = date('Ym-');
            $code = sprintf("%'.05d", 1);
            $user_code = $prefix . $code;

            $query = "INSERT INTO users (user_code, username, email, password, user_type)
                    VALUES ('$user_code', '$username', '$email', '$password', '$user_type')";

            try {
                $result = mysqli_query($conn, $query);
                if ($result) {
                    echo "User <b>$username</b> created successfully.";
                }
            } catch (Exception $e) {
                if (mysqli_errno($conn) == 1062) {
                    echo "A user with the same email already exist.";
                }
            }
        }
        mysqli_free_result($resultCheck);
    }
    else {
        echo "Register failed";
    }
?>