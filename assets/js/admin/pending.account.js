import { confirmAlert, errorAlert, successAlert } from "../helpers/sweetAlert2.js";
import { dateFormatter } from "../utilities/dateFormatter.js";
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
                    <td>
                        <button class="btn btn-primary view-id-verification" data-image="${d.id_verification}"><i class="fas fa-file-invoice"></i> <span
                                style="margin-left:10px">View</span></button>
                    </td>
                    <td>${dateFormatter(d.created_at)}</td>
                    <td>
                        <button class="btn btn-success approve-status" title="Approve" data-id="${d.accountId}" data-approve-status="Approved"><i class="fas fa-check"></i></button>
			            <button class="btn btn-danger approve-status" title="Cancel" data-id="${d.accountId}" data-approve-status="Cancelled"><i class="fas fa-times"></i></button>
                    </td>                    
                </tr>
            `;
        });
    } else {
        tableBody.innerHTML = `
        <tr>
            <td colspan="${colspan}" class="text-center" style="height:100px">No Data Found</td>
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
}

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
            displayTable(data, brgyIncTblEl, 5);
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
            displayTable(data, cityHealthTblEl, 4);
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
            displayTable(data, delTblEl, 4);
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
