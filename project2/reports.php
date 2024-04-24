<?php
    include_once('config.php');

    // Get users data
    $userArr = array();
    $result = mysqli_query($conn, "SELECT * FROM users WHERE user_type='user'");
    while ($data = mysqli_fetch_assoc($result)) {
        array_push($userArr, $data);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/reports.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <h1 class="main-heading">Data and Reports</h1>
        <div class="report">
            <!-- <h2>Your Customers</h2> -->
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Tickets</th>
                    <th>Last Login</th>
                    <th>Status</th>
                </tr>
                <?php 
                    for ($i = 0; $i < sizeof($userArr); $i++ ) {
                        $user = $userArr[$i];
                ?>
                <tr>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td class="col-ticket">
                        <?php
                            // get ticket col from event_register based on user_id and total them up
                            $total = 0;
                            try {
                                $userId = $user['user_id'];
                                $result = mysqli_query($conn, 
                                "SELECT ticket FROM event_register WHERE user_id=$userId");
                                while ($row = $result->fetch_assoc()) {
                                    $total += $row['ticket'];
                                }
                            } catch (Exception $e) { }
                            echo $total;    
                        ?>
                        <span class="material-symbols-outlined">
                            book_online 
                        </span>
                    </td>
                    <td>
                        <?php
                            $lastSignedIn = $user['signed_in'];
                            $timestamp =  date('h:i:sa', strtotime($lastSignedIn));
                            echo $timestamp;
                        ?>
                    </td>
                    <td>Active</td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </main>
</body>
</html>