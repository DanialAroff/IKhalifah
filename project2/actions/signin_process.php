<?php
    require_once('../config.php');

    if (isset($_POST['email'])) {
        $errMsg1 = "Incorrect email / password. Try again or click Forgot Password to reset account.";
        $errMsg1_console = "Incorrect credentials";
        $query = "SELECT * FROM users WHERE email=?";

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Prepared statement
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $user = $result->fetch_assoc();
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_regenerate_id();
                    $_SESSION['userId'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['userType'] = $user['user_type'];
                    $_SESSION['signedin_ikhalifah'] = 1;

                    $user_id = $user['user_id'];
                    $email = $user['email'];
                    // Timestamp when signed in
                    try {
                        mysqli_query($conn, "UPDATE users SET signed_in=NOW() WHERE user_id=$user_id");
                    } catch (Exception $e) { }

                    if (isset($_POST['rememberme'])) {
                        // Update token for remember me                
                        try {
                            $token = openssl_random_pseudo_bytes(20);
                            $token = hash('sha256', $token);
                            $expires_at = time() + (7 * 24 * 60 * 60); // 7 days
                            echo $expires_at;

                            $result = mysqli_query($conn, "INSERT INTO users_token (email, refresh_token, created_at, expires_at)
                            VALUES ('$email', '$token', NOW(), '$expires_at')");
                            if ($result) {
                                // Set cookies
                                // 3 days = 2592000 = 3 * 24 * 60 * 60
                                define('remember_me_period', 7 * 24 * 60 * 60);
                                setcookie('email', $user['email'], time() + remember_me_period);
                                setcookie('remember_token', $token, time() + remember_me_period);
                            }
                        } catch (Exception $e) {
                            exit();
                        }
                    }

                    header('Content-Type: application/json');
                    echo json_encode(array("success" => true, "redirect_url" => "index"));
                    exit();
                } else {
                    $_SESSION['failed_signin_msg'] = $errMsg1;
                    header('Content-Type: application/json');
                    echo json_encode(array("success" => false, "error" => $errMsg1));
                    exit();
                }
            } else {
                $_SESSION['failed_signin_msg'] = $errMsg1;
                echo $errMsg1_console. ' ' . $user;
                exit();
            }
        } else {
            header('Content-Type: application/json');
            echo 'Cannot find user';
            exit();
        }
    } else  {
        header('Content-Type: application/json');
        // echo 'Invalid request.';
        echo json_encode($_POST);
    }
?>