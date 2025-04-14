import { Chart, registerables } from 'https://cdn.skypack.dev/chart.js@3.7.0';
import fetch from '../utilities/fetchClient.js';

Chart.register(...registerables);

const barChart = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['Pending Requests', 'Accepted Requests', 'Cancelled Requests'],
        datasets: [{
            label: 'Total Requests',
            data: [],
            backgroundColor: ['#ffcd38', '#37e978', '#ff5162']
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

document.addEventListener('DOMContentLoaded', () => {
    fetch.get('../api/city.health.dashboard.php')
        .then(response => {
            const { data } = response.data;
            barChart.data.datasets[0].data = data;
            barChart.update();
        })
        .catch(error => {
            console.error(error);
        })

});