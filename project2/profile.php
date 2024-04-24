<?php
    include_once('config.php');
    include('issignedin.php');

    if (isset($_POST['save'])) {
        // If password is changed
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $userId = $_SESSION['userId'];

        $stmt;
        if ($password) {
            $stmt = $conn->prepare("UPDATE users SET username=?, email=?, password=? WHERE user_id=?");
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("ssss", $username, $email, $password, $userId);
        } else {
            $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE user_id=?");
            $stmt->bind_param("sss", $username, $email, $userId);
        }

        $result = $stmt->execute();
        if ($result) {
            $result = mysqli_query($conn, "SELECT * FROM users WHERE user_id=$userId");
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <!-- <h1 class="main-heading">Profile</h1> -->
        <div class="container">
            <div class="row">
                <div class="img-container">
                    <img src="" alt="">
                </div>
                <div class="details">
                    <h2><?= $_SESSION['username'] ?></h2>
                    <p><?= $_SESSION['email'] ?></p>
                    <button class="btn-edit-profile">Edit profile</button>
                </div>
            </div>
            <div class="row">
                <div class="signout-container">
                    <a href="signout.php" class="signout">
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                        <p>Sign out</p>
                    </a>
                </div>
            </div>
            <dialog id="editProfile">
                <div class="header">
                    <h2>Edit Profile</h2>
                    <button class="btn-close">❌</button>
                </div>
                <form action="profile.php" method="POST" id="profileForm">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?= $_SESSION['username'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?= $_SESSION['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password">
                    </div>
                    <input type="hidden" name="save" value="1">
                    <button type="submit" class="btn-submit">
                        Save change
                    </button>
                </form>
            </dialog>
            <dialog id="confirmationDialog">
                <div class="dialog-body">
                    <h2>Confirmation</h2>
                    <p>Changes will be saved</p>
                    <div class="buttons">
                        <button class="btn-cancel-submit">Cancel</button>
                        <button class="btn-confirm-submit">Confirm</button>
                    </div>
                </div>
            </dialog>
        </div>
    </main>
    <script>
        const editDialog = document.querySelector('#editProfile');
        const confirmDialog = document.querySelector('#confirmationDialog');
        const btnEdit = document.querySelector('.btn-edit-profile');
        const btnSubmit = document.querySelector('.btn-submit');
        const btnConfirm = document.querySelector('.btn-confirm-submit');
        const btnCancel = document.querySelector('.btn-cancel-submit');

        btnEdit.addEventListener('click', () => {
            editDialog.showModal();
        });
        btnSubmit.addEventListener('click', e => {
            e.preventDefault();
            confirmDialog.showModal();
        });
        btnCancel.addEventListener('click', () => {
            confirmDialog.close();
        });
        btnConfirm.addEventListener('click', e => {
            const form = document.getElementById('profileForm');
            console.log(form);
            confirmDialog.close();
            // editDialog.close();
            form.submit();
            console.log('Submit');
            // editDialog.querySelector('form').submit();
        });

        const btnClose = document.querySelector('.btn-close');
        btnClose.addEventListener('click', () => {
            editDialog.close();
        });
    </script>
</body>
</html>