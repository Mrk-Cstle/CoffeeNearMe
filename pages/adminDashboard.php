<?php include '../assets/template/navigation.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/design/adminDashboard.css">
    <title>Document</title>

</head>

<body>
    <div class="container">

        <div class="salesandInventory">
            <!--SALES OVERVIEW FORM-->
            <div class="salesOverview">
                <p id="salesHead">Sales Overview</p>

                <div class="salesBord">

                    <div class="salesOver">
                        <img src="../assets/images/salesIcon.png" class="salesImage">
                        <div class="paragraphSales">
                            <p id="salesNum">50</p>
                            <p id="salesPara">Orders</p>
                        </div>
                    </div>
                    <div class="borderRight"></div>

                    <div class="salesOver">
                        <img src="../assets/images/revenueIcon.png" class="salesImage">
                        <div class="paragraphSales">
                            <p id="salesNum">50</p>
                            <p id="salesPara">Total Sales Today</p>
                        </div>
                    </div>
                    <div class="borderRight"></div>

                    <div class="salesOver">
                        <img src="../assets/images/profitIcon.png" class="salesImage">
                        <div class="paragraphSales">
                            <p id="salesNum">50</p>
                            <p id="salesPara">Number</p>
                        </div>
                    </div>

                </div>

            </div>

            <!--INVENTORY SUMMARY FORM-->
            <div class="inventorySummary">
                <p id="inventoryHead">Inventory Summary</p>

                <div class="inventoryBord">

                    <div class="inventorySum">
                        <img src="../assets/images/in-stockIcon.png" class="inventImage">
                        <div class="paragraphInvent">
                            <p id="inventNum">50</p>
                            <p id="inventPara">Stocks</p>
                        </div>
                    </div>
                    <div class="borderRight"></div>

                    <div class="inventorySum">
                        <img src="../assets/images/lowstockIcon.png" class="inventImage">
                        <div class="paragraphInvent">
                            <p id="inventNum">50</p>
                            <p id="inventPara">Low Stocks</p>
                        </div>
                    </div>
                    <div class="borderRight"></div>

                    <div class="inventorySum">
                        <img src="../assets/images/newStocksIcon.png" class="inventImage">
                        <div class="paragraphInvent">
                            <p id="inventNum">50</p>
                            <p id="inventPara">New Stocks</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="topSellingandLowStockProduct">

            <div class="topSellingDiv">
                <h5 id="topHead">Top Selling Product</h5>
                <div class="selling">
                    <div class="heading">
                        <p id="head">Name</p>
                        <p id="head">Sold Quantity</p>
                        <p id="head">Remaining</p>
                        <p id="head">Price</p>
                    </div>
                    <div id="borderDown"></div>

                    <div class="bodySell">
                        <p id="bodyP1">Spanish Latte</p>
                        <p id="bodyP2">12</p>
                        <p id="bodyP3">5 Latte</p>
                        <p id="bodyP4">₱120</p>
                    </div>

                    <div id="borderDown"></div>

                    <div class="bodySell">
                        <p id="bodyP1">Spanish Latte</p>
                        <p id="bodyP2">12</p>
                        <p id="bodyP3">5 Latte</p>
                        <p id="bodyP4">₱120</p>
                    </div>

                    <div id="borderDown"></div>

                    <div class="bodySell">
                        <p id="bodyP1">Spanish Latte</p>
                        <p id="bodyP2">12</p>
                        <p id="bodyP3">5 Latte</p>
                        <p id="bodyP4">₱120</p>
                    </div>

                    <div id="borderDown"></div>

                    <div class="bodySell">
                        <p id="bodyP1">Spanish Latte</p>
                        <p id="bodyP2">12</p>
                        <p id="bodyP3">5 Latte</p>
                        <p id="bodyP4">₱120</p>
                    </div>
                </div>

            </div>

            <div class="lowStock">
                <div class="lowStockDiv">
                    <h5 id="lowHead">Low Stock</h5>

                    <div class="lowHeading">
                        <h5 id="lowHead">Product</h5>
                        <h5 id="lowHead">Product Name</h5>
                        <h5 id="lowHead">Quantity</h5>
                    </div>

                    <div class="lowBody">
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
                    </div>

                </div>
            </div>

        </div>

        <div class="charts">

            <!--BAR CHART -->
            <div class="barChart-container">
                <div class="chartBar-container">
                    <h3 class="barChartHeadOne">In-Demand Product</h3>
                    <div class="canvasBar-container">
                        <canvas id="myBarChart"></canvas>
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

    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Materialize library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Bar CHART SCRIPT -->
    <script src="../pages/script/barchart.js"></script>

    <!-- Line CHART SCRIPT -->
    <script src="../pages/script/linechart.js"></script>

</body>

</html>