import { Chart, registerables } from 'https://cdn.skypack.dev/chart.js@3.7.0';
import fetch from '../utilities/fetchClient.js';

Chart.register(...registerables);

// KPI Elements 
const totalPendingEl = document.getElementById('total-pending');
const totalAcceptedEl = document.getElementById('total-accepted');
const totalCancelledEl = document.getElementById('total-cancelled');

// KPI Labels
const totalPendingLblEl = document.getElementById('total-pending-label');
const totalAcceptedLblEl = document.getElementById('total-accepted-label');
const totalCancelledLblEl = document.getElementById('total-cancelled-label');

// Chart Element
const requestChartEl = document.getElementById('request-chart').getContext('2d');

const request_data = {
    labels: ['Pending', 'Approved', 'Cancelled'],
    datasets: [
        {
            label: 'Standard Request',
            data: [],
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
        },
        {
            label: 'Customized Request',
            data: [],
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
        }
    ]
};

const config = {
    type: 'bar',
    data: request_data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
        },
        scales: {
            x: {
                stacked: false,
            },
            y: {
                beginAtZero: true,
            }
        }
    },
};

document.addEventListener('DOMContentLoaded', () => {
    fetch.get('../api/city.health.dashboard.php')
        .then(response => {
            const { data } = response?.data;
            totalPendingEl.innerText = data?.total_requests?.Pending;
            totalAcceptedEl.innerText = data?.total_requests?.Accepted;
            totalCancelledEl.innerText = data?.total_requests?.Cancelled;

            totalPendingLblEl.innerText = data?.total_requests?.Pending > 1 ? "Pending Requests" : "Pending Request";
            totalAcceptedLblEl.innerText = data?.total_requests?.Accepted > 1 ? "Accepted Requests" : "Accepted Request";
            totalCancelledLblEl.innerText = data?.total_requests?.Cancelled > 1 ? "Cancelled Requests" : "Cancelled Request";

            request_data.datasets[0].data = data?.standard_requests;
            request_data.datasets[1].data = data?.customized_requests;

            new Chart(requestChartEl, config);

        })
        .catch(error => {
            console.error(error);
        });
});