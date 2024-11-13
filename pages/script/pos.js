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
                        pictureHtml = `<img style="width: 75px; height: 75px; object-fit: cover;" class="product-img" src="uploads/product/${product.picture}" data-product-img="${product.picture}">`;
                    } else {
                        pictureHtml = `<img style="width: 75px; height: 75px; object-fit: cover;" class="product-img" src="uploads/product/default.png" data-product-img="default.png">`;
                    }

                    // Check if product is available
                    let isAvailable = product.available_quantity > 0 && product.available_quantity !== 9223372036854776000;
                    let productClass = isAvailable ? '' : 'not-available';
                    let availableText = isAvailable ? product.available_quantity : 0;

                    listItems += `
                        <div class="product ${productClass}" data-product-id="${product.product_id}" data-available-quantity="${product.available_quantity}">
                            ${pictureHtml}
                            <h3 class="${isAvailable ? '' : 'text-danger'}">${product.product_name}</h3>
                            <p>₱${Number(product.price).toLocaleString()}</p>
                            <div class="quantity-control">
                                <button class="minus-btn">-</button>
                                <input type="text" value="1" class="quantity" readonly>
                                <button class="plus-btn">+</button>
                            </div>
                            <p>Available: ${availableText}</p>
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
              
              console.log('loading categories: ' + response.message);
              

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
                success: function (response) {
                   console.log(response.message);
                    const data = JSON.parse(response);
                    console.log(data.message);
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
                        loadProduct();
                    } else {
                        alert(data.message);
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
       const quantity = $(this).data('quantity');
        
   
    // Send request to remove the item from the cart
    $.ajax({
        type: 'POST',
        url: 'action/cart_handler.php',
        data: {
            action: 'remove',
            quantity:  quantity,
            product_id: productId
        },
        success: function (response) {
         console.log(response)
            const data = JSON.parse(response);
            console.log(data.message)
            if (data.status === 'success') {
                updateCartDisplay(data.cart); // Refresh the cart after deletion
                console.log(data.message)
                loadProduct();
            } else {
                console.log(response.message)
                alert('Error removing item: ' + data.message);
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
});

let isDiscounted = false; // Set default discount state
// Check localStorage for stored discount state
if (localStorage.getItem('isDiscounted') === 'true') {
    isDiscounted = true; // Apply discount if stored as true
    $('.discount-button').addClass('active'); // Highlight the discount button
    $('.normal-button').removeClass('active'); // Unhighlight the regular button
} else if (localStorage.getItem('isDiscounted') === 'false') {
    isDiscounted = false; // No discount if stored as false
    $('.normal-button').addClass('active'); // Highlight the regular button
    $('.discount-button').removeClass('active'); // Unhighlight the discount button
}

// Attach click handler to the "Discount" button
$('.discount-button').on('click', function () {
    isDiscounted = true; // Enable discount
    $(this).addClass('active'); // Highlight the discount button
    $('.normal-button').removeClass('active'); // Unhighlight the regular button

    // Store the discount state in localStorage
    localStorage.setItem('isDiscounted', 'true');

    // Recalculate the cart with discount
    fetchCart(); // Ensure this triggers cart recalculation
});

// Attach click handler to the "Regular" button
$('.normal-button').on('click', function () {
    isDiscounted = false; // Disable discount
    $(this).addClass('active'); // Highlight the regular button
    $('.discount-button').removeClass('active'); // Unhighlight the discount button

    // Store the discount state in localStorage
    localStorage.setItem('isDiscounted', 'false');

    // Recalculate the cart without discount
    fetchCart(); // Ensure this triggers cart recalculation
});

// Function to update the cart display
function updateCartDisplay(cart) {
    let tableRows = '';
    let subtotal = 0;
    let totalDiscount = 0;

    // Iterate over cart items
    cart.forEach(function (item) {
        let itemTotal = 0;
        let itemPrice = item.price;
        let discountedPrice = item.price * 0.9; // 10% discount for the first 2 items

        // Apply discount only on the first 2 items of the quantity
        if (isDiscounted) {
            let discountQuantity = Math.min(item.quantity, 2); // Discount the first 2 items
            let normalQuantity = item.quantity - discountQuantity;
            itemTotal = (discountedPrice * discountQuantity) + (itemPrice * normalQuantity); // Calculate total for the item
            totalDiscount += (itemPrice - discountedPrice) * discountQuantity; // Calculate total discount
        } else {
            itemTotal = itemPrice * item.quantity; // Regular price if no discount
        }

        subtotal += itemTotal; // Add item total to the subtotal

        // Build the table rows for the cart display
        tableRows += `
            <tr class="ordered">
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>₱${Number(itemTotal.toFixed(2)).toLocaleString()}</td>
                <td>
                    <button class="delete-btn" data-quantity="${item.quantity}" data-index="${item.id}">
                        <img src="../assets/images/delete.png" class="deleteIcon">
                    </button>
                </td>
            </tr>
        `;
    });

    // Update the table with cart rows
    $('.order-list-table tbody').html(tableRows);

    // Update the totals in the HTML
    $('#subtotal').text(`₱${subtotal.toFixed(2)}`);
    $('#discount').text(`₱${totalDiscount.toFixed(2)}`);
    $('#total').text(`₱${(subtotal - totalDiscount).toFixed(2)}`);

    // Call to update the change when payment is entered
    updateChange();
}

// Function to update the change based on payment input
function updateChange() {
    const paymentAmount = parseFloat($('#payment-amount').val()) || 0;
    const totalAmount = parseFloat($('#total').text().replace('₱', '').replace(',', '')) || 0;
    const change = paymentAmount - totalAmount;

    // Display the change
    $('#change').text(`₱${change.toFixed(2)}`);
}




// Attach an event listener to the payment amount field to recalculate change
$('#payment-amount').on('input', function () {
    updateChange();
    togglePayNowButton();
});

     function togglePayNowButton() {
        const totalAmount = parseFloat($('#total').text().replace('₱', '').replace(',', ''));
        const paymentAmount = parseFloat($('#payment-amount').val()) || 0;

        if (paymentAmount < totalAmount) {
            $('.pay-now').prop('disabled', true);  // Disable the button
        } else {
            $('.pay-now').prop('disabled', false); // Enable the button
        }
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
    const totalAmount = $('#total').text().replace('₱', '');

    // SweetAlert confirmation before proceeding
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to complete the payment. Total: ₱" + totalAmount,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, pay now!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, proceed with the AJAX request
            $.ajax({
                type: 'POST',
                url: 'action/cart_handler.php',
                data: {
                    action: 'pay',
                    total: totalAmount
                },
                success: function(response) {
                    const data = JSON.parse(response);

                    if (data.status === 'success') {
                        // SweetAlert for successful payment
                        Swal.fire({
                            title: 'Payment Successful!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        // Receipt modal
                        let receiptList = document.querySelector('#receipt-list');
                        let subtotal = document.querySelector('#subtotal').textContent;
                        let total = document.querySelector('#total').textContent;
                        let discount = document.querySelector('#discount').textContent;
                        let change = document.querySelector('#change').textContent;

                        // Clear previous receipt items
                        receiptList.innerHTML = '';

                        // Append each item to the receipt
                        data.items.forEach(item => {
                            let li = document.createElement('li');
                            li.innerHTML = `${item.name} - ${item.quantity} x ₱${item.price} `;
                            receiptList.appendChild(li);
                        });

                        // Set subtotal and total for modal
                        document.querySelector('#modal-subtotal').textContent = subtotal;
                        document.querySelector('#modal-total').textContent = total;
                        document.querySelector('#modal-discount').textContent = discount;
                        document.querySelector('#modal-change').textContent = change;

                        // Show the modal
                        document.getElementById('receipt-modal').style.display = 'flex';

                        // Clear cart display
                        loadProduct();
                        $('.order-list-table tbody').html('');
                        $('#subtotal').text('₱0.00');
                        $('#total').text('₱0.00');
                        $('#discount').text('₱0.00');
                        $('#change').text('₱0.00');
                    } else {
                        // SweetAlert for error handling
                        Swal.fire({
                            title: 'Payment Failed!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        }
    });
});

    // $('.pay-now').on('click', function () {
    //     var data = {
          
    //          action: 'pay' 
    //   };
    //     $.ajax({
    //         type: 'POST',
    //         url: 'action/pos_db.php',
    //         data: JSON.stringify(data),
    //         success: function(response) {
    //             // const data = JSON.parse(response);
    //             console.log(response.message)
    //             if (response.status === 'success') {
    //                 alert(response.message);
    //                 // Clear the cart display
    //                 loadProduct();
    //                 $('#order-list').html('');
    //                 $('#subtotal').text('₱0.00');
    //                 $('#total').text('₱0.00');
    //             } else {
    //                  alert(response.message);
    //                 alert(response.message.join(',\n')); // Display any errors
    //             }
    //         }
    //     });
    // });
})