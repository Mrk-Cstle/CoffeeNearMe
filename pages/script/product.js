$(document).ready(function () {
    $('#add-productbtn').click(function() {
        var productadd = $('#product-add').val();
        var product_categoryadd = $('#product_categoryadd').val();
        var priceadd = $('#priceadd').val();
      

        var data = {
          productadd: productadd,
          product_categoryadd: product_categoryadd,
          priceadd: priceadd,
        
          action: 'add'
        }
        productAjaxRequest(data);
    });
  
   var urlParams = new URLSearchParams(window.location.search);
    var currentPage = urlParams.has('page') ? parseInt(urlParams.get('page')) : 1;
    var totalPages = 1;
  
   if (urlParams.has('category')) {
        $('#categoryFilter').val(urlParams.get('category'));
    }

    if (urlParams.has('search')) {
        $('#searchInput').val(urlParams.get('search'));
    }
    $('#categoryFilter').change(function () {
        currentPage = 1;
        updateUrl();
            loadProduct();
      });

      //for search
      $('#searchInput').keyup(function () {
        currentPage = 1;
        updateUrl();
            loadProduct();
      });
  
   $('#prevPage').click(function() {
        if (currentPage > 1) {
          currentPage--;
          updateUrl();
            loadProduct();
        }
    });

    $('#nextPage').click(function() {
        if (currentPage < totalPages) {
          currentPage++;
          updateUrl();
            loadProduct();
        }
    });
  
  function loadProduct() {
      var categoryFilter = $('#categoryFilter').val();
        var searchQuery = $('#searchInput').val();
         var itemsPerPage = 5;
         var data = {
          
           action: 'reload',
           page: currentPage,
            categoryFilter: categoryFilter,
          searchQuery: searchQuery,
          itemsPerPage: itemsPerPage
          
      };
      $.ajax({
          type: 'POST',
          url: 'action/product_db.php', // Replace with correct path to fetch categories
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
                    <tr class="tableRowProductsInfo" >
                            <td style="display: none;" class="products-id">${product.product_id}</td>
                            <td class="tableProductsInfo">${pictureHtml}</td>
                            
                           
                           
                            <td  class="product-category tableProductsInfo" >${product.product_category}</td>
                            <td  class="product-name tableProductsInfo" >${product.product_name}</td>
                            
                            
                            <td class="product-quantity tableProductsInfo">${product.price}</td>
                            
                           
                            
                            
                            
                            <td class="tableProductsInfo"><button class="view-btn" data-product-id='${product.product_id}' type="button" id="btn-action" data-bs-toggle="modal" data-bs-target="#viewProductModal">View</button></td> 
                        </tr>

          `;
              });
              $('.product-tbl').html(listItems); // Update DOM with new categories
               totalPages = response.totalPages;
              $('#currentPage').text(currentPage);

                    // Enable/disable pagination buttons
              $('#prevPage').prop('disabled', currentPage === 1);
              $('#nextPage').prop('disabled', currentPage === totalPages);
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
  
 
  
   function updateUrl() {
        var categoryFilter = $('#categoryFilter').val();
        var searchQuery = $('#searchInput').val();
        
        var newUrl = window.location.pathname + '?page=' + currentPage;

        if (categoryFilter) {
            newUrl += '&category=' + encodeURIComponent(categoryFilter);
        }

        if (searchQuery) {
            newUrl += '&search=' + encodeURIComponent(searchQuery);
        }

        window.history.replaceState({ path: newUrl }, '', newUrl);
  }

  $('#saveChanges').click(function() {
        var productName = $('#product-add').val();
        var productCategory = $('#product_categoryadd').val();
        var productPrice = $('#priceadd').val();
      

        var data = {
          productName: productName,
          productCategory: productCategory,
          productPrice: productPrice,
        
          action: 'add'
        }
        productAjaxRequest(data);
      });
  
    function productAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/product_db.php', // replace with your server endpoint
          data: JSON.stringify(data),
          contentType: 'application/json',

          success: function(response) {

            console.log(response);
            // Optionally close the modal
            if (response.status === 'success') {
              Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
              });

              loadProduct();
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
  
  loadProduct();

  

$(document).on('click', '.view-btn', function () {
           var $row = $(this).closest('tr');
          var productsid = $row.find('.products-id').text().trim();;
  
           var data = {
                    productsid: productsid,
                    action: 'editmodal'
          }
          
            $.ajax({
            type: 'POST',
            url: 'action/product_db.php', 
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                if (response.status === 'success') {
                    var Data = response.data;

                   
                    $('input[name="productName"]').val(Data.product_name);
                  
                    $('input[name="productPrice"]').val(Data.price);
                     $('#productCategory').val(`<option value="${Data.product_category}">${Data.product_category}</option>`).val(Data.product_category);
                  $('input[name="productId"]').val(Data.product_id);

                   if (typeof loadProductIngredients === 'function') {
                    loadProductIngredients();
                } else {
                    console.error('loadProductIngredients function is not available.');
                }
                  
                if (Data.picture) {
                                var imgSrc = "uploads/product/" + Data.picture; // Assuming the image path is relative to your project structure
                                $('.productImg').attr('src', imgSrc);
                            } else {
                                // Use a default image if no picture is found
                                $('.productImg').attr('src', 'uploads/product/default.png'); // You can specify your default image path here
                            }
                                  
           
                } else {
                    console.error('Failed to fetch user data');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading user data:", status, error);
                console.log("XHR object:", xhr); 
                if (xhr.responseText) {
                console.log("Response text:", xhr.responseText); 
                }
            }
    });
        //    console.log("asd")
          
        //   userAjaxRequest(data);
          
        }); 



  
$(document).on('click', '.updatebtn', function() {



        // Retrieve the value of the input field
        var productId = $('#productId').val();
        var productName = $('#productName').val();
        var productCategory = $('#productCategory').val();
        var productPrice = $('#productPrice').val();
        


        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, update it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var data = {
              productId: productId,
              productName: productName,
              productCategory: productCategory,
              productPrice: productPrice,
              
              action: 'edit'
            }
            productAjaxRequest(data);
          }



        });


      });
 $(document).on('click', '.deletebtn', function() {



        // Retrieve the value of the input field
        var productId = $('#productId').val();


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
              productId: productId,
              action: 'delete'
            }
            productAjaxRequest(data);
          }
          $('#productName').val("");
          $('#productCategory').val("");
          $('#productPrice').val("");
         


        });


      });



  
  
  
  
  
  
//////category js


function loadCategories() {

        var data = {

          action: 'reload'
        };

        $.ajax({
          type: 'POST',
          url: 'action/productCategory_db.php', // Replace with correct path to fetch categories
          contentType: 'application/json',
          data: JSON.stringify(data),
          success: function(response) {

            if (response.status === 'success') {
              var categories = response.categories;
              var listItems = '';
              categories.forEach(function(category) {
                listItems += `
            <li class='items list-group-item'>
              ${category.category}
              <a href='#' data-product-id='${category.category_id}'  class='dots bi bi-trash text-dark category-delete'></a>
            </li>
          `;
              });
              $('.list-group').html(listItems); // Update DOM with new categories
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

  loadCategories();

$(document).on('click', '.category-delete', function() {

        var categoryId = $(this).data('product-id');

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
              categoryId: categoryId,
              action: 'delete'
            };
            categoryAjaxRequest(data);
          }
          // var data = {
          //   categoryId: categoryId,
          //   action: 'delete'
          // }
          // sendAjaxRequest(data);
        });
      });

  $('#add_category').click(function() {
        var category = $('#category').val();
        var data = {
          category: category,
          action: 'add'
        }
        categoryAjaxRequest(data);
      });
  
  function categoryAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/productCategory_db.php', // replace with your server endpoint
          data: JSON.stringify(data),
          contentType: 'application/json',

          success: function(response) {

            console.log(response);
            // Optionally close the modal
            if (response.status === 'success') {
              Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then((result) => {
                        // Check if the user confirmed the alert
                        if (result.isConfirmed) {
                            // Reload the page after the alert is closed
                            location.reload(true);
                        }
                    });
              loadCategories();

            } else {

              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
            $('#Category').modal('hide');
          },
          error: function(error) {
            // Handle any errors
            console.error(error);
          }
        });
      }
})