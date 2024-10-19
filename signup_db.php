<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = 'user';

        if (empty($username)) {
            $_SESSION['error'] = 'Please enter your username';
            header("location: sign-up.php");
        } else if(empty($email)) {
            $_SESSION['error'] = 'Please enter your email';
            header("location: sign-up.php");
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email format is invalid';
            header("location: sign-up.php");
        } else if(empty($password)) {
            $_SESSION['error'] = 'Please enter your password';
            header("location: sign-up.php");
        } else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'The password must be between 5 and 20 characters long';
            header("location: sign-up.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'Please confirm your password';
            header("location: sign-up.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'Passwords do not match';
            header("location: sign-up.php");
        } else {
            try {

                // ดึงตัวแปล conn ที่เชื่อมต่อกับฐานข้อมูล db.php
                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email"); // เช็คไม่ให้อีเมลซ้ำในระบบ
                $check_email->bindParam(":email" , $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "This email has already <a href='login.php'>Click here</a> to login";
                    header("location: sign-up.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(username, email, password, urole) 
                                            VALUES(:username, :email, :password, :urole)");
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "Registration completed successfully.! <a href='login.php' class='alert-link'>Click here</a> to login";
                    header("location: sign-up.php");
                } else {
                    $_SESSION['error'] = "Something went wrong";
                    header("location: sign-up.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>