<?php
session_start();
require_once "../shared/session.redirect.php";
require_once "../util/DeviceDetector.php";

$device = new DeviceDetector();

if ($device->type() == 'desktop') {
    header("Location: ../page/login.php");
    exit();
}
$title = "Login";

ob_start();
?>
<link rel="stylesheet" href="../assets/css/login.mobile.css">
<?php 
$styles = ob_get_clean(); 

ob_start();
?>

<!-- Login Form -->
<form action="../logic/login.mobile.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/delivery_pic.jpeg" alt="Logo" />
        <div class="login-form">
            <h2>Login As Delivery Person</h2>
            <input 
                type="text" 
                id="username" 
                name="username" 
                placeholder="Username" 
                required 
                aria-label="Username"
                value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>"
            />
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Password" 
                required 
                aria-label="Password" 
            />
            <button type="submit" name="login">Login</button>
        </div>
    </div>
</form>
<?php 
unset($_SESSION["username"]);
$content = ob_get_clean(); 

require_once "../shared/layout.php"; 
?>