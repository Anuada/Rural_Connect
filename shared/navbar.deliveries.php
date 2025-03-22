<?php
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

//session_start(); 

$dh = new DirHandler();
$db = new DbHelper();

// Fetch deliveries based on logged-in user
$deliveries = $db->fetchRecords('deliveries', ['accountId' => $_SESSION['accountId']]);

// Sanitize user data
$fname = isset($deliveries[0]['fname']) ? htmlspecialchars($deliveries[0]['fname'], ENT_QUOTES, 'UTF-8') : '';
$lname = isset($deliveries[0]['lname']) ? htmlspecialchars($deliveries[0]['lname'], ENT_QUOTES, 'UTF-8') : '';
$profileImage = isset($deliveries[0]['id_verification']) ? htmlspecialchars($deliveries[0]['id_verification'], ENT_QUOTES, 'UTF-8') : 'profileicon.jpg';
?>

<style>
    /* Sidebar Navigation */
    .sidebar {
        position: fixed;
        top: 0;
        left: -250px; /* Initially hidden */
        width: 250px;
        height: 100vh;
        background-color: #87CEEB;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        transition: left 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        padding: 15px;
        z-index: 1000;
    }

    .sidebar.open {
        left: 0;
    }

    .sidebar .navbar-brand {
        margin-bottom: 20px;
        text-align: center;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        margin: 10px 0;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        display: block;
        padding: 10px;
        border-radius: 5px;
        transition: background 0.2s ease-in-out;
    }

    .sidebar ul li a:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* Burger Menu */
    .burger-menu {
        font-size: 24px;
        background: none;
        border: none;
        cursor: pointer;
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1001;
        color: #333;
    }

    .profile-circle {
        width: 40px;
        height: 40px;
        background-color: #007bff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 14px;
        font-weight: bold;
        margin: 10px auto;
    }

    .sidebar .logout {
        position: absolute;
        bottom: 20px;
        width: 100%;
        text-align: center;
    }
</style>

<!-- Burger Menu Button -->
<button class="burger-menu" onclick="toggleSidebar()">☰</button>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <a class="navbar-brand" href="#">
        <img src="../assets/img/misc/med2.JPG" alt="Rural Logo" width="160">
    </a>

    <ul>
        <li><a href="./">🏠 Home</a></li>
        <li><a href="view_med.php">📦 Ready for Delivery</a></li>
        <li><a href="./events.php">💊 Ordered Medicine</a></li>
    </ul>

    <div class="profile-circle"><?= strtoupper(substr($fname, 0, 1)) ?></div>
    
    <ul>
        <li><a href="../user/#">⚙️ Update Profile</a></li>
        <li class="logout"><a href="../logic/logout.php">🚪 Logout</a></li>
    </ul>
</nav>

<script>
    function toggleSidebar() {
        let sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("open");
    }
</script>
