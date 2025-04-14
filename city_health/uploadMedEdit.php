<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
$city_health_title = Misc::displayPageTitle("Update Medicine","fa-pills me-2");

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
<div class="card p-4 shadow-lg rounded">
    <form action="../logic/upadate_med_avail.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($medicine["id"]); ?>">
        <div class="form-fields">
            <div class="mb-3">
                <label for="med_name">Medicine Name</label>
                <input type="text" id="med_name" name="med_name"
                    value="<?php echo htmlspecialchars($medicine["med_name"]); ?>" required>
            </div>

            <div class="mb-3">
                <label for="med_description">Description</label>
                <textarea id="med_description" name="med_description" rows="4" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category"
                        value="<?php echo htmlspecialchars($medicine["category"]); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="DosageForm">Dosage Form</label>
                    <input type="text" id="DosageForm" name="DosageForm"
                        value="<?php echo htmlspecialchars($medicine["DosageForm"]); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="DosageStrength">Dosage Strength</label>
                    <input type="text" id="DosageStrength" name="DosageStrength"
                        value="<?php echo htmlspecialchars($medicine["DosageStrength"]); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity"
                        value="<?php echo intval($medicine["quantity"]); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" id="expiry_date" name="expiry_date" required>
                </div>
            </div>

            <button type="submit" name="submit">Update Medicine</button>
        </div>
    </form>
</div>
<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    document.getElementById('med_description').value = "<?php echo htmlspecialchars($medicine["med_description"]) ?>";
    document.getElementById('expiry_date').value = "<?php echo date('Y-m-d', strtotime($medicine["expiry_date"])) ?>";
</script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>