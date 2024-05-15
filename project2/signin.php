<?php require_once('config.php') ?>
<?php
$email = mysqli_real_escape_string($conn, $_POST['email'] ?? "");
$password = mysqli_real_escape_string($conn, $_POST['password'] ?? "");

// If remember me cookie exist
if (isset($_COOKIE['remember_token'])) {
    echo $_COOKIE['remember_token'];
    // exit();
}


if (isset($_SESSION['signedin_ikhalifah'])) {
    header('location: index.php');
    exit();
}
// if (isset($_POST['submit'])) {
//     $query = "SELECT * FROM users WHERE email=?";

//     // Prepared statement
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("s", $email);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     if ($result) {
//         $user = $result->fetch_assoc();
//         if ($user) {
//             if (password_verify($password, $user['password'])) {
//                 session_regenerate_id();
//                 $_SESSION['userId'] = $user['user_id'];
//                 $_SESSION['username'] = $user['username'];
//                 $_SESSION['email'] = $user['email'];
//                 $_SESSION['user_type'] = $user['user_type'];
//                 $_SESSION['signedin_ikhalifah'] = 1;

//                 $user_id = $user['user_id'];
//                 $email = $user['email'];
//                 // Timestamp when signed in
//                 try {
//                     mysqli_query($conn, "UPDATE users SET signed_in=NOW() WHERE user_id=$user_id");
//                 } catch (Exception $e) {
//                 }

//                 if (isset($_POST['rememberme'])) {
//                     // Update token for remember me                
//                     try {
//                         $token = openssl_random_pseudo_bytes(20);
//                         $token = hash('sha256', $token);
//                         $expires_at = time() + (7 * 24 * 60 * 60); // 7 days
//                         echo $expires_at;
//                         echo '<br>' . $user['email'];
//                         echo '<br>' . $email;
//                         // exit();

//                         $result = mysqli_query($conn, "INSERT INTO users_token (email, refresh_token, created_at, expires_at)
//                         VALUES ('$email', '$token', NOW(), '$expires_at')");
//                         if ($result) {
//                             // Set cookies
//                             // 3 days = 2592000 = 3 * 24 * 60 * 60
//                             define('remember_me_period', 7 * 24 * 60 * 60);
//                             setcookie('email', $user['email'], time() + remember_me_period);
//                             setcookie('remember_token', $token, time() + remember_me_period);
//                         }
//                     } catch (Exception $e) {
//                         echo $e;
//                         exit();
//                     }
//                 }

//                 header('location: index.php');
//                 exit();
//             } else {
//                 $_SESSION['failed_signin_msg'] = "Wrong email / password. Try again or click Forgot Password to reset account.";
//             }
//         } else {
//             $_SESSION['failed_signin_msg'] = "Wrong email / password. Try again or click Forgot Password to reset account.";
//         }
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="css/header.css">

    <script src="https://kit.fontawesome.com/57a4458178.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php //include('header.php'); 
    ?>
    <div class="loading-screen">
        <div class="loader-container">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
            <p>Signing you in...</p>
        </div>
    </div>
    <main>
        <div class="form-container">
            <h1>Login</h1>
            <p class="error-msg">
                <?php
                // if (isset($_SESSION['failed_signin_msg'])) {
                //     echo $_SESSION['failed_signin_msg'] . "<br><br>";
                //     unset($_SESSION['failed_signin_msg']);
                // }
                ?>
            </p>
            <form method="POST" id="signinForm">
                <div class="form-group">
                    <label for="email">Email Address/Alamat Emel</label>
                    <div class="input">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" placeholder="Email" name="email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password/Kata Laluan</label>
                    <div class="input">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" placeholder="Password" name="password" required>
                        <i class="fa-regular fa-eye-slash show-password" id="togglePassword"></i>
                    </div>
                </div>
                <div class="form-checkbox">
                    <input type="checkbox" name="rememberme" id="rememberme">
                    <label for="rememberme" aria-describedby="tooltip-rememberme">Remember Me?</label>
                </div>
                <?php
                if (isset($_SESSION['failed_signin_msg']) && !empty($_SESSION['failed_signin_msg'])) {
                ?>
                    <div class="error-msg">
                        <i class="fa-solid fa-circle-info"></i>
                        <?= $_SESSION['failed_signin_msg'] ?>
                    </div>
                <?php
                    unset($_SESSION['failed_signin_msg']);
                }
                ?>
                <button type="submit" name="submit">
                    Sign in
                </button>
            </form>
            <div class="links">
                <p>
                    Don't have an account?
                    <a href="register">Sign up</a>
                </p>
                <a href="password-reset.php">Forgot Password?</a>
            </div>
        </div>
    </main>

    <script src="script/jquery-3.7.1.min.js"></script>
    <script>
        const pass = document.getElementById('password');
        const togglePass = document.getElementById('togglePassword');

        togglePass.addEventListener('click', e => {
            const type = pass.type === "password" ? "text" : "password";
            pass.type = type;

            if (type === "password") {
                togglePass.classList.remove("fa-eye");
                togglePass.classList.add("fa-eye-slash");
            } else {
                togglePass.classList.remove("fa-eye-slash");
                togglePass.classList.add("fa-eye");
            }
        });
    </script>
    <script>
        // Spinner
        const loginForm = document.getElementById('signinForm');
        const loadingScreen = document.querySelector('.loading-screen');

        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();

            loadingScreen.style.display = 'grid';

            setTimeout(() => {
                loadingScreen.style.display = 'none';

                // Redirect to success page or display login successful message
            }, 1500);
        });
    </script>
    <script>
        $(document).on('submit', '#signinForm', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'actions/signin_process.php',
                type: 'POST',
                data: $('#signinForm').serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        window.location.href = response.redirect_url;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
</body>

</html>