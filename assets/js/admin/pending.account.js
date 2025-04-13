import { confirmAlert, errorAlert, successAlert } from "../helpers/sweetAlert2.js";
import { dateFormatter, truncateText } from "../utilities/formatter.js";
import fetch from "../utilities/fetchClient.js";
import renderPagination from "../utilities/table.pagination.js";

// VARIABLES
let currentPage = 1;
const limit = 4;

// Table Body Elements
const brgyIncTblEl = document.getElementById('barangay-inc-table-data');
const cityHealthTblEl = document.getElementById('city-health-table-data');
const delTblEl = document.getElementById('deliveries-table-data');

// Pagination Containers Elements
const brgyIncPagEl = document.getElementById('barangay-inc-pagination');
const cityHealthPagEl = document.getElementById('city-health-pagination');
const delPagEl = document.getElementById('deliveries-pagination');

// Modal Elements
const imageModalEl = document.getElementById('imageModal');
const modalImageDisplayEl = document.getElementById('modalImage');
const imageModal = new bootstrap.Modal(imageModalEl);

// Other Elements
const tabElements = document.querySelectorAll('button[data-bs-toggle="tab"]');

const displayTable = (data, tableBody, colspan) => {
    tableBody.innerHTML = "";
    if (data.length > 0) {
        data.map(d => {
            tableBody.innerHTML += `
                <tr>
                    <td>${d.fname} ${d.lname}</td>
                    ${d.barangay != null ? `<td>${d.barangay}</td>` : ''}
                    <td>${truncateText(d.email)}</td>
                    <td>
                        <button class="btn btn-primary shadow view-id-verification" data-image="${d.id_verification}"><i class="fas fa-image"></i> <span
                                style="margin-left:10px">View</span></button>
                    </td>
                    <td>${dateFormatter(d.created_at)}</td>
                    <td>
                        <span class="d-flex justify-content-start">
                            <button class="btn btn-success shadow approve-status" title="Approve" data-id="${d.accountId}" data-approve-status="Approved"><i class="fas fa-check"></i></button>
                            <button class="btn btn-danger shadow approve-status" title="Cancel" data-id="${d.accountId}" data-approve-status="Cancelled" style="margin-left:10px"><i class="fas fa-times"></i></button>
                        </span>
                    </td>                    
                </tr>
            `;
        });
    } else {
        tableBody.innerHTML = `
        <tr>
            <td colspan="${colspan}" class="text-center text-secondary user-select-none" style="height:100px">No Pending Accounts Found</td>
        </tr>
        `;
    }

    // View ID Card
    const viewIdVerification = document.querySelectorAll('.view-id-verification');
    viewIdVerification.forEach(view => {
        view.addEventListener('click', () => {
            const image = view.getAttribute('data-image');
            modalImageDisplayEl.src = image;
            imageModal.show();
        })
    });

    // Appprove Status
    const approveStatus = document.querySelectorAll('.approve-status');
    approveStatus.forEach(status => {
        status.addEventListener('click', () => {
            const payload = {
                accountId: status.getAttribute('data-id'),
                account_status: status.getAttribute('data-approve-status')
            };
            const question = `Are you sure you want to get this account ${payload.account_status.toLowerCase()}?`;
            confirmAlert(question, handle_approval_status, payload);
        });
    });

    // Copy Email
    const tooltip = document.querySelectorAll('.tool-tip');
    tooltip.forEach(t => {
        t.addEventListener('click', () => {
            const text = t.dataset.fulltext;
            navigator.clipboard.writeText(text)
                .then(() => {
                    successAlert('Email Copied');
                })
                .catch((error) => {
                    console.error('failed to copy');
                });
        })
    });
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

const handle_approval_status = (payload) => {
    console.log(payload);
    fetch.put('../api/admin.user.account.approval.php', payload)
        .then(response => {
            successAlert(response.data.message);
        })
        .catch(error => {
            const { message } = error?.data;
            if (message != null) {
                errorAlert(error.data.message);
            } else {
                console.error(error);
            }

        })
        .finally(() => {
            callFetches();
        })
}

const fetchBarangayInc = (page = 1) => {
    fetch.get(`../api/admin.display.accounts.php?user_type=barangay_inc&approve_status=Pending&page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data, brgyIncTblEl, 6);
            initTooltips();
            renderPagination(pagination, brgyIncPagEl, fetchBarangayInc);
        })
        .catch(error => {
            console.error(error);
        })
}

const fetchCityHealth = (page = 1) => {
    fetch.get(`../api/admin.display.accounts.php?user_type=city_health&approve_status=Pending&page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data, cityHealthTblEl, 5);
            initTooltips();
            renderPagination(pagination, cityHealthPagEl, fetchCityHealth);
        })
        .catch(error => {
            console.error(error);
        })
}

const fetchDeliveries = (page = 1) => {
    fetch.get(`../api/admin.display.accounts.php?user_type=deliveries&approve_status=Pending&page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data, delTblEl, 5);
            initTooltips();
            renderPagination(pagination, delPagEl, fetchDeliveries);
        })
        .catch(error => {
            console.error(error);
        })
}

const callFetches = () => {
    fetchBarangayInc(currentPage);
    fetchCityHealth(currentPage);
    fetchDeliveries(currentPage);
}

document.addEventListener('DOMContentLoaded', () => {
    callFetches();

    tabElements.forEach(tab => {
        tab.addEventListener('shown.bs.tab', () => {
            callFetches();
        });
    });
});
