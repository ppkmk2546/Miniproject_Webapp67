<?php
require 'config/db.php';

if (!isset($_GET['id'])) {
    header('location:index.php');
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE ProductID=:id"); 
$stmt->bindParam(':id', $id);
$stmt->execute();
$product = $stmt->fetch();
$discount = $product['Price'] * (100 - $product['Discount'])/100;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$product['ProductName']?> | Flow Feet</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!--? CSS Bootstrap-->

    <!--? ICON FRONT-AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!--? promotion-->
    <header class="container-fluid text-center text-white" style="background-color: #606c38;">
        <p class="py-3 mb-0">Fast Delivery & Free Returns on All Orders!</p>
    </header>

    <?php include 'nav.php';?>

    <div class="container-fluid py-4" style="background-color: #f3f3f3;">
        <div class="container text-center">
            <div>
                <span class="text-body-secondary fs-3 fst-italic">Exclusive Deals Today – Hurry, Limited Stock!</span>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <!--breadcrumb-->
        <div class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="user.php" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="collection.php" class="text-dark">Collection</a></li> <!--แก้ตรง link-->
                    <li class="breadcrumb-item active">Shoes</li>
                </ol>
            </div>

        </div>

        <div class="row">

            <?php

            $image = $conn->prepare("SELECT file_name FROM images WHERE product_id=:id");
            $image->bindParam(':id', $id);
            $image->execute();

            $images = $image->fetchAll(PDO::FETCH_ASSOC);
            ?>

            
            <!-- ? Gallery Section -->
            <div class="col-md-6"> <!-- ? คอมลัม 6-->

                <!-- <div class="row g-2"> -->

                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators d-flex justify-content-start m-0">
                        <?php
                            $i = 0;
                            foreach ($images as $img) {
                                $active = $i == 0 ? 'active' : '';
                                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'" class="'.$active.' w-25" aria-current="true" aria-label="Slide '.($i+1).'">';
                                echo '<img src="picture/'.$img['file_name'].'" class="d-block w-100 mt-4" alt="'.$img['file_name'].'">';
                                echo '</button>';
                                $i++;
                            }
                        ?>
                    </div>

                    <div class="carousel-inner" style="z-index: 10;">
                        <?php
                            $i = 0;
                            foreach ($images as $img) {
                                $active = $i == 0 ? 'active' : '';
                                echo '<div class="carousel-item '.$active.'">';
                                echo '<img src="picture/'.$img['file_name'].'" class="d-block w-100" alt="'.$img['file_name'].'">';
                                echo '</div>';
                                $i++;
                            }
                        ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    
                </div>

            </div>

            <!-- ? Product Details Section -->
            <!--? size-->
            <!-- ? button -->
            <form action="checkout.php" method="get" class="col-md-6">
                <h2 class="display-5 fw-bold"><?=$product['ProductName'];?></h2>
                
                <?php
                if ($product['Discount'] !== 0) {
                ?>
                <s class="fs-5 fw-bold">฿<?=number_format($product['Price']);?></s><strong class="ms-2 text-danger fs-5 fw-bold">฿<?=number_format($discount);?></strong>
                <?php
                } else {
                ?>
                    <p class="fs-5 fw-bold">฿<?=number_format($product['Price']);?></p>
                <?php
                }
                ?>

                
                

                <div class="mb-3">
                    <!-- <label class="form-label">Size: <?=$product['Size'];?> </label> -->
                    <div class="row g-2 text-center">
                        <div class="col-2">
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <input type="radio" class="btn-check" name="size" value="4" id="4"<?=$product['Size'] === 4 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 4 ? ' disabled' : ''; ?>" for="4">US 4</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="4.5" id="4.5"<?=$product['Size'] === 4.5 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 4.5 ? ' disabled' : ''; ?>" for="4.5">US 4.5</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="5" id="5"<?=$product['Size'] === 5 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 5 ? ' disabled' : ''; ?>" for="5">US 5</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="5.5" id="5.5"<?=$product['Size'] === 5.5 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 5.5 ? ' disabled' : ''; ?>" for="5.5">US 5.5</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="6" id="6"<?=$product['Size'] === 6 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 6 ? ' disabled' : ''; ?>" for="6">US 6</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="6.5" id="6.5"<?=$product['Size'] === 6.5 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 6.5 ? ' disabled' : ''; ?>" for="6.5">US 6.5</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="7" id="7"<?=$product['Size'] === 7 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 7 ? ' disabled' : ''; ?>" for="7">US 7</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="7.5" id="7.5"<?=$product['Size'] === 7.5 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 7.5 ? ' disabled' : ''; ?>" for="7.5">US 7.5</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="8" id="8"<?=$product['Size'] === 8 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 8 ? ' disabled' : ''; ?>" for="8">US 8</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="8.5" id="8.5"<?=$product['Size'] === 8.5 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 8.5 ? ' disabled' : ''; ?>" for="8.5">US 8.5</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="9" id="9"<?=$product['Size'] === 9 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 9 ? ' disabled' : ''; ?>" for="9">US 9</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="9.5" id="9.5"<?=$product['Size'] === 9.5 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 9.5 ? ' disabled' : ''; ?>" for="9.5">US 9.5</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="10" id="10"<?=$product['Size'] === 10 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 10 ? ' disabled' : ''; ?>" for="10">US 10</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" class="btn-check" name="size" value="11" id="11"<?=$product['Size'] === 11 ? ' required' : ''; ?>>
                            <label class="btn btn-outline-dark w-100 py-2<?=$product['Size'] !== 11 ? ' disabled' : ''; ?>" for="11">US 11</label>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="mb-3">
                    <button type="submit" class="btn btn-success py-4 rounded-3 w-100" style="font-weight: bold;">
                        Buy Now
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>

                <div class="mb-3">
                    <button class="btn btn-outline-dark py-4 rounded-3 w-100" style="font-weight: bold;">
                        Add to Favorites
                        <i class="fa-regular fa-star"></i>
                    </button>
                </div>


                <div class="mt-4">
                    <h5>
                        <i class="fa-solid fa-circle-info"></i>
                        Product Information
                    </h5>
                    <p class="word-wrap text-muted">
                        <?=$product['ProductDescription'];?>
                    </p>

                    <hr> <!--? เส้นวรรค-->

                    <h5>
                        <i class="fa-solid fa-truck-fast"></i>
                        Shipping Information
                    </h5>
                    <p class="text-muted">
                        We offer free shipping on orders over 2,000 ฿. Your order will be processed within 1-3
                        business days, and you can expect delivery within 5-7 business days.
                    </p>
                </div>

            </form>

        </div>
    </div>

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">© 2024 Flow Feet, Inc</p>
        
            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
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