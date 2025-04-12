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
const thisMonth = document.getElementById('thisMonth');

// Subscribers Breakdown Chart
const subscribersChart = new Chart(document.getElementById('subscribersBreakdownChart'), {
    type: 'doughnut',
    data: {
        labels: ['Annual', 'Monthly'],
        datasets: [{
            label: 'Subscribers',
            data: [],
            backgroundColor: ['#3b82f6', '#10b981'],
            hoverOffset: 4
        }]
    },
});

// Total Users Breakdown Chart
const totalUsersChart = new Chart(document.getElementById('totalUsersBreakdownChart'), {
    type: 'doughnut',
    data: {
        labels: ['Barangay Incharge', 'City Health', 'Delivery'],
        datasets: [{
            label: 'Total Users',
            data: [],
            backgroundColor: ['#fbbf24', '#6366f1', '#10b981'],
            hoverOffset: 4
        }]
    },
});

// Bar Chart
const totalUsersAddedThisMonth = new Chart(document.getElementById('totalUsersAddedThisMonth'), {
    type: 'bar',
    data: {
        labels: ['Barangay Incharge', 'City Health', 'Delivery'],
        datasets: [{
            label: 'Total Users Added',
            data: [],
            backgroundColor: ['#fbbf24', '#6366f1', '#10b981']
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
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

const fetchTotalUsersAddedThisMonth = () => {
    fetch.get('../api/admin.total.users.added.php')
        .then(response => {
            const { total, month_year } = response.data.data;
            thisMonth.innerHTML = `<span class="month-date">(${month_year})</span>`;
            totalUsersAddedThisMonth.data.datasets[0].data = total;
            totalUsersAddedThisMonth.update();
        })
        .catch(error => {
            console.error(error);
        });
}

const fetchTotalEarningsThisMonth = () => {
    fetch.get('../api/admin.total.earnings.php')
        .then(response => {
            const { data } = response.data;
            monthlyEarningsLabel.innerHTML = `Monthly Earnings <span class="month-date">(${data.month_year})</span>`;
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
    fetchTotalUsersAddedThisMonth();
})