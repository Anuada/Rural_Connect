import { confirmAlert } from '../helpers/sweetAlert2.js';

// Modal Elements
const detailModalEl = document.getElementById('detailModal');
const detailModal = new bootstrap.Modal(detailModalEl);
const requested_medicine = document.getElementById('requested_medicine');
const requested_quantity = document.getElementById('requested_quantity');
const incharge_barangay = document.getElementById('incharge_barangay');
const incharge_name = document.getElementById('incharge_name');
const incharge_address = document.getElementById('incharge_address');
const incharge_contact_number = document.getElementById('incharge_contact_number');
const modalImage = document.getElementById('modalImage');

const viewDetailsBtnEl = document.querySelectorAll('.view-details');
viewDetailsBtnEl.forEach(btn => {
    btn.addEventListener('click', () => {
        const data = JSON.parse(btn.getAttribute('data-details'));
        requested_medicine.textContent = data.med_name;
        requested_quantity.textContent = data.request_quantity;
        incharge_barangay.textContent = data.barangay;
        incharge_name.textContent = `${data.fname} ${data.lname}`;
        incharge_address.textContent = data.address;
        incharge_contact_number.textContent = data.contactNo;
        modalImage.src = data.document;
        detailModal.show();
    });
});

// Preview Image Elements
const previewOverlay = document.getElementById('previewOverlay');
const previewImage = document.getElementById('previewImage');
const clickableImage = document.getElementById('modalImage');

clickableImage.addEventListener('click', () => {
    previewImage.src = clickableImage.src;
    previewOverlay.classList.remove('hidden');
});

// Close preview when clicking outside the image
previewOverlay.addEventListener('click', (e) => {
    if (e.target === previewOverlay) {
        previewOverlay.classList.add('hidden');
        previewImage.src = '';
    }
});

const acceptRequests = document.querySelectorAll('.accept-requests');
const cancelRequests = document.querySelectorAll('.cancel-requests');

acceptRequests.forEach(accept => {
    accept.addEventListener('submit', (e) => {
        e.preventDefault();

        const form = e.target;

        const submitForm = () => {
            form.submit();
        }
        const question = "Are you sure you want to accept this request?";
        confirmAlert(question, submitForm);
    });
});

cancelRequests.forEach(cancel => {
    cancel.addEventListener('submit', (e) => { 
        e.preventDefault();

        const form = e.target;

        const submitForm = () => {
            form.submit();
        }
        const question = "Are you sure you want to cancel this request?";
        confirmAlert(question, submitForm);
    });
});