<?php
    require 'config/db.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){  
        if(isset($_POST['ProductName']) && isset($_POST['Brand']) && isset($_POST['Category']) && isset($_POST['Size']) && isset($_POST['Color']) && isset($_POST['Price']) && isset($_POST['Discount']) && isset($_POST['ProductDescription']) && isset($_GET['id'])) {
            if ($_FILES['ImageFile']['tmp_name'][0]) {

                $fileTmpPaths = $_FILES['ImageFile']['tmp_name'];
                $fileNames = $_FILES['ImageFile']['name'];
                
                $uploadFolder = 'picture/';
                if (!is_dir($uploadFolder)) {
                    mkdir($uploadFolder, 0777, true);
                }
                
                $stmt = $conn->prepare("UPDATE products SET ProductName=:productname, Brand=:brand, Category=:category, Size=:size,Discount=:discount, Color=:color, Price=:price, ProductDescription=:productdescription WHERE ProductID=:id");
                $stmt->bindParam(':productname', $_POST['ProductName']);
                $stmt->bindParam(':brand', $_POST['Brand']);
                $stmt->bindParam(':category', $_POST['Category']);
                $stmt->bindParam(':size', $_POST['Size']);
                $stmt->bindParam(':color', $_POST['Color']);
                $stmt->bindParam(':price', $_POST['Price']);
                $stmt->bindParam(':discount', $_POST['Discount']);
                $stmt->bindParam(':productdescription', $_POST['ProductDescription']);
                $stmt->bindParam(':id', $_GET['id']);
                
                if ($stmt->execute()) {
                    
                    $rm = $conn->prepare("DELETE FROM images WHERE product_id=:id");
                    $rm->bindParam(':id', $_GET['id']);
                    
                    if ($rm->execute()) {
                        foreach ($fileNames as $index => $fileName) {
                            $fileTmpPath = $fileTmpPaths[$index];
                        
                            $fileInfo = pathinfo($fileName);
                            $fileBaseName = $fileInfo['filename'];
                            $fileExtension = $fileInfo['extension'];
                        
                            $newFileName = $fileBaseName . '_' . time() . '.' . $fileExtension;
                            $destPath = $uploadFolder . $newFileName;
                        
                            if (move_uploaded_file($fileTmpPath, $destPath)) {
                                    $insert = $conn->prepare("INSERT INTO images (file_name, product_id) VALUES (:file_name, :product_id)");
                                    $insert->bindParam(':file_name', $newFileName);
                                    $insert->bindParam(':product_id', $_GET['id']);
                                    $insert->execute();
                            } else {
                                header("location:editproduct.php?id=" . $_GET['id']);
                                exit;
                            }
                        }
                    }
        
                    header('location: admin.php');
                } else {
                    echo "Error inserting product.";
                }
            } else {
                $stmt = $conn->prepare("UPDATE products SET ProductName=:productname, Brand=:brand, Category=:category, Size=:size,Discount=:discount, Color=:color, Price=:price, ProductDescription=:productdescription WHERE ProductID=:id");
                $stmt->bindParam(':productname', $_POST['ProductName']);
                $stmt->bindParam(':brand', $_POST['Brand']);
                $stmt->bindParam(':category', $_POST['Category']);
                $stmt->bindParam(':size', $_POST['Size']);
                $stmt->bindParam(':color', $_POST['Color']);
                $stmt->bindParam(':price', $_POST['Price']);
                $stmt->bindParam(':discount', $_POST['Discount']);
                $stmt->bindParam(':productdescription', $_POST['ProductDescription']);
                $stmt->bindParam(':id', $_GET['id']);
                
                if($stmt->execute()){
                    header('location: admin.php');
                }
            }
        } else {
            header("location:editproduct.php?id=".$_GET['id']."");
        }
    }   
?>