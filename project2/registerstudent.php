<?php
include_once('config.php');
include('issignedin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>i-Khalifah - About Us</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/registerstudent.css">

    <script src="https://kit.fontawesome.com/57a4458178.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main-container">
        <?php include('header.php'); ?>
        <main>
            <h1 class="page-title text-header">
                Register Student
            </h1>
            <div class="content">
                <form action="registerstudent_process.php" id="applicationForm">
                    <section class="form-section">
                        <p class="font-m m-b-sm text-bold">Student Information</p>
                        <div class="form-group">
                            <label for="fullname">Name</label>
                            <input type="text" name="fullname" id="fullname">
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Birth Date</label>
                            <input type="text" name="birthdate" id="birthdate">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" name="age" id="age">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option value="boy">Boy</option>
                                <option value="girl">Girl</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality">
                        </div>
                        <div class="form-group">
                            <label for="birthcertno">Birth Certificate No</label>
                            <input type="text" name="birthcertno" id="birthcertno">
                        </div>
                    </section>
                    <section class="form-section">
                        <p class="font-m m-b-sm text-bold">Parent Information</p>
                        <div class="form-group">
                            <label for=""></label>
                        </div>
                    </section>
                </form>
            </div>
        </main>
        <?php include('inc/footer.php'); ?>
    </div>
</body>

</html>