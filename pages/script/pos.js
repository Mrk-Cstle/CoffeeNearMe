$(document).ready(function () {
       $('#categoryDropdown').change(function () {
       
       
            loadProduct();
      });

      //for search
      $('#searchInput').keyup(function () {
        
        
            loadProduct();
      });

function loadProduct() {
      var categoryFilter = $('#categoryDropdown').val();
        var searchQuery = $('#searchInput').val();
         
         var data = {
          
             action: 'reload',
             categoryFilter: categoryFilter,
             searchQuery: searchQuery

          
          
      };
    $.ajax({
        type: 'POST',
        url: 'action/pos_db.php',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            if (response.status === 'success') {
                var product = response.product;
                var listItems = '';

                product.forEach(function(product) {
                    let pictureHtml = '';
                    if (product.picture) {
                        pictureHtml = `<img style="width: 150px; height: 150px; object-fit: cover;" class="product-img" src="uploads/product/${product.picture}" data-product-img="${product.picture}">`;
                    } else {
                        pictureHtml = `<img style="width: 150px; height: 150px; object-fit: cover;" class="product-img" src="uploads/product/default.png" data-product-img="default.png">`;
                    }

                    // Check if product is available
                    let isAvailable = product.available_quantity > 0;
                    let productClass = isAvailable ? '' : 'not-available';

                    listItems += `
                        <div class="product ${productClass}" data-product-id="${product.product_id}" data-available-quantity="${product.available_quantity}">
                            ${pictureHtml}
                            <h3 class="${isAvailable ? '' : 'text-danger'}">${product.product_name}</h3>
                            <p>₱${product.price}</p>
                            <div class="quantity-control">
                                <button class="minus-btn">-</button>
                                <input type="text" value="1" class="quantity" readonly>
                                <button class="plus-btn">+</button>
                            </div>
                            <p>Available: ${product.available_quantity}</p>
                            <button 
                            class="add-to-cart-btn" 
                            ${isAvailable ? '' : 'style="cursor: not-allowed; opacity: 0.5; background-color: #ccc; border-color: #ccc; color: #666;"'}
                            ${isAvailable ? '' : 'disabled'}
                            > 
                            Add to Cart 
                            </button>
                        </div>
                    `;
                });
                
                $('.product-grid').html(listItems);

                // Attach event listeners for quantity control
                attachQuantityControl();
              
              console.error('loading categories: ' + response.message);
              

            } else {
              console.error('Error loading categories: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error loading categories:', status, error);
            console.log('XHR object:', xhr); // Log the entire XHR object for more details
            if (xhr.responseText) {
              console.log('Response text:', xhr.responseText); // Log the response text if available
            }
            // Handle any additional error details as needed
          }
        });
    }
    

function attachQuantityControl() {
    $('.product').each(function() {
        let availableQuantity = parseInt($(this).data('available-quantity'));
        let $minusBtn = $(this).find('.minus-btn');
        let $plusBtn = $(this).find('.plus-btn');
        let $quantityInput = $(this).find('.quantity');

        // Increase quantity with plus button
        $plusBtn.on('click', function() {
            let currentQuantity = parseInt($quantityInput.val());
           
            if (currentQuantity  >= availableQuantity) {
                $plusBtn.prop('disabled', true); // Disable plus button if limit reached
                
            }
            $minusBtn.prop('disabled', false); // Re-enable minus button
        });

        // Decrease quantity with minus button
        $minusBtn.on('click', function() {
            let currentQuantity = parseInt($quantityInput.val());
            if (currentQuantity > 1) {
                $quantityInput.val(currentQuantity - 1);
            }
            if (currentQuantity - 1 <= 1) {
                $minusBtn.prop('disabled', true); // Disable minus button if minimum is reached
            }
            $plusBtn.prop('disabled', false); // Re-enable plus button
        });

        // Initially disable minus button
        $minusBtn.prop('disabled', true);

        
    });
}
  loadProduct();
  
   
    

     $('.product-grid').on('click', '.add-to-cart-btn', function () {
        const productElement = $(this).closest('.product');
        const productId = productElement.data('product-id');
        const productName = productElement.find('h3').text();
        const productPrice = parseFloat(productElement.find('p').text().replace('₱', ''));
        const quantity = parseInt(productElement.find('.quantity').val());

        let $productDiv = $(this).closest('.product');
        let availableQuantity = parseInt($productDiv.data('available-quantity'));
        let selectedQuantity = parseInt($productDiv.find('.quantity').val());

        if (selectedQuantity <= availableQuantity) {
            // Update the available stock on the server side
            $.ajax({
                type: 'POST',
                url: 'action/cart_handler.php',
                data: {
                    action: 'add',
                    product_id: productId,
                    product_name: productName,
                    product_price: productPrice,
                    quantity: selectedQuantity
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.status === 'success') {
                        updateCartDisplay(data.cart);

                        // Update the available stock on the page
                        let newAvailableQuantity = availableQuantity - selectedQuantity;
                        $productDiv.data('available-quantity', newAvailableQuantity);
                        $productDiv.find('.available-stock').text('Available: ' + newAvailableQuantity);

                        if (newAvailableQuantity <= 0) {
                            $productDiv.find('.add-to-cart-btn').prop('disabled', true).css({
                                'cursor': 'not-allowed',
                                'opacity': '0.5',
                                'background-color': '#ccc',
                                'border-color': '#ccc',
                                'color': '#666'
                            });
                        }
                    } else {
                        alert('Failed to add to cart.');
                    }
                }
            });
        } else {
            alert('Not enough stock available.');
        }
    });

// $('.product').each(function() {
//         let availableQuantity = parseInt($(this).data('available-quantity'));
//         if (availableQuantity <= 0) {
//             $(this).find('.add-to-cart-btn').prop('disabled', true).css({
//                 'cursor': 'not-allowed',
//                 'opacity': '0.5',
//                 'background-color': '#ccc',
//                 'border-color': '#ccc',
//                 'color': '#666'
//             });
//         }
//     });
    // Function to fetch and display the cart
    function fetchCart() {
        $.ajax({
            type: 'POST',
            url: 'action/cart_handler.php',
            data: {
                action: 'fetch'
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    updateCartDisplay(data.cart);
                }
            }
        });
    }
   $(document).on('click', '.delete-btn', function () {
    const productId = $(this).data('index');

    // Send request to remove the item from the cart
    $.ajax({
        type: 'POST',
        url: 'action/cart_handler.php',
        data: {
            action: 'remove',
            product_id: productId
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                updateCartDisplay(data.cart); // Refresh the cart after deletion
            } else {
                alert('Error removing item: ' + data.message);
            }
        }
    });
});

    // Function to update the cart display
    function updateCartDisplay(cart) {
        let listItems = '';
        let subtotal = 0;

        // Iterate over cart items
        cart.forEach(function (item) {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            listItems += `
                <li>
                    ${item.name} x ${item.quantity} - ₱${itemTotal.toFixed(2)}
                     <button class="delete-btn" data-index="${item.id}">Delete</button>
                </li>
            `;
        });

        // Update the order list and totals in the HTML
        $('#order-list').html(listItems);
        $('#subtotal').text(`₱${subtotal.toFixed(2)}`);
        $('#total').text(`₱${subtotal.toFixed(2)}`);
    }

    // Quantity control buttons (optional)
    $('.product-grid').on('click', '.plus-btn', function () {
        let input = $(this).siblings('.quantity');
        input.val(parseInt(input.val()) + 1);
    });

    $('.product-grid').on('click', '.minus-btn', function () {
        let input = $(this).siblings('.quantity');
        let currentVal = parseInt(input.val());
        if (currentVal > 1) {
            input.val(currentVal - 1);
        }
    });

    // Fetch the cart when the page loads
    fetchCart();


    $('.pay-now').on('click', function () {
        var data = {
          
             action: 'pay' 
      };
        $.ajax({
            type: 'POST',
            url: 'action/pos_db.php',
            data: JSON.stringify(data),
            success: function(response) {
                // const data = JSON.parse(response);
                console.log(response.message)
                if (response.status === 'success') {
                    alert(response.message);
                    // Clear the cart display
                    loadProduct();
                    $('#order-list').html('');
                    $('#subtotal').text('₱0.00');
                    $('#total').text('₱0.00');
                } else {
                     alert(response.message);
                    alert(response.message.join(',\n')); // Display any errors
                }
            }
        });
    });
})