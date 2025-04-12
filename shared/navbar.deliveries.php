<?php
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$db = new DbHelper();

$deliveries = $db->fetchRecords('deliveries', ['accountId' => $_SESSION['accountId']]);

$fname = isset($deliveries[0]['fname']) ? htmlspecialchars($deliveries[0]['fname'], ENT_QUOTES, 'UTF-8') : '';
$lname = isset($deliveries[0]['lname']) ? htmlspecialchars($deliveries[0]['lname'], ENT_QUOTES, 'UTF-8') : '';
$profileImage = isset($deliveries[0]['id_verification']) ? htmlspecialchars($deliveries[0]['id_verification'], ENT_QUOTES, 'UTF-8') : 'profileicon.jpg';
?>

<style>
    /* Navbar Custom Styling */
    .navbar-custom {
        background: linear-gradient(135deg, #006eff, #0056d2);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        padding: 12px 20px;
        transition: all 0.3s ease-in-out;
    }

    /* Navbar Links */
    .nav-link.fuchsia {
        text-decoration: none;
        border-bottom: 2px solid transparent;
        padding-bottom: 2px;
        color: white !important;
        transition: all 0.3s ease-in-out;
    }

    .nav-link.fuchsia:hover {
        border-bottom: 2px solid #ffffff;
        transform: translateY(-2px);
    }

    /* Profile Dropdown */
    .profile-container {
        width: 45px;
        height: 45px;
        background: white;
        color: #0056d2;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 16px;
        border: 2px solid white;
        transition: all 0.3s ease-in-out;
    }

    .profile-container:hover {
        background: #f8f9fa;
        color: #007bff;
    }

    /* Dropdown Menu Styling */
    .dropdown-menu {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        border: none;
    }

    .dropdown-item {
        font-weight: 500;
        transition: all 0.3s ease-in-out;
    }

    .dropdown-item:hover {
        background: #007bff;
        color: white;
    }
</style>

<nav class="navbar fixed-top navbar-custom">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand ml-10" href="#">
            <img src="../assets/img/misc/med2.JPG" alt="Rural Logo" width="160">
        </a>

        <div class="d-none d-md-flex align-items-center">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 20px;" href="./">Home</a>
                </li>
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown position-relative">
                    <div class="dropdown">
                        <a href="#" class="nav-link d-flex align-items-center" id="profileDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="profile-container">M</div>
                        </a>
                        <!-- Drop Down Menu -->
                        <div class="dropdown-menu position-absolute dropdown-menu-right" style="right: 0; top: 100%;"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">Deliveries</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../deliveries/updateProfile.php">Update Profile</a>
                            <a class="dropdown-item" href="../page/rate-and-feedback.php">Rate & Feedback</a>
                            <a class="dropdown-item" href="../logic/logout.php">Logout</a>
                        </div>
                        <!-- Drop Down Menu -->
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>