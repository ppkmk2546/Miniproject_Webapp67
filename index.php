
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Flow Feet</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!--? CSS Bootstrap-->
    <link rel="stylesheet" href="Custom-Slider.css"> <!-- ? CSS Slider-->
    <link rel="stylesheet" href="card_index.css">  <!-- ? CSS Card Hover-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        html{
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <!--? promotion-->
    <header class="container-fluid text-center text-white" style="background-color: #606c38;">
        <p class="py-3 mb-0">Free shipping On Orders Over ฿2000.Free Return <a href="collection.php" class="text-white">Shop Now</a></p>
    </header>

    <!-- ? Navbar responsive humbuger menu -->
    <?php
        include "nav.php";
    ?>


    <!-- ? Slider-->
    <div id="carouselExampleIndicators" class="carousel slide">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">

          <div class="carousel-item c-item active">
            <img src="picture_slider/slid-1.jpg" class="d-block w-100 c-img" alt="slide-1">
            <div class="carousel-caption">
                <p class="display-3 fw-bold">Run Stronger, Run Farther</p>
                <p class="lead">Designed for support and comfort, our shoes help you run longer and injury free.</p>
                <a class="btn btn btn-success fw-bold shadow "style="margin:7px" href="collection.php">SHOP NOW</a><br>
                
            </div>
          </div>

          <div class="carousel-item c-item">
            <img src="picture_slider/slid-2.jpg" class="d-block w-100 c-img" alt="slide-2">
            <div class="carousel-caption">
                <p class="display-3 fw-bold">Relax, Walk, Repeat"</p>
                <p class="lead">Designed for all-day wear, our casual shoes give you the freedom to walk comfortably, wherever you go.</p>
                <a class="btn btn btn-success fw-bold shadow" style="margin:7px" href="collection.php">SHOP NOW</a><br>
            </div>
          </div>

          <div class="carousel-item c-item">
            <img src="picture_slider/slid-3.jpg" class="d-block w-100 c-img" alt="slide-3">
            <div class="carousel-caption">
                <p class="display-3 fw-bold">Your Everyday Adventure</p>
                <p class="lead">Versatile sneakers for every journey comfort and durability all day long.</p>
                <a class="btn btn btn-success fw-bold shadow" href="collection.php">SHOP NOW</a>
            </div>
          </div>

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

    <!--? Popular Product -->
    <div class="container">
        <!-- ? title -->
        <h2 id="product" class="pb-2 border-bottom pt-5 text-uppercase">Our Popular Product</h2>
        <div class="row pt-5 g-2 g-md-3">

        <?php 

            $stmt = $conn->prepare("SELECT * FROM products ORDER BY rating DESC LIMIT 4"); 
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($row as $data) {
                $image = $conn->prepare("SELECT file_name FROM images WHERE product_id=:id");
                $image->bindParam(':id', $data['ProductID']);
                $image->execute();
    
                $images = $image->fetchAll(PDO::FETCH_ASSOC);
                $discount = $data['Price'] * (100 - $data['Discount'])/100;
                
                echo '<div class="col-sm-12 col-md-3 col-lg-3">';
                echo '<div class="card shadow h-100 card-product-hover" style="width: 18rem; border: none;">';
                
                if ($data['Discount'] !== 0) {
                    echo '<div class="position-absolute top-0 start-0 badge bg-danger text-white p-2" style="font-size: 0.8rem; border-radius: 0;">SALE -'.$data['Discount'].'%</div>';
                }
                
                echo '<img src="picture/'.$images[0]['file_name'].'" class="card-img-top" alt="Nike Dunk Low Cacao">';
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title fw-bold">'.$data['ProductName'].'</h5>';
                echo '<p class="card-text text-muted text-truncate">'.$data['ProductDescription'].'</p>';
                echo '<div class="d-flex justify-content-center align-items-center mt-3">';
                $alt_star = $data['rating'] - 5;
                // echo $alt_star;
                for ($i = 0; $i < $data['rating']; $i++) {
                    echo '<span class="star fas fa-star text-warning"></span>';
                }
                for ($i = 0; $i > $alt_star; $i--) {
                    echo '<span class="star far fa-star text-warning"></span>';
                }
                // echo '<span class="star far fa-star text-warning"></span>';
                // echo '<span class="badge rounded-pill bg-light text-dark px-3 py-2 shadow-sm" style="font-size: 0.7rem;">'.$data['rating'].'</span>';
                echo '</div>';
                echo '<div class="d-flex justify-content-between align-items-center mt-4">';
                echo '<h5 class="mt-2">';
                if ($data['Discount'] !== 0) {
                    echo '<s>'.number_format($data['Price']).' ฿</s><strong class="ms-2 text-danger">'.number_format($discount).' ฿</strong>';
                } else {
                    echo '<strong class="ms-2">'.number_format($data['Price']).' ฿</strong>';
                }
                echo '</h5>';
                echo '<a class="btn btn-sm btn-outline-success" href="product.php?id='.$data['ProductID'].'">Shop Now</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        ?>
        </div>
    </div>

    <!-- ? Hero สโลแกนเว็บไซต์ -->
    <div class="container-fluid" style="background-color: #f3f3f3;">
        <div class="px-4 py-5 my-5 text-center">
            <h1 class="fw-bold">Walk with Confidence, Wear with Pride.</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead mb-4">Shop our stylish and comfortable shoes from top brands. Find your perfect pair and step out in confidence!</p>
            </div>
        </div>
    </div>
    
    
    <!-- ? Features Section อธิบายประเภทของรองเท้า -->

    <div class="container px-4 py-5" id="about">
        <h2 class="pb-2 border-bottom text-uppercase">Explore Our Features</h2>
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
          <div class="col d-flex flex-column align-items-start gap-2">
            <h2 class="fw-bold text-body-emphasis">Discover Comfort and Style</h2>
            <p class="text-body-secondary">Explore our collection of shoes that combine modern design with exceptional comfort. Whether running, working, or relaxing.</p>
            <a href="#" class="btn btn-success btn-lg shadow">Explore Collection</a>
          </div>
    
          <div class="col">
            <div class="row row-cols-1 row-cols-sm-2 g-4">
              <div class="col d-flex flex-column gap-2">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient fs-4 rounded-3 shadow" style="width: 2em; height: 2em;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h4 class="fw-semibold mb-0 text-body-emphasis">Running Shoes</h4>
                <p class="text-body-secondary">Lightweight and comfortable for peak performance.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient fs-4 rounded-3 shadow" style="width: 2em; height: 2em;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h4 class="fw-semibold mb-0 text-body-emphasis">Casual Shoes</h4>
                <p class="text-body-secondary">Stylish and versatile for everyday wear.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient fs-4 rounded-3 shadow" style="width: 2em; height: 2em;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h4 class="fw-semibold mb-0 text-body-emphasis">Sneakers</h4>
                <p class="text-body-secondary">Trendy designs for workouts and casual outings.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient fs-4 rounded-3 shadow" style="width: 2em; height: 2em;">
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
                <h4 class="fw-semibold mb-0 text-body-emphasis">Lifestyle Collection</h4>
                <p class="text-body-secondary">All-day comfort for daily adventures.</p>
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- ? วรรคแบ่งเส้น-->
    <div class="container">
        <hr>
    </div>

    <!-- ? Customers-->
    <div class="container my-5" id="contact">
        <h2 class="text-center text-uppercase mb-5">What Our Customers Say</h2>
        <div class="row g-4">
            
            <div class="col-md-4">
                <div class="card border-0 shadow p-4 h-100 card-customer">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2 fw-bold">Incredible Comfort and Style</h5>
    
                        <small class="text-muted mb-3">Reviewed on June 12, 2024</small>
    
                        <p class="card-text flex-grow-1 fst-italic text-muted">These shoes are a game-changer! They’re not only comfortable for long walks and runs, but their sleek design makes them perfect for everyday wear. My feet have never felt better!</p>
                        
                        <div class="card-footer d-flex align-items-center mt-3">
                            <img src="profille customer/profile-1.jpg" 
                                class="rounded-circle me-3 img-fluid shadow" 
                                alt="Adam K. ref.profile-1" 
                                style="max-width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Adam K.</h6>
                                <small class="text-muted">New York, NY</small>
                                <div class="d-flex justify-content-center align-items-center mt-1">
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card border-0 shadow p-4 h-100 card-customer">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2 fw-bold">Fast Shipping, Great Shoes</h5>
    
                        <small class="text-muted mb-3">Reviewed on August 20, 2024</small>
    
                        <p class="card-text flex-grow-1 fst-italic text-muted">The delivery was super quick, and the quality of the shoes is unbeatable. They fit perfectly and are incredibly comfortable for my daily runs. I’m definitely ordering again!</p>
                        
                        <div class="card-footer d-flex align-items-center mt-3">
                            <img src="profille customer/profile-2.jpg"
                                class="rounded-circle me-3 img-fluid shadow" 
                                alt="Linda M." 
                                style="max-width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Linda M.</h6>
                                <small class="text-muted">Los Angeles, CA</small>
                                <div class="d-flex justify-content-center align-items-center mt-1">
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star-half-alt text-warning me-1"></span> <!-- ? ดาวครึ่ง-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card border-0 shadow p-4 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2 fw-bold">All-day Comfort Guaranteed</h5>
    
                        <small class="text-muted mb-3">Reviewed on October 7, 2024</small>
    
                        <p class="card-text flex-grow-1 fst-italic text-muted">I’m on my feet for hours, and these shoes provide the perfect support. Not only are they comfortable, but they also add a touch of style to my wardrobe. Couldn’t be happier!</p>
                        
                        <div class="card-footer d-flex align-items-center mt-3">
                            <img src="profille customer/profile-3.jpg" 
                                class="rounded-circle me-3 img-fluid shadow" 
                                alt="Alex R." 
                                style="max-width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Alex R.</h6>
                                <small class="text-muted">Chicago, IL</small>
                                <div class="d-flex justify-content-center align-items-center mt-1">
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star fas fa-star text-warning me-1"></span>
                                    <span class="star far fa-star text-warning me-1"></span> <!-- ? เปล่า-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>

    

    <!--footer-->
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