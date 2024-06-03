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
                    <!-- <i class="fa-solid fa-location-dot"></i> -->
                    <i class="fa-solid fa-phone"></i>
                    <div class="location-country-name">+03-XXXXXXX</div>
                </div>
            </div>
            <ul>
                <li><a href="<?= base_url ?>/aboutus.php">About Us</a></li>
                <li class="nav-admissions">
                    <a href="#">Admissions</a>
                    <div class="nav-admissions-sub sub-menu">
                        <div class="d-flex justify-end">
                            <ul>
                                <li><a href="<?= base_url ?>/registerstudent.php">Register Student</a></li>
                                <li><a href="<?= base_url ?>/fees.php">School Fees</a></li>
                                <li><a href="">Book Tour</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-event">
                    <a href="<?= base_url ?>/events.php">Event</a>
                    <div class="nav-event-sub sub-menu">
                        <div class="d-flex justify-end">
                            <ul>
                                <li><a href="<?= base_url ?>/event-upcoming.php">Upcoming Event</a></li>
                                <li><a href="">Photos</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button> -->
                <?php
                if (isset($_SESSION['signedin_ikhalifah'])) {
                ?>
                    <div id="menuContainer">
                        <button class="btn-menu">
                            <?php if (isset($_SESSION['username'])) { ?>
                                <p>Hi, <?= $_SESSION['username'] . '!' ?></p>
                            <?php } ?>
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.875rem"></i>
                        </button>
                        <div class="user-menu" id="userMenu">
                            <ul>
                                <li><a href="<?= base_url ?>/profile.php">Profile</a></li>
                                <li><a href="<?= base_url ?>/schedule.php">Schedule</a></li>
                                <li><a href="<?= base_url ?>/contactus.php">Contact Us</a></li>

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
                <?php
                } else {
                ?>
                    <li class="signin">
                        <a href="<?= base_url ?>/signin.php" class="signin-link">Sign in</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <!-- <div class="searchbar-container"> -->
        <!-- <input list="events" name="events" placeholder="Search"> -->
        <!-- <datalist id="events"> -->
        <?php
        // include_once('config.php');
        // $result = mysqli_query($conn, "SELECT * FROM events WHERE status=1 & approved=1"); 
        // while($row = mysqli_fetch_assoc($result)) {
        ?>
        <!-- <option value=""> -->
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

        // const userMenu = document.getElementById('userMenu');
        // const menuContainer = document.getElementById('menuContainer');

        // menuContainer.addEventListener('mouseenter', e => {
        //     userMenu.style.display = 'block';
        // });
        // menuContainer.addEventListener('mouseleave', e => {
        //     userMenu.style.display = 'none';
        // });
    </script>
    <script>
        // Open/close personal menu
        let isOpen = false;

        const menuBtn1 = document.querySelector('.btn-menu');
        const menuContainer = document.getElementById('menuContainer');
        const userMenu = document.getElementById('userMenu');

        document.addEventListener('click', e => {
            if (!menuContainer.contains(e.target)) {
                if (isOpen) {
                    userMenu.style.display = 'none';
                    isOpen = false;
                }
            }
        });

        menuBtn1.addEventListener('click', e => {
            e.preventDefault();
            userMenu.style.display = isOpen ? 'none' : 'block';
            isOpen = !isOpen;
        });
    </script>
</header>