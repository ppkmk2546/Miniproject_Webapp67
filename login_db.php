<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        

        if (empty($email)) {
            $_SESSION['error'] = 'Please enter your email';
            header("location: login.php");
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email format is invalid';
            header("location: login.php");
        } else if(empty($password)) {
            $_SESSION['error'] = 'Please enter your password';
            header("location: login.php");
        } else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'The password must be between 5 and 20 characters long';
            header("location: login.php");
        } else {
            try {

                // ดึงตัวแปล conn ที่เชื่อมต่อกับฐานข้อมูล db.php
                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email"); // เช็คไม่ให้อีเมลซ้ำในระบบ
                $check_data->bindParam(":email" , $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($email == $row['email']){
                        if(password_verify($password, $row['password'])){
                            if($row['urole'] == 'admin'){
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin.php"); //ให้แอดมินไปหน้าของแอดมิน
                            } else {
                                $_SESSION['user_login'] = $row['id'];
                                header("location: index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'Password is incorrect';
                            header("location: login.php");
                        }
                    } else {
                        $_SESSION['error'] = 'Invalid email';
                        header("location: login.php");
                    }
                } else {
                    $_SESSION['error'] = "User information not found in the system";
                    header("location: login.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        
    }

?>