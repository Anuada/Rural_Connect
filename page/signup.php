<?php session_start(); ?>
<?php require_once "../shared/session.redirect.php"; ?>
<?php $title = "Sign Up"; ?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/signup.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="../page/">Rural Connect</a>
    </div>
</nav>

<!-- Signup Form -->
<div class="d-flex align-items-center justify-content-center min-vh-100">
    <form action="../logic/signup.php" method="POST" enctype="multipart/form-data" id="signup-form">
        <div class="signup-container">
            <img src="../assets/img/misc/rural_connect_icon_logo.png" alt="Logo" />
            <div class="signup-form">
                <h2>Create an Account</h2>
                <div class="mb-3">
                    <label for="id_verification">Upload Valid ID</label>
                    <input type="file" accept="image/*" class="form-control" name="id_verification" id="id_verification"
                        required>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="number" class="form-control" name="contactNo" id="contactNo"
                            placeholder="Contact Number" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select class="form-control" name="user_type" id="user_type" required>
                            <option value="" hidden selected>Select User Type</option>
                            <option value="barangay_inc">Barangay Incharge</option>
                            <option value="city_health">City Health</option>
                            <option value="deliveries">Deliveries</option>
                        </select>
                    </div>
                    <div id="barangay_input_field" class="d-none"></div>
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                            required>
                    </div>
                    <div class="col-md-4 mb-3 password-container">
                        <input type="password" class="form-control passwordEl" id="password" name="password"
                            placeholder="Password" required aria-label="Password" />
                        <i class="fas fa-eye" data-action="togglePassword" style="cursor: pointer;"></i>
                    </div>
                    <div class="col-md-4 mb-3 password-container">
                        <input type="password" class="form-control passwordEl" name="con_password"
                            placeholder="Confirm Password" required>
                        <i class="fas fa-eye" data-action="togglePassword" style="cursor: pointer;"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                <a class="login-account" href="../page/login.php">Login to your Account →</a>
            </div>
        </div>
    </form>
</div>

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