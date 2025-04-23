import displayDeliveryStatus from "../utilities/displayDeliveryStatusColor.js";
import { dateFormatter } from "../utilities/formatter.js";

const tableDisplay = (data, container) => {
    container.innerHTML = "";
    if (data.length > 0) {
        data.map(d => {
            container.innerHTML += `
                <div class="med-card card p-3 d-flex flex-md-row flex-column align-items-md-center gap-3 shadow-sm view-request-details" data-id="${d.id}" data-request-type="${d.med_image != undefined ? "med-delivery" : "custom-med-delivery"}">
                    ${d.med_image != undefined ? `
                        <div class="med-img text-center">
                            <img src="${d.med_image}" alt="Medicine Image" class="rounded img-fluid">
                        </div>
                        `: ''}
                    <div class="med-details flex-grow-1">
                        <div class="fw-bold">${d.med_name}</div>
                        <div class="text-secondary small">${d.category}</div>
                        <div class="text-secondary small">${d.dosage_form} - ${d.dosage_strength}</div>
                    </div>
                    <div class="med-info text-nowrap small">Barangay ${d.barangay}</div>
                    <div class="med-info text-nowrap small">${dateFormatter(d.date_of_supply)}</div>
                    <div class="med-info text-nowrap small">${displayDeliveryStatus(d.delivery_status)}</div>
                </div>
            `;
        });
    } else {
        container.innerHTML = `
            <div class="text-center text-secondary user-select-none py-5">
                No Delivery Queue Found
            </div>
        `;
    }

    const viewRequestDetailsEl = document.querySelectorAll('.view-request-details');
    viewRequestDetailsEl.forEach(viewRequest => {
        viewRequest.addEventListener('click', () => {
            const id = viewRequest.dataset.id;
            const requestType = viewRequest.dataset.requestType;
            window.location.href = `../deliveries/delivery-details.php?${requestType}=${id}`;
        });
    });
}

export default tableDisplay;
