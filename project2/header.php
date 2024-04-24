<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<header>
    <div class="title">
        <a href="index.php">UEVENT.HUB</a>
    </div>
    <div class="d-flex">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php 
                    if ($_SESSION['user_type'] == 'user') {
                ?>
                <li><a href="activity.php">Activity</a></li>
                <?php } ?>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
        <div class="searchbar-container">
            <input list="events" name="events" placeholder="Search">
            <datalist id="events">
                <?php
                    include_once('config.php');
                    $result = mysqli_query($conn, "SELECT * FROM events WHERE status=1 & approved=1"); 
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                <option value="<?= $row['event_name'] ?>">
                <?php } ?>
            </datalist>
        </div>
        <a href="signout.php" class="signout">
            <span class="material-symbols-outlined">
                logout
            </span>
        </a>
    </div>
</header>