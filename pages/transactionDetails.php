<?php include '../assets/template/navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Table</title>
    <link rel="stylesheet" href="../assets/design/transactionDetails.css">
    <style>

    </style>
</head>
<body>
    <div class="container">
        <h2>Transaction Details</h2>
        <div class="transaction">
            <table class="transaction-table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>User</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>

                    <tr>
                        <td>55</td>
                        <td>Ron De Guzman</td>
                        <td>₱500</td>
                        <td>2024-09-26</td>
                        <td><button id="btn-view" onclick="openModal()">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&raquo;</a>
        </div>
       <!-- Modal Structure -->
<div id="receiptModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Coffee Near Me</h2>
        <p><strong>Transaction:</strong> 2</p>
        <p><strong>Date:</strong> 2024-02-10</p>
        <p><strong>Cashier:</strong> MDC</p>

        <div class="receipt-table-container"> <!-- Scrollable container -->
            <table class="receipt-table">
                <thead class="thead-receipt">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody class="tbody-receipt">
                    <tr>
                        <td>Spanish Latte</td>
                        <td>5</td>
                        <td>₱500</td>
                    </tr>
                    <tr>
                        <td>Spanish Latte</td>
                        <td>5</td>
                        <td>₱500</td>
                    </tr>
                    <tr>
                        <td>Spanish Latte</td>
                        <td>5</td>
                        <td>₱500</td>
                    </tr>
                    <tr>
                        <td>Spanish Latte</td>
                        <td>5</td>
                        <td>₱500</td>
                    </tr>
                    <tr>
                        <td>Spanish Latte</td>
                        <td>5</td>
                        <td>₱500</td>
                    </tr>
                    <tr>
                        <td>Spanish Latte</td>
                        <td>5</td>
                        <td>₱500</td>
                    </tr>
                </tbody>
            </table>
            
            
        </div>
        <div class="total">
            <p>Total</p>
            <p>₱1500</p>
        </div>
    </div>
</div>
    </div>

    <script>
        function openModal() {
            document.getElementById("receiptModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("receiptModal").style.display = "none";
        }

        // Close the modal when the user clicks anywhere outside of it
        window.onclick = function(event) {
            const modal = document.getElementById("receiptModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
