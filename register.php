<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }
        .card-registration .select-arrow {
            top: 13px;
        }
    </style>
</head>

<body>
    <section class="h-100" style="background-color: #006400;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="makerere_logo-removebg-preview.png" alt="Sample photo" class="img-fluid h-100" style="object-fit: contain; width: 100%; height: 100%;"/>
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Pay slip registration form</h3>
                                    
                                    <!-- Form start -->
                                    <form action="submitForm.php" method="POST" onsubmit="return validatePasswords()">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" name="firstName" id="firstName" class="form-control form-control-lg" required/>
                                                    <label class="form-label" for="form3Example1m">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" name="lastName" id="lastName" class="form-control form-control-lg" required/>
                                                    <label class="form-label" for="form3Example1n">Last name</label>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" name="ippsNumber" id="ippsNumber" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="form3Example8">IPPS Number</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" name="unit" id="unit" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="form3Example8">Unit</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="makerereEmail" id="makerereEmail" class="form-control form-control-lg" pattern="^[a-zA-Z0-9._%+-]+@mak\.ac\.ug$" title="Email must be in the format: example@mak.ac.ug" required/>
                                            <label class="form-label" for="form3Example8">Makerere Email</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="personalEmail" id="personalEmail" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="form3Example8">Personal Email</label>
                                        </div>
                                    
                                        <!-- Password with pattern for rules -->
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" id="password" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="form3Example8">Password</label>
                                        </div>
                                        
                                        <!-- Confirm Password -->
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="form3Example8">Confirm Password</label>
                                        </div>
                                        <div class="d-flex justify-content-end pt-3">
                                            <p style="padding: 20px;"><a href="index.html">Have an Account</a></p>
                                            <button type="submit" class="btn btn-success btn-lg ms-2">Submit form</button>
                                            
                                        </div>
                                        
                                    </form>
                                    <!-- Form end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  

    <script>
        // Function to validate password match
        function validatePasswords() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false; // Prevent form submission
            }
        }
    </script>
</body>
</html>
