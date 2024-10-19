<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'Please login!';
        header('location: login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <?php 

            if (isset($_SESSION['admin_login'])) {
                $admin_id = $_SESSION['admin_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id"); 
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>
        <div class="d-flex justify-content-between align-items-center"><h2 class="my-4">Welcome Admin <?=$row['username']?></h2><a href="logout.php" class="btn btn-danger" >Logout</a></div> 
        <hr>

    
    <div class="row">
        
    <div class="col-3 mb-4">
        <a href="insertproduct.php" class="card border text-dark d-flex text-center text-decoration-none align-items-center justify-content-center h-100 card-product-hover" style="width: 18rem; border: none;">
            <h1>+</h1>
        </a>
    </div>

        <?php 

            $stmt = $conn->prepare("SELECT * FROM products"); 
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($row as $data) {
                
                $image = $conn->prepare("SELECT file_name FROM images WHERE product_id=:id");
                $image->bindParam(':id', $data['ProductID']);
                $image->execute();
    
                $images = $image->fetchAll(PDO::FETCH_ASSOC);
                $discount = $data['Price'] * (100 - $data['Discount'])/100;
                
                echo '<div class="col-3 mb-4">';
                echo '<div class="card border h-100 card-product-hover" style="width: 18rem; border: none;">';
                
                if ($data['Discount'] !== 0) {
                    echo '<div class="position-absolute top-0 start-0 badge bg-danger text-white p-2" style="font-size: 0.8rem; border-radius: 0;">SALE -'.$data['Discount'].'%</div>';
                }
                
                echo '<img src="picture/'.$images[0]['file_name'].'" class="card-img-top" alt="Nike Dunk Low Cacao">';
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title fw-bold">'.$data['ProductName'].'</h5>';
                echo '<p class="card-text text-muted text-truncate">'.$data['ProductDescription'].'</p>';
                echo '<div class="d-flex justify-content-center align-items-center mt-3">';
                echo '<span class="star fas fa-star text-warning"></span>';
                echo '<span class="star fas fa-star text-warning"></span>';
                echo '<span class="star fas fa-star text-warning"></span>';
                echo '<span class="star fas fa-star text-warning"></span>';
                echo '<span class="star fas fa-star-half-alt text-warning"></span>';
                // echo '<span class="badge rounded-pill bg-light text-dark px-3 py-2 shadow-sm" style="font-size: 0.7rem;">4.5</span>';
                echo '</div>';
                echo '<div class="d-flex justify-content-between align-items-center mt-4">';
                echo '<h5 class="mt-2">';
                if ($data['Discount'] !== 0) {
                    echo '<label class="text-decoration-line-through text-muted">'.number_format($data['Price']).' ฿</label><strong class="ms-2 text-danger">'.number_format($discount).' ฿</strong>';
                } else {
                    echo '<strong class="ms-2">'.number_format($data['Price']).' ฿</strong>';
                }
                echo '</h5>';
                echo '<div class="d-flex justify-content-end gap-2">';
                echo '<a class="btn btn-sm btn-secondary mr-2" href="editproduct.php?id='.$data['ProductID'].'">Edit</a>';
                // echo '<a class="btn btn-sm btn-danger " href="deleteproduct.php?id='.$data['ProductID'].'">Delete</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        ?>
        </div>
        </div>



    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>