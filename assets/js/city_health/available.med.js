import { confirmAlert } from '../helpers/sweetAlert2.js';

// Modal Elements
const viewModalEl = document.getElementById('viewModal');
const viewModal = new bootstrap.Modal(viewModalEl);
const med_name = document.getElementById('med_name');
const quantity = document.getElementById('quantity');
const med_description = document.getElementById('med_description');

// Button Elements
const otherDetailsBtnEl = document.querySelectorAll('.other-details');
const deleteMedicineBtnEl = document.querySelectorAll('.delete-medicine');

otherDetailsBtnEl.forEach(btn => {
    btn.addEventListener('click', () => {
        const data = JSON.parse(btn.getAttribute('data-details'));
        med_name.textContent = data.med_name;
        quantity.textContent = data.quantity;
        med_description.textContent = data.med_description;
        viewModal.show();
    });
});

deleteMedicineBtnEl.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const question = "Are you sure you want to delete this medicine?";
        confirmAlert(question, handleDeleteMedicine, id);
    });
});

const handleDeleteMedicine = (id) => {
    location.href = `../logic/delete_avail_med.php?id=${id}`;
}