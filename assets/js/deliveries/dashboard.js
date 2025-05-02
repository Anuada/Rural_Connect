import fetch from '../utilities/fetchClient.js';
import { Chart, registerables } from 'https://cdn.skypack.dev/chart.js@3.7.0';

Chart.register(...registerables);

// Availability Status Elements
const toggleEl = document.getElementById('availability-toggle');
const statusTextEl = document.getElementById('availability-status');

// KPIs and Charts Elements
const totalOngoingQueuesEl = document.getElementById('total-ongoing-queues');
const totalOnGoingQueuesLblEl = document.getElementById('total-ongoing-queues-label');
const totalClaimedEl = document.getElementById('total-claimed');
const totalReturnedEl = document.getElementById('total-returned');
const ongoingQueuesChartEl = document.getElementById('ongoing-queues-chart').getContext('2d');
const claimedChartEl = document.getElementById('claimed-chart').getContext('2d');
const returnedChartEl = document.getElementById('returned-chart').getContext('2d');

// Availability Status Related
toggleEl.addEventListener('change', () => {
    const payload = {
        availability_status: toggleEl.checked ? 'Available' : 'Unavailable'
    };

    handleChangeAvailabilityStatus(payload);
});

const fetchAvailabilityStatus = () => {
    fetch.get('../api/deliveries.display.availability.status.php')
        .then(response => {
            const availability_status = response?.data?.data;
            toggleEl.checked = availability_status === 'Available';
            statusTextEl.innerText = availability_status;
            statusTextEl.className = availability_status === 'Available' ? 'rc-blue-text user-select-none' : 'user-select-none';
        })
        .catch(error => {
            console.error(error);
        });
};

const handleChangeAvailabilityStatus = (payload) => {
    fetch.put('../api/deliveries.change.availability.status.php', payload)
        .then(response => {
            console.log(response?.data?.message);
            fetchAvailabilityStatus();
        })
        .catch(error => {
            console.error(error);
        });
};

// KPI and Charts Related
const ongoingQueuesChartData = {
    labels: ['Standard Request', 'Customized Request'],
    datasets: [{
        label: 'Ongoing Queue',
        data: [],
        backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
        hoverOffset: 4,
        borderWidth: 0,
    }]
};

const claimedChartData = {
    labels: ['Standard Request', 'Customized Request'],
    datasets: [{
        label: 'Claimed',
        data: [],
        backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
        hoverOffset: 4,
        borderWidth: 0,
    }]
};

const returnedChartData = {
    labels: ['Standard Request', 'Customized Request'],
    datasets: [{
        label: 'Returned',
        data: [],
        backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
        hoverOffset: 4,
        borderWidth: 0,
    }]
};

const updateChart = (chartData, chartValues, ctx) => {
    if (chartValues.every(val => val === 0)) {
        chartData.labels = ['No Data'];
        chartData.datasets[0].data = [1];
        chartData.datasets[0].backgroundColor = ['#d3d3d3'];
    } else {
        chartData.labels = ['Standard Request', 'Customized Request'];
        chartData.datasets[0].data = chartValues;
        chartData.datasets[0].backgroundColor = ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'];
    }

    new Chart(ctx, {
        type: 'doughnut',
        data: chartData,
        options: {
            responsive: true
        }
    });
}

const fetchDeliveryData = () => {
    fetch.get('../api/deliveries.dashboard.php')
        .then(response => {
            // Variables
            const totalOnGoingQueue = response?.data?.data?.totals?.ongoing_queues;
            const ongoingQueuesChart = response?.data?.data?.ongoing_queues_chart;
            const claimedChart = response?.data?.data?.claimed_chart;
            const returnedChart = response?.data?.data?.returned_chart;

            // Declaring of Values in KPIs
            totalOngoingQueuesEl.innerText = totalOnGoingQueue;
            totalOnGoingQueuesLblEl.innerText = totalOnGoingQueue > 1 ? "Ongoing Queues" : "Ongoing Queue";
            totalClaimedEl.innerText = response?.data?.data?.totals?.claimed;
            totalReturnedEl.innerText = response?.data?.data?.totals?.returned;

            // Declaring of Values in Charts
            updateChart(ongoingQueuesChartData, ongoingQueuesChart, ongoingQueuesChartEl);
            updateChart(claimedChartData, claimedChart, claimedChartEl);
            updateChart(returnedChartData, returnedChart, returnedChartEl);
        })
        .catch(error => {
            console.error(error);
        });
};

document.addEventListener('DOMContentLoaded', () => {
    fetchAvailabilityStatus();
    fetchDeliveryData();
});