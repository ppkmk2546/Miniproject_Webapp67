<?php
    session_start();
    require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!--? CSS Bootstrap-->

    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>

</head>

<body>
    
    <section class="p-3 p-md-4 p-xl-5 d-flex justify-content-center align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="card border-0 shadow" style="max-width: 900px; width: 100%;">
                <div class="row g-0">

                    <div class="col-12 col-md-6">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover"
                            src="picture_login_register/Login.jpg"
                            alt="Sign-up">
                    </div>

                    <div class="col-12 col-md-6">

                        <div class="card-body p-3 p-md-4 p-xl-5">

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4 text-center ">
                                        <h3 class="">Create Your Account</h3>
                                        <small class="text-muted">Please sign up to get started with your
                                            account.</small>
                                        <!-- ? ข้อความแนะนำ -->
                                    </div>
                                </div>
                            </div>

                            
                            <form action="signup_db.php" method="post">
                                <div class="row gy-3 overflow-hidden">

                                    <?php if(isset($_SESSION['error'])) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php 
                                                echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                            ?>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php if(isset($_SESSION['success'])) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php 
                                                echo $_SESSION['success'];
                                                unset($_SESSION['success']);
                                            ?>
                                        </div>
                                    <?php } ?>

                                    <?php if(isset($_SESSION['warning'])) { ?>
                                        <div class="alert alert-warning" role="alert">
                                            <?php 
                                                echo $_SESSION['warning'];
                                                unset($_SESSION['warning']);
                                            ?>
                                        </div>
                                    <?php } ?>

                                    <div class="col-12">
                                        <label for="username" class="form-label text-muted">Username <span 
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Enter your username">
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label text-muted">Email <span 
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="name@example.com">
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label text-muted">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="********">
                                    </div>

                                    <div class="col-12">
                                        <label for="confirm password" class="form-label text-muted">Confirm Password <span
                                        class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="c_password"
                                            placeholder="********">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="text-center mt-3">
                                <p class="text-muted">Already have an account? <a href="login.php"
                                        class="link-primary text-decoration-none">Log in</a></p>
                            </div>

                            <div class="mt-3">
                                <hr class="mb-3 border-secondary-subtle">
                                <div class="d-flex justify-content-end">
                                    <a href="index.php" class="link-secondary text-decoration-none">Back to Main</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">© 2024 Flow Feet, Inc</p>

            <a href="/"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
            </ul>
        </footer>
    </div>

    <script src="js/bootstrap.min.js"></script> <!-- ? Js Bootstrap-->
    
</body>

</html>