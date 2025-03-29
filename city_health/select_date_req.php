<?php
session_start();
require_once "../util/DbHelper.php";
require "../shared/navbar_city_health.php";
require_once "../shared/session.city_health.php";

$dbHelper = new DbHelper();
$title = "Select Date for Delivery";

// Get request ID from URL parameter
$requestId = isset($_GET['requestId']) ? $_GET['requestId'] : null;

// Fetch users for selection
$users = $dbHelper->fetchDeliveries();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .sidebar {
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        background-color: #343a40;
        padding-top: 20px;
        margin-top: 5%;
    }

    .sidebar .nav-link {
        color: white;
        font-size: 16px;
    }

    .sidebar .nav-link:hover {
        background-color: #495057;
        border-radius: 5px;
    }

    .content-wrapper {
        margin-left: 260px;
        padding: 20px;
    }
</style>
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<br>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 sidebar">
            <h4 class="text-center text-white">City Health Officer</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uploadAvailableMed.php"><i class="fas fa-upload me-2"></i> Upload Medicine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="request_med.php"><i class="fas fa-prescription-bottle me-2"></i> Requested Medicine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_med.php"><i class="fas fa-pills me-2"></i> Available Medicine</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div style="margin-top:10%;" class="col-md-9 col-lg-10 content-wrapper">
            <center>
                <h2>Select Delivery Date</h2>
            </center>

            <!-- Date Submission Form -->
            <div class="d-flex justify-content-center mt-4">
                <div class="card shadow-lg p-4 w-50">
                    <h4 class="text-center fw-bold">Select Delivery Date</h4>
                    <form action="../logic/Selectdate_req.php" method="POST">
                        <input type="hidden" name="requestId" value="<?php echo htmlspecialchars($requestId); ?>">
                        
                        <label for="assignedUser">Select User:</label>
                        <select class="form-control" name="deliveries_accountId" required>
                            <?php foreach ($users as $user): ?>
                                <option value="<?php echo htmlspecialchars($user['accountId']); ?>"> 
                                    <?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']); ?> 
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="date_of_supply">Select Supply Date:</label>
                        <input type="date" name="date_of_supply" class="form-control" required>

                        <button type="submit" name="submit" class="btn btn-primary mt-3">Assign</button>
                    </form>
                </div>
            </div>

        </div>
        <?php $content = ob_get_clean(); ?>

        <?php ob_start(); ?>
        <script src="../assets/js/navbar.js"></script>
        <script>
            function confirmDelete(id) {
                if (confirm("Are you sure you want to delete this record?")) {
                    window.location.href = "../logic/delete_avail_med.php?id=" + id;
                }
            }
        </script>
        <?php $scripts = ob_get_clean(); ?>

        <?php require_once "../shared/layout.php"; ?>
