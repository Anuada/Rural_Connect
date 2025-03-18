<?php
session_start();
include "../shared/session.city_health.php";
include "../shared/navbar_city_health.php";

$title = "Form Upload Medicine";
$db = new DbHelper();
$dh = new DirHandler();

ob_start();
?>

<title><?php echo htmlspecialchars($title); ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/styleUploadMed.css" rel="stylesheet">


<div class="container" style="margin-top: 10%;">
    <div class="row">
        <!-- Image Column -->
        <div class="col-md-6 image-container">
            <img src="../assets/img/misc/logo1.png" alt="Medicine Image">
        </div>
        <!-- Form Column -->
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4">Upload Medicine</h2>
                <form action="../logic/upload_med.php" method="post" enctype="multipart/form-data" id="submitformlegal">
                    <input type="hidden" name="city_health_id" value="<?php echo htmlspecialchars($_SESSION["accountId"]); ?>" required>

                    <div class="form-group mb-3">
                        <label for="TypeofMedicine">Medicine Name</label>
                        <input type="text" class="form-control" id="med_name" name="med_name" placeholder="Enter type of Medicine" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="med_description">Description</label>
                        <input type="text" class="form-control" id="med_description" name="med_description" placeholder="Enter type of Description" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="DosageForm">Dosage Form</label>
                        <input type="text" class="form-control" id="DosageForm" name="DosageForm" placeholder="Enter Dosage Form" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="DosageForm">Dosage Strength</label>
                        <input type="text" class="form-control" id="DosageStrength" name="DosageStrength" placeholder="Enter Dosage Strength" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required>
                    </div>
                    

                    <div class="form-group mb-3">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" placeholder="Enter Expiry Date" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="med_image">Upload Image</label>
                        <input type="file" accept="image/*" name="med_image" id="med_image" class="form-control" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100">Submit Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies (Popper.js and jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$content = ob_get_clean();
ob_start();
?>

<?php
$scripts = ob_get_clean();

require_once "../shared/layout.php";
?>