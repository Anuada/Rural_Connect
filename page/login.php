<?php
session_start();
$title = "Login";
ob_start();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/login2.css">
<style>
    /* Global Styling */
    body {
        background: linear-gradient(135deg, #D8EFFF, #A1D2FF);
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        color: #333;
        flex-direction: column;
    }

    /* Navbar Styling */
    .navbar {
        width: 100%;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        padding: 15px 20px;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 0 0 10px 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar .nav-link {
        color: #007bff;
        font-size: 16px;
        margin: 0 10px;
        text-decoration: none;
        transition: 0.3s;
    }

    .navbar .nav-link:hover {
        color: #0056b3;
        transform: scale(1.05);
    }

    .navbar-brand {
        font-size: 20px;
        font-weight: bold;
        color: #007bff;
    }

    /* Login Box */
    .login-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(15px);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.1);
        width: 380px;
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
        margin-top: 80px;
    }

    /* Logo */
    .login-container img {
        width: 80px;
        margin-bottom: 15px;
        border-radius: 10px;
    }

    /* Form Styling */
    .login-form h2 {
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: 600;
        color: #007bff;
    }

    .login-form input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        background: rgba(255, 255, 255, 0.9);
        color: #333;
        outline: none;
        transition: 0.3s;
    }

    .login-form input::placeholder {
        color: #888;
    }

    .login-form input:focus {
        border: 1px solid #007bff;
        background: rgba(255, 255, 255, 1);
    }

   
    .login-form button {
        width: 100%;
        padding: 12px;
        background: #007bff;
        border: none;
        color: white;
        font-size: 18px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .login-form button:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

   
    .forgot-password, .create-account {
        display: block;
        margin-top: 12px;
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        transition: 0.3s;
    }

    .forgot-password:hover, .create-account:hover {
        text-decoration: underline;
        opacity: 0.8;
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<nav class="navbar">
    <a class="navbar-brand" href="#">Rural Connect</a>
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="value.php">Value</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
    </ul>
</nav>

<form action="../logic/login.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/delivery_pic.jpeg" alt="Logo" />
        <div class="login-form">
            <h2>Login to Your Account</h2>
            <input placeholder="Username" required aria-label="Username" type="text" id="username" name="username" />
            <input placeholder="Password" required aria-label="Password" type="password" id="password" name="password" />
            <button type="submit" name="login">Login</button>
            <a class="forgot-password" href="../page/forgot-password.php">Forgot Password?</a>
            <a class="create-account" href="../page/signup.php">Create an Account →</a>
        </div>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>
