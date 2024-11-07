$(document).ready(function () {

  

    function lowstock() {
     
         
         var data = {
          
             action: 'lowstock'
      
      };
    $.ajax({
        type: 'POST',
        url: 'action/dashboard_db.php',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            if (response.status === 'success') {
                var ingredients = response.ingredients;
                
                
                
               let header = `<h5 id="lowHead">Low Stock</h5>

                    <div class="lowHeading">
                        <h5 id="lowHead">Picture</h5>
                        <h5 id="lowHead">Ingredient Name</h5>
                        <h5 id="lowHead">Quantity</h5>
                    </div>`

                let listItems = header;
                ingredients.forEach(function(ingredients) {
                    let pictureHtml = '';
                    if (ingredients.picture) {
                        pictureHtml = `<img  class="lowImage" src="uploads/ingredients/${ingredients.picture}" data-product-img="${ingredients.picture}">`;
                    } else {
                        pictureHtml = ` <img src="../assets/images/coffee.png" class="lowImage">`;
                    }

                 
                    listItems += `
                    

                        <div class="lowBody">
                        ${pictureHtml}
                        <h5 id="lowP1">${ingredients.raw_name}</h5>
                        <h5 id="lowP2">${ingredients.quantity} ${ingredients.unit}</h5>
                        </div>
                    <div id="borderDown"></div>
                    `;
                });
                
                $('.lowStockDiv').html(listItems);

                
     
              
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
  lowstock()
  
  $('#filter').change(function () {
      
        topproduct();
  });
  

    function topproduct() {
     var filter = $('#filter').val();
         
         var data = {
          filter: filter,
             action: 'topproduct'
      
      };
    $.ajax({
        type: 'POST',
        url: 'action/dashboard_db.php',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            if (response.status === 'success') {
                var top = response.top;
                
                
                
               let header = ` <div class="heading">
                                  <p id="head">Name</p>
                                  <p id="head">Sold Quantity</p>
                                 
                                  <p id="head">Price</p>
                              </div>
                              <div id="borderDown"></div>`

                let listItems = header;
                if (top.length > 0) {
              
                top.forEach(function(item) {
                    listItems += `
                        <div class="bodySell">
                            <p id="bodyP1">${item.product_name}</p>
                            <p id="bodyP2">${item.sold_quantity}</p>
                            <p id="bodyP4">₱${Number(item.total_value).toLocaleString()}</p>
                        </div>
                        <div id="borderDown"></div>`;
                });
            } else {
                
                listItems += `<p class="no-data">${response.message}</p>`;
            }
                
                $('.selling').html(listItems);

                
     
              
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
  topproduct();
})