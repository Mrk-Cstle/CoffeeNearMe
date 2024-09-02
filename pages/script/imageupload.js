$(document).on('submit', '.ingredients-image', function(event) {
    event.preventDefault();
      
    
    var ingredientId = $('.imageButton').data('ingredients-id');
    console.log(ingredientId);
    var formData = new FormData(this); // Create a FormData object to handle file upload
    formData.append("action", "ingredients");
    formData.append("id", ingredientId);// Append additional data
   console.log(ingredientId);
    imageAjaxRequest(formData);
});



function imageAjaxRequest(formData) {
    $.ajax({
        type: 'POST',
        url: 'action/imageupload_db.php', 
        data: formData, 
        contentType: false, // Set to false to tell jQuery not to process the data
        processData: false, // Set to false to prevent jQuery from converting the FormData object into a query string
        success: function(response) {
             if (response.status == 'success') {
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
            } else {
              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
            
            
        },
        error: function(xhr, status, error) {
            console.error('Error uploading image:', status, error);
            console.log('XHR object:', xhr);
            if (xhr.responseText) {
                console.log('Response text:', xhr.responseText);
            }
           
        }
    });
}