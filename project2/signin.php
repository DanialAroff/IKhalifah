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
            <p class="error-msg m-b-sm">
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
                // if (isset($_SESSION['failed_signin_msg']) && !empty($_SESSION['failed_signin_msg'])) {
                ?>
                    <div class="error-msg">
                        <i class="fa-solid fa-circle-info"></i>
                        <?= $_SESSION['failed_signin_msg'] ?>
                    </div>
                <?php
                //     unset($_SESSION['failed_signin_msg']);
                // }
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
            }, 2000);
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
                    } else {
                        let errMsg = document.querySelector('.error-msg');
                        errMsg.textContent = response.error;
                        console.log(errMsg)
                        errMsg.style.display = 'block';
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