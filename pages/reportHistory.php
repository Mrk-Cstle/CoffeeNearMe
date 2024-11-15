<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Base Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-top: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .left-section,
        .right-section {
            display: flex;
            flex-direction: column;
        }

        .left-row {
            display: flex;
            gap: 20px;
            margin-top: 40px;
        }

        .left-section div,
        .right-section div {
            margin-bottom: 10px;
        }

        .left-section input,
        .right-section div {
            font-size: 1rem;
        }

        .left-section input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .right-section div {
            text-align: right;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .total-box {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .total-box div {
            text-align: right;
            font-size: 18px;
            margin-right: 20px;
        }

        /* Print Styles */
        @media print {
            body {
                width: 100%;
            }

            .container {
                width: 100%;
                max-width: 100%;
                margin: 0;
            }

            .table-container {
                overflow: visible;
            }

            .no-print {
                display: none;
            }

            @page {
                margin: 30px;
            }

            body {
                -webkit-print-color-adjust: exact;
                /* Ensures colors are printed correctly */
            }

            /* Hide header and footer added by the browser */
            footer,
            header {
                display: none !important;
            }

        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>

    <div class="container">
        <h1>DAILY SALES REPORT</h1>
        <div class="header">
            <!-- Left Section -->
            <div class="left-section">
                <div class="left-row">
                    <div>
                        <strong>DATE</strong><br>
                        <input type="text" id="dateRangePicker" placeholder="Select Date Range" />
                    </div>
                </div>
            </div>
            <div class="no-print">
                <button onclick="window.print()">Print Report</button>
            </div>
        </div>

        <!-- Sales Table -->
        <div class="table-container">
            <h2>Sales Transactions</h2>
            <table id="productTable">
                <thead>
                    <tr>
                        <th>PRODUCT NAME</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>AMOUNT</th>
                        <th>COST</th>
                        <th>MARGIN</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sales data will be appended here -->
                </tbody>
            </table>
        </div>

        <div class="total-box">
            <div><strong>TOTAL SALES</strong></div>
            <div id="grandTotalSales"></div>
        </div>
        <div class="total-box">
            <div><strong>TOTAL COST</strong></div>
            <div id="grandTotalCost"></div>
        </div>
        <div class="total-box">
            <div><strong>GRAND TOTAL</strong></div>
            <div id="grandTotalMargin"></div>
        </div>

        <!-- Expenses Table -->
        <div class="table-container">
            <h2>Expenses</h2>
            <table id="expensesTable">
                <thead>
                    <tr>
                        <th>EXPENSE</th>
                        <th>CATEGORY</th>
                        <th>AMOUNT</th>
                        <th>DATE</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Expenses data will be appended here -->
                </tbody>
            </table>
        </div>

        <div class="total-box">
            <div><strong>TOTAL EXPENSES</strong></div>
            <div id="grandTotalExpenses"></div>
        </div>

    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        flatpickr("#dateRangePicker", {
            mode: "range",
            dateFormat: "Y-m-d", // Ensure this matches the format in your database
            onChange: function(selectedDates, dateStr) {
                // Check if two dates are selected (start and end)
                if (selectedDates.length === 2) {
                    fetchDailySalesAndExpenses(); // Trigger AJAX reload
                }
            }
        });

        function fetchDailySalesAndExpenses() {
            // Fetch the selected date range from the dateRangePicker
            var dateRange = $('#dateRangePicker').val(); // Date range in "YYYY-MM-DD to YYYY-MM-DD"

            var startDate = '';
            var endDate = '';

            if (dateRange) {
                var dates = dateRange.split(" to ");
                startDate = dates[0];
                endDate = dates.length > 1 ? dates[1] : startDate; // If no end date, set end date equal to start date
            }

            // Make AJAX request with the selected date range
            $.ajax({
                url: 'action/salesreport_db.php',
                type: 'POST',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                },
                dataType: 'json',
                success: function(data) {
                    let productTableBody = $('#productTable tbody');
                    let expensesTableBody = $('#expensesTable tbody');
                    productTableBody.empty(); // Clear existing rows in product table
                    expensesTableBody.empty(); // Clear existing rows in expenses table

                    let grandTotalSales = 0;
                    let grandTotalExpenses = 0;
                    let grandTotalCost = 0; // Initialize grandTotalCost
                    let grandTotalMargin = 0; // Initialize grandTotalMargin

                    // Display product sales data
                    data.products.forEach(item => {
                        const amount = parseFloat(item.total_sales_between).toFixed(2); // Total sales for the product
                        grandTotalSales += parseFloat(amount); // Accumulate total sales

                        const cost = parseFloat(item.total_cost_between).toFixed(2); // Total cost for the product
                        grandTotalCost += parseFloat(cost); // Accumulate total cost

                        const margin = amount - cost; // Calculate margin for this product
                        grandTotalMargin += margin; // Accumulate margin for all products

                        // Append a new row for each product item
                        productTableBody.append(`
            <tr>
                <td>${item.product_name}</td>
                <td>₱${parseFloat(item.price).toFixed(2)}</td>
                <td>${item.total_qty_sold_between}</td>
                <td>₱${amount}</td>
                <td>₱${item.total_cost_between}</td>
                <td>₱${margin.toFixed(2)}</td> <!-- Show margin with 2 decimal places -->
            </tr>
        `);
                    });

                    // Display expenses data
                    data.expenses.forEach(expense => {
                        const amount = parseFloat(expense.amount).toFixed(2); // Format expense amount
                        grandTotalExpenses += parseFloat(amount); // Accumulate the grand total for expenses

                        // Append a new row for each expense item
                        expensesTableBody.append(`
            <tr>
                <td>${expense.expenses_id}</td>
                <td>${expense.category}</td>
                <td>₱${amount}</td>
                <td>${expense.payment_date}</td>
            </tr>
        `);
                    });

                    // Calculate total margin (total sales - total cost)
                    const totalMargin = grandTotalSales - grandTotalCost;

                    // Update the grand totals display
                    $('#grandTotalSales').text('₱' + grandTotalSales.toFixed(2));
                    $('#grandTotalExpenses').text('₱' + grandTotalExpenses.toFixed(2));
                    $('#grandTotalMargin').text('₱' + totalMargin.toFixed(2)); // Display total margin
                    $('#grandTotalCost').text('₱' + grandTotalCost.toFixed(2)); // Display total cost
                },
                error: function(err) {
                    console.error('Error fetching data:', err);
                }
            });
        }

        fetchDailySalesAndExpenses(); // Initial load for today's data
    });
</script>

</html>