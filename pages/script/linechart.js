document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myLineChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: 'Sales',
                    data: [15000, 20000, 18000, 25000, 22000, 27000, 30000, 35000, 32000, 37000, 39000, 50000],
                    borderColor: 'rgba(45, 43, 43, 1)',
                    backgroundColor: 'rgba(45, 43, 43, 0.2)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(45, 43, 43, 100)',
                    pointBorderColor: 'rgba(45, 43, 43, 100)',
                    borderCapStyle: 'round',
                    borderJoinStyle: 'round',
                    fill: true
                },
                {
                    label: 'Profit',
                    data: [5000, 8000, 6000, 9000, 7000, 10000, 12000, 14000, 11000, 15000, 16000, 20000],
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(255, 159, 64, 1)',
                    pointBorderColor: 'rgba(255, 159, 64, 1)',
                    borderCapStyle: 'round',
                    borderJoinStyle: 'round',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const datasetLabel = tooltipItem.dataset.label || '';
                            return `${datasetLabel}: ₱${tooltipItem.raw.toLocaleString()}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false // Hide grid lines for x-axis
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [5, 5], 
                    },
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});
