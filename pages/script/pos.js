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
          url: 'action/pos_db.php', // Replace with correct path to fetch categories
          contentType: 'application/json',
          data: JSON.stringify(data),
          success: function(response) {

            if (response.status === 'success') {
              var product = response.product;
              var listItems = '';

              product.forEach(function(product) {
               
                 let pictureHtml = '';
                                if (product.picture) {
                                    pictureHtml = `<img style="width: 150px; height: 150px;object-fit: cover;" class="product-img" src="uploads/product/${product.picture}"data-product-img="${product.picture}">`;
                                } else {
                                    pictureHtml = `<img style="width: 150px; height: 150px;object-fit: cover;" class="product-img" src="uploads/product/default.png"data-product-img="default.png">`; // or provide alternative HTML
                                }
                listItems += `
                            
                                  <div class="product" data-product-id="${product.product_id}">
                            ${pictureHtml}
                            <h3>${product.product_name}</h3>
                            <p>₱${product.price}</p>
                            <div class="quantity-control">
                                <button class="minus-btn">-</button>
                                <input type="text" value="1" class="quantity" readonly>
                                <button class="plus-btn">+</button>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>

          `;
              });
              $('.product-grid').html(listItems);
               
              
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

  loadProduct();
  
   
    // Handle payment
//   $('.pay-now').click(function () {
//       var data = {
          
//              action: 'pay',
//              cart: cart
             

          
          
//       };
//         $.ajax({
//             type: 'POST',
//             url: 'action/pos_db.php', // Replace with the correct path to process payment
//             contentType: 'application/json',
//             data: JSON.stringify(data),
//             success: function(response) {
//                 if (response.status === 'success') {
//                     alert('Payment successful!');
//                     cart = {}; // Clear the cart
//                     updateCart();
//                 } else {
//                     alert('Payment failed: ' + response.message);
//                 }
//             }
//         });
    //     });
    


    $('.product-grid').on('click', '.add-to-cart-btn', function () {
        const productElement = $(this).closest('.product');
        const productId = productElement.data('product-id');
        const productName = productElement.find('h3').text();
        const productPrice = parseFloat(productElement.find('p').text().replace('₱', ''));
        const quantity = parseInt(productElement.find('.quantity').val());

        // Send data to PHP to add product to session cart
        $.ajax({
            type: 'POST',
            url: 'action/cart_handler.php', // Your PHP script for handling the cart
            data: {
                action: 'add',
                product_id: productId,
                product_name: productName,
                product_price: productPrice,
                quantity: quantity
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    updateCartDisplay(data.cart);
                } else {
                    alert('Failed to add to cart.');
                }
            }
        });
    });

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

    // Function to update the cart display
    function updateCartDisplay(cart) {
        let listItems = '';
        let subtotal = 0;

        // Iterate over cart items
        cart.forEach(function (item, index) {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            listItems += `
                <li>
                    ${item.name} x ${item.quantity} - ₱${itemTotal.toFixed(2)}
                     <button class="delete-btn" data-index="${index}">Delete</button>
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