<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Coffee Near Me</title>
</head>
<style>
    body {
        background-color: #D76614;
    }

    .text-logo {
        display: flex;
        height: 80px;
        width: 250px;
        margin-bottom: 30px;
        margin-right: 60px;
        margin-left: 20px;
    }

    .logo {
        background-color: #000000;
        margin-top: 20px;
        padding: 10px;
        padding-bottom: 30px;
        height: 350px;
        width: 350px;
    }

    .usr {
        border: #000000;
    }

    .pss {
        border: #000000;
    }

    .row {
        display: block;
    }

    .form-control {
        background-color: #806D61;
    }

    .btn {
        margin-top: 30px;
        width: 100px;
        margin-left: 100px;
        background-color: #806D61;
        color: #FFFFFF;
    }

    .btn:hover {
        background-color: #806D60;
    }

    .image {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        position: relative;

    }

    .Area {
        display: flex;
        background-color: #1E1E1E;
        max-width: fit-content;
        margin-left: auto;
        margin-right: auto;
        margin-top: 100px;
        padding: 40px;
    }

    @media (max-width: 768px) {
        .Area {
            display: flex;
            background-color: #1E1E1E;
            width: 100%;
            height: auto;
            margin-left: auto;
            margin-right: auto;
            margin-top: 300px;
            padding: 40px;

        }

        .logo {
            background-color: #000000;
            margin-top: 20px;
            padding: 10px;
            padding-bottom: 30px;
            height: auto;
            width: 250px;
            display: block;
        }
    }

    @media (max-width: 640px) {
        .Area {
            margin: 0 auto;
            width: 100vw;
            height: auto;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;

        }

        .logo {
            margin-top: 0px;
            padding: 10px;
            padding-bottom: 30px;
            height: auto;
            width: 200px;

        }
    }
</style>

<body>
    <div class="Area">
        <form>
            <div class="row g-2 mb-3">
                <div>
                    <img class="text-logo" src="assets/images/logotext _nobg.png">
                </div>
                <div class="user col-10">
                    <label class="form-label" style="color:#FFFFFF;">Username</label>
                    <input type="Username" name="user_name" id="user_name" class="usr form-control">
                </div>
                <div class="pass col-10 mb-3">
                    <label class="form-label" style="color:#FFFFFF;">Password</label>
                    <input type="Password" name="password" id="password" class="pss form-control">
                </div>
                <p id="errorhandling" style="color:red;"> </p>
                <div>
                    <button class="btn">Login</button>
                </div>
            </div>
        </form>
        <div>
            <div class="image col-12">
                <img class="logo" src="assets/images/logo_no_bg.png">
            </div>
        </div>
    </div>
    <!-- <a href="pages/adduser.php">add user</a> -->

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn').click(function(event) {
            event.preventDefault();

            var user = $('#user_name').val().trim();
            var password = $('#password').val().trim();


            if (user === "") {
                $('#errorhandling').text("Username is required.");
                $('#user_name').focus();
                return;
            } else if (password === "") {
                $('#errorhandling').text("Password is required.");
                $('#password').focus();
                return;
            } else {

                $('#errorhandling').text("");
            }

            var data = {
                user: user,
                password: password
            };

            $.ajax({
                type: "POST",
                url: "pages/action/logindb.php",
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    // Parse the JSON response if not already parsed
                    if (typeof response !== 'object') {
                        response = JSON.parse(response);
                    }

                    if (response.success) {
                        $('#errorhandling')
                            .text(response.message)
                            .css('color', 'green');
                        // Optionally, redirect to dashboard
                        window.location.href = "pages/adminDashboard.php";
                    } else {
                        $('#errorhandling').text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    $('#errorhandling').text("An error occurred: " + error);
                }
            });
        });
    });
</script>

</html>