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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Edit Product</title>

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

    </style>
    
</head>
<body>
    <?php
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE ProductID=:id"); 
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch();          
    ?>      
        
            <div class="container">
                <a href="admin.php" class="link-secondary"><i class="fa-solid fa-arrow-left"></i></a> 
                <h1 class="text-center mb-4 fs-3">Edited Product</h1>
                
                
                <form action="editproductaction.php?id=<?=$product['ProductID']?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="ProductName" class="form-label text-muted">Product Name</label>
                        <input type="text" class="form-control" id="ProductName" name="ProductName" value="<?=$product['ProductName']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Brand" class="form-label text-muted">Brand</label>
                        <input type="text" class="form-control" id="Brand" name="Brand" value="<?=$product['Brand']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Category" class="form-label text-muted">Category</label>
                        <input type="text" class="form-control" id="Category" name="Category" value="<?=$product['Category']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Size" class="form-label text-muted">Size</label>
                        <input type="number" class="form-control" id="Size" name="Size" value="<?=$product['Size']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Color" class="form-label text-muted">Color</label>
                        <input type="text" class="form-control" id="Color" name="Color" value="<?=$product['Color']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Price" class="form-label text-muted">Price</label>
                        <input type="number" class="form-control" id="Price" name="Price" value="<?=$product['Price']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Discount" class="form-label text-muted">Discount</label>
                        <input type="text" class="form-control" id="Discount" name="Discount" value="<?=$product['Discount']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="ImageFile" class="form-label text-muted">ImageURL</label>
                        <input type="file" class="form-control" id="ImageFile" name="ImageFile[]" accept="image/*" multiple>
                    </div>

                    <div class="mb-3">
                        <label for="ProductDescription" class="form-label text-muted">Product Description</label>
                        <textarea class="form-control" id="ProductDescription" name="ProductDescription" rows="3"><?=$product['ProductDescription']?></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success btn-lg w-25">Submit</button>
                        <!-- Replace confirm with SweetAlert -->
                        <a class="btn btn-danger btn-lg w-25" href="deleteproduct.php?id=<?=$product['ProductID']?>" onclick="return showDeleteAlert(event);">Delete</a>
                    </div>
                </form>
            </div>
            
    
</body>
<script src="js/bootstrap.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showDeleteAlert(event) {
    event.preventDefault();

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });

    return false;
}
</script>

</html>