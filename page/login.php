<?php
session_start();
require_once "../shared/session.redirect.php";
require_once "../util/DeviceDetector.php";

$device = new DeviceDetector();

if ($device->type() == 'mobile') {
    header("Location: ../mobile/login.php");
    exit();
}
$title = "Login";

ob_start();
?>
<link rel="stylesheet" href="../assets/css/login.css">
<?php
$styles = ob_get_clean();

ob_start();
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="../page/">Rural Connect</a>
    </div>
</nav>

<!-- Login Form -->
<form action="../logic/login.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/rural_connect_icon_logo.png" alt="Logo" />
        <div class="login-form">
            <h2>Login to Your Account</h2>
            <input type="text" id="username" name="username" placeholder="Username" required aria-label="Username"
                value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" />
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required
                    aria-label="Password" />
                <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
            </div>
            <button type="submit" name="login">Login</button>
            <a class="forgot-password" href="../page/forgot-password.php">Forgot Password?</a>
            <a class="create-account" href="../page/signup.php">Create an Account →</a>
        </div>
    </div>
</form>
<?php
unset($_SESSION["username"]); // Clear session username after use
$content = ob_get_clean();

$scripts = '<script type="module" src="../assets/js/login.js"></script>'; // No additional scripts needed

require_once "../shared/layout.php";
?>