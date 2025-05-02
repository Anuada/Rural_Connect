import { confirmAlert, errorAlert, successAlert } from '../helpers/sweetAlert2.js';
import { dateFormatter, pluralize, truncateSentence, urlEncode, displayFormattedDeliveryCondition } from "../utilities/formatter.js";
import fetch from "../utilities/fetchClient.js";
import renderPagination from "../utilities/table.pagination.js";
import serializeForm from '../helpers/serializeForm.js';
import displayDeliveryStatus from '../utilities/displayDeliveryStatusColor.js';
import { isEmptyTrimmed } from '../utilities/misc.js';

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
const deliveryIdEl = document.getElementById('delivery_id');

// View Delivery Feedback Modal Elements
const deliveryFeedbackModalEl = document.getElementById('deliveryFeedbackModal');
const deliveryFeedbackModal = new bootstrap.Modal(deliveryFeedbackModalEl);
const receivedByEl = document.getElementById('receivedBy');
const deliveryConditionEl = document.getElementById('deliveryCondition');
const feedbackTextEl = document.getElementById('feedbackText');

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

deliveryFeedbackModalEl.addEventListener('hidden.bs.modal', () => {
    receivedByEl.innerText = '';
    deliveryConditionEl.innerText = '';
    feedbackTextEl.innerHTML = '';
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

const displayTable = async (data, tableBody) => {
    tableBody.innerHTML = "";

    if (data.length > 0) {
        const rowHtmlList = await Promise.all(data.map(async d => {
            const statusHtml = await displayStatus(d);
            return `
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
                    <td>${statusHtml}</td>
                </tr>
            `;
        }));

        tableBody.innerHTML = rowHtmlList.join('');
    } else {
        tableBody.innerHTML = `
        <tr>
            <td colspan="5" class="text-center user-select-none" style="height:100px; color: lightgray">No Requests Found</td>
        </tr>
        `;
    }

    initTooltips();

    const viewDetailsBtnEl = document.querySelectorAll('.view-details');
    viewDetailsBtnEl.forEach(btn => {
        btn.addEventListener('click', async () => {
            const data = JSON.parse(btn.getAttribute('data-details'));
            requested_medicine.textContent = data.med_name;
            requested_quantity.textContent = `${data.request_quantity} ${data.request_quantity > 1 ? await pluralize(data.unit.toLowerCase()) : data.unit.toLowerCase()}`;
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

    const viewFeedbacks = document.querySelectorAll('.view-feedback');
    viewFeedbacks.forEach(viewFeedback => {
        viewFeedback.addEventListener('click', () => {
            const request_type = viewFeedback.getAttribute('data-request-type');
            const delivery_id = viewFeedback.getAttribute('data-delivery-id');

            fetchAllDeliveryFeedback(request_type, delivery_id);
        });
    });

    const isReturnedEl = document.querySelectorAll('.is-returned');
    isReturnedEl.forEach(isReturned => {
        isReturned.addEventListener('click', () => {
            const payload = {
                request_type: isReturned.getAttribute('data-request-type'),
                delivery_id: isReturned.getAttribute('data-delivery-id'),
                delivery_status: 'Returned'
            };
            const question = "Are you sure that the medicine has been returned?";
            confirmAlert(question, handleConfirmReturned, false, payload);
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
                    <span class="row text-secondary">${data.brand_name}</span>
                    <span class="row text-secondary cursor-default"
                        data-fulltext="${data.category}"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top"
                        title="${data.category}">
                        ${truncateSentence(data.category, 35)}
                    </span>
                    <span class="row text-secondary">${data.dosage_strength}</span>
                </span>
            </span>
        `;
    }
    return `
        <div style="margin-left: 20px">
            <span class="row">${data.med_name}</span>
            <span class="row text-secondary">${data.category}</span>
            <span class="row text-secondary">${data.dosage_strength}</span>
        </div>
    `;
}

const displayStatus = async (data) => {
    switch (data.status) {
        case 'Accepted':
            if (data.delivery_status == 'Claimed') {
                return `<span class="cursor-pointer view-feedback" data-delivery-id="${data.delivery_id}" data-request-type="${data.med_image != undefined ? "Standard Request" : "Customized Request"}" data-bs-toggle="tooltip" data-bs-placement="top" title="View Delivery Feedback">${displayDeliveryStatus(data.delivery_status)}</span>`;
            } else if (data.delivery_status == 'Failed Delivery') {
                const delivery_id = data.delivery_id;
                const request_type = data.med_image != undefined ? "Standard Request" : "Customized Request";
                const count = await fetchFailedDeliveryCount(request_type, delivery_id);
                if (count >= 3) {
                    return `<span class="cursor-pointer is-returned" data-delivery-id="${data.delivery_id}" data-request-type="${data.med_image != undefined ? "Standard Request" : "Customized Request"}" data-bs-toggle="tooltip" data-bs-placement="top" title="Kindly confirm whether the medicine has been returned">${displayDeliveryStatus(data.delivery_status)}</span>`;
                }
                return displayDeliveryStatus(data.delivery_status);
            } else {
                return displayDeliveryStatus(data.delivery_status);
            }

        case 'Cancelled':
            return `<i class="text-danger user-select-none">${data.status}</i>`;

        default:
            // Your buttons (unchanged)
            const type = data.med_image !== undefined ? "default request" : "customized request";
            return `
                <span class="d-flex justify-content-start">
                    <button class="btn btn-primary shadow accept-request" data-request-type="${type}" data-status="Accepted" data-id="${data.id}" style="margin-right: 10px;" title="Accept">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="btn btn-outline-primary shadow cancel-request" data-request-type="${type}" data-status="Cancelled" data-id="${data.id}" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </span>
            `;
    }
};

const handleConfirmReturned = (payload) => {
    fetch.put('../api/change-delivery-status.php', payload)
        .then(response => {
            const { message } = response?.data;
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
        });
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

const fetchAllDeliveryFeedback = (request_type, delivery_id) => {
    fetch.get(`../api/city.health.view.delivery.feedback.php?request_type=${urlEncode(request_type)}&delivery_id=${delivery_id}`)
        .then(response => {
            const { data } = response?.data;
            receivedByEl.innerText = data?.received_by;
            deliveryConditionEl.innerText = displayFormattedDeliveryCondition(data?.delivery_condition);
            feedbackTextEl.innerHTML = isEmptyTrimmed(data?.feedback) ? '<i class="user-select-none text-secondary">No Feedback</i>' : data?.feedback;
            deliveryFeedbackModal.show();
        })
        .catch(error => {
            console.error(error);
        })
}

const fetchFailedDeliveryCount = async (request_type, delivery_id) => {
    return await fetch.get(`../api/city.health.fetch.failed.delivery.count.php?request_type=${urlEncode(request_type)}&delivery_id=${delivery_id}`)
        .then(response => {
            const { data } = response?.data;
            return data;
        })
        .catch(() => {
            return 0;
        });
};

const fetchAllAvailableCouriers = () => {
    fetch.get('../api/city.health.display.available.couriers.php')
        .then(response => {
            const { data } = response?.data;
            handleDisplayAllAvailableCouriers(data);
        })
        .catch(error => {
            console.error(error);
        });
};

const handleDisplayAllAvailableCouriers = (data) => {
    deliveryIdEl.innerHTML = '';
    deliveryIdEl.innerHTML = '<option hidden selected>SELECT COURIER</option>';
    data.map(d => {
        deliveryIdEl.innerHTML += `
            <option value="${d.accountId}">${d.courier}</option>
        `;
    });
};

const initTooltips = () => {
    // Dispose any existing tooltips first
    const existingTooltips = document.querySelectorAll('.tooltip');
    existingTooltips.forEach(t => t.remove());

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach((tooltipTriggerEl) => {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
};

const callFetches = () => {
    fetchAllAvailableCouriers();
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