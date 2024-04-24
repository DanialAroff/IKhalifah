<?php
    include('config.php');
    include('issignedin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEVENT>HUB - Approval Request</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/approvalrequest.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main class="p">
        <h1 class="main-heading">Approval Request</h1>
        <table>
            <tr>
                <th>Request Date</th>
                <th>Event</th>
                <th>Status</th>
                <th>Requestor</th>
                <th>Action</th>
            </tr>
            <?php
                $rows = array();
                try {
                    $result = mysqli_query($conn, "SELECT * FROM approval");
                    while($row = $result->fetch_assoc()) {
                        array_push($rows, $row);
                    }
                } catch (Exception $e) { }
                foreach($rows as $row) {
            ?>
            <tr>
                <td><?= date("d/m/Y", strtotime($row['request_date'])) ?></td>
                <td>

                </td>
                <td>
                    <?= $row['approved'] ? 'Approved' : 'Pending' ?>
                </td>
                <td class="col-requestor" data-id="<?= $row['requestor'] ?>">
                    <?= $row['requestor_name'] ?>
                </td>
                <td>
                    <?php 
                        $approvalCode = $row['approved'];
                        if ($approvalCode == 0) {
                    ?>
                    <button class="btn btn-approve" data-id="<?= $row['event_id'] ?>">Approve</button>
                    <button class="btn btn-reject" data-id="<?= $row['event_id'] ?>">Reject</button>
                    <?php 
                        } else {
                            if ($approvalCode == 1) {
                                echo '<div class="label-approved">Approved</div>';
                            } elseif ($approvalCode == 2) {
                                echo '<div class="label-rejected">Rejected</div>';
                            }
                        } 
                    ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <dialog id="requestorDialog">
            <form action="">
                <button>Approve</button>
            </form>
        </dialog>
    </main>
    <script>
        const dialog = document.getElementById('requestorDialog');
        const btnApprove = document.querySelectorAll('.btn-approve');
        const btnReject = document.querySelectorAll('.btn-reject');

        const btnRequestor = document.querySelectorAll('.col-requestor');

        if (btnApprove) {
            for (let btn of btnApprove) {
                btn.addEventListener('click', e => {
                    const id = e.target.getAttribute('data-id');
                    fetch(`requestdetailsdata.php?id=${id}`)
                        .then(response => response.json())
                        .then(data => {
                            dialog.innerHTML = `
                                <form method='POST' action='requestdetailsdata.php'>
                                    <h2>${data.event_name}</h2>
                                    <p>Date: ${data.date}</p>
                                    <p>Venue: ${data.venue}</p>
                                    <p>${data.description}</p>
                                    <input type=hidden value=${data.event_id} name='id'>
                                    <button class='btn-dialog-approve' name='approve'>Approve</button>
                                </form>
                            `;
                            console.log(data);
                            dialog.showModal();
                        })
                        .catch(error => console.error(error))
                });
            }
        }
        if (btnReject) {
            for (let btn of btnReject) {
                btn.addEventListener('click', e => {
                    const id = e.target.getAttribute('data-id');
                    fetch(`requestdetailsdata.php?id=${id}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data) { 
                                dialog.innerHTML = `
                                    <form method='POST' action='requestdetailsdata.php'>
                                        <h2>${data.event_name}</h2>
                                        <p>Date: ${data.date}</p>
                                        <p>Venue: ${data.venue}</p>
                                        <p>${data.description}</p>
                                        <input type=hidden value=${data.event_id} name='id'>
                                        <button class='btn-dialog-reject' name='reject'>Reject</button>
                                    </form>
                                `;
                                dialog.showModal();
                            }
                        })
                        .catch(error => console.error(error))
                }); 
            }
        }

        for (let req of btnRequestor) {
            console.log(req)
            req.addEventListener('click', e => {
                const reqId = e.target.getAttribute('data-id');
                fetch(`requestdetailsdata.php?userId=${reqId}`)
                .then(response => response.json())
                .then(data => {
                    dialog.innerHTML = `
                    <div class="requestor-profile">
                    <button class="btn-close" onclick="dialog.close()">❌</button>
                    <form method='POST' action='requestdetailsdata.php'>
                        <h2>${data.username}</h2>
                        <p>${data.email}</p>
                        <p>${data.phoneNo}</p>
                        </form>
                    
                    </div>
                    `;
                    dialog.showModal();
                })
                .catch(error => console.error(error))
            });
        }

        const btnClose = document.querySelector('.btn-close');
        btnClose.addEventListener('click', () => {
            dialog.close();
        });
    </script>
</body>
</html>