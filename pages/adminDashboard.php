<?php include '../assets/template/navigation.php'; ?>
<?php include 'include/dashboard.php'; ?>
<?php include 'include/access.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/design/adminDashboard.css">

    <title>Document</title>
    <style>
        /* Style to set the canvas size */
        #salesChart {
            width: 100%;
            /* Full width */
            height: 400px;
            /* Fixed height */
        }

        
        
    </style>
</head>

<body>
    <div class="container">

        <h3 class="headDash">Dashboard</h3>
        <?php if (hasAccess('admin')): ?>
            <div class="salesandInventory">
                <!--SALES OVERVIEW FORM-->
                <div class="salesOverview">
                    <p id="salesHead">Sales Overview</p>

                    <div class="salesBord">

                        <div class="salesOver">
                            <p id="salesPara">Sales Today</p>
                            <img src="../assets/images/salesIcon.png" class="salesImage">
                            <div class="paragraphSales">
                                <p id="salesNum">₱<?php echo number_format($total_sales_today, 2); ?></p>
                            </div>
                        </div>
                        

                        <div class="salesOver">
                            <p id="salesPara">Transaction Today</p>
                            <img src="../assets/images/revenueIcon.png" class="salesImage">
                            <div class="paragraphSales">
                                <p id="salesTrans"><?php echo $total_transactions_today; ?></p>
                                
                            </div>
                        </div>

                        

                        <a href="salesReportPrint.php" class="salesOverLink" target="_blank">
                            <div class="salesOver">
                                <p id="salesPara">Today's Report</p>
                                <img src="../assets/images/reportBlack.png" class="salesImage">
                                <div class="paragraphSales">
                                    
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                <!--INVENTORY SUMMARY FORM-->
                <div class="inventorySummary">
                    <p id="inventoryHead">Inventory Summary</p>

                    <div class="inventoryBord">

                        <div class="inventorySum">
                            <p id="inventPara">Stocks</p>
                            <img src="../assets/images/stockBlack.png" class="inventStock">
                            <div class="paragraphInvent">
                                <p id="inventNumStock"><?php echo $total_ingredients; ?></p>
                            </div>
                        </div>
                        <div class="borderRight"></div>

                        <div class="inventorySum">
                             <p id="inventPara">Low Stocks</p>
                            <img src="../assets/images/lowStockBlack.png" class="inventImage">
                            <div class="paragraphInvent">
                                <p id="inventNum"><?php echo $low_stock_count; ?></p>
                            </div>
                        </div>
                        <div class="borderRight"></div>

                        <a href="actionInventory.php" class="inventorySum">
                            <p id="inventPara">Inventory History</p>
                            <img src="../assets/images/inventoryHistoryBlak.png" class="inventHis">
                            <div class="paragraphInvent">

                               
                            </div>
                        </a>
                        <div class="borderRight"></div>

                        <a href="transactionDetails.php" class="inventorySum">
                            <p id="inventPara">Transaction History</p>
                            <img src="../assets/images/transactionBlack.png" class="inventSum">
                            <div class="paragraphInvent">

                                
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="topSellingandLowStockProduct">

            <div class="topSellingDiv">

                <h5 id="topHead">Top Selling Product</h5>
                <select class="topbtn btn btn-dark me-1" aria-label="filter" name="filter" id="filter">
                    <option value="Today">Today</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>


                </select>
                <div class="selling">
                    <div class="heading">

                    </div>
                    <div id="borderDown"></div>

                    <div class="bodySell">


                    </div>


                </div>

            </div>

            <div class="lowStock">
                <div class="lowStockDiv">
                    <!-- <h5 id="lowHead">Low Stock</h5>

                    <div class="lowHeading">
                        <h5 id="lowHead">Product</h5>
                        <h5 id="lowHead">Product Name</h5>
                        <h5 id="lowHead">Quantity</h5>
                    </div> -->


                    <!-- <div class="lowBody">
                        <img src="../assets/images/coffee.png" class="lowImage">
                        <h5 id="lowP1">Coffee</h5>
                        <h5 id="lowP2">5</h5>
                    </div>
                    <div id="borderDown"></div>

                    <div class="lowBody">
                        <img src="../assets/images/latte.png" class="lowImage">
                        <h5 id="lowP1">Sugar</h5>
                        <h5 id="lowP2">15</h5>
                    </div>
                    <div id="borderDown"></div>

                    <div class="lowBody">
                        <img src="../assets/images/latte.png" class="lowImage">
                        <h5 id="lowP1">Sugar</h5>
                        <h5 id="lowP2">15</h5>
                    </div> -->

                </div>
            </div>

        </div>


        <?php if (hasAccess('admin')): ?>
            <div class="charts">


                <!--BAR CHART -->
                <div class="barChart-container">
                    <div class="chartBar-container">
                        <h3 class="barChartHeadOne">Total Sales Over Time</h3>
                        <div class="canvasBar-container">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!--LINE CHART-->

                <div class="chartLine-container">
                    <div class="lineChart-container">
                        <h3 id="salesHead">Sales</h3>
                        <div class="canvasLine-container">
                            <canvas id="myLineChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </div>

    <!-- Include Luxon library -->
    <script src="https://cdn.jsdelivr.net/npm/luxon@latest/build/global/luxon.min.js"></script>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include the Luxon date adapter for Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@latest/dist/chartjs-adapter-luxon.bundle.min.js"></script>
    <!-- Include Materialize library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        let salesChart; // Declare the salesChart variable here


        async function fetchData() {
            try {
                const response = await fetch('action/analytics.php');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();

                console.log(data);


                const chartData = {
                    labels: [...data.dates, ...getForecastDates(data.dates)],
                    totalSales: data.sales,


                    forecastSales: [...Array(data.sales.length).fill(null), ...(Array.isArray(data.forecast) ? data.forecast : [])]
                };

                renderChart(chartData);
            } catch (error) {
                console.error('Error fetching data:', error);

            }
        }

        // Function to generate forecast dates
        function getForecastDates(existingSalesDates) {
            const forecastDays = 5; // Number of days to forecast
            const lastDate = new Date(existingSalesDates[existingSalesDates.length - 1]); // Get the last actual date
            const forecastDates = [];

            for (let i = 1; i <= forecastDays; i++) {
                const nextDate = new Date(lastDate);
                nextDate.setDate(lastDate.getDate() + i); // Increment the date by i days
                forecastDates.push(nextDate.toISOString().split('T')[0]); // Format to YYYY-MM-DD
            }

            return forecastDates;
        }

        // Function to render the chart
        function renderChart(data) {
            const ctx = document.getElementById('salesChart').getContext('2d');

            // Destroy previous instance if it exists
            if (salesChart) {
                salesChart.destroy();
            }

            // Create a new chart
            salesChart = new Chart(ctx, {
                type: 'line', // Line chart type
                data: {
                    labels: data.labels,
                    datasets: [{
                            label: 'Total Sales',
                            data: data.totalSales,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                        },
                        {
                            label: 'Forecast Sales',
                            data: data.forecastSales,
                            borderColor: 'rgba(255, 99, 132, 1)', // Different color for forecast
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: false, // Don't fill the area under the forecast line
                            borderDash: [5, 5] // Dashed line for forecast
                        }
                    ]
                },
                options: {
                    responsive: true, // Make chart responsive
                    maintainAspectRatio: true, // Maintain aspect ratio
                    scales: {
                        x: {
                            type: 'category',
                            title: {
                                display: true,
                                text: 'Date'
                            },
                            ticks: {
                                autoSkip: true, // Prevent overcrowding on x-axis
                                maxTicksLimit: 10 // Limit number of ticks
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Sales'
                            }
                        }
                    }
                }
            });
        }

        // Fetch data when the page loads
        fetchData();
    </script>


    <script src="../pages/script/dashboard.js"></script>

    <!-- Bar CHART SCRIPT -->
    <script src="../pages/script/barchart.js"></script>

    <!-- Line CHART SCRIPT -->
    <script src="../pages/script/linechart.js"></script>

</body>

</html>