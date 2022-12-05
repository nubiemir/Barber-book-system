<?php session_start(); // starts session to check if user logged in

if(!isset($_SESSION['login'])){// check if user is logged in from session
    header("location:userlogin.php");// user not logged in, redirect to login page
}else{
    $username = $_SESSION['user'];// user logged in, read username from session
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
    <script defer src="script/cursor.js"></script>
    <title>Barbershop</title>
</head>
<body>
    <div class="container-header">
        <nav>
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <ul>
                <li class="nav-link"><a class="nav-link"  href="index.php">Home</a></li>
                <li class="nav-link"><a class="nav-link" href="pricing.php">Pricing</a></li>
                <li class="nav-link"><a class=" active nav-link" href="#">Gallery</a></li>
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
    
    <div class="gallery-container">
        <div class="gallery-title">
            <h2>Gallery with our Cuts</h2>
            <p> A couple of minutes and voila - you got the best styling</p>
        </div>
        <div class="gallery-images">
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/1.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/2.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/3.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/4.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/5.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/6.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/7.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew"> 
                <img src="images/haricuts/8.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/9.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/10.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/11.jpeg" alt="">
            </div>
            <div class="gallery-card" class="skew">
                <img src="images/haricuts/12.jpeg" alt="">
            </div>
        </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.2/gsap.min.js" integrity="sha512-kVlGhj2qFy+KBCFuvjBJTGUMxbdqJKs4yK2jh0e0VPhWUPiPC87bzm4THmaaIee3Oj7j6sDpTTgm2EPPiESqBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.2/ScrollTrigger.min.js" integrity="sha512-mwNAdRfAgTFw7sywUyp8aLsHQN5qHd6PIX2K8zIbJLjGw0DyKriCK3sSs9IphpRqsNRvyRlP3HtbFtJIUofHJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // this is for animation of the images using gsap scroll trigger
let proxy = { skew: 0 },
    skewSetter = gsap.quickSetter(".gallery-card", "skewY", "deg"), // fast
    clamp = gsap.utils.clamp(-20, 20);  

ScrollTrigger.create({
  onUpdate: (self) => {
    let skew = clamp(self.getVelocity() / -300);
    if (Math.abs(skew) > Math.abs(proxy.skew)) {
      proxy.skew = skew;
      gsap.to(proxy, {skew: 0, duration: 0.8, ease: "power3", overwrite: true, onUpdate: () => skewSetter(proxy.skew)});
    }
  }
});

gsap.set(".gallery-card", {transformOrigin: "right center", force3D: true});
</script>
</body>
</html>