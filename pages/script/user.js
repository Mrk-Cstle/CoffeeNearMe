  $(document).ready(function() {

      var userurlParams = new URLSearchParams(window.location.search);
      var currentPage = userurlParams.has('page') ? parseInt(userurlParams.get('page')) : 1;
      var totalPages = 1;

      if (userurlParams.has('category')) {
          $('#categoryFilter').val(userurlParams.get('category'));
      }
      if (userurlParams.has('search')) {
        $('#search-user').val(userurlParams.get('search'))
      }
      
            $("#categoryFilter").change(function () {
                currentPage = 1;
                updateUrl();
                loadUser();
            })
            $("#search-user").keyup(function () {
                currentPage = 1;
                updateUrl();
                loadUser();
               
            })
       $('#prevPage').click(function() {
        if (currentPage > 1) {
          currentPage--;
          updateUrl();
           loadUser();
        }
    });

    $('#nextPage').click(function() {
        if (currentPage < totalPages) {
          currentPage++;
          updateUrl();
            loadUser();
        }
    });
      function loadUser() {
          var category = $("#categoryFilter").val();
          var search = $("#search-user").val();
           var itemsPerPage = 5;
                
                var data = {
                    action: 'reload',
                    category: category,
                    search_user: search,
                    itemsPerPage: itemsPerPage,
                    page: currentPage,
                    itemsPerPage: itemsPerPage
                }
                $.ajax({
                  type: "POST",
                  url: "action/user_db.php", // Replace with correct path to fetch categories
                  contentType: "application/json",
                  data: JSON.stringify(data),
                    success: function (response) {
                       
                        if (response.status === 'success') {
                            var users = response.data;
                            var userlist = '';
                            
                            
                          users.forEach(function (user) {
                               let pictureHtml = '';
                                if (user.picture) {
                                    pictureHtml = `<img style="width: 75px; height: 75px;object-fit: cover;" class="ingredients-img" src="uploads/user/${user.picture}">`;
                                } else {
                                    pictureHtml = `<img style="width: 75px; height: 75px;object-fit: cover;" class="ingredients-img" src="uploads/user/default.png">`; // or provide alternative HTML
                                }
                                userlist += `
                                <tr">
                                <td style="display: none;" class="users-id">${user.user_id}</td>
                                <td>${pictureHtml}</td>
                                <td style="padding-top: 2.5%;">${user.full_name}</td>
                                <td style="padding-top: 2.5%;">${user.address}</td>
                                <td style="padding-top: 2.5%;">${user.contact_number}</td>
                                <td data-user-id='${user.user_id}'><a class='btn btn-dark  view-btn '
                                    href='#View'
                                    data-bs-toggle='modal'>
                                    View
                                </a></td>
                                </tr>
                                `;
                            });
                           
                            $('.users-tbl').html(userlist);

                            totalPages = response.totalPages;
                            $('#currentPage').text(currentPage);

                            $('#prevPage').prop('disabled', currentPage === 1);
                            $('#nextPage').prop('disabled', currentPage === totalPages);
                            console.error('loading categories: ' + response.message);
                        }


                  },
                  error: function (xhr, status, error) {
                    console.error("Error loading categories:", status, error);
                    console.log("XHR object:", xhr); 
                    if (xhr.responseText) {
                      console.log("Response text:", xhr.responseText); 
                    }
                    
                  },
                });
              
      }
      
            function updateUrl() {
                var category = $('#categoryFilter').val();
                var search = $('#search-user').val();

                var newUrl = window.location.pathname + '?page=' + currentPage;

                if (category) {
                    newUrl += '&category=' + encodeURIComponent(category);
                }
                if (search) {
                    newUrl += '&search=' + encodeURIComponent(search);
                }
                window.history.replaceState({ path: newUrl }, '', newUrl);
            }

     
    $('.updates-btn').click(function() {
          
          Swal.fire({
            title: 'Confirm Update',
            text: 'Are you sure you want to update the user data?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then(function(result) {
            if (result.isConfirmed) {
                // Proceed with update
                var user_id = $('#users-id').val();
              
              var updatedData = {
                full_name: $('input[name="full_name"]').val().trim(),
                user_name: $('input[name="user_name"]').val().trim(),
                password: $('input[name="password"]').val().trim(),
                address: $('input[name="address"]').val().trim(),
                contact_number: $('input[name="contact_number"]').val().trim(),
                account_type: $('input[name="account_type"]').val().trim(),
                account_date: $('input[name="account_date"]').val().trim(),
                user_id: user_id,
                action: 'edit'
              };

              // Send AJAX request
              $.ajax({
                  type: 'POST',
                  url: 'action/user_db.php',
                  data: JSON.stringify(updatedData),
                  contentType: 'application/json'
                })
                .then(function(response) {
                  console.log(response);

                  if (typeof response === 'string') {
                    response = JSON.parse(response);
                  }

                  if (response.status === 'success') {
                    Swal.fire({
                      title: 'Success',
                      text: response.message,
                      icon: 'success',
                      confirmButtonText: 'OK'
                    });
loadUser();
                    var $row = $('.users-id:contains("' + user_id + '")').closest('tr'); // Find the corresponding row
                    $row.find('.view-btn').trigger('click'); // Trigger the click on view-btn
                   
                  } else {
                    Swal.fire({
                      icon: 'info',
                      title: 'Update Failed',
                      text: response.message,
                      confirmButtonColor: '#d33',
                      confirmButtonText: 'OK'
                    });
                  }
                })
                .fail(function(xhr, status, error) {
                  console.error('AJAX Error:', error);
                  Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'Failed to update user. Please try again later.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                  });
                });
            }
          });
        });
     
            $('#saveChanges').click(function() {
                // Collect the input data
                var full_name = $('#full_name').val().trim();
        var user_name = $('#user_name').val().trim();
        var password = $('#password').val().trim();
        var address = $('#address').val().trim();
        var contact_number = $('#contact_number').val().trim();

        // Validation checks
        if (full_name === "") {
            $('#errorhandling').text("Full name is required.");
            $('#full_name').focus();
            return;
        }
        
        if (user_name === "") {
            $('#errorhandling').text("Username is required.");
            $('#user_name').focus();
            return;
        }
        
        if (password === "") {
            $('#errorhandling').text("Password is required.");
            $('#password').focus();
            return;
        } 
        
       
        
        if (contact_number === "") {
            $('#errorhandling').text("Contact number is required.");
            $('#contact_number').focus();
            return;
        } else if (!/^\d+$/.test(contact_number)) {
            $('#errorhandling').text("Contact number must contain only digits.");
            $('#contact_number').focus();
            return;
              }else if (contact_number.length < 11) {
            $('#errorhandling').text("Invalid Contact number.");
            $('#contact_number').focus();
            return;
        }
        if (address === "") {
            $('#errorhandling').text("Address is required.");
            $('#address').focus();
            return;
        }

                // Prepare the data to be sent
                var data = {
                    full_name: full_name,
                    user_name: user_name,
                    password: password,
                    address: address,
                    contact_number: contact_number,
                    action: 'add'
                }
                userAjaxRequest(data);

            });
            $('.delete-btn').click(function() {
                var user_id = $('#users-id').val();
            

                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You are about to delete this user.',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            user_id: user_id,
                            action: 'delete'
                        }
                        userAjaxRequest(data);
                        

                    }
                });
            });

      $(document).on('click', '.view-btn', function () {
           var $row = $(this).closest('tr');
          var userid = $row.find('.users-id').text().trim();
          
           var data = {
                    usersid: userid,
                    action: 'editmodal'
          }
          
            $.ajax({
            type: 'POST',
            url: 'action/user_db.php', 
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                if (response.status === 'success') {
                    var userData = response.data;

                   
                    $('input[name="full_name"]').val(userData.full_name);
                    $('input[name="account_type"]').val(userData.account_type);
                    $('input[name="user_name"]').val(userData.user_name);
                    $('input[name="password"]').val(userData.password);
                    $('input[name="address"]').val(userData.address);
                    $('input[name="contact_number"]').val(userData.contact_number);
                    $('input[name="account_date"]').val(userData.account_date);
                  $('input[name="users_id"]').val(userData.user_id);
                  
                if (userData.picture) {
                                var imgSrc = "uploads/user/" + userData.picture; // Assuming the image path is relative to your project structure
                                $('.fprofile').attr('src', imgSrc);
                            } else {
                                // Use a default image if no picture is found
                                $('.fprofile').attr('src', 'uploads/user/default.png'); // You can specify your default image path here
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
            function userAjaxRequest(data) {
                $.ajax({
                    type: 'POST',
                    url: 'action/user_db.php', // replace with your server endpoint
                    data: JSON.stringify(data),
                    contentType: 'application/json',

                    success: function (response) {
                        
                       
                       
                        // Optionally close the modal
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            

                           
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                        loadUser();
                        $('#Add').modal('hide');
                    },
                    error: function(error) {
                        // Handle any errors
                        console.error(error);
                    }
                });
      }
      loadUser();

      
        });