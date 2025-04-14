import { Chart, registerables } from 'https://cdn.skypack.dev/chart.js@3.7.0';
import fetch from '../utilities/fetchClient.js';

Chart.register(...registerables);

const displayStarFeedbacks = (num) => {
    const total_num = parseInt(num);
    let stars = [];
    for (let i = 0; i < total_num; i++) {
        stars.push("★");
    }
    return stars.join("");
}

const displayFeedbacksOnModal = (data) => {
    const feedbackDisplay = document.getElementById("modalContent");
    feedbackDisplay.innerHTML = "";
    data.map(d => {
        feedbackDisplay.innerHTML += `
            <div class="slide">
                <div class="card">
                    <div class="stars">${displayStarFeedbacks(d.rating)}</div>
                    <p>${d.feedback ? `"${d.feedback}"` : "<i>[speechless]</i>"}</p>
                    <h5>- ${d.username}</h5>
                </div>
            </div>
        `;
    })
}

document.addEventListener('DOMContentLoaded', () => {

    // Ratings Related
    let ctx = document.getElementById('ratingsChart').getContext('2d');
    let ratingsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
            datasets: [{
                label: 'Number of Ratings',
                data: [],
                backgroundColor: [
                    '#ef4444', // red-500
                    '#a78bfa', // violet-400
                    '#3b82f6', // blue-500
                    '#34d399', // emerald-400
                    '#fbbf24', // amber-400
                ],
                borderColor: 'transparent', // or simply remove border if not needed
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#ccc' // Light gray ticks
                    },
                    grid: {
                        color: '#444' // Subtle grid lines
                    }
                },
                x: {
                    ticks: {
                        color: '#ccc'
                    },
                    grid: {
                        color: '#444'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#ccc' // Light gray text for dark mode
                    }
                },
            },
            onClick: function (event) {
                let activePoints = this.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false);
                if (activePoints.length) {
                    let clickedIndex = activePoints[0].index;
                    let ratingValue = this.data.labels[clickedIndex];
                    let rating = ratingValue[0];
    
                    fetch.get(`../api/admin.feedback.php?rating=${rating}`)
                        .then(response => {
                            displayFeedbacksOnModal(response.data.data);
                        })
                        .catch(error => {
                            console.error(error);
                        });
    
                    let modal = new bootstrap.Modal(document.getElementById('ratingModal'));
                    modal.show();
                }
            },
            onHover: function (event, chartElement) {
                event.native.target.style.cursor = chartElement.length ? 'pointer' : 'default';
            }
        }
    });
    

    fetch.get('../api/admin.ratings.php')
        .then(({ data }) => {
            ratingsChart.data.datasets[0].data = data.data;
            ratingsChart.update();
        })
        .catch((error) => {
            console.error(error);
        });

});