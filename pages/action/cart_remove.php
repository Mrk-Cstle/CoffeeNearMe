$(document).on('click', '.delete-btn', function () {
let itemIndex = $(this).data('index');

// Remove item from the local cart in sessionStorage
let cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
cartItems.splice(itemIndex, 1);
sessionStorage.setItem('cart', JSON.stringify(cartItems));

// Update the cart display
updateCartDisplay();

// Update the server-side session
$.ajax({
type: 'POST',
url: 'remove_from_cart.php',
data: { index: itemIndex },
success: function(response) {
if (response.status === 'success') {
console.log(response.message);
} else {
console.error(response.message);
}
},
error: function() {
console.error('An error occurred while communicating with the server.');
}
});
});