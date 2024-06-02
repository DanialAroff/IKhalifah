<?php
include_once('config.php');
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

    <script src="https://kit.fontawesome.com/57a4458178.js" crossorigin="anonymous"></script>
    <style>
        main {
            margin: 1.75rem;
            padding: 0;
            background-color: #FEFEFE;
            border-radius: 4px;
        }

        main p {
            margin-bottom: 10px;
        }

        .fees-card {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.125);
            margin-bottom: 20px;
        }

        .fees-card--header {
            background-color: #DDD;
            color: var(--primary-color);
            padding: 0.875rem 0.75rem;
            overflow: hidden;
        }

        .fees-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .fees-card table td {
            padding: 0 0.75rem;
            padding-block: 1rem;
            /* padding-top: 1.25rem; */
        }

        .fees-card .col--fee {
            text-align: end;
        }

        .fees-card p.note {
            margin-top: 0.25rem;
            font-style: italic;
        }

        .fees-card table tr {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <?php include('header.php'); ?>
        <main>
            <!-- https://www.alice-smith.edu.my/join/tuition-and-fees -->
            <h1 class="page-title">
                School Fees
            </h1>
            <div class="content">
                <div class="fees-card">
                    <div class="fees-card--header">Application and Enrolment</div>
                    <table>
                        <tr>
                            <td class="col--item">
                                1. <strong>Registration fees</strong>
                                <p class="note">Payable upon submission of Application Form</p>
                            </td>
                            <td class="col--fees">RM 500</td>
                        </tr>
                        <tr>
                            <td class="col--item">
                                2. <strong>Enrolment fee, non-refundable</strong>
                                <p class="note">To be paid to confirm the placement of a child</p>
                            </td>
                            <td class="col--fees">RM 2,000</td>
                        </tr>
                    </table>
                </div>
                <!-- Fees -->
                <div class="fees-card">
                    <div class="fees-card--header">Fees</div>
                    <table>
                        <tr>
                            <td class="col--item">
                                1. School fees are inclusive of all books, materials and resources.
                            </td>
                            <!-- <td class="col--fees">RM 1,500</td> -->
                        </tr>
                        <tr>
                            <td class="col--item">
                                2. A parent deposit is required for each child. The deposit is refundable when the child leaves the school with sufficient notification (one full term’s notice).
                            </td>
                            <!-- <td class="col--fees">RM 5,000</td> -->
                        </tr>
                    </table>
                </div>
            </div>
        </main>
        <?php include('inc/footer.php'); ?>
    </div>
</body>

</html>