<?php
session_start();
include "../shared/session.delivery.php";
include "../shared/navbar.deliveries.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$dbHelper = new DbHelper();
$title = "Ready to Deliver";

$id = $_SESSION['accountId'];

// Fetch requested medicine data
$requested = $dbHelper->DisplayMed_to_Delivery($id);
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/city_css_req_med.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<section style="padding-top:50px">
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">

          <div class="table-container">
            <table id="medicineTable" style="margin-top: 10%;" class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="8" class="bg-primary text-white text-center">Requested Medicine</th>
                </tr>
                <tr>
                  <th>Barangay Incharge</th>
                  <th>Address</th>
                  <th>Contact Number</th>
                  <th>Medicine</th>
                  <th>Category</th>
                  <th>Dosage Form</th>
                  <th>Dosage Strength</th>
                  <th>Date of Supply</th>
                 
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($requested)): ?>
                  <?php foreach ($requested as $req): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($req['fname'] . ' ' . $req['lname']); ?></td>
                      <td><?php echo htmlspecialchars($req['address']); ?></td>
                      <td><?php echo htmlspecialchars($req['contactNo']); ?></td>
                      <td><?php echo htmlspecialchars($req['med_name']); ?></td>
                      <td><?php echo htmlspecialchars($req['request_category']); ?></td>
                      <td><?php echo htmlspecialchars($req['request_DosageForm']); ?></td>
                      <td><?php echo htmlspecialchars($req['request_DosageStrength']); ?></td>
                      <td><?php echo date("F d, Y", strtotime($req['date_of_supply'])); ?></td>

                      
                     
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="8" class="text-center text-muted">No requested medicine found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Pagination Controls -->
          <div class="pagination-container text-center mt-3">
            <button id="prevPage" class="btn btn-outline-primary" disabled>Previous</button>
            <span id="pageNumbers"></span>
            <button id="nextPage" class="btn btn-outline-primary">Next</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Additional scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/lawyer.sidebar.js"></script>
<script src="../assets/js/pagenion_med_req.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
