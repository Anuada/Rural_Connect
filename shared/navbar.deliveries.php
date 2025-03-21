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
    .nav-link.fuchsia {
        text-decoration: none;
        border-bottom: 2px solid #B6D0E2;
        padding-bottom: 2px;
        font-style: italic;
    }
</style>

<nav class="navbar fixed-top" style="background-color: #f8f9fa; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid m-1 d-flex align-items-center">
        <a class="navbar-brand ml-10" href="#">
            <img src="../assets/img/misc/med2.JPG" alt="Rural Logo" width="160">
        </a>

        <div class="d-none d-md-flex align-items-center" style="margin-right: 10px;">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    
                <a class="nav-link fuchsia" style="margin-right: 15px;" href="./">Home</a>
                    
                </li>

                <li class="nav-item">
                   
                        <a class="nav-link fuchsia" style="margin-right: 15px;" href="view_med.php">Ready for Delivery</a>
                    
                </li>
                <li class="nav-item">
                    
                        <a class="nav-link fuchsia" style="margin-right: 15px;" href="./events.php">Order Medicine</a>

                    
                </li>
                <li class="nav-item dropdown position-relative">
    <div class="dropdown">
    <a href="#" class="nav-link d-flex align-items-center" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggleSideMenu()">
    <div style="
                width: 40px; 
                height: 40px; 
                background-color: #007bff; 
                color: white; 
                font-weight: bold; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                border-radius: 50%; 
                font-size: 14px;">
                B
            </div>
        </a>
        <!-- Drop Down Menu -->
        <div class="dropdown-menu position-absolute dropdown-menu-right" style="right: 0; top: 100%;" aria-labelledby="profileDropdown">
            
            <a class="dropdown-item" href="#">
                <?php echo"Barangay" ?>
                <?php echo "<br>";?>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../user/#">Update Profile</a>
            <a class="dropdown-item" href="../logic/logout.php">Logout</a>
        </div>
        <!-- Drop Down Menu -->
    </div>
</li>


        </div>
    </div>
</nav>