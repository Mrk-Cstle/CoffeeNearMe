$(document).ready(function () {

    $('#saveChanges').click(function() {
        var expenses = $('#expenses').val();
        var icategory = $('#icategory').val();
        var payment = $('#payment').val();
      

        var data = {
          expenses: expenses,
          categoryadd: icategory,
          payment: payment,
        
          action: 'add'
        }
        expensesAjaxRequest(data);
    });

    var urlParams = new URLSearchParams(window.location.search);
    var currentPage = urlParams.has('page') ? parseInt(urlParams.get('page')) : 1;
    var totalPages = 1;

    
    
  
  
    if (urlParams.has('search')) {
        $('#searchInput').val(urlParams.get('search'));
    }
    

      //for search
      $('#searchInput').keyup(function () {
        currentPage = 1;
        updateUrl();
            loadExpenses();
      });
  
   $('#prevPage').click(function() {
        if (currentPage > 1) {
          currentPage--;
          updateUrl();
            loadExpenses();
        }
    });

    $('#nextPage').click(function() {
        if (currentPage < totalPages) {
          currentPage++;
          updateUrl();
            loadExpenses();
        }
    });
    flatpickr("#dateRangePicker", {
      mode: "range",
      dateFormat: "Y-m-d", // Ensure this matches the format in your database
      onChange: function(selectedDates, dateStr) {
        // Check if two dates are selected (start and end)
        if (selectedDates.length === 2) {
          currentPage = 1; // Reset to first page
          updateUrl();
          loadExpenses(); // Trigger AJAX reload
        }
      }
    });
  
 function loadExpenses() {
   
    var searchQuery = $('#searchInput').val();
    var dateRange = $('#dateRangePicker').val(); // Date range in "YYYY-MM-DD to YYYY-MM-DD"
    var itemsPerPage = 5;

    // Extract start and end dates from the date range
    var startDate = '';
    var endDate = '';
    if (dateRange) {
    var dates = dateRange.split(" to ");
    startDate = dates[0];
    // If there's no "to" part in the range, treat it as a single date
    if (dates.length > 1) {
        endDate = dates[1];
    } else {
        endDate = startDate;  // If no end date, set end date equal to start date
    }
}

    // Debugging output
   
    // console.log("Search Query:", searchQuery);
    // console.log("Date Range:", dateRange);
    // console.log("Start Date:", startDate, "End Date:", endDate);

    var data = {
        action: 'reload',
        page: currentPage,
        
        searchQuery: searchQuery,
        startDate: startDate,
        endDate: endDate,
        itemsPerPage: itemsPerPage
    };

    $.ajax({
        type: 'POST',
        url: 'action/expenses_db.php', // Replace with your backend URL
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            if (response.status === 'success') {
                var expenses = response.product;
                var listItems = '';

                expenses.forEach(function(expenses) {
                    listItems += `
                        <tr>
                            <td>${expenses.category}</td>
                            <td><i>${expenses.expenses}</i></td>
                            <td><b>₱${expenses.payment}</b></td>
                            <td>${expenses.date}</td>
                            <td><button data-expenses-id='${expenses.expenses_id}' class="delete-btn">
                                <img src="../assets/images/delete.png" alt="" class="delete-icon"></button></td>
                        </tr>
                    `;
                });
                $('.expenses-tbl').html(listItems);
                totalPages = response.totalPages;
                $('#currentPage').text(currentPage);

                $('#prevPage').prop('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages);
            } else {
                console.error('Error loading categories: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading categories:', status, error);
            if (xhr.responseText) {
                console.log('Response text:', xhr.responseText);
            }
        }
    });
}
  
 
  
   function updateUrl() {
      
        var searchQuery = $('#searchInput').val();
        
        var newUrl = window.location.pathname + '?page=' + currentPage;

       

        if (searchQuery) {
            newUrl += '&search=' + encodeURIComponent(searchQuery);
        }

        window.history.replaceState({ path: newUrl }, '', newUrl);
  }

function expensesAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/expenses_db.php', // replace with your server endpoint
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

              loadExpenses();
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
    $(document).on('click', '.delete-btn', function() {



        // Retrieve the value of the input field
         var expensesId = $(this).data('expenses-id');
console.log(expensesId);

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
              expenses: expensesId,
              action: 'delete'
            }
            expensesAjaxRequest(data);
           
          }
          
         


        });


      });
    loadExpenses();
    })