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

    .left-section, .right-section {
      display: flex;
      flex-direction: column;
    }

    .left-row {
      display: flex;
      gap: 20px;
      margin-top: 40px;
    }

    .left-section div, .right-section div {
      margin-bottom: 10px;
    }

    .left-section input, .right-section div {
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

    th, td {
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
        -webkit-print-color-adjust: exact; /* Ensures colors are printed correctly */
      }

      /* Hide header and footer added by the browser */
      footer, header {
        display: none !important;
      }

    }
  </style>
</head>
<body>

  <div class="container">
    <h1>BASIC DAILY SALES REPORT TEMPLATE</h1>
    <div class="header">
      <!-- Left Section -->
      <div class="left-section">
        <div class="left-row">
          <div>
            <strong>SALES PERSON</strong><br>
            <input type="text" value="Robert Smith" readonly>
          </div>
          <div>
            <strong>DATE</strong><br>
            <input type="text" value="05/11/2024" readonly>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="right-section">
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
      </div>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>ITEM NO</th>
            <th>ITEM NAME</th>
            <th>ITEM DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>AMOUNT</th>
            <th>TAX RATE</th>
            <th>TAX</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>A123</td>
            <td>ITEM A</td>
            <td>Item A description</td>
            <td>$10.00</td>
            <td>20</td>
            <td>$200.00</td>
            <td>15%</td>
            <td>$30.00</td>
            <td>$230.00</td>
          </tr>
          <tr>
            <td>B123</td>
            <td>ITEM B</td>
            <td>Item B description</td>
            <td>$20.00</td>
            <td>10</td>
            <td>$200.00</td>
            <td>15%</td>
            <td>$30.00</td>
            <td>$230.00</td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>

    <div class="total-box">
      <div><strong>GRAND TOTAL</strong></div>
      <div>$4,027.50</div>
    </div>

    <div class="no-print">
      <button onclick="window.print()">Print Report</button>
    </div>
  </div>

</body>
</html>
