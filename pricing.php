<?php session_start(); // starts session to check if user is logged in

if(!isset($_SESSION['login'])){ // check if user is login from session
    header("location:userlogin.php"); // user not logged in redirect to login page
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/barber.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.min.js" integrity="sha512-zuZ5wVszlsRbRF/vwXD0QS/tHzBYHFzCD/BT0lI3yrWhNZFWDkkF3KPEY//WTanqxwPdZkskQ+xZo0rnfHBc5A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="script/cursor.js"></script>
    <script defer src="script/request.js"></script>
    <title>Barbershop</title>
</head>
<body onload="getPrices()">
    <header class="profile-wrapper">
    <div class="container-header">
        <nav>
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <ul>
                <li class="nav-link"><a class="nav-link"  href="index.php">Home</a></li>
                <li class="nav-link"><a class="nav-link active" href="#">Pricing</a></li>
                <li class="nav-link"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-link"><a class="nav-link" href="aboutus.php">About Us</a></li>
                <li class="nav-link user"><img src="http://placehold.jp/50x50.png" alt="">
                    <ol>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="myappointments.php">Appointments</a></li>
                        <li><a href="#" onclick="logout()">Log Out</a></li>
                    </ol>
                </li>
            </ul>
        </nav>
    </div>
    <div class="pricing-container">
        <div class="price-title">
            <h2>Price List</h2>
            <p>Quality Services at affordable prices</p>
        </div>
        <div class="price-list" id="price-list"></div>

    </div>
    <div class="footer">
        <h2>ፈጠሮ ባርቤሪ</h2>
        <div class="logo">
            <img src="images/logo.png" alt="">
        </div>
        <div class="social">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-whatsapp"></i>
            
        </div>
         <div class="copyright">
                <p>&#169;Copyright | 2019. All Rights Reserved</p>
         </div>
        
    </div>
    <div class="mouse">
        <span class="mouse-text"></span>
    </div>