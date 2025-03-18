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
                <th colspan="8" class="bg-fuchsia text-center">Requested Medicine</th>
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
                </tr>
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
<!-- Additional scripts if needed -->
<script src="../assets/js/script.js"></script>
<script src="../assets/js/lawyer.sidebar.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
