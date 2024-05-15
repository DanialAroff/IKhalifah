<link href="https://fonts.googleapis.com/css2?family=Marmelad&display=swap" rel="stylesheet">
<header>
    <div class="title-box">
        <a href="<?= base_url ?>">
            <img src="<?= base_url ?>/assets/img/khalifah_garden_logo-removebg.png" alt="">
        </a>
        <div class="title">
            <p class="title-name">i-Khalifah</p>
            <p class="title-subtext">Islamic science preschool</p>
        </div>
    </div>
    <div class="nav-container">
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
                <li><a href="<?= base_url ?>/aboutus.php">About Us</a></li>
                <li class="nav-admissions">
                    <a href="#">Admissions</a>
                    <div class="nav-admissions-sub sub-menu">
                        <div class="container">
                            <ul>
                                <li><a href="">Register Student</a></li>
                                <li><a href="">School Fees</a></li>
                                <li><a href="">Categories</a></li>
                                <li><a href="">Book Tour</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-event">
                    <a href="<?= base_url ?>/event/event.php">Event</a>
                    <div class="nav-event-sub sub-menu">
                        <div class="container">
                            <ul>
                                <li><a href="">Events List</a></li>
                                <li><a href="">Upcoming Event</a></li>
                                <li><a href="">Pictures</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="">Career Opportunity</a></li>
                <!-- <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button> -->
                <div id="menuContainer">
                    <button class="btn-menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="user-menu" id="userMenu">
                        <ul>
                            <li><a href="<?= base_url ?>/activities.php">Activities</a></li>
                            <li><a href="<?= base_url ?>/contactus.php">Contact Us</a></li>
                            <li><a href="<?= base_url ?>/faq.php">FAQ</a></li>

                            <?php
                            if (!isset($_SESSION['signedin_ikhalifah'])) {
                            ?>
                                <li><a href="<?= base_url ?>/signin.php">Sign in</a></li>
                            <?php } else { ?>

                                <li class="sign-out-item">
                                    <a href="<?= base_url ?>/signout.php">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <p>Sign out</p>
                                    </a>
                                </li>

                            <?php } ?>
                        </ul>
                    </div>
                </div>
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

    </div>

    <script>
        const navNames = ['aboutus', 'admissions', 'event', 'careeroppt'];
        const navAdmissions = document.querySelector('.nav-admissions');
        const admissionsSub = document.querySelector('.nav-admissions-sub');

        const initSub = (menu, submenu) => {
            menu.addEventListener('mouseenter', e => {
                submenu.style.display = 'block';
            });

            menu.addEventListener('mouseleave', e => {
                submenu.style.display = 'none';
            });
        }

        initSub(navAdmissions, admissionsSub);
        initSub(document.querySelector('.nav-event'), document.querySelector('.nav-event-sub'));

        const userMenu = document.getElementById('userMenu');
        const menuContainer = document.getElementById('menuContainer');

        menuContainer.addEventListener('mouseenter', e => {
            userMenu.style.display = 'block';
        });
        menuContainer.addEventListener('mouseleave', e => {
            userMenu.style.display = 'none';
        });
    </script>
</header>