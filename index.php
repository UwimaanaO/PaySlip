<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Fullscreen background with opacity */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background: url('background.jpg') no-repeat center center/cover;
        }

        /* Overlay to control opacity */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* 50% opacity black overlay */
            z-index: -1;
        }

        /* Form box styling */
        .form-box {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: white;
            position: relative;
            z-index: 1;
        }

        /* Error Message */
        #errorMessage {
            display: none;
        }
    </style>
</head>
<body>

<div class="container-sm form-box border p-4">
    <h4 style="color: #006400; text-align: center;">WELCOME TO MAKERERE UNIVERSITY PAYSLIP DISSEMINATION TOOL</h4>
    <img src="makerere_logo-removebg-preview.png" class="mx-auto d-block" style="width:80px">
    <hr class="hr" />
    <h4 style="text-align: center;">LOGIN TO YOUR ACCOUNT</h4>

    <!-- Error Message -->
    <div id="errorMessage" class="alert alert-danger text-center"></div>

    <form id="loginForm">
        <!-- Email Field with Icon -->
        <div class="form-group">
            <label for="email">Makerere Email</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Staff Email" pattern="^[a-zA-Z0-9._%+-]+@mak\.ac\.ug$" title="Email must be in the format: example@mak.ac.ug" required>
            </div>
        </div>
    
        <!-- Password Field with Lock Icon and Eye Toggle -->
        <div class="form-group">
            <label for="pwd">Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
        </div>
    
        <!-- Login Button (Rounded) -->
        <div class="form-group">
            <button type="submit" class="btn btn-block rounded-pill" style="background-color: #006400; color: white;">Login</button>
        </div>
    </form>

    <!-- Forgot Password and Footer -->
    <p style="color: #006400; text-align: center;">Forgot your password? <a href="https://sso.mak.ac.ug/recover/" target="_blank"><u>Reset</u></a></p>
    <p style="color: #006400; text-align: center;">Have no account <a href="register.php" target="_blank"><u>Register</u></a></p>
    <p style="text-align: center;"><strong>@Makerere University 2025</strong></p>
</div>

<script>
    // Toggle password visibility
    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordField = document.getElementById("pwd");
        let icon = this.querySelector("i");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });

    // AJAX Login Request
    $(document).ready(function () {
        $("#loginForm").submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "login.php",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        window.location.href = response.redirect;
                    } else {
                        $("#errorMessage").text(response.message).fadeIn();
                        setTimeout(() => { $("#errorMessage").fadeOut(); }, 3000);
                    }
                },
                error: function () {
                    $("#errorMessage").text("Something went wrong. Try again.").fadeIn();
                    setTimeout(() => { $("#errorMessage").fadeOut(); }, 3000);
                }
            });
        });
    });
</script>

</body>
</html>