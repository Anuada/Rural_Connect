import serializeForm from '../helpers/serializeForm.js';
import { confirmAlert, choicesAlert, errorAlert } from '../helpers/sweetAlert2.js';
import fetch from '../utilities/fetchClient.js';
import { dateFormatter, pluralize } from '../utilities/formatter.js';

// Variable
let defaultStock = 0;
let medicineName = '';

// Modal Elements
const viewModalEl = document.getElementById('viewModal');
const viewModal = new bootstrap.Modal(viewModalEl);
const generic_name = document.getElementById('generic_name');
const quantity = document.getElementById('quantity');
const expiration_date_el = document.getElementById('expiration_date_el');
const med_description = document.getElementById('med_description');
const addStockModalEl = document.getElementById('addStockModal');
const addStockModal = new bootstrap.Modal(addStockModalEl);
const medicineId = document.getElementById('id');
const totalQuantity = document.getElementById('total-quantity');
const addStock = document.getElementById('stock');

viewModalEl.addEventListener('hidden.bs.modal', () => {
    generic_name.textContent = '';
    quantity.textContent = '';
    expiration_date_el.innerHTML = '';
    med_description.textContent = '';
})

// Button Elements
const otherDetailsBtnEl = document.querySelectorAll('.other-details');
const editMedicineBtnEl = document.querySelectorAll('.edit-medicine');
const deleteMedicineBtnEl = document.querySelectorAll('.delete-medicine');

// Other Elements
const addStockFormEl = document.getElementById('add-stock-form');

otherDetailsBtnEl.forEach(btn => {
    btn.addEventListener('click', async () => {
        const data = JSON.parse(btn.getAttribute('data-details'));
        generic_name.textContent = data.generic_name;
        quantity.textContent = `${data.quantity} ${data.quantity > 1 ? await pluralize(data.unit.toLowerCase()) : data.unit.toLowerCase()}`;
        if (data.expiration_date != null) {
            expiration_date_el.innerHTML = `
            <i class="fas fa-file-alt"></i> <strong>Expiration Date:</strong>
            <span id="expiration_date_el">${dateFormatter(data.expiration_date)}</span>
            `;
        }
        med_description.textContent = data.med_description;
        viewModal.show();
    });
});

editMedicineBtnEl.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const generic_name = btn.getAttribute('data-med-name');
        const quantity = btn.getAttribute('data-quantity');

        choicesAlert("What would you like to modify?", "Add Stock", "Edit Details", handleAddStock, handleEditMedicine, false, [id, generic_name, quantity], [id]);
    });
});

deleteMedicineBtnEl.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const question = "Are you sure you want to delete this medicine?";
        confirmAlert(question, handleDeleteMedicine, false, id);
    });
});

const handleAddStock = (id, generic_name, quantity) => {
    medicineId.value = id;
    totalQuantity.value = quantity;
    defaultStock = parseInt(quantity);
    medicineName = generic_name;
    addStockModal.show();
}

addStock.addEventListener('input', () => {
    const addedStock = addStock.value ? parseInt(addStock.value) : 0;
    totalQuantity.value = addedStock > 0 ? addedStock + defaultStock : defaultStock;
});

addStockFormEl.addEventListener('submit', (e) => {
    e.preventDefault();
    const payload = serializeForm(addStockFormEl);

    const question = `You're about to add ${payload.stock} ${payload.stock > 1 ? "units" : "unit"} of ${medicineName}. Proceed?`;
    confirmAlert(question, handleAddStockForm, false, payload);
});

const handleAddStockForm = (payload) => {
    fetch.put('../api/city.health.update.medicine.stock.php', payload)
        .then(response => {
            const { status } = response?.response;
            if (status == 200) {
                window.location.href = "../city_health/medicine-inventory.php";
            }
        })
        .catch(error => {
            const { message } = error?.data;
            if (message != undefined) {
                errorAlert(message);
            } else {
                console.error(error);
            }
        });
}

addStockModalEl.addEventListener('hidden.bs.modal', () => {
    addStockFormEl.reset();
    medicineId.value = '';
});

const handleEditMedicine = (id) => {
    location.href = `../city_health/edit-medicine.php?id=${id}`;
}

const handleDeleteMedicine = (id) => {
    location.href = `../logic/delete_avail_med.php?id=${id}`;
}

const initTooltips = () => {
    // Dispose any existing tooltips first
    const existingTooltips = document.querySelectorAll('.tooltip');
    existingTooltips.forEach(t => t.remove());

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach((tooltipTriggerEl) => {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    initTooltips();
});