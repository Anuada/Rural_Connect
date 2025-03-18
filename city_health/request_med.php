<?php
session_start();
include "../shared/session.city_health.php";
include "../shared/navbar_city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$dbHelper = new DbHelper();
$title = "Requested Medicine";

// Ensure `city_health_id` exists in the session before using it
if (isset($_SESSION['accountId'])) {
    $id = $_SESSION['accountId']; // Fetch city_health_id from the session
} else {
    die("Error: accountId not set in session.");
}

// Fetch requested medicine data
$requested = $dbHelper->fetchData($id);
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/lawyer.sidebar.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<br>
<br>
<br>

<section>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <style>
            .table-container {
              display: flex;
              justify-content: center;
              align-items: center;
              margin-top: 5%;
            }

            table {
              border-collapse: collapse;
              width: 100%;
            }

            th, td {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }

            th {
              background-color: #f2f2f2;
            }

            tr:nth-child(even) {
              background-color: #f2f2f2;
            }

            tr:hover {
              background-color: #dddddd;
            }
          </style>

          <div class="table-container">
            <table>
              <tr>
                <th colspan="9" class="bg-fuchsia text-center">Requested Medicine</th>
              </tr>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact No.</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Dosage</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php foreach ($requested as $req) : ?>
                <tr>
                  <td><?php echo $req['fname']; ?></td>
                  <td><?php echo $req['lname']; ?></td>
                  <td><?php echo $req['address']; ?></td>
                  <td><?php echo $req['contactNo']; ?></td>
                  <td><?php echo $req['med_name']; ?></td>
                  <td><?php echo $req['request_quantity']; ?></td>
                  <td><?php echo $req['request_DosageForm'] . ' - ' . $req['request_DosageStrength']; ?></td>
                  <td><?php echo $req['requestStatus']; ?></td>
                  <td>
                    <?php if ($req['requestStatus'] == "Pending") : ?>
                      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal<?php echo $req['id']; ?>">Accept</button>
                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $req['id']; ?>">Cancel</button>
                    <?php endif; ?>
                  </td>
                </tr>

                <!-- Accept Modal -->
                <div class="modal fade" id="acceptModal<?php echo $req['id']; ?>" tabindex="-1" aria-labelledby="acceptLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="acceptLabel">Accept Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to accept this request?
                      </div>
                      <div class="modal-footer">
                        <form action="../logic/request_med.php" method="POST">
                          <input type="hidden" name="requestId" value="<?php echo $req['id']; ?>">
                          <button type="submit" name="acceptRequest" class="btn btn-success">Yes, Accept</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Cancel Modal -->
                <div class="modal fade" id="cancelModal<?php echo $req['id']; ?>" tabindex="-1" aria-labelledby="cancelLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="cancelLabel">Cancel Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to cancel this request?
                      </div>
                      <div class="modal-footer">
                        <form action="../logic/request_med.php" method="POST">
                          <input type="hidden" name="requestId" value="<?php echo $req['id']; ?>">
                          <button type="submit" name="cancelledRequest" class="btn btn-danger">Yes, Cancel</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>

              <?php endforeach; ?>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<br>
<br>
<br>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Additional scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/lawyer.sidebar.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
