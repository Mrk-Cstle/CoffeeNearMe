document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('analysisChart').getContext('2d');
    new Chart(ctx, {
        type: 'line', 
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Analysis',
                data: [15000, 20000, 18000, 25000, 22000, 27000, 30000, 35000, 32000, 57000, 39000, 33000],
                borderColor: 'rgba(75, 192, 192, 1)', // Line color
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Fill color
                borderWidth: 2,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(215, 102, 20, 80)',
                pointBorderColor: 'rgba(215, 102, 20, 80)',
                fill: true 
            }]
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
                            return `₱${tooltipItem.raw.toLocaleString()}`;
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
                    suggestedMin: 10000, // Minimum value on y-axis
                    suggestedMax: 100000, // Maximum value on y-axis
                    grid: {
                        borderDash: [5, 5], // Optional dashed lines
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
