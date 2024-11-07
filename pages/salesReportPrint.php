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
</head>

<body>

  <div class="container">
    <h1>DAILY SALES REPORT</h1>
    <div class="header">
      <!-- Left Section -->
      <div class="left-section">
        <div class="left-row">
          <div>
            <!-- <strong>USER</strong><br>
            <input type="text" value="Robert Smith" readonly> -->
          </div>
          <div>
            <strong>DATE</strong><br>
            <input id="dateInput" type="text" readonly>
          </div>
        </div>
      </div>
      <div class="no-print">
        <button onclick="window.print()">Print Report</button>
      </div>
      <!-- Right Section -->
      <!-- <div class="right-section">
        <div>
          <strong>SALES AMOUNT</strong><br>
          <span>$3,750.00</span>
        </div>
        <div>
          <strong>SALES TAX</strong><br>
          <span>$277.50</span>
        </div>
        <div>
          <strong>SALES TOTAL</strong><br>
          <span>$4,027.50</span>
        </div>
      </div> -->
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>

            <th>PRODUCT NAME</th>

            <th>PRICE</th>
            <th>QTY</th>
            <th>AMOUNT</th>


          </tr>
        </thead>
        <tbody>
          <!-- <tr>

            <td>ITEM A</td>

            <td>$10.00</td>
            <td>20</td>
            <td>$200.00</td>


          </tr>
          <tr>

            <td>ITEM B</td>

            <td>$20.00</td>
            <td>10</td>
            <td>$200.00</td>


          </tr> -->
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>

    <div class="total-box">
      <div><strong>TOTAL</strong></div>
      <div id="grandTotal"></div>
    </div>


  </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {


    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0]; // Format as YYYY-MM-DD
    $('#dateInput').val(formattedDate);

    // Fetch and display today's sales data



    function fetchDailySales() {
      const date = $('#dateInput').val(); // Get the date from the input

      $.ajax({
        url: 'action/report_db.php', // Ensure this is the correct path to your PHP file
        type: 'POST',
        data: {
          date: date // Pass the date if needed; otherwise, remove this if the current date should be used
        },
        dataType: 'json',
        success: function(data) {
          let tableBody = $('table tbody');
          tableBody.empty(); // Clear any existing rows

          let grandTotal = 0;

          data.forEach(item => {
            const amount = parseFloat(item.total_sales_today).toFixed(2); // Calculate item sales amount
            grandTotal += parseFloat(amount); // Accumulate the grand total

            // Append a new row for each item
            tableBody.append(`
                <tr>
                    <td>${item.product_name}</td>
                    <td>$${parseFloat(item.price).toFixed(2)}</td>
                    <td>${item.total_qty_sold_today}</td>
                    <td>$${amount}</td>
                </tr>
            `);
          });

          // Update the grand total display
          $('#grandTotal').text('₱' + grandTotal.toFixed(2));
        },
        error: function(err) {
          console.error('Error fetching data:', err);
        }
      });

    }

    fetchDailySales();

  })
</script>

</html>