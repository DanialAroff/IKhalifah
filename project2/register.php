<?php
    include_once('config.php');

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username'] ?? "");
        $email = mysqli_real_escape_string($conn, $_POST['email'] ?? "");
        $password = mysqli_real_escape_string($conn, $_POST['password'] ?? "");
        $password2 = mysqli_real_escape_string($conn, $_POST['password2'] ?? "");
        $userType = 'user';

        if ($password !== $password2) {
            $_SESSION['register_err_msg'] = 'Password are not the same';
            header('location: signin.php');
            exit();
        }

        // check if username already exist
        // https://stackoverflow.com/questions/17736421/how-to-prevent-duplicate-usernames-when-people-register
        $query1 = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_row();
        if ($row) {
            print_r($row);
            exit();
            $_SESSION['register_err_msg'] = "Username has already been taken";
            $stmt->free_result();
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $username, $email, $password, $userType);
            $stmt->execute();
    
            $result = $stmt->get_result();
            if ($result) {
                header('location: signup-success.php');
            }
        }

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
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/auth.css">

    <script src="https://kit.fontawesome.com/57a4458178.js" crossorigin="anonymous"></script>
</head>
<body>
<main>
        <!-- <div class="background"> -->
            <div class="form-container">
                <h1>Sign Up</h1>
                <p class="error-msg">
                    <?php
                        if (isset($_SESSION['failed_signin_msg'])) {
                            echo $_SESSION['failed_signin_msg'] . "<br><br>";
                            unset($_SESSION['failed_signin_msg']);
                        }
                    ?>
                </p>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input">
                            <i class="fa-regular fa-user"></i>
                            <input type="username" id="username" placeholder="Username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address/Alamat Emel</label>
                        <div class="input">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="email" placeholder="Email" name="email" required>
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
                    <div class="form-group">
                        <label for="repassword">Password/Kata Laluan</label>
                        <div class="input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="repassword" id="repassword" placeholder="Re-enter Password" name="repassword" required>
                            <i class="fa-regular fa-eye-slash show-password" id="togglePassword"></i>
                        </div>
                    </div>
                    <button type="submit" name="submit">
                        Sign up
                    </button>
                </form>
                <div class="links">
                    <p>
                        Already have an account? 
                        <a href="register.php">Log in here</a>
                    </p>
                    <!-- <a href="password-reset.php">Forgot Password?</a> -->
                </div>
                <div class="signup-success">
                    <div class="success-icon-container">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <p>Your account has been registered.</p>
                    <p>Sign in <a href="signin.php">here</a> </p>
                </div>
            </div>
        <!-- </div> -->
    </main>
    <script>
        let valid = false;
        let filled = false;

        const password = document.getElementById('password');
        const repassword = document.getElementById('repassword');
        const form = document.getElementById('registrationForm');
        const submitButton = form.getElementsByTagName('button');
        const hintText = document.querySelector('.hint-text');
        // submitButton.disabled;

        const toggle = () => {
            if (repassword.value !== password.value) {
                console.log('Invalid');
                hintText.style.display = 'block';
            } else {
                hintText.style.display = 'none';
            }
        }
        repassword.addEventListener('keyup', e => {
            filled = true;
            toggle();
        });
        password.addEventListener('keyup', e => {
            if (filled) {
                toggle();
            }
        });
        form.addEventListener('submit', e => {
            if (repassword.value !== password.value) {
                e.preventDefault();
            }
        });

    </script>
</body>
</html>