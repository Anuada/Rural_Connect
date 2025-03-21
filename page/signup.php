<?php session_start(); ?>
<?php $title = "Sign Up"; ?>
<?php ob_start(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
   
    body {
        background: linear-gradient(135deg, #D8EFFF, #A1D2FF);
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    
    .navbar {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        padding: 15px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar .nav-link {
        color: #007bff !important;
        font-size: 16px;
        font-weight: 500;
        transition: 0.3s;
    }

    .navbar .nav-link:hover {
        color: #0056b3 !important;
        transform: scale(1.05);
    }

    .navbar-brand {
        font-size: 20px;
        font-weight: bold;
        color: #007bff;
    }

    .btn-primary {
        background: #007bff;
        border: none;
        font-weight: 500;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

    /* Signup Form Container */
    .signup-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(15px);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.1);
        width: 450px;
        margin: 80px auto;
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
    }

    .signup-container h2 {
        font-size: 26px;
        font-weight: 600;
        color: #007bff;
    }

    .signup-container input, .signup-container select {
        background: rgba(255, 255, 255, 0.9);
        color: #333;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .signup-container input::placeholder {
        color: #888;
    }

    .signup-container input:focus, .signup-container select:focus {
        border: 1px solid #007bff;
        background: rgba(255, 255, 255, 1);
    }

    .login-account {
        display: block;
        margin-top: 12px;
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        transition: 0.3s;
    }

    .login-account:hover {
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
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">Rural Connect</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="value.php">Value</a></li>
      <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
    </ul>
  </div>
</nav>

<!-- Signup Form -->
<div class="signup-container">
    <h2>Create an Account</h2>

    <form action="../logic/signup.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Upload Valid ID</label>
            <input type="file" class="form-control" name="id_verification" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="fname" placeholder="First Name" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" name="contact" placeholder="Contact Number" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" placeholder="Address" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <select class="form-control" name="user_type" required>
                <option value="" disabled selected>Select User Type</option>
                <option value="barangay_inc">Barangay Incharge</option>
                <option value="city_health">City Health</option>
                <option value="deliveries">Deliveries</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="con_password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="signup">Sign Up</button>
        <a class="login-account" href="../page/login.php">Login to your Account →</a>
    </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
