<?php
session_start();
require_once 'config/db.php';

 ?>
 
<nav class="navbar navbar-expand-sm navbar-light sticky-top bg-white">  <!--เพิ่ม Sticky-top-->
        <!-- ? Content -->
        <div class="container">
            <!-- ? Brand -->
            <a href="index.php"   class="navbar-brand">
                <img src="picture/Logo.png" alt="Logo" width="50" height="50" class="logo ">
                Flow Feet
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- ? Menu -->
            <div class="collapse navbar-collapse" id="navbarToggle">
                <ul class="navbar-nav pe-3 ms-auto">
                    <li class="nav-item pe-3">
                        <a href="index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item pe-3">
                        <a href="#about" class="nav-link">About</a>
                    </li>
                    <li class="nav-item pe-3">
                        <a href="#contact" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item pe-3">
                        <a href="#product" class="nav-link">Product</a>
                    </li>
                    <li class="nav-item pe-3">
                        <a href="collection.php" class="nav-link">Collection</a>
                    </li>
                    <?php 
                    if (!isset($_SESSION['user_login'])) {
                        echo '
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-outline-success shadow-sm me-2" style="width: 120px;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="sign-up.php" class="btn btn btn-success shadow" style="width: 120px;">Sign-up</a>
                    </li>';
                    } else {
                        echo '
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-outline-dark shadow-sm me-2" style="width: 120px;">Logout</a>
                    </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
</nav>