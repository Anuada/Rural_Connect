import { dateFormatter } from "../utilities/formatter.js";
import fetch from "../utilities/fetchClient.js";
import renderPagination from "../utilities/table.pagination.js";

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
                    <td class="text-center">${d.date_of_supply !== null ? dateFormatter(d.date_of_supply) : "<span class='user-select-none text-secondary'>TBD</span>"}</td>
                    <td>${displayStatus(d.requestStatus)}</td>
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

const displayStatus = (status) => {
    switch (status) {
        case 'Accepted':
            return `<i class="text-success user-select-none">${status}</i>`;

        case 'Cancelled':
            return `<i class="text-danger user-select-none">${status}</i>`;

        default:
            return `<i class="text-warning user-select-none">${status}</i>`;
    }
}

const fetchRequestedMedicine = (page = 1) => {
    fetch.get(`../api/barangay.inc.requested.med.php?page=${page}&limit=${limit}`)
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
    fetch.get(`../api/barangay.inc.customized.med.request.php?page=${page}&limit=${limit}`)
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

    tabElements.forEach(tab => {
        tab.addEventListener('shown.bs.tab', () => {
            callFetches();
        });
    });
});