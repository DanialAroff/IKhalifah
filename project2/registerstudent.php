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
                <form action="actions/registerstudent_process.php" id="applicationForm" class="d-flex flex-column">
                    <section class="form-section">
                        <p class="font-m m-b-sm text-bold">Student Information</p>
                        <div class="form-group">
                            <label for="fullname">Name</label>
                            <input type="text" name="fullname" id="fullname">
                        </div>
                        <div class="form-group-multiple">
                            <div class="form-group">
                                <label for="birthdate">Birth Date</label>
                                <input type="date" name="birthdate" id="birthdate">
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
                        </div>
                        <div class="form-group-multiple">
                            <div class="form-group">
                                <label for="birthcertno">Birth Certificate No</label>
                                <input type="text" name="birthcertno" id="birthcertno">
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" name="nationality" id="nationality">
                            </div>
                        </div>
                        <br>
                        <div class="form-group-address">
                            <!-- <p class="">Address</p> -->
                            <label for="address1">Adress Line 1</label>
                            <input type="text" name="address1" id="address1" placeholder="">
                            <label for="address2">Adress Line 2</label>
                            <input type="text" name="address2" id="address2" placeholder="">
                            <div class="form-group-multiple">
                                <div class="form-group">
                                    <label for="address3">Postcode</label>
                                    <input type="text" name="address3" id="address3" placeholder="ex: 46150">
                                </div>
                                <div class="form-group">
                                    <label for="address4">City</label>
                                    <input type="text" name="address4" id="address4" placeholder="">
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="form-section">
                        <p class="font-m m-b-sm text-bold">Parent Information</p>
                        <div class="form-group">
                            <label for="parentFullname">Name</label>
                            <input type="text" name="parentFullname" id="parentFullname">
                        </div>
                        <div class="form-group-multiple">
                            <div class="form-group">
                                <label for="parentIc">IC No</label>
                                <input type="text" name="parentIc" id="parentIc">
                            </div>
                            <div class="form-group">
                                <label for="parentAge">Age</label>
                                <input type="text" name="parentAge" id="parentAge">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="relationship">Relationship with child</label>
                            <select name="relationship" id="relationship">
                                <option value="boy">Father</option>
                                <option value="girl">Mother</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parentNationality">Nationality</label>
                            <input type="text" name="nationality" id="parentNationality">
                        </div>
                        <div class="form-group">
                            <label for="parentOccupation">Occupation</label>
                            <input type="text" name="parentOccupation" id="parentOccupation">
                        </div>
                        <div class="form-group">
                            <label for="parentPhone">Phone Number</label>
                            <input type="tel" name="parentPhone" id="parentPhone">
                        </div>
                    </section>
                    <!-- <section class="form-section">
                        <p class="font-m m-b-sm text-bold">Children Information</p>
                        <div class="form-group">
                            <label for="healthinfo">Info</label>
                            <input type="checkbox" name="healthInfo1" id="healthInfo1" value="asthma">
                        </div>
                    </section> -->

                    <button type="submit" name="submit" class="btn-submit">Register</button>
                </form>
            </div>
        </main>
        <?php include('inc/footer.php'); ?>
    </div>
</body>

</html>