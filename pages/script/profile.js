$(document).ready(function () {

    loadData();
    function loadData() {
    
      
        console.log(userId);
        var data = {
           action: 'fetchProfile',
           userid: userId
           

        };
        $.ajax({
            type: "POST",
            url: 'action/profile_db.php',
            data: JSON.stringify(data),
            contentType: 'application/json',
         success: function (response) {
                       
                if (response.status === 'success') {
                        var userData = response.data;
                    console.log(userId);
                   
                    $('input[name="user"]').val(userData.user_name);
                    $('input[name="password"]').val(userData.password);
                    $('input[name="address"]').val(userData.address);
                    $('input[name="contact"]').val(userData.contact_number);
                    $('input[name="fullname"]').val(userData.full_name);
                    $('input[name="type"]').val(userData.account_type);
                  $('input[name="users_id"]').val(userData.user_id);
                  
                  if (userData.picture) {
                                var imgSrc = "uploads/user/" + userData.picture; // Assuming the image path is relative to your project structure
                                $('.profile-image').attr('src', imgSrc);
                            } else {
                                // Use a default image if no picture is found
                                $('.profile-image').attr('src', 'uploads/user/default.png'); // You can specify your default image path here
                            }

                } else {
                    console.log(response.message)
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
               
                user_name: $('input[name="user"]').val().trim(),
                password: $('input[name="password"]').val().trim(),
                address: $('input[name="address"]').val().trim(),
                contact_number: $('input[name="contact"]').val().trim(),
                user_id: user_id,
              
                
                action: 'updateProfile'
              };

              // Send AJAX request
              $.ajax({
                  type: 'PATCH',
                  url: 'action/profile_db.php',
                  data: JSON.stringify(updatedData),
                  contentType: 'application/json',
               success: function (response) {
                       
                 if (response.status === 'success') {
                  Swal.fire({
                      title: 'Success',
                      text: response.message,
                      icon: 'success',
                      confirmButtonText: 'OK'
                    });
                   loadData();

                } else {
                     Swal.fire({
                      icon: 'info',
                      title: 'Update Failed',
                      text: response.message,
                      confirmButtonColor: '#d33',
                      confirmButtonText: 'OK'
                    });
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
          });
        });
});