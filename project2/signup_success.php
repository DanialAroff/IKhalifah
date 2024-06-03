<?php
    include_once('config.php');
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
    <style>
        main {
            height: 100%;
            display: grid;
            place-items: center;
        }
        h1 {
            font-size: 3rem;
            text-transform: uppercase;
        }
        .container {
            color: #FFF;
            text-align: center;
        }
        a {
            color: #16CEDA;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>Success</h1>
            <p>You have sign up an account successfully.</p>
            <a href="signin.php">Sign in to your account here</a>
        </div>
    </main>
</body>
</html>