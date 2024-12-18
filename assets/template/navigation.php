<?php
include 'action/session.php';

// Check if the user is logged in
checkLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="../assets/template/navigation.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <title></title>
</head>
<style>
   .profile {
      height: 30px;
      width: 30px;
      border-radius: 30px;
      margin-right: 5px;
   }

   .show {
      display: block;
   }
</style>

<body>

   <header class="header">
      <nav class="container-fluid">
         <div class="nav__data">
            <a href="#" class="nav__logo">
            </a>

            <div class="nav__toggle" id="nav-toggle">
               <i class="ri-menu-line nav__burger"></i>
               <i class="ri-close-line nav__close"></i>
            </div>
         </div>

         <!--=============== NAV MENU ===============-->
         <div class="nav__menu" id="nav-menu">
            <ul class="nav__list me-5">
               <li><a href="posProduct.php" class="nav__link">
                     <h3 class="bi bi-cart"></h3>
                  </a></li>

               <!--=============== DROPDOWN 2 ===============-->
               <li class="dropdown__item">
                  <div class="nav__link">
                     <img class="profile" src="../assets/images/logo_no_bg.png"> <?php echo $_SESSION['full_name']; ?> <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                  </div>

                  <ul class="dropdown__menu">
                     <li>
                        <a href="userProfile.php" class="dropdown__link">
                           <i class="ri-user-line"></i> Profile
                        </a>
                     </li>



                     <li>
                        <a id="signoutbtn" class="dropdown__link">
                           <i class="ri-message-3-line"></i> Signout
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </nav>
   </header>
   <div class="area"></div>
   <nav class="main-menu">
      <img class="top-logo" src="../assets/images/logotext _nobg.png">
      <ul>
         <li>
            <a href="adminDashboard.php">
               <h2 class="bi bi-house-fill ms-3 me-3" style="color: #fff;"></h2>
               <span class="nav-text">
                  Dashboard
               </span>
            </a>
         </li>
         <li>
            <a href="product.php">
               <h2 class="bi bi-box2-fill ms-3 me-3" style="color: #fff;"></h2>
               <span class="nav-text">
                  Product
               </span>
            </a>
         </li>
         <li>
            <a href="ingredients.php">
               <h2 class="bi bi-boxes ms-3 me-3" style="color: #fff;"></h2>
               <span class="nav-text">
                  Inventory
               </span>
            </a>
         </li>

         <li>
            <?php if ($_SESSION['account_type'] == 'admin') { ?>
               <a href="expenses.php">
                  <h2 class="bi bi-file-spreadsheet  ms-3 me-2" style="color: #fff;"></h2>
                  <span class="nav-text">
                     Expenses
                  </span>
               </a>
            <?php
            } ?>
         </li>
         <li>
            <?php if ($_SESSION['account_type'] == 'admin') { ?>
               <a href="user.php">
                  <h2 class="bi bi-people-fill ms-3 me-3" style="color: #fff;"></h2>
                  <span class="nav-text">
                     Users
                  </span>
               </a><?php
                  } ?>


         </li>
      </ul>
   </nav>
   <script>
      const showMenu = (toggleId, navId) => {
         const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId)

         toggle.addEventListener('click', () => {
            // Add show-menu class to nav menu
            nav.classList.toggle('show-menu')

            // Add show-icon to show and hide the menu icon
            toggle.classList.toggle('show-icon')
         })
      }

      showMenu('nav-toggle', 'nav-menu')

      $(document).ready(function() {

         $('#signoutbtn').click(function() {
            $.ajax({
               url: 'action/logout.php',
               type: 'POST',
               success: function(response) {
                  // Redirect to login page after logging out
                  window.location.href = '../index.php';
               },
               error: function() {
                  alert('Error signing out. Please try again.');
               }
            });
         });
      })


      // Apply selected class on page load based on saved item
      document.addEventListener("DOMContentLoaded", function() {
         const selectedMenuItem = localStorage.getItem('selectedMenuItem');
         if (selectedMenuItem) {
            document.querySelectorAll('.main-menu li, .dropdown-menu > li')[selectedMenuItem].classList.add('selected');
         }
      });

      // Attach click event to all menu items
      document.querySelectorAll('.main-menu li > a, .dropdown-menu > li > a').forEach((item, index) => {
         item.addEventListener('click', function() {
            // Store the selected item index in local storage
            localStorage.setItem('selectedMenuItem', index);
         });
      });
   </script>
</body>

</html>