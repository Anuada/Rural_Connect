import { Chart, registerables } from 'https://cdn.skypack.dev/chart.js@3.7.0';
import fetch from '../utilities/fetchClient.js';
import { formatAsAmount } from '../utilities/formatter.js';

Chart.register(...registerables);

const totalUsers = document.getElementById('totalUsers');
const pendingAccounts = document.getElementById('pendingAccounts');
const totalRating = document.getElementById('totalRating');
const monthlyEarningsLabel = document.getElementById('monthlyEarningsLabel');
const monthlyEarnings = document.getElementById('monthlyEarnings');
const totalSubscribers = document.getElementById('totalSubscribers');
const pendingSubscribers = document.getElementById('pendingSubscribers');

// Doughnut Chart
const subscribersChart = new Chart(document.getElementById('doughnutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Annual', 'Monthly'],
        datasets: [{
            label: 'Subscribers',
            data: [],
            backgroundColor: ['#3b82f6', '#10b981'],
            hoverOffset: 4
        }]
    }
});

// Bar Chart
const totalUsersChart = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['Barangay Incharge', 'City Health', 'Delivery'],
        datasets: [{
            label: 'Total Accounts',
            data: [],
            backgroundColor: ['#fbbf24', '#6366f1', '#10b981']
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const fetchTotalUsers = () => {
    fetch.get('../api/admin.total.users.php')
        .then(response => {
            const { data } = response.data;
            totalUsersChart.data.datasets[0].data = data;
            totalUsersChart.update();

            let sum = 0;
            data.forEach(datum => {
                sum += parseInt(datum);
            });
            totalUsers.textContent = sum;
        })
        .catch(error => {
            console.error(error);
        });
}

const fetchTotalSubscribers = () => {
    fetch.get(`../api/admin.total.subscribers.php`)
        .then(response => {
            const { data } = response.data;
            subscribersChart.data.datasets[0].data = data;
            subscribersChart.update();

            let sum = 0;
            data.forEach(datum => {
                sum += parseInt(datum);
            });
            totalSubscribers.textContent = sum;
        })
        .catch(error => {
            console.error(error);
        });
}

const fetchTotalEarningsThisMonth = () => {
    fetch.get('../api/admin.total.earnings.php')
        .then(response => {
            const { data } = response.data;
            monthlyEarningsLabel.textContent = `Monthly Earnings (${data.month_year})`;
            monthlyEarnings.innerHTML = formatAsAmount(data.total_earnings);
        })
        .catch(error => {
            console.error(error);
        });
}

const fetchPendings = () => {
    fetch.get('../api/admin.total.pendings.php')
        .then(response => {
            const { data } = response.data;
            pendingAccounts.textContent = data.accounts;
            pendingSubscribers.textContent = data.subscribers;
        })
        .catch(error => {
            console.error(error);
        })
}

const fetchTotalRating = () => {
    fetch.get('../api/admin.total.rating.php')
        .then(response => {
            const { data } = response.data;
            totalRating.innerHTML = `<i class="fas fa-star"></i> <span style="margin-left: 10px">${data}</span>`;
        })
        .catch(error => {
            console.error(error);
        })
}

document.addEventListener('DOMContentLoaded', () => {
    fetchPendings();
    fetchTotalUsers();
    fetchTotalRating();
    fetchTotalSubscribers();
    fetchTotalEarningsThisMonth();
})