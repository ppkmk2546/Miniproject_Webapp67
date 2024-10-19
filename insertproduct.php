<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'Please login!';
    header('location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    if (isset($_FILES['ImageFile']['name']) && is_array($_FILES['ImageFile']['name'])) {

        $fileTmpPaths = $_FILES['ImageFile']['tmp_name'];
        $fileNames = $_FILES['ImageFile']['name'];
        
        $uploadFolder = 'picture/';
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }
        
        $sql_update = "INSERT INTO products (ProductName, Brand, Category, Size, Color, Price, ProductDescription, Discount) 
                       VALUES (:productname, :brand, :category, :size, :color, :price, :productdescription, :discount)";
        $result = $conn->prepare($sql_update);
        $result->bindParam(':productname', $_POST['ProductName']);
        $result->bindParam(':brand', $_POST['Brand']);
        $result->bindParam(':category', $_POST['Category']);
        $result->bindParam(':size', $_POST['Size']);
        $result->bindParam(':color', $_POST['Color']);
        $result->bindParam(':price', $_POST['Price']);
        $result->bindParam(':discount', $_POST['Discount']);
        $result->bindParam(':productdescription', $_POST['ProductDescription']);
        
        if ($result->execute()) {
            $productId = $conn->lastInsertId();

            foreach ($fileNames as $index => $fileName) {
                $fileTmpPath = $fileTmpPaths[$index];
            
                $fileInfo = pathinfo($fileName);
                $fileBaseName = $fileInfo['filename'];
                $fileExtension = $fileInfo['extension'];
            
                $newFileName = $fileBaseName . '_' . time() . '.' . $fileExtension;
                $destPath = $uploadFolder . $newFileName;
            
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $stmt = $conn->prepare("INSERT INTO images (file_name, product_id) VALUES (:file_name, :product_id)");
                    $stmt->bindParam(':file_name', $newFileName);
                    $stmt->bindParam(':product_id', $productId);
                    $stmt->execute();
                } else {
                    header("location:editproduct.php?id=" . $productId);
                    exit;
                }
            }

            header('location: admin.php');
        } else {
            echo "Error inserting product.";
        }
    } else {
        echo "No files uploaded or invalid input.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <style>

        /* ตกแต่ง */
        
        body {
            background-color: #f8f9fa; /* สีพื้นหลังแบบอ่อน */
        }
        .container {
            max-width: 600px; /* กำหนดความกว้างฟอร์ม */
            margin-top: 50px; /* เพิ่มช่องว่างด้านบน */
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* เงา */
            border-radius: 10px; /* ทำมุมมน */
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        button {
            width: 100%;
        }

    </style>
</head>
<body>
    <div class="container"> 
        <a href="admin.php" class="link-secondary"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="text-center mb-4 fs-3">Insert Product</h1>

        <form action="insertproduct.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="ProductName" class="form-label text-muted">Product Name 
                    <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ProductName" name="ProductName" required>
            </div>
            
            <div class="mb-3">
                <label for="Brand" class="form-label text-muted">Brand
                    <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="Brand" name="Brand" required>
            </div>
                    
            <div class="mb-3">
                <label for="Category" class="form-label text-muted">Category
                    <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="Category" name="Category" required>
            </div>
                    
            <div class="mb-3">
                <label for="Size" class="form-label text-muted">Size
                    <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="Size" name="Size" required>
            </div>

            <div class="mb-3">
                <label for="Color" class="form-label text-muted">Color
                    <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="Color" name="Color" required>
            </div>

            <div class="mb-3">
                <label for="Price" class="form-label text-muted">Price
                    <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="Price" name="Price" required>
            </div>

            <div class="mb-3">
                <label for="Discount" class="form-label text-muted">Discount</label>
                <input type="text" class="form-control" id="Discount" name="Discount" required>
            </div>
            
            <div class="mb-3">
                <label for="ImageFile" class="form-label text-muted">ImageURL</label>
                <input type="file" class="form-control" id="ImageFile" name="ImageFile[]" accept="image/*" multiple required>
            </div>

            <div class="mb-3">
                <label for="ProductDescription" class="form-label text-muted">Product Description</label>
                <textarea type="text" class="form-control" id="ProductDescription" name="ProductDescription" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg">Submit</button>
        </form>

    </div>
      
    
</body>
<script src="js/bootstrap.min.js"></script>
</html>