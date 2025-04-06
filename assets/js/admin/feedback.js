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
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ], borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
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
                        })

                    // Show the modal
                    let modal = new bootstrap.Modal(document.getElementById('ratingModal'));
                    modal.show();
                }
            },
            onHover: function (event, chartElement) {
                if (chartElement.length) {
                    // Change cursor to pointer when hovering over a bar
                    event.native.target.style.cursor = 'pointer';
                } else {
                    // Reset cursor when not hovering over a bar
                    event.native.target.style.cursor = 'default';
                }
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