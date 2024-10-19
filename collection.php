
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection | Flow Feet</title>
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

    
    <?php
        include "nav.php";
    ?>

    <div class="container-fluid py-4" style="background-color: #f3f3f3;">
        <div class="container text-center">
            <div>
                <span class="text-body-secondary fs-3 fst-italic">Step into your perfect style choose the shoes that fit you best!</span>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 id="product" class="pb-3 border-bottom pt-4 text-uppercase">Collection</h2>
        <br>
        <div class="row col-12">
        <?php 
            $colorQuery = $conn->query("SELECT DISTINCT color FROM products WHERE color IS NOT NULL");
            $colors = $colorQuery->fetchAll(PDO::FETCH_COLUMN);

            $categoryQuery = $conn->query("SELECT DISTINCT category FROM products WHERE category IS NOT NULL");
            $categories = $categoryQuery->fetchAll(PDO::FETCH_COLUMN);

            $sizeQuery = $conn->query("SELECT DISTINCT size FROM products WHERE size IS NOT NULL");
            $sizes = $sizeQuery->fetchAll(PDO::FETCH_COLUMN);

            $brandQuery = $conn->query("SELECT DISTINCT brand FROM products WHERE brand IS NOT NULL");
            $brands = $brandQuery->fetchAll(PDO::FETCH_COLUMN);

            $selectedColors = isset($_GET['color']) ? $_GET['color'] : [];
            $selectedCategories = isset($_GET['category']) ? $_GET['category'] : [];
            $selectedSizes = isset($_GET['size']) ? $_GET['size'] : [];
            $selectedBrands = isset($_GET['brand']) ? $_GET['brand'] : [];
        ?>
    <form method="GET" id="filterForm" action="collection.php" class="col-3">
        <ul class="list-group mb-2">
        <li class="list-group-item d-flex justify-content-between align-items-center">Color
        <!-- <span class="badge text-bg-secondary rounded-pill">14</span> -->
            <?php foreach ($colors as $color): ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" name="color[]" value="<?= htmlspecialchars($color) ?>" id="<?= htmlspecialchars($color) ?>" onchange="this.form.submit()" <?php if (isset($_GET['color']) && in_array($color, $_GET['color'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($color) ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>

            <ul class="list-group mb-2">
            <li class="list-group-item d-flex justify-content-between align-items-center">Category
            
                <?php foreach ($categories as $category): ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" name="category[]" value="<?= htmlspecialchars($category) ?>" id="<?= htmlspecialchars($category) ?>" onchange="this.form.submit()" <?php if (isset($_GET['category']) && in_array($category, $_GET['category'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="list-group mb-2">
            <li class="list-group-item d-flex justify-content-between align-items-center">Size
            
                <?php foreach ($sizes as $size): ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" name="size[]" value="<?= htmlspecialchars($size) ?>" id="<?= htmlspecialchars($size) ?>" onchange="this.form.submit()" <?php if (isset($_GET['size']) && in_array($size, $_GET['size'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="<?= htmlspecialchars($size) ?>"><?= htmlspecialchars($size) ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="list-group mb-2">
            <li class="list-group-item d-flex justify-content-between align-items-center">Brand
            
                <?php foreach ($brands as $brand): ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" name="brand[]" value="<?= htmlspecialchars($brand) ?>" id="<?= htmlspecialchars($brand) ?>" onchange="this.form.submit()" <?php if (isset($_GET['brand']) && in_array($brand, $_GET['brand'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="<?= htmlspecialchars($brand) ?>"><?= htmlspecialchars($brand) ?></label>
                    </li>
                <?php endforeach; ?>
                
            </ul> 
    </form>

<div class="row col-9">
<?php
$filters = [];
$sql = "SELECT * FROM products WHERE 1=1"; 

if (!empty($selectedColors)) {
    $placeholders = implode(',', array_fill(0, count($selectedColors), '?'));
    $sql .= " AND color IN ($placeholders)";
    $filters = array_merge($filters, $selectedColors);
}

if (!empty($selectedCategories)) {
    $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));
    $sql .= " AND category IN ($placeholders)";
    $filters = array_merge($filters, $selectedCategories);
}

if (!empty($selectedSizes)) {
    $placeholders = implode(',', array_fill(0, count($selectedSizes), '?'));
    $sql .= " AND size IN ($placeholders)";
    $filters = array_merge($filters, $selectedSizes);
}

if (!empty($selectedBrands)) {
    $placeholders = implode(',', array_fill(0, count($selectedBrands), '?'));
    $sql .= " AND brand IN ($placeholders)";
    $filters = array_merge($filters, $selectedBrands);
}


$stmt = $conn->prepare($sql);
$stmt->execute($filters);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    foreach ($results as $row) {
        $image = $conn->prepare("SELECT file_name FROM images WHERE product_id=:id");
        $image->bindParam(':id', $row['ProductID']);
        $image->execute();

        $images = $image->fetchAll(PDO::FETCH_ASSOC);
        $discount = $row['Price'] * (100 - $row['Discount'])/100;
                
        echo '<div class="col-md-12 col-lg-4 mb-4">';
        echo '<div class="card border" style="border: none;">';
        
        if ($row['Discount'] !== 0) {
            echo '<div class="position-absolute top-0 start-0 badge bg-danger text-white p-2" style="font-size: 0.8rem; border-radius: 0;">SALE -'.$row['Discount'].'%</div>';
        }
        
        echo '<img src="picture/'.$images[0]['file_name'].'" class="card-img-top" alt="Nike Dunk Low Cacao">';
        echo '<div class="card-body text-center">';
        echo '<h5 class="card-title fw-bold">'.$row['ProductName'].'</h5>';
        // echo '<p class="card-text text-muted">Designed for performance with a sleek look.</p>';
        echo '<p class="card-text text-muted text-truncate">'.$row['ProductDescription'].'</p>';
        echo '<div class="d-flex justify-content-center align-items-center mt-3">';
        echo '<span class="star fas fa-star text-warning"></span>';
        echo '<span class="star fas fa-star text-warning"></span>';
        echo '<span class="star fas fa-star text-warning"></span>';
        echo '<span class="star fas fa-star text-warning"></span>';
        echo '<span class="star fas fa-star-half-alt text-warning"></span>';
        echo '<span class="badge rounded-pill bg-light text-dark px-3 py-2 shadow-sm" style="font-size: 0.7rem;">4.5</span>';
        echo '</div>';
        echo '<div class="d-flex justify-content-between align-items-center mt-4">';
        echo '<h5 class="mt-2">';
        if ($row['Discount'] !== 0) {
            echo '<s>'.number_format($row['Price']).' ฿</s><strong class="ms-2 text-danger">'.number_format($discount).' ฿</strong>';
        } else {
            echo '<strong class="ms-2">'.number_format($row['Price']).' ฿</strong>';
        }
        echo '</h5>';
        echo '<a class="btn btn-sm btn-outline-success" href="product.php?id='.$row['ProductID'].'">Shop Now</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No results found.";
}


?>
</div> <!--div ปิดทั้งหมด-->
   

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