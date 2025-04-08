import fetch from "../utilities/fetchClient.js";
import { successAlert, confirmAlert } from "../helpers/sweetAlert2.js";
import { subscriptionLoader } from "./table.loader.js";
import serializeForm from "../helpers/serializeForm.js";

const table_data = document.getElementById('table-data');
const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
const modalImage = document.getElementById('modalImage');
const canStaModal = document.getElementById('cancelStatusModal');
const cancelStatusModal = new bootstrap.Modal(canStaModal);
const idEl = document.getElementById('id');
const approve_statusEl = document.getElementById('approve_status');
const noteErrorEl = document.getElementById('noteError');
const formEl = document.getElementById('cancel-subscription');

const displayTable = (data) => {
    table_data.innerHTML = "";
    if (data.length > 0) {
        data.map(d => {
            table_data.innerHTML += `
                <tr>
                    <td>${d.barangay}</td>
                    <td>${d.fname} ${d.lname}</td>
                    <td>${d.plan}</td>
                    <td class="text-center">
                        <button class="btn btn-primary view-gcash-receipt" data-image="${d.receipt}"><i class="fas fa-file-invoice"></i> <span
                                style="margin-left:10px">View</span></button>
                    </td>
                    <td>${display_action(d)}</td>
                </tr>
            `;
        });
    } else {
        table_data.innerHTML = `
        <tr>
            <td colspan="5" class="text-center" style="height:100px">No Subscribers Found</td>
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
            <a href="../receipt/?id=${data.id}" target="_blank" class="btn btn-success">
				<i class="fas fa-file-invoice"></i> 
				<span style="margin-left:10px">View Receipt</span>
			</a>
			`;

        case "Cancelled":
            return `<i class="text-danger user-select-none">${data.approve_status}</i>`;

        default:
            return `
			<button class="btn btn-success approve-status" title="Approve" data-id="${data.id}" data-approve-status="Approved"><i class="fas fa-check"></i></button>
			<button class="btn btn-danger cancel-status" title="Cancel" data-id="${data.id}" data-cancel-status="Cancelled"><i class="fas fa-times"></i></button>
			`;
    }
}

let currentPage = 1;
const limit = 5;

const fetchSubscribers = (page = 1) => {
    fetch.get(`../api/admin.subscribers.php?page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            displayTable(data);
            renderPagination(pagination);
        })
        .catch(error => {
            console.error(error);
        });
};

const renderPagination = (pagination) => {
    const paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = '';

    let { currentPage, totalPages } = pagination;

    if (totalPages <= 1) return;

    // Prev
    if (currentPage > 1) {
        paginationContainer.innerHTML += `<button class="btn btn-secondary mx-1 page-btn" data-page="${currentPage - 1}">Prev</button>`;
    }

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        paginationContainer.innerHTML += `<button class="btn btn${i === currentPage ? '-primary' : '-outline-primary'} mx-1 page-btn" data-page="${i}">${i}</button>`;
    }

    // Next
    if (currentPage < totalPages) {
        paginationContainer.innerHTML += `<button class="btn btn-secondary mx-1 page-btn" data-page="${currentPage + 1}">Next</button>`;
    }

    // Add event listeners
    const buttons = document.querySelectorAll('.page-btn');
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentPage = parseInt(btn.getAttribute('data-page'));
            fetchSubscribers(currentPage);
        });
    });
};


document.addEventListener('DOMContentLoaded', () => {
    fetchSubscribers(currentPage);
});
