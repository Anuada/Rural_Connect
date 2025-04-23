import { confirmAlert, errorAlert, successAlert } from '../helpers/sweetAlert2.js';
import { dateFormatter } from "../utilities/formatter.js";
import fetch from "../utilities/fetchClient.js";
import renderPagination from "../utilities/table.pagination.js";
import serializeForm from '../helpers/serializeForm.js';
import displayDeliveryStatus from '../utilities/displayDeliveryStatusColor.js';

// VARIABLES
let currentPage = 1;
const limit = 3;

// Table Body Elements
const requestedMedTableEl = document.getElementById('requested-med-table-data');
const customizedMedRequestEl = document.getElementById('customized-med-request-table-data');

// Pagination Container Elements
const requestedMedPageEl = document.getElementById('requested-med-pagination');
const customizedMedRequestPageEl = document.getElementById('customized-med-request-pagination');

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

// Modal Accept Barangay Request Elements
const selectCourierAndDeliveryDateModalEl = document.getElementById('selectCourierAndDeliveryDateModal');
const selectCourierAndDeliveryDateModal = new bootstrap.Modal(selectCourierAndDeliveryDateModalEl);
const acceptBarangayRequestFormEl = document.getElementById('accept-barangay-request');
const requestTypeEl = document.getElementById('request-type');
const statusEl = document.getElementById('status');
const barangayRequestIdEl = document.getElementById('barangay_request_id');

// Preview Image Elements
const previewOverlay = document.getElementById('previewOverlay');
const previewImage = document.getElementById('previewImage');
const clickableImage = document.getElementById('modalImage');

// Other Elements
const tabElements = document.querySelectorAll('button[data-bs-toggle="tab"]');

selectCourierAndDeliveryDateModalEl.addEventListener('hidden.bs.modal', () => {
    acceptBarangayRequestFormEl.reset();
    requestTypeEl.value = '';
    statusEl.value = '';
    barangayRequestIdEl.value = '';
});

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

const displayTable = (data, tableBody) => {
    tableBody.innerHTML = "";
    if (data.length > 0) {
        data.map(d => {
            tableBody.innerHTML += `
                <tr>
                    <td>${displayMedicine(d)}</td>
                    <td>${d.barangay}</td>
                    <td>
                        <button class="btn btn-primary shadow view-details" data-details='${JSON.stringify(d)}'>
                            <i class="fas fa-eye"></i><span style="margin-left:10px">View</span>
                        </button>
                    </td>
                    <td>
                        <div class="text-center">${d.date_of_supply != null ? dateFormatter(d.date_of_supply) : "<span class='user-select-none text-secondary'>TBD</span>"}</div>
                    </td>
                    <td>${displayStatus(d)}</td>
                </tr>
            `;
        });
    } else {
        tableBody.innerHTML = `
        <tr>
            <td colspan="5" class="text-center user-select-none" style="height:100px; color: lightgray">No Requests Found</td>
        </tr>
        `;
    }

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

    const acceptRequestEl = document.querySelectorAll('.accept-request');
    acceptRequestEl.forEach(acceptRequest => {
        acceptRequest.addEventListener('click', () => {
            requestTypeEl.value = acceptRequest.getAttribute('data-request-type');
            statusEl.value = acceptRequest.getAttribute('data-status');
            barangayRequestIdEl.value = acceptRequest.getAttribute('data-id');
            selectCourierAndDeliveryDateModal.show();
        });
    });

    const cancelRequestEl = document.querySelectorAll('.cancel-request');
    cancelRequestEl.forEach(cancelRequest => {
        cancelRequest.addEventListener('click', () => {
            const payload = {
                request_type: cancelRequest.getAttribute('data-request-type'),
                status: cancelRequest.getAttribute('data-status'),
                barangay_request_id: cancelRequest.getAttribute('data-id')
            };

            const question = `Are you sure you want to get this request ${payload.status.toLowerCase()}?`;
            confirmAlert(question, handleBarangayRequestApproval, false, payload);
        });
    });
}

const displayMedicine = (data) => {
    if (data.med_image != undefined) {
        return `
            <span class="row">
                <span class="col-auto">
                    <img src="${data.med_image}" alt="Medicine Image" class="img-fluid rounded shadow"
                        style="width: 100px; height: 100px; object-fit: cover;">
                </span>
                <span class="col">
                    <span class="row">${data.med_name}</span>
                    <span class="row text-secondary">${data.category}</span>
                    <span class="row text-secondary">${data.dosage_form} - ${data.dosage_strength}</span>
                </span>
            </span>
        `;
    }
    return `
        <div style="margin-left: 20px">
            <span class="row">${data.med_name}</span>
            <span class="row text-secondary">${data.category}</span>
            <span class="row text-secondary">${data.dosage_form} - ${data.dosage_strength}</span>
        </div>
    `;
}

const displayStatus = (data) => {
    switch (data.status) {
        case 'Accepted':
            return displayDeliveryStatus(data.delivery_status);

        case 'Cancelled':
            return `<i class="text-danger user-select-none">${data.status}</i>`;

        default:
            if (data.med_image != undefined) {
                return `
                    <span class="d-flex justify-content-start">
                        <button class="btn btn-primary shadow accept-request" data-request-type="default request" data-status="Accepted" data-id="${data.id}" style="margin-right: 10px;" title="Accept">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-outline-primary shadow cancel-request" data-request-type="default request" data-status="Cancelled" data-id="${data.id}" title="Cancel">
                            <i class="fas fa-times"></i>
                        </button>
                    </span>
                `;
            } else {
                return `
                    <span class="d-flex justify-content-start">
                        <button class="btn btn-primary shadow accept-request" data-request-type="customized request" data-status="Accepted" data-id="${data.id}" style="margin-right: 10px;" title="Accept">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-outline-primary shadow cancel-request" data-request-type="customized request" data-status="Cancelled" data-id="${data.id}" title="Cancel">
                            <i class="fas fa-times"></i>
                        </button>
                    </span>
                `;
            }
    }
}

acceptBarangayRequestFormEl.addEventListener('submit', (e) => {
    e.preventDefault();
    const payload = serializeForm(acceptBarangayRequestFormEl);
    const question = `Are you sure you want to get this request ${payload.status.toLowerCase()}?`;
    confirmAlert(question, handleBarangayRequestApproval, false, payload);
});

const handleBarangayRequestApproval = (payload) => {
    fetch.put('../api/city.health.barangay.request.approval.php', payload)
        .then(response => {
            const { message } = response?.data;
            successAlert(message);
            selectCourierAndDeliveryDateModal.hide();
            callFetches();
        })
        .catch(error => {
            callFetches();
            const { message } = error?.data;
            if (message != undefined) {
                errorAlert(message);
            } else {
                console.error(error);
            }
        });
}

const fetchRequestedMedicine = (page = 1) => {
    fetch.get(`../api/city.health.requested.med.php?page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data, requestedMedTableEl);
            renderPagination(pagination, requestedMedPageEl, fetchRequestedMedicine);
        })
        .catch(error => {
            console.error(error);
        })
}

const fetchCustomizedRequestMedicine = (page = 1) => {
    fetch.get(`../api/city.health.customized.med.request.php?page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data, customizedMedRequestEl);
            renderPagination(pagination, customizedMedRequestPageEl, fetchCustomizedRequestMedicine);
        })
        .catch(error => {
            console.error(error);
        })
}

const callFetches = () => {
    fetchRequestedMedicine(currentPage);
    fetchCustomizedRequestMedicine(currentPage);
}

document.addEventListener('DOMContentLoaded', () => {
    callFetches();

    const today = new Date().toISOString().split('T')[0];
    document.getElementById("date_of_supply").setAttribute("min", today);

    tabElements.forEach(tab => {
        tab.addEventListener('shown.bs.tab', () => {
            callFetches();
        });
    });
});