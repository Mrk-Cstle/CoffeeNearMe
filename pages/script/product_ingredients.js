$(document).ready(function () {


    $('#add_ingredientsbtn').click(function () {
    
        event.preventDefault();


    var ingredients = $('#product_ingredients').val();
    var qty = $('#productingredientQuantity').val();
     var productId = $('#productId').val();
    

    
        var data = {
            ingredients: ingredients,
            qty: qty,
            productId: productId,
            action: 'add'
        }
        productingredientsAjaxRequest(data);
      });


$(document).on('click', '.trashIcon', function (e) {
    e.preventDefault(); 
    var $li = $(this).closest('li');

    
  var hiddenValue = $li.find('input[type="hidden"]').val();
  
   
        
    
    console.log('Hidden input value:', hiddenValue);

  Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
             var data = {
            hiddenValue: hiddenValue,
            
            action: 'delete'
        }
           productingredientsAjaxRequest(data);
          }
         
         


        });
  
});

function productingredientsAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/product_ingredients_db.php', // replace with your server endpoint
          data: JSON.stringify(data),
          contentType: 'application/json',

          success: function(response) {

            console.log(response);
            
            if (response.status === 'success') {
              Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
              })
                       
                            loadProductIngredients();
               
              

            } else {

              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
           
          },
          error: function(error) {
            // Handle any errors
            console.error(error);
          }
        });
      }

     
                    
})

function loadProductIngredients() {
      var productId = $('#productId').val();
        console.log(productId)
         var data = {
          
           action: 'reload',
           productId: productId
          
      };
      $.ajax({
          type: 'POST',
          url: 'action/product_ingredients_db.php', // Replace with correct path to fetch categories
          contentType: 'application/json',
          data: JSON.stringify(data),
          success: function(response) {

            if (response.status === 'success') {
              var ingredients = response.ingredients;
              var listItems = '';

              ingredients.forEach(function(ingredients) {
               
                 
                listItems += `
                   
         
                    <li class="ingredientLi list-group-item">
                            <input type="hidden" id="prod-ingredients-hide" name="prod-ingredients-hide" value="${ingredients.product_raw_id}">
                            ${ingredients.raw_name}  
                            <span class="spanquantity">${ingredients.quantity}</span>
                            <a href="#" class="trashIcon bi bi-trash text-dark"></a>
                        </li>
                       

          `;
              });



              
               $('.ingredientBodyMowdal').html(listItems);
              
               
          
        
              

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

  
  