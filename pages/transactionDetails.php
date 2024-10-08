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

                <tbody id="table-data">

                </tbody>
            </table>
        </div>
        <div class="pagination">
            <button id="prevPage" disabled>Previous</button>
            <span id="currentPage">1</span>
            <button id="nextPage" disabled>Next</button>
        </div>
        
        <!-- Modal Structure -->
        <div id="receiptModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="transactionheader">
                    <!-- <h2>Coffee Near Me</h2>
                    <p><strong>Transaction:</strong> 2</p>
                    <p><strong>Date:</strong> 2024-02-10</p>
                    <p><strong>Cashier:</strong> MDC</p> -->
                </div>


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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function openModal(button, transaction_id) {
            document.getElementById("receiptModal").style.display = "block";
            var $row = $(button).closest('tr');
            var usertd = $row.find('.usertd').text().trim();
            var totaltd = $row.find('.totaltd').text().trim();
            var timetd = $row.find('.timetd').text().trim();


            $.ajax({
                type: 'GET',
                url: 'action/transaction_db.php',
                data: {
                    transaction_id: transaction_id,
                    action: 'transaction_item'

                },
                success: function(response) {
                    if (response.status === 'success') {
                        var transaction = response.transaction;


                        var totalcontent = '';
                        var headercontent = '';
                        var receiptContent = '';

                        headercontent += `
                            
                            <h2>Coffee Near Me</h2>
                            <p><strong>Transaction:</strong> ${transaction_id}</p>
                            <p><strong>Date:</strong> ${timetd}</p>
                            <p><strong>Cashier:</strong> ${usertd}</p>`
                        totalcontent += `
                            <p>Total</p>
                            <p>₱${totaltd}</p>
                            `
                        transaction.forEach(function(item) {




                            receiptContent += `
                    <tr>
                        <td>${item.product_name}</td>
                        <td>${item.quantity}</td>
                        <td>₱${item.price}</td>
                    </tr>`;



                        });
                        $('.tbody-receipt').html(receiptContent);

                        $('.transactionheader').html(headercontent);
                        $('.total').html(totalcontent);




                    } else {
                        console.log(response.message);
                    }
                },
                error: function() {
                    console.log('Error fetching transaction details.');
                }
            });

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

    <script>
        $(document).ready(function() {


            var urlParams = new URLSearchParams(window.location.search);
            var currentPage = urlParams.has('page') ? parseInt(urlParams.get('page')) : 1;
            var totalPages = 1;
            $('#prevPage').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    updateUrl();
                    loads();
                }
            });

            $('#nextPage').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateUrl();
                    loads();
                }
            });

            function loads() {
                var itemsPerPage = 10;
                var data = {
                    page: currentPage,
                    itemsPerPage: itemsPerPage,
                    action: 'reload'

                };
                $.ajax({
                    type: 'GET',
                    url: 'action/transaction_db.php', // Replace with correct path to fetch categories
                    contentType: 'application/json',
                    data: data,
                    success: function(response) {

                        if (response.status === 'success') {
                            var items = response.item;
                            var listItem = "";



                            items.forEach(function(item) {
                                listItem += `
                            <tr>
                                <td >${item.transaction_id}</td>
                                <td class ="usertd">${item.user}</td>
                                <td class ="totaltd">${item.total_amount}</td>
                                <td class = "timetd">${item.timestamp}</td>
                               
                                <td><button id="btn-view" onclick="openModal(this,${item.transaction_id})">View</button></td>
                            </tr>`



                            });
                            $('#table-data').html(listItem);
                            totalPages = response.totalPages;
                            $('#currentPage').text(currentPage);

                            // Enable/disable pagination buttons
                            $('#prevPage').prop('disabled', currentPage === 1);
                            $('#nextPage').prop('disabled', currentPage === totalPages);



                        } else {
                            console.log(response.message)
                        }
                    },
                    error: function(xhr, status, error) {

                    }
                });
            }

            function updateUrl() {


                var newUrl = window.location.pathname + '?page=' + currentPage;



                window.history.replaceState({
                    path: newUrl
                }, '', newUrl);
            }
            loads();
        });
    </script>
</body>

</html>