<?php session_start() ?>
<?php $title = "Sign Up" ?>
<?php ob_start() ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <div class="logo">
      <img src="../assets/img/misc/delivery_pic.jpeg" alt="Company Logo" width="70" height="70" style="border-radius: 50%; object-fit: cover;">
    </div>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Value</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
    <a class="btn btn-primary" href="../page/login.php">Login</a>
  </div>
</nav>

<!-- Signup Form -->
<div class="container mt-5">
    <h2 class="text-center">Signup Form</h2>
    

    <form action="../logic/signup.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="id_verification" class="form-label">Valid ID</label>
            <input type="file" class="form-control" name="id_verification" id="id_verification">
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lname" id="lname" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact Number</label>
            <input type="number" class="form-control" name="contact" id="contact" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="mb-3">
            <label for="user_type" class="form-label">User Type</label>
            <select class="form-control" name="user_type" id="user_type" required>
                <option value="barangay_inc">Barangay Incharge</option>
                <option value="city_health">City Health</option>
                <option value="deliveries">Deliveries</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="mb-3">
            <label for="con_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="con_password" id="con_password" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>
