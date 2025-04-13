import fetch from "../utilities/fetchClient.js";
import { successAlert, confirmAlert } from "../helpers/sweetAlert2.js";
import { subscriptionLoader } from "../utilities/table.loader.js";
import serializeForm from "../helpers/serializeForm.js";
import renderPagination from "../utilities/table.pagination.js";

// VARIABLES
let currentPage = 1;
const limit = 5;

// Elements
const searchEl = document.getElementById('search');
const table_data = document.getElementById('table-data');
const paginationContainer = document.getElementById('pagination');
const imgModalEl = document.getElementById('imageModal')
const modalImage = document.getElementById('modalImage');
const cancelStatusModalEl = document.getElementById('cancelStatusModal');

// Form Elements
const formEl = document.getElementById('cancel-subscription');
const idEl = document.getElementById('id');
const approve_statusEl = document.getElementById('approve_status');
const noteErrorEl = document.getElementById('noteError');

// Bootstrap Modals
const imageModal = new bootstrap.Modal(imgModalEl);
const cancelStatusModal = new bootstrap.Modal(cancelStatusModalEl);

cancelStatusModalEl.addEventListener('hidden.bs.modal', () => {
    formEl.reset();
    idEl.value = "";
    approve_statusEl.value = "";
    noteErrorEl.innerText = "";
});

const displayTable = (data) => {
    table_data.innerHTML = "";
    if (data.length > 0) {
        data.map(d => {
            table_data.innerHTML += `
                <tr>
                    <td>${d.barangay}</td>
                    <td>${d.fname} ${d.lname}</td>
                    <td>${d.plan}</td>
                    <td>
                        <button class="btn btn-primary shadow view-gcash-receipt" data-image="${d.receipt}"><i class="fas fa-file-invoice"></i> <span
                                style="margin-left:10px">View</span></button>
                    </td>
                    <td>${display_action(d)}</td>
                </tr>
            `;
        });
    } else {
        table_data.innerHTML = `
        <tr>
            <td colspan="5" class="text-center text-secondary user-select-none" style="height:100px">No Subscribers Found</td>
        </tr>
        `;
    }

    // View GCash Receipt
    const viewGcashReceipt = document.querySelectorAll('.view-gcash-receipt');
    viewGcashReceipt.forEach(view => {
        view.addEventListener('click', () => {
            const image = view.getAttribute('data-image');
            modalImage.src = image;
            imageModal.show();
        });
    });

    // Approve Status Action
    const approveStatus = document.querySelectorAll('.approve-status');
    approveStatus.forEach(status => {
        status.addEventListener('click', () => {
            const payload = {
                id: status.getAttribute('data-id'),
                approve_status: status.getAttribute('data-approve-status')
            };
            const question = `Are you sure you want to get this subscription ${payload.approve_status.toLowerCase()}?`;
            confirmAlert(question, handle_approval_status, payload);
        });
    });

    // Cancel Status
    const cancelStatus = document.querySelectorAll('.cancel-status');
    cancelStatus.forEach(status => {
        status.addEventListener('click', () => {
            const id = status.getAttribute('data-id');
            const cancel_status = status.getAttribute('data-cancel-status');
            idEl.value = id;
            approve_statusEl.value = cancel_status;
            cancelStatusModal.show();
        });
    });
}

formEl.addEventListener('submit', (e) => {
    e.preventDefault();
    const payload = serializeForm(formEl);
    const question = `Are you sure you want to get this subscription ${payload.approve_status.toLowerCase()}?`;
    confirmAlert(question, handle_approval_status, payload);
})

const handle_approval_status = (payload) => {
    subscriptionLoader(table_data);
    fetch.put('../api/admin.subscription.approval.php', payload)
        .then(response => {
            table_data.innerHTML = "";
            cancelStatusModal.hide();
            formEl.reset();
            fetchSubscribers();
            successAlert(response.data.message);
        })
        .catch(error => {
            const errors = error.data.data;
            noteErrorEl.innerHTML = errors.note ?? "";
            console.error(error);
            fetchSubscribers();
        })
        ;
}

const display_action = (data) => {
    switch (data.approve_status) {
        case "Approved":
            return `
            <a href="../receipt/?id=${data.id}" target="_blank" class="btn btn-success shadow">
				<i class="fas fa-file-invoice"></i> 
				<span style="margin-left:10px">View Receipt</span>
			</a>
			`;

        case "Cancelled":
            return `
            <i  class="text-danger user-select-none" 
                data-bs-toggle="tooltip" 
                data-bs-placement="right" 
                title="${data.cancel_note ?? ""}">
                ${data.approve_status}
            </i>            
            `;

        default:
            return `
			<button class="btn btn-success shadow approve-status" title="Approve" data-id="${data.id}" data-approve-status="Approved"><i class="fas fa-check"></i></button>
			<button class="btn btn-danger shadow cancel-status" title="Cancel" data-id="${data.id}" data-cancel-status="Cancelled"><i class="fas fa-times"></i></button>
			`;
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

const fetchSubscribers = (page = 1) => {
    fetch.get(`../api/admin.subscribers.php?page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data);
            initTooltips();
            renderPagination(pagination, paginationContainer, fetchSubscribers);
        })
        .catch(error => {
            console.error(error);
        });
};

document.addEventListener('DOMContentLoaded', () => {
    fetchSubscribers(currentPage);
});
