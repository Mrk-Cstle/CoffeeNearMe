<?php include '../assets/template/navigation.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="../assets/design/posProduct.css">
</head>
<style>
    .disabled-btn {
        cursor: not-allowed;
        opacity: 0.5;
        background-color: #ccc;
        border-color: #ccc;
        color: #666;
    }

    /* Receipt Modal Styles */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        background: white;
        padding: 20px;
        max-width: 400px;
        margin: 0 auto;
        border-radius: 10px;
        text-align: center;
    }

    .receipt-details {
        margin-top: 20px;
    }

    .receipt-details ul {
        list-style: none;
        padding: 0;
    }

    .receipt-details ul li {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        margin-left: 105px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }

    .print-btn {
        display: flex;
    }

    #close-receipt {
        background-color: #D76614;
        color: #fff;
        margin-left: 130px;
    }

    #print-receipt {
        background-color: #D76614;
        color: white;
        margin-left: 10px;
    }

    /* Styling for print layout */
    @media print {

        body {
            visibility: hidden !important;
        }

        .pos-container {
            visibility: hidden !important;
        }

        .modal-content {
            width: 400px;
            font-family: monospace;
            display: block !important;
            visibility: visible !important;
        }

        .receipt-details ul li {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            margin-left: 100px;
            font-size: 1rem;
        }

        @page {
            size: auto;
            margin: .5rem 0;
        }


        #print-receipt,
        #close-receipt {
            display: none;
            /* Hide buttons during print */
        }



    }

    .discount-div button.active {
        background-color: #3085d6;
        /* Highlight color */
        color: white;
    }
</style>

<body>
    <div class="pos-container">
        <!-- Product Grid with Search and Category Buttons -->
        <div class="product-grid-container">
            <div class="header-pos">
                <input id="searchInput" type="text" placeholder="Search all product here...">

                <div class="categories">
                    <select id="categoryDropdown" class="category-select">
                        <option value="">Filter</option>
                        <?php

                        include '../pages/include/dbConnection.php';

                        // Read all rows from the database
                        $sql = "SELECT * FROM product_category";
                        $results = $conn->query($sql);

                        if (!$results) {
                            die("Invalid query: " . $conn->error);
                        }

                        // Read data for each row
                        while ($rows = $results->fetch_assoc()) {
                            echo '<option value ="' . $rows["category"] . '">' . $rows["category"] . '</option> ';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="product-grid">



            </div>
        </div>

        <!-- Order Details Sidebar -->
        <div class="order-summary">
            <h2>Order Details</h2>
            <table class="order-list-table">
                <thead class="order-heading">
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </thead>



                <tr class="ordered">

                </tr>

            </table>
            <ul id="order-list ">


                <!-- Orders will be added here dynamically -->


            </ul>
            <div class="totals">
                <input type="hidden" id="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                <div class="discount-div">
                    <button class="discount-button">Discount</button>
                    <button class="normal-button">Regular</button>
                </div>

                <div class="div-payment">
                    <p id="payment-text">Customer Payment:</p>
                    <input type="number" class="paymentAmount" id="payment-amount" placeholder="">
                </div>

                <p>Subtotal: <span id="subtotal">₱0.00</span></p>
                <p>Discounted: <span id="discount">₱0.00</span></p>
                <p>Total: <span id="total">₱0.00</span></p>
                <p>Change: <span id="change">₱0.00</span></p>

                <button class="pay-now" disabled>Pay Now</button>

            </div>
        </div>

        <!-- Receipt Modal -->
        <div id="receipt-modal" class="modal">
            <div class="modal-content">
                <h2>Coffee Near Me Receipt</h2>
                <p>Thank you for your purchase!</p>
                <div class="receipt-details">
                    <ul id="receipt-list">
                        <!-- Dynamic order items will appear here -->
                    </ul>
                    <p><strong>Subtotal:</strong> <span id="modal-subtotal">0.00</span></p>
                    <p><strong>Discount:</strong> <span id="modal-discount">0.00</span></p>
                    <h4><strong>Total:</strong> <span id="modal-total">0.00</span></h4>
                    <p><strong>Change:</strong> <span id="modal-change">0.00</span></p>
                </div>
                <div class="print-btn">
                    <button id="close-receipt">Close</button>
                    <button id="print-receipt">Print Receipt</button>
                </div>

            </div>
        </div>

    </div>

    <script>
        // Open the receipt modal when the "Pay Now" button is clicked
        // document.querySelector('.pay-now').addEventListener('click', function() {
        //     let orderList = document.querySelector('#order-list');
        //     let receiptList = document.querySelector('#receipt-list');
        //     let subtotal = document.querySelector('#subtotal').textContent;
        //     let total = document.querySelector('#total').textContent;

        //     // Clear previous receipt items
        //     receiptList.innerHTML = '';

        //     // Add each order item to the receipt
        //     orderList.querySelectorAll('li').forEach(item => {
        //         let li = document.createElement('li');
        //         li.innerHTML = item.innerHTML.replace('Delete', ''); // Remove delete button
        //         receiptList.appendChild(li);
        //     });

        //     // Set subtotal and total for modal
        //     document.querySelector('#modal-subtotal').textContent = subtotal;
        //     document.querySelector('#modal-total').textContent = total;

        //     // Show the modal
        //     document.getElementById('receipt-modal').style.display = 'flex';
        // });

        // Close the modal
        document.getElementById('close-receipt').addEventListener('click', function() {
            document.getElementById('receipt-modal').style.display = 'none';
        });

        // Print the receipt
        document.getElementById('print-receipt').addEventListener('click', function() {
            window.print();
        });
    </script>

    <!-- <script>
        const productGrid = document.querySelector('.product-grid');
        const orderSummary = document.querySelector('.order-summary');

        // Set a maximum height for the product grid
        productGrid.style.maxHeight = 'calc(100vh - 350px)'; // Adjust this value based on header height and padding

        // Set a maximum height for the order summary
        orderSummary.style.maxHeight = 'calc(100vh - 350px)'; // Adjust this value based on content and padding

        // Handle category filtering with dropdown
        const categoryDropdown = document.getElementById('categoryDropdown');
        const products = document.querySelectorAll('.product');

        // Add to Cart Filtering
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        const orderList = document.getElementById('order-list');
        const subtotalElement = document.getElementById('subtotal');
        const totalElement = document.getElementById('total');
        let subtotal = 0;

        categoryDropdown.addEventListener('change', () => {
            const selectedCategory = categoryDropdown.value;

            products.forEach(product => {
                if (selectedCategory === 'all' || product.getAttribute('data-category') === selectedCategory) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });

        // Handle quantity control (plus and minus buttons)
        const plusButtons = document.querySelectorAll('.plus-btn');
        const minusButtons = document.querySelectorAll('.minus-btn');

        plusButtons.forEach(button => {
            button.addEventListener('click', () => {
                const quantityInput = button.previousElementSibling;
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            });
        });

        minusButtons.forEach(button => {
            button.addEventListener('click', () => {
                const quantityInput = button.nextElementSibling;
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
        });


        // Add to Cart Button
        addToCartButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const productElement = event.target.closest('.product');
                const productName = productElement.querySelector('h3').textContent;
                const productPrice = parseFloat(productElement.querySelector('p').textContent.replace('₱', ''));
                const quantity = parseInt(productElement.querySelector('.quantity').value);
                const totalPrice = productPrice * quantity;

                // Create a new list item for the order
                const orderItem = document.createElement('li');
                orderItem.classList.add('order-item'); // Add a class for easier targeting
                orderItem.innerHTML = `
                    <div class="item">
                        <span>${productName} x${quantity}</span>
                        <span>₱${totalPrice.toFixed(2)}</span>
                        <button class="delete-btn">🗑️</button> 
    </div>
    `;

    // Append the order item to the order list
    orderList.appendChild(orderItem);

    // Update the subtotal and total
    subtotal += totalPrice;
    subtotalElement.textContent = `₱${subtotal.toFixed(2)}`;
    totalElement.textContent = `₱${subtotal.toFixed(2)}`;

    // Add event listener to the delete button
    const deleteBtn = orderItem.querySelector('.delete-btn');
    deleteBtn.addEventListener('click', () => {
    // Remove item from the list
    orderItem.remove();

    // Update the subtotal and total
    subtotal -= totalPrice; // Subtract the item's total price from the subtotal
    subtotalElement.textContent = `₱${subtotal.toFixed(2)}`;
    totalElement.textContent = `₱${subtotal.toFixed(2)}`;
    });
    });
    });
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script/pos.js"></script>
</body>

</html>