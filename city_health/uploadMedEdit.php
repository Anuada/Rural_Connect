<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
$city_health_title = "Update Medicine";

$db = new DbHelper();
$ms = new Misc;

$location = $ms->url("city_health/view_med.php");
if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    $_SESSION['m'] = "Id Not Set!";
    header("Location: $location");
    exit();
}

$id = $_GET['id'];

$medicine = $db->getRecord("med_availability", ["id" => $id]);

if (!$medicine) {
    $_SESSION['m'] = "Medicine Details Not Found!";
    header("Location: $location");
    exit();
}

?>

<?php ob_start() ?>
<form action="../logic/upadate_med_avail.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($medicine["id"]); ?>">

    <div class="mb-3">
        <label for="med_name" class="form-label">Type of Medicine</label>
        <input type="text" id="med_name" name="med_name" class="form-control"
            value="<?php echo htmlspecialchars($medicine["med_name"]); ?>" required>
    </div>

    <div class="mb-3">
        <label for="med_description" class="form-label">Description</label>
        <textarea id="med_description" name="med_description" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" id="category" name="category" class="form-control"
            value="<?php echo htmlspecialchars($medicine["category"]); ?>" required>
    </div>

    <div class="mb-3">
        <label for="DosageForm" class="form-label">Dosage Form</label>
        <input type="text" id="DosageForm" name="DosageForm" class="form-control"
            value="<?php echo htmlspecialchars($medicine["DosageForm"]); ?>" required>
    </div>

    <div class="mb-3">
        <label for="DosageStrength" class="form-label">Dosage Strength</label>
        <input type="text" id="DosageStrength" name="DosageStrength" class="form-control"
            value="<?php echo htmlspecialchars($medicine["DosageStrength"]); ?>" required>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" id="quantity" name="quantity" class="form-control"
            value="<?php echo intval($medicine["quantity"]); ?>" required>
    </div>

    <div class="mb-3">
        <label for="expiry_date" class="form-label">Expiry Date</label>
        <input type="date" id="expiry_date" name="expiry_date" class="form-control" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Update Medicine</button>
</form>
<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    document.getElementById('med_description').value = "<?php echo htmlspecialchars($medicine["med_description"]) ?>";
    document.getElementById('expiry_date').value = "<?php echo date('Y-m-d',strtotime($medicine["expiry_date"])) ?>";
</script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>