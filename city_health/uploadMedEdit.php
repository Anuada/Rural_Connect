<?php
include "../util/dbhelper.php";
session_start(); // Start the session
require_once "../shared/session.city_health.php";

ob_start();
include "../shared/navbar_city_health.php";
$navbar = ob_get_clean();
echo $navbar; 

$db = new DbHelper;
$id = $_GET["id"] ?? null;

if (!$id) {
    die("Invalid ID provided.");
}

// Ensure the correct table name is used
$medicine = $db->getRecord("med_availabilty", ["id" => $id]); 

if (!$medicine) {
    die("Medicine not found.");
}

?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<?php $styles = ob_get_clean(); ?>
<?php ob_start(); ?>
    <div class="container mt-4">
        <h2>Update Medicine</h2>
        <form style="margin-top:10%;" action="../logic/upadate_med_avail.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($medicine["id"]); ?>">

            <div class="mb-3">
                <label for="med_name" class="form-label">Type of Medicine</label>
                <input type="text" id="med_name" name="med_name" class="form-control" 
                    value="<?php echo htmlspecialchars($medicine["med_name"]); ?>" required>
            </div>

            <div class="mb-3">
                <label for="med_description" class="form-label">Description</label>
                <input type="text" id="med_description" name="med_description" class="form-control"  
                    value="<?php echo htmlspecialchars($medicine["med_description"]); ?>" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control"
                    value="<?php echo intval($medicine["quantity"]); ?>" required>
            </div>

            <div class="mb-3">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="date" id="expiry_date" name="expiry_date" class="form-control" 
                    value="<?php echo htmlspecialchars($medicine["expiry_date"]); ?>" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update Medicine</button>
        </form>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
  
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
