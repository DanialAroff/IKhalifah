<header>
    <div class="title">
        <a href="index.php">
            <img src="" alt="">
        </a>
    </div>
    <div class="d-flex">
        <nav>
            <div class="top-nav">
                <div class="lang">
                    <button class="btn-lang-bm btn-lang">BM</button>
                    <button class="btn-lang-eng btn-lang lang-border">ENG</button>
                </div>
                <div class="location">
                    <i class="fa-solid fa-location-dot"></i>
                    <div class="location-country-name">Malaysia</div>
                </div>
            </div>
            <ul>
                <?php
                // if ($_SESSION['user_type'] == 'user') {
                ?>
                <!-- <li><a href="activity.php">Activity</a></li> -->
                <?php
                // } 
                ?>
                <li><a href="">About Us</a></li>
                <li><a href="">Admissions</a></li>
                <li><a href="">Event</a></li>
                <li><a href="">Career Opportunity</a></li>
                <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </ul>
        </nav>
        <!-- <div class="searchbar-container"> -->
        <!-- <input list="events" name="events" placeholder="Search"> -->
        <!-- <datalist id="events"> -->
        <?php
        include_once('config.php');
        // $result = mysqli_query($conn, "SELECT * FROM events WHERE status=1 & approved=1"); 
        // while($row = mysqli_fetch_assoc($result)) {
        ?>
        <!-- <option value="<?= $row['event_name'] ?>"> -->
        <?php //} 
        ?>
        <!-- </datalist> -->
        <!-- </div> -->
        <!-- <a href="signout.php" class="signout">
            <span class="material-symbols-outlined">
                logout
            </span>
        </a> -->
    </div>
</header>