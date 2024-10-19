<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'Please login!';
        header('location: login.php');
    }

    if (!isset($_GET['id'])) {
        // $_SESSION['error'] = 'Please login!';
        header('location: product.php');
    }
    
    $id = $_GET['id'];
    $size = $_GET['size'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE ProductID=:id"); 
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch();
    $discount = $product['Price'] * (100 - $product['Discount'])/100;

    $image = $conn->prepare("SELECT file_name FROM images WHERE product_id=:id");
    $image->bindParam(':id', $id);
    $image->execute();

    $images = $image->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | <?=$product['ProductName']?>
    </title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <?php include 'config/db.php';
  ?>

<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>
    <div>
        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6">
                <h4>Billing Details</h4>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6">
            <img src="picture/<?=$images[0]['file_name'];?>" class="image-fluid sd-flex w-100 h-50 rounded mb-4 justify-content-center" alt="Image">
                <h4>Order Summary</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div class="d-flex row gap-2"> 
                            <h6 class="my-0">Product </h6>
                            <small class="text-muted"> <?=$product['ProductName'];?></small>
                            <!-- <h6 class="my-0">Size </h6>
                            <small class="text-muted"> <?=$size;?></small> -->
                            <div class="col-4">
                                <button class="btn btn-dark w-100 py-2" disabled>US <?=$size;?></button>
                            </div>
                        </div>
                        <span class="text-muted"><?=number_format($discount);?></span>
                        <!-- <span class="text-muted"><?=$size;?></span> -->
                    </li>
                    <!-- <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Product 2</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Product 3</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$5</span>
                    </li> -->
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>$<?=number_format($discount);?></strong>
                    </li>
                </ul>

                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>

                
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo '
                    <script>Swal.fire({
                        icon: "success",
                        title: "Successfully Purchase!",
                        showConfirmButton: false,
                        timer: 1800
                    }).then(() => {
                        window.location = "index.php";
                    });
                  </script>'; 
                }
                ?>
                
                  <form method="post" action="">
                  <button type="submit" class="btn btn-primary w-100">Complete Purchase</button>
                  </form>
                
                
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
