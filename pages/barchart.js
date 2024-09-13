document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myBarChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: 'Purchase',
                    data: [15000, 20000, 18000, 25000, 22000, 27000, 30000, 35000, 32000, 37000, 39000, 33000],
                    backgroundColor: 'rgba(45, 43, 43, 100)',
                    borderRadius: 10,
                    borderColor: 'rgba(45, 43, 43, 100)',
                    borderWidth: 1,
                    barPercentage: 0.4, // Adjust the width of bars
                    categoryPercentage: 0.5 // Adjust the width of the groups
                },
                {
                    label: 'Sale',
                    data: [25000, 30000, 27000, 32000, 35000, 37000, 40000, 42000, 45000, 47000, 35000, 37000],
                    backgroundColor: 'rgba(215, 102, 20, 80)',
                    borderRadius: 10,
                    borderColor: 'rgba(215, 102, 20, 80)',
                    borderWidth: 1,
                    barPercentage: 0.4, // Adjust the width of bars
                    categoryPercentage: 0.5 // Adjust the width of the groups
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
                            return `${tooltipItem.dataset.label}: ₱${tooltipItem.raw.toLocaleString()}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: false, // Set to false to show bars grouped
                    grid: {
                        display: false // Hide grid lines for x-axis
                    }
                },
                y: {
                    stacked: false, // Set to false to ensure bars don't stack
                    beginAtZero: true,
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
