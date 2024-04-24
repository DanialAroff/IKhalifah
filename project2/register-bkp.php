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
</head>
<body>
    <main>
        <h1>Sign up!</h1>
        <p class="error-msg">
            <?php
                if (isset($_SESSION['register_err_msg'])) {
                    echo $_SESSION['register_err_msg'] . "<br><br>";
                    unset($_SESSION['register_err_msg']);
                }
            ?>
        </p>
        <form action="" method="POST" id="registrationForm">
            <div class="form-group">
                <input type="text" id="username" placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <input type="email" id="email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <input type="password" id="password" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <input type="password" id="repassword" placeholder="Re-enter Password" name="password2">
                <div class="hint-text">Password is not the same as above</div>
            </div>
            <button type="submit" name="submit">Sign me up</button>
            <div>
                <a href="signin.php">Already have an account? Sign in here</a>
            </div>
        </form>
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