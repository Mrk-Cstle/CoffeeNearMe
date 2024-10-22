<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Series and Forecasting Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <h2>Time Series Analysis</h2>
    <canvas id="timeSeriesChart" width="600" height="300"></canvas>

    <h2>Forecasting Analysis</h2>
    <canvas id="forecastingChart" width="600" height="300"></canvas>

    <script>
        // Sample monthly sales data
        let months = [];
        let sales = [];
        let forecast = [];

        // Generate data for 24 months (2 years)
        for (let i = 0; i < 24; i++) {
            const date = new Date(2022, i, 1);
            months.push(date.toISOString().slice(0, 7)); // Format YYYY-MM
            sales.push(Math.floor(Math.random() * (200 - 100 + 1)) + 100 + (i * 1.5)); // Simulated sales data
        }

        // Generate forecast for the next 6 months
        for (let i = 0; i < 6; i++) {
            forecast.push(sales[sales.length - 1] + (i * 2.5)); // Simple forecast
            months.push(new Date(2024, i, 1).toISOString().slice(0, 7)); // Add forecast months
        }

        // Create Time Series Analysis Chart
        const ctx1 = document.getElementById('timeSeriesChart').getContext('2d');
        const timeSeriesChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: months.slice(0, 24), // First 24 months
                datasets: [{
                    label: 'Historical Sales',
                    data: sales,
                    borderColor: 'blue',
                    fill: false,
                    tension: 0.1
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

        // Create Forecasting Analysis Chart
        const ctx2 = document.getElementById('forecastingChart').getContext('2d');
        const forecastingChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: months, // All months including forecast
                datasets: [{
                        label: 'Historical Sales',
                        data: sales,
                        borderColor: 'blue',
                        fill: false,
                        tension: 0.1
                    },
                    {
                        label: 'Forecasted Sales',
                        data: sales.concat(forecast), // Combine historical and forecast data
                        borderColor: 'orange',
                        fill: false,
                        tension: 0.1,
                        borderDash: [5, 5] // Dashed line for forecast
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>