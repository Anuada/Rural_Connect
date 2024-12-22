<?php

require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$db = new DbHelper();

$city_health = $db->fetchRecords('city_health', ['accountId' => $_SESSION['accountId']]);

$fname = isset($city_health[0]['fname']) ? $city_health[0]['fname'] : '';
$lname = isset($city_health[0]['lname']) ? $city_health[0]['lname'] : '';

?>

<?php ob_start() ?>
<?php $styles = ob_get_clean() ?>
<nav class="navbar fixed-top" style="background-color: #f8f9fa; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid m-1 d-flex align-items-center">
        <a class="navbar-brand ml-10" href="#">
            <img src="../assets/img/misc/med2.JPG" alt="Elevate Her Logo" width="160">
        </a>

        <div class="d-none d-md-flex align-items-center" style="margin-right: 10px">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./community.php">Community Forum</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./events.php">Events</a>
                </li>

                <li class="nav-item dropdown position-relative">
                    <div class="dropdown">
                        <a href="#" class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggleSideMenu()">
                            <?php if (!empty($city_health) && !empty($city_health[0]["profileImage"])) : ?>
                                <img src="<?php echo $dh->city_health. $city_health[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                            <?php else : ?>
                                <img src="<?php echo $dh->city_health; ?>profileicon.jpg" alt="Profile Image" width="40" height="40" style="border-radius: 60%;" onerror="this.src='../assets/img/profile/city_health/profile_icon.jpg'">
                            <?php endif; ?>
                            <!-- Drop Down Menu -->
                            <div class="dropdown-menu position-absolute dropdown-menu-right" style="right: 0; top: 100%;" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#">
                                    <?php echo $fname . " " . $lname ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../user/#">Update Profile</a>
                                <a class="dropdown-item" href="../logic/logout.php">Logout</a>
                            </div>
                            <!-- Drop Down Menu -->
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

