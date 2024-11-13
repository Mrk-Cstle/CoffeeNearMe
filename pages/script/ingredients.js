
    $(document).ready(function() {
      function loadCategories() {

        var data = {

          action: 'reload'
        };

        $.ajax({
          type: 'POST',
          url: 'action/category_db.php', // Replace with correct path to fetch categories
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
              <a href='#' data-category-id='${category.category_id}'  class='dots bi bi-trash text-dark category-delete'></a>
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

      $('#add_category').click(function() {
        var category = $('#category').val().trim();

         $('#errorhandling').text('');

    // Validation checks
    if (category === "") {
        $('#errorhandlingcategory').text("Category is required.");
        $('#category').focus();
        return;
    }
        var data = {
          category: category,
          action: 'add'
        }
        sendAjaxRequest(data);
      });

      $(document).on('click', '.dots', function() {

        var categoryId = $(this).data('category-id');

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
            sendAjaxRequest(data);
          }
          // var data = {
          //   categoryId: categoryId,
          //   action: 'delete'
          // }
          // sendAjaxRequest(data);
        });
      });

      function sendAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/category_db.php', // replace with your server endpoint
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
      loadCategories();


      //for ingredients ajax

     var urlParams = new URLSearchParams(window.location.search);
    var currentPage = urlParams.has('page') ? parseInt(urlParams.get('page')) : 1;
    var totalPages = 1;

      // Set the filter and search input values from the URL if they exist
    if (urlParams.has('category')) {
        $('#categoryFilter').val(urlParams.get('category'));
    }

    if (urlParams.has('search')) {
        $('#searchInput').val(urlParams.get('search'));
    }

      //for filter
      $('#categoryFilter').change(function () {
        currentPage = 1;
        updateUrl();
        loadIngredients();
      });

      //for search
      $('#searchInput').keyup(function () {
        currentPage = 1;
        updateUrl();
        loadIngredients();
      });
      
      $('#prevPage').click(function() {
        if (currentPage > 1) {
          currentPage--;
          updateUrl();
            loadIngredients();
        }
    });

    $('#nextPage').click(function() {
        if (currentPage < totalPages) {
          currentPage++;
          updateUrl();
            loadIngredients();
        }
    });
      
      function loadIngredients() {
        var categoryFilter = $('#categoryFilter').val();
        var searchQuery = $('#searchInput').val();
        var itemsPerPage = 5;
        var data = {

          action: 'reload',
          categoryFilter: categoryFilter,
          searchQuery: searchQuery,
          page: currentPage,
          itemsPerPage: itemsPerPage
        };
        $.ajax({
          type: 'POST',
          url: 'action/ingredients_db.php', // Replace with correct path to fetch categories
          contentType: 'application/json',
          data: JSON.stringify(data),
          success: function(response) {

            if (response.status === 'success') {
              var ingredients = response.ingredients;
              var listItems = '';

              ingredients.forEach(function(ingredient) {
                var lowStock = ingredient.quantity < 0.8 * ingredient.ideal_quantity;
                var BackgroundColor = lowStock ? '#FA8072' : '';
                 let pictureHtml = '';
                                if (ingredient.picture) {
                                    pictureHtml = `<img style="width: 60px; height: 60px;object-fit: cover;" class="ingredients-img" src="uploads/ingredients/${ingredient.picture}"data-ingredients-img="${ingredient.picture}">`;
                                } else {
                                    pictureHtml = `<img style="width: 60px; height: 60px;object-fit: cover;" class="ingredients-img" src="uploads/ingredients/default.png"data-ingredients-img="default.png">`; // or provide alternative HTML
                                }
                listItems += `
                    <tr >
                            <td>${pictureHtml}</td>
                           <td style="display: none;" class="ingredient-category">${ingredient.category}</td>
                            <td class="ingredient-name" style="background-color: ${BackgroundColor}; padding-top: 2.5%;" >${ingredient.raw_name}</td>
                            
                            <td class="ingredient-quantity" style="padding-top: 2.5%;">${ingredient.quantity} ${ingredient.unit}</td>
                            <td class="ingredient-ideal-quantity" style="padding-top: 2.5%;">${ingredient.ideal_quantity} ${ingredient.unit}</td>
                            
                            
                            <td>
                                <div class="dropdown">
                                  <button class="dropdown-btn"><img src="../assets/images//threeDots.png" class="threeIcon"></button>
                                    <div class="dropdown-content">
                                        <a data-ingredients-id='${ingredient.ingredients_id}' class="vbtn btn-dark btn-sm"  data-toggle="modal" data-target="#editModal">View</a>
                                        <a data-ingredients-id='${ingredient.ingredients_id}' class="vbtn vbtn-in btn-dark btn-sm" data-toggle="modal" data-target="#stockINModal">Stock In</a>
                                        <a data-ingredients-id='${ingredient.ingredients_id}' class="vbtn vbtn-out btn-dark btn-sm" data-toggle="modal" data-target="#stockOUTModal">Stock Out</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

          `;
              });
              $('.ingredients-tbl').html(listItems); // Update DOM with new categories
              
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
      

      //For Edit Ingredients
      $(document).on('click', '.vbtn', function() {
        // Get data attributes from the clicked link
        var $row = $(this).closest('tr');

        var ingredientId = $(this).data('ingredients-id');
        var ingredientName = $row.find('.ingredient-name').text().trim();
        var ingredientQuantity = $row.find('.ingredient-quantity').text().trim();
        var ingredientIdealQuantity = $row.find('.ingredient-ideal-quantity').text().trim();
        var ingredientCategory = $row.find('.ingredient-category').text().trim();
        var ingredientImage = $row.find('.ingredients-img').data('ingredients-img');
        
        console.log(ingredientImage)

        // Populate the modal fields with the data

        $('#ingredient-id').val(ingredientId);
        $('#names').val(ingredientName);
        $('#qtys').val(ingredientQuantity);
        $('#ideal_qtys').val(ingredientIdealQuantity);
          
        $('#categorys').val(`<option value="${ingredientCategory}">${ingredientCategory}</option>`).val(ingredientCategory);
        $('.imageButton').data('ingredients-id', ingredientId);
        var imgsrc = "uploads/ingredients/"+ ingredientImage;
        $('.ingredientProfile').attr('src', imgsrc);
        

      });

      $(document).on('click', '.vbtn-in', function () {
        var $row = $(this).closest('tr');
        var ingredientId = $(this).data('ingredients-id');
        var ingredientName = $row.find('.ingredient-name').text().trim();
        var ingredientQuantityText = $row.find('.ingredient-quantity').text().trim();
        
        var quantityParts = ingredientQuantityText.split(' ');
        var ingredientUnit = quantityParts[quantityParts.length - 1];

        $('.ingreText').text(ingredientName);
        $('#stockinunit').val(ingredientUnit);
        console.log(ingredientName)
        
      $('.stockBtnUpdate').off('click').on('click', function() {
        var stockQty = $('#stockinQty').val();
        
        
              var data = {
                ingredientId: ingredientId,
                ingredientName:ingredientName,
                stockQty: stockQty,
                stockUnit: ingredientUnit,
                action: "stockin"
                  
                  }
        ingredientsAjaxRequest(data);
        
        });
       
      });
      $(document).on('click', '.vbtn-out', function () {
        var $row = $(this).closest('tr');
        var ingredientId = $(this).data('ingredients-id');
        var ingredientName = $row.find('.ingredient-name').text().trim();
         var ingredientQuantityText = $row.find('.ingredient-quantity').text().trim();
        
        var quantityParts = ingredientQuantityText.split(' ');
        var ingredientUnit = quantityParts[quantityParts.length - 1]; 

        $('.ingreText').text(ingredientName);
        $('#stockoutunit').val(ingredientUnit);
        console.log(ingredientName)
        
      $('.stockBtnUpdate').off('click').on('click', function() {
              var stockQty = $('#stockoutQty').val();
              var data = {
                ingredientId: ingredientId,
                ingredientName:ingredientName,
                stockQty: stockQty,
                  stockUnit: ingredientUnit,
                  action: "stockout"
                  
                  }
        ingredientsAjaxRequest(data);
        
        });
       
 });
      $(document).on('click', '.updatebtn', function() {



        // Retrieve the value of the input field
        var ingredients_id = $('#ingredient-id').val();
        var ingredients_names = $('#names').val();
        var ingredients_qtys = $('#qtys').val();
        var ingredients_idealqtys = $('#ideal_qtys').val();
        var ingredients_categorys = $('#categorys').val();


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
              ingredients_id: ingredients_id,
              ingredients_names: ingredients_names,
              ingredients_qtys: ingredients_qtys,
              ingredients_idealqtys: ingredients_idealqtys,
              ingredients_categorys: ingredients_categorys,
              action: 'edit'
            }
            ingredientsAjaxRequest(data);
          }



        });


      });


      $(document).on('click', '.deletebtn', function() {



        // Retrieve the value of the input field
        var ingredients_id = $('#ingredient-id').val();


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
              ingredients_id: ingredients_id,
              action: 'delete'
            }
            ingredientsAjaxRequest(data);
          }
          $('#ingredient-id').val("");
          $('#names').val("");
          $('#qtys').val("");
          $('#ideal_qtys').val("");


        });


      });

      $('#saveChanges').click(function() {
        var ingredients = $('#ingredients').val();
        var category = $('#icategory').val();
        var qty = $('#qty').val();
        var ideal_qty = $('#ideal_qty').val();
        var unit = $('#a_unit').val();

        $('#errorhandling').text('');

      if (ingredients === "") {
        $('#errorhandling').text("Ingredients field is required.");
        $('#ingredients').focus();
        return;
    }
      if (category === "") {
          $('#errorhandling').text("Category field is required.");
          $('#icategory').focus();
          return;
      }
      if (qty === "" || isNaN(qty) || qty <= 0) {
          $('#errorhandling').text("Please enter a valid quantity.");
          $('#qty').focus();
          return;
      }
      if (ideal_qty === "" || isNaN(ideal_qty) || ideal_qty <= 0) {
          $('#errorhandling').text("Please enter a valid ideal quantity.");
          $('#ideal_qty').focus();
          return;
      }
      if (unit === "") {
          $('#errorhandling').text("Unit field is required.");
          $('#a_unit').focus();
          return;
      }

        var data = {
          ingredients: ingredients,
          category: category,
          qty: qty,
          ideal_qty: ideal_qty,
          unit: unit,
          action: 'add'
        }
        ingredientsAjaxRequest(data);
      });

      function ingredientsAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/ingredients_db.php', // replace with your server endpoint
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

              loadIngredients();
            } else {
              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
            $('#Add').modal('hide');
          },
          error: function(error) {
            // Handle any errors
            console.error(error);
          }
        });
      }
      loadIngredients();
    });
