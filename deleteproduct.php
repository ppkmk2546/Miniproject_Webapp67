<?php
    require 'config/db.php';

    if($_SERVER['REQUEST_METHOD'] === 'GET'){  
        if(isset($_GET['id'])) {
            $stmt = $conn->prepare("DELETE FROM products WHERE ProductID=:id");
            $stmt->bindParam(':id', $_GET['id']);
            
            if($stmt->execute()){
                $rm = $conn->prepare("DELETE FROM images WHERE product_id=:id");
                $rm->bindParam(':id', $_GET['id']);
                if ($rm->execute()) { 
                    header('location: admin.php');
                }
            }
        } else {
            header("location: admin.php");
        }
    }   
?>