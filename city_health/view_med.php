<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;
$records = $db->fetchRecords('med_availability');
$city_health_title = "Available Medicine";
?>

<?php ob_start() ?>
<!-- Main Content -->
<main>
    <table>
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Dosage Form</th>
                <th>Dosage Strength</th>
                <th>Quantity</th>
                <th>Date Added</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (is_array($records) && !empty($records)): ?>
                <?php foreach ($records as $row): ?>
                    <tr>
                        <td><?php echo $row['med_name'] ?></td>
                        <td class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="<?php echo $row['med_description'] ?>">
                            <?php echo $ms->truncateSentence($row['med_description']) ?>
                        </td>
                        <td><?php echo $row['category'] ?></td>
                        <td><?php echo $row['DosageForm'] ?></td>
                        <td><?php echo $row['DosageStrength'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo date('F d, Y',strtotime($row['date'])) ?></td>
                        <td><?php echo date('F d, Y',strtotime($row['expiry_date'])) ?></td>
                        <td>
                            <span class="d-flex justify-content-start">
                                <a href="<?php echo $ms->url("city_health/uploadMedEdit.php?id=" . $row['id']) ?>"
                                    class="btn btn-warning btn-sm" title="Edit" style="margin-right: 10px">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete(<?php echo $row['id']; ?>)" title="Delete" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    const initTooltips = () => {
        // Dispose any existing tooltips first
        const existingTooltips = document.querySelectorAll('.tooltip');
        existingTooltips.forEach(t => t.remove());

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach((tooltipTriggerEl) => {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    };

    const confirmDelete = (id) => {
        Swal.fire({
            title: "Are you sure you want to delete this record?",
            showDenyButton: true,
            confirmButtonColor: "#007bff",
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = `../logic/delete_avail_med.php?id=${id}`;
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        initTooltips();
    });
</script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>