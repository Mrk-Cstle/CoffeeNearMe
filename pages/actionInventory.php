<?php
include '../assets/template/navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Table</title>
    <link rel="stylesheet" href="../assets/design/actionInventory.css">
</head>

<body>
    <div class="container">
        <h2>Inventory Actions</h2>
        <div class="transaction">
            <table class="transaction-table">
                <thead>
                    <tr>
                        <th>Action ID</th>
                        <th>Action Type</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Action Date</th>
                        <th>Performed By</th>
                    </tr>
                </thead>

                <tbody id="tabledata">


                </tbody>
            </table>
        </div>
        <div class="pagination">
            <button id="prevPage" disabled>Previous</button>
            <span id="currentPage">1</span>
            <button id="nextPage" disabled>Next</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    itemsPerPage: itemsPerPage
                };
                $.ajax({
                    type: 'GET',
                    url: 'action/inventoryAction_db.php', // Replace with correct path to fetch categories
                    contentType: 'application/json',
                    data: data,
                    success: function(response) {

                        if (response.status === 'success') {
                            var items = response.item;
                            var listItem = "";



                            items.forEach(function(item) {
                                listItem += `
                            <tr>
                                <td>${item.action_id}</td>
                                <td>${item.action_type}</td>
                                <td>${item.item}</td>
                                <td>${item.quantity} ${item.unit}</td>
                                <td>${item.action_date}</td>
                                <td>${item.performed_by}</td>
                            </tr>`



                            });
                            $('#tabledata').html(listItem);
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