import fetch from "../utilities/fetchClient.js";
import displayDeliveryStatus from "../utilities/displayDeliveryStatusColor.js";
import { timestampFormatter } from "../utilities/formatter.js";

// Elements
const trackDeliveryStatusEl = document.getElementById('track-delivery-status');

// Variables
let deliveryId = '';
let requestType = '';

// For Query Parameter
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const medDeliveryParam = urlParams.get('med-delivery');
const customMedDeliveryParam = urlParams.get('custom-med-delivery');

deliveryId = medDeliveryParam ?? customMedDeliveryParam;
requestType = medDeliveryParam != null ? 'med-delivery' : 'custom-med-delivery';

const displayDeliveryStatusTracker = (data) => {
    trackDeliveryStatusEl.innerHTML = '';
    data.map(d => {
        trackDeliveryStatusEl.innerHTML += `
            <div class="timeline-entry">
                <div class="timeline-dot"></div>
                <h6 class="mb-1">${displayDeliveryStatus(d.status)}</h6>
                <div class="timeline-time">${timestampFormatter(d.updated_at)}</div>
            </div>
        `;
    });
};

const fetchDeliveryStatusHistoryDetails = () => {
    fetch.get(`../api/barangay.inc.track.delivery.status.php?${requestType}=${deliveryId}`)
        .then(response => {
            const deliveryStatusHistory = response?.data?.data;
            displayDeliveryStatusTracker(deliveryStatusHistory);
        })
        .catch(error => {
            console.error(error);
        });
}

document.addEventListener('DOMContentLoaded', () => {
    fetchDeliveryStatusHistoryDetails();

    setInterval(fetchDeliveryStatusHistoryDetails, 1000);
});