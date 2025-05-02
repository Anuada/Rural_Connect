import { ucwords, dateFormatter, truncateSentence } from "../utilities/formatter.js";
import fetch from "../utilities/fetchClient.js";
import renderPagination from "../utilities/table.pagination.js";
import displayDeliveryStatus from "../utilities/displayDeliveryStatusColor.js";
import serializeForm from '../helpers/serializeForm.js';
import { confirmAlert, errorAlert, successAlert } from '../helpers/sweetAlert2.js';

// VARIABLES
let currentPage = 1;
const limit = 4;

// Table Body Elements
const requestedMedTableEl = document.getElementById('requested-med-table-data');
const customizedMedRequestEl = document.getElementById('customized-med-request-table-data');

// Pagination Container Elements
const requestedMedPageEl = document.getElementById('requested-med-pagination');
const customizedMedRequestPageEl = document.getElementById('customized-med-request-pagination');

// Preview Image Elements
const previewOverlay = document.getElementById('previewOverlay');
const previewImage = document.getElementById('previewImage');

// Modal Elements
const claimConfirmAndDeliveryFeedbackModalEl = document.getElementById('claimConfirmAndDeliveryFeedbackModal');
const claimConfirmAndDeliveryFeedbackModal = new bootstrap.Modal(claimConfirmAndDeliveryFeedbackModalEl);
const confirmClaimFormEl = document.getElementById('confirm-claim');
const delivery_id = document.getElementById('delivery_id');
const request_type = document.getElementById('request_type');
const delivery_condition = document.getElementById('delivery_condition');

// Other Elements
const tabElements = document.querySelectorAll('button[data-bs-toggle="tab"]');

const displayTable = (data, tableBody) => {
    tableBody.innerHTML = "";
    if (data.length > 0) {
        data.map(d => {
            tableBody.innerHTML += `
                <tr>
                    <td>${displayMedicine(d)}</td>
                    <td>${d.request_quantity}</td>
                    <td><button class="btn btn-primary view-med-document" data-med-document="${d.document}"><i class="fas fa-eye"></i> <span style="margin-left: 10px">View</span></button></td>
                    <td class="text-center">
                        ${d.date_of_supply !== null ?
                    `<span class="cursor-pointer track-delivery-status" data-request-type="${d.med_image != undefined ? "med-delivery" : "custom-med-delivery"}" data-request-id="${d.med_delivery_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Track Delivery Status">${dateFormatter(d.date_of_supply)}</span>`
                    : "<span class='user-select-none text-secondary'>TBD</span>"}
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

    const viewMedDocument = document.querySelectorAll('.view-med-document');
    viewMedDocument.forEach(btn => {
        btn.addEventListener('click', () => {
            const medDocument = btn.getAttribute('data-med-document');
            previewImage.src = medDocument;
            previewOverlay.classList.remove('hidden');
        });
    });

    // Close preview when clicking outside the image
    previewOverlay.addEventListener('click', (e) => {
        if (e.target === previewOverlay) {
            previewOverlay.classList.add('hidden');
            previewImage.src = '';
        }
    });

    const trackDeliveryStatus = document.querySelectorAll('.track-delivery-status');
    trackDeliveryStatus.forEach(deliveryStatus => {
        deliveryStatus.addEventListener('click', () => {
            const request_type = deliveryStatus.getAttribute('data-request-type');
            const request_id = deliveryStatus.getAttribute('data-request-id');

            window.location.href = `../barangay_inc/track-delivery-status.php?${request_type}=${request_id}`;
        });
    });

    const isClaimed = document.querySelectorAll('.is-claimed');
    isClaimed.forEach(claimed => {
        claimed.addEventListener('click', () => {
            delivery_id.value = claimed.getAttribute('data-med-delivery-id');
            request_type.value = claimed.getAttribute('data-request-type');
            claimConfirmAndDeliveryFeedbackModal.show();
        });
    });
}

confirmClaimFormEl.addEventListener('submit', (e) => {
    e.preventDefault();
    let payload = {
        delivery_status: 'Claimed'
    };
    payload = { ...payload, ...serializeForm(confirmClaimFormEl) }
    const question = "Kindly confirm whether the medicine has been claimed.";
    confirmAlert(question, handleConfirmClaim, false, payload);
});

const handleConfirmClaim = (payload) => {
    fetch.put('../api/change-delivery-status.php', payload)
        .then(response => {
            const { message } = response?.data;
            claimConfirmAndDeliveryFeedbackModal.hide();
            successAlert(message);
            callFetches();
        })
        .catch(error => {
            const { message } = error?.data;
            const { status } = error?.response;
            if (status == 422 && message != undefined) {
                errorAlert(message);
            }
            callFetches();
            console.error(error);
        })
};

claimConfirmAndDeliveryFeedbackModalEl.addEventListener('hidden.bs.modal', () => {
    confirmClaimFormEl.reset();
    delivery_id.value = '';
    request_type.value = '';
});

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
                    <span class="row text-secondary">${data.brand_name}</span>
                    <span class="row text-secondary cursor-default"
                        data-fulltext="${data.category}"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top"
                        title="${data.category}">
                        ${truncateSentence(data.category, 35)}
                    </span>
                    <span class="row text-secondary">${data.unit} - ${data.dosage_strength}</span>
                </span>
            </span>
        `;
    }
    return `
        <div style="margin-left: 20px">
            <span class="row">${data.med_name}</span>
            <span class="row text-secondary">${data.category}</span>
            <span class="row text-secondary">${data.unit} - ${data.dosage_strength}</span>
        </div>
    `;
}

const displayStatus = (data) => {
    switch (data.requestStatus) {
        case 'Accepted':
            if (data.delivery_status == 'Delivered') {
                return `<span class="cursor-pointer is-claimed" data-med-delivery-id="${data.med_delivery_id}" data-request-type="${data.med_image != undefined ? "Standard Request" : "Customized Request"}" data-bs-toggle="tooltip" data-bs-placement="top" title="Kindly confirm whether the medicine has been claimed">${displayDeliveryStatus(data.delivery_status)}</span>`;
            }
            return displayDeliveryStatus(data.delivery_status);

        case 'Cancelled':
            return `<i class="text-danger user-select-none">${data.requestStatus}</i>`;

        default:
            return `<i class="text-warning user-select-none">${data.requestStatus}</i>`;
    }
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

const fetchRequestedMedicine = (page = 1) => {
    fetch.get(`../api/barangay.inc.requested.med.php?page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data, requestedMedTableEl);
            initTooltips();
            renderPagination(pagination, requestedMedPageEl, fetchRequestedMedicine);
        })
        .catch(error => {
            console.error(error);
        })
}

const fetchCustomizedRequestMedicine = (page = 1) => {
    fetch.get(`../api/barangay.inc.customized.med.request.php?page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data, customizedMedRequestEl);
            initTooltips();
            renderPagination(pagination, customizedMedRequestPageEl, fetchCustomizedRequestMedicine);
        })
        .catch(error => {
            console.error(error);
        })
}

const fetchDeliveryConditions = () => {
    fetch.get('../api/delivery.conditions.php')
        .then(response => {
            const { data } = response?.data;
            handleDisplaySelectionOfDeliveryConditions(data);
        })
        .catch(error => {
            console.error(error);
        });
}

const handleDisplaySelectionOfDeliveryConditions = (data) => {
    delivery_condition.innerHTML = '';
    delivery_condition.innerHTML = '<option value="" hidden selected>SELECT DELIVERY CONDITION</option>';
    data.map(d => {
        delivery_condition.innerHTML += `<option value="${d}">${ucwords(d)}</option>`;
    });
}

const callFetches = () => {
    fetchRequestedMedicine(currentPage);
    fetchCustomizedRequestMedicine(currentPage);
    fetchDeliveryConditions();
}

document.addEventListener('DOMContentLoaded', () => {
    callFetches();

    tabElements.forEach(tab => {
        tab.addEventListener('shown.bs.tab', () => {
            callFetches();
        });
    });
});