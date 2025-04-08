<?php session_start(); ?>
<?php require_once "../shared/session.redirect.php"; ?>
<?php $title = "Sign Up"; ?>

<?php ob_start(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/signup.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="../page/">Rural Connect</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="../page/">Home</a></li>
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
            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" name="contactNo" id="contactNo" placeholder="Contact Number"
                required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <select class="form-control" name="user_type" id="user_type" required>
                <option value="" hidden selected>Select User Type</option>
                <option value="barangay_inc">Barangay Incharge</option>
                <option value="city_health">City Health</option>
                <option value="deliveries">Deliveries</option>
            </select>
        </div>
        <div id="barangay_input_field"></div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
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

<script type="module" src="../assets/js/signup.js"></script>

<?php if (isset($_SESSION["informations"])): ?>
    <script>
        <?php foreach ($_SESSION["informations"] as $key => $value): ?>
            document.getElementById("<?php echo $key ?>").value = "<?php echo $value ?>";
        <?php endforeach ?>
    </script>
    <?php unset($_SESSION["informations"]) ?>
<?php endif; ?>

<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>