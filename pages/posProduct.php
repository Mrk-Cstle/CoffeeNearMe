<?php include '../assets/template/navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="posProduct.css">
</head>
<body>
    <div class="pos-container">
        <!-- Product Grid with Search and Category Buttons -->
        <div class="product-grid-container">
            <div class="header-pos">
                <input type="text" placeholder="Search all product here...">
                <button class="possearch-btn">Search</button>
                <div class="categories">
                    <select id="categoryDropdown" class="category-select">
                        <option value="all" selected>All</option>
                        <option value="iced-coffee">Iced Coffee</option>
                        <option value="milktea">Milktea</option>
                        <option value="espresso">Espresso</option>
                        <option value="fruity">Fruity</option>
                        <option value="cake">Cake</option>
                        <option value="hot-coffee">Hot Coffee</option>
                    </select>
                </div>
            </div>

            <div class="product-grid">
                <div class="product" data-category="iced-coffee">
                    <img src="../assets/images/latte.png" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
                
                <div class="product" data-category="milktea">
                    <img src="../assets/images/matcha.jpg" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>

                <div class="product" data-category="espresso">
                    <img src="../assets/images/latte.png" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>

                <div class="product" data-category="fruity">
                    <img src="../assets/images/fruity.jpg" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>

                <div class="product" data-category="cake">
                    <img src="../assets/images/cake.jpg" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>

                <div class="product" data-category="hot-coffee">
                    <img src="../assets/images/hot.jpg" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>

                <div class="product" data-category="iced-coffee">
                    <img src="../assets/images/frappe.jpg" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>

                <div class="product" data-category="milktea">
                    <img src="../assets/images/latte.png" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
                
                <div class="product" data-category="milktea">
                    <img src="../assets/images/latte.png" alt="Latte">
                    <h3>Latte</h3>
                    <p>₱30.00</p>
                    <div class="quantity-control">
                        <button class="minus-btn">-</button>
                        <input type="text" value="1" class="quantity" readonly>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>

            </div>
        </div>
        
        <!-- Order Details Sidebar -->
        <div class="order-summary">
            <h2>Order Details</h2>
            <ul id="order-list">
                <!-- Orders will be added here dynamically -->
            </ul>
            <div class="totals">
                <p>Subtotal: <span id="subtotal">₱0.00</span></p>
                <h3>Total: <span id="total">₱0.00</span></h3>
                <button class="pay-now">Pay Now</button>
            </div>
        </div>
    </div>

    <script>
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
                        <button class="delete-btn">🗑️</button> <!-- Trash icon as button -->
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
    </script>
</body>
</html>
