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
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/barber.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;1,300,500;1&family=Poppins:wght@200&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script defer src="script/book.js"></script>
    <script defer src="script/cursor.js"></script>
    <script defer src="script/ripple.js"></script>
    <script defer src="script/request.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <title>Barber Shop</title>
</head>
<body>
    <header>
        <div class="wrapper">
            <nav>
                <div class="logo">
                    <img src="images/logo.png" alt="Logo">
                </div>
                <ul>
                    <li class="nav-link"><a class="active nav-link"  href="#">Home</a></li>
                    <li class="nav-link"><a class="nav-link" href="pricing.php">Pricing</a></li>
                    <li class="nav-link"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-link"><a class="nav-link" href="aboutus.php">About Us</a></li>
                    <!-- <li class="nav-link"><a href="login.php"><button>Login In</button></li></a>
                    <li class="nav-link"><a href="register.php"><button>Register</button></a></li> -->
                    <li class="nav-link user"><img src="http://placehold.jp/50x50.png" alt="">
                        <ol>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="myappointments.php">Appointments</a></li>
                            <li><a href="#" onclick="logout()">Log Out</a></li>
                        </ol>
                    </li>
                </ul>
            </nav>
            <div class="description">
                <div class="title">
                    <h1>We Create and Renovate</h1>
                    <p>Hair Style Trends</p>
                </div>
                <div class="moto">
                    <p>A good haircut is only a moment away—make an appointment today.</p>
                    <button id="book">Make Appointment</button>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="row intro">
            <div class="row-image">
                <img src="images/guy-barbershop.jpg" alt="">
            </div>
            <div class="row-detail">
                <h4>Never Ask a Barber if You Need a Haircut</h4>
                <p id="moto-text">Beardy is an amazing barbershop located in the heart of the Upper West Side Manhattan</p>
                <p id="moto-detail">The barbers from our barbershop can not only provide you with the most comfortable hairdresser services but bear the good company to chat during the entire procedure. Not to mention the variety of drinks in our bar.</p>
            </div>
        </div>
        <div class="row services">
            <div class="row-title">
                <h3>Our Services</h3>
            </div>
                <div class="services-card">

                    <div class="card">
                        <img src="images/items/cut.png" alt="">
                        <h5 class="service-title">Hair Cutting</h5>
                        <p class="service-detail">Get the best haircut in your life made by our barbers.</p>
                    </div>
                
                    <div class="card">
                        <img src="images/items/shave.png" alt="">
                        <h5 class="service-title">Shaving</h5>
                        <p class="service-detail">We are going to shave your with a grandpa’s method.</p>
                    </div>
                

               
                    <div class="card">
                        <img src="images/items/style.png" alt="">
                        <h5 class="service-title">Styling</h5>
                        <p class="service-detail">Need a new haircut styling? Welcome to our barbershop.</p>
                    </div>
               

                
                    <div class="card">
                        <img src="images/items/trim.png" alt="">
                        <h5 class="service-title">Trimming</h5>
                        <p class="service-detail">Cutting hair on your face according to your length.</p>
                    </div>
                </div>
        
        </div>
    <div class="row reviews">
        <div class="review-container" id="review-container">
            
        </div>
     
    </div>
    <div class="row team">
        <div class="row-title">
            <h3>Our Team</h3>
        </div>
        <div class="team-slider swiper mySwiper">
            <!-- <button class="left arrow">
                <i class="fa-solid fa-angles-left"></i>
            </button> -->
            <div class="team-container swiper-wrapper" >
                <!-- <div class="team-card swiper-slide">
                    <img src="http://placehold.jp/380x450.png" alt="">
                    <p>Name</p>
                    <p>Title</p>
                </div>
                <div class="team-card swiper-slide">
                    <img src="http://placehold.jp/380x450.png" alt="">
                    <p>Name</p>
                    <p>Title</p>
                </div>
                <div class="team-card swiper-slide">
                    <img src="http://placehold.jp/380x450.png" alt="">
                    <p>Name</p>
                    <p>Title</p>
                </div>
                <div class="team-card swiper-slide">
                    <img src="http://placehold.jp/380x450.png" alt="">
                    <p>Name</p>
                    <p>Title</p>
                </div>
                <div class="team-card swiper-slide">
                    <img src="http://placehold.jp/380x450.png" alt="">
                    <p>Name</p>
                    <p>Title</p>
                </div>
                <div class="team-card swiper-slide">
                    <img src="http://placehold.jp/380x450.png" alt="">
                    <p>Name</p>
                    <p>Title</p>
                </div> -->
            </div>
            <!-- <button class="right arrow">
                <i class="fa-solid fa-angles-right"></i>
            </button> -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div> 
    </div>
    <div class="row contact">
        <div class="contact-details">
            <h4>Contact Information</h4>
            <p>Do not be shy to describe your future hairstyle via phone call or email.</p> 
            <div class="address">
                <div class="location">
                    <img src="http://placehold.jp/50x50.png" alt="">
                    <span>Address: <b id="street"></b></span>
                </div>
                <div class="phone">
                    <img src="http://placehold.jp/50x50.png" alt="">
                    <span>Call US: <b id="phone"></b> </span>
                </div>
                <div class="email">
                    <img src="http://placehold.jp/50x50.png" alt="">
                    <span>E-mail: <b id="email"></b> </span>
                </div>
            </div>
        </div>
        <div class="map">
            <img src="http://placehold.jp/900x700.png" alt="">
        </div>
    </div>
    <div class="row feedback">
        <h3>Feedback, Our Breakfast</h3>
        <p>Please Share your experience with us</p>
        <form action="" method="POST">
            <div class="alert"></div>
            <textarea name="feed" id="feed_msg" cols="40" rows="5" placeholder="Write your message *" required></textarea>
            <button>Send Feedback</button>
        </form>
    </div>
    </section>
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
    <div class="appointment">
        <div class="appointment-form">
            <div id="alert"></div>
            <form action="" method="POST" class="form" id="form">
                <h3>Booking Appointment</h3>
                <div class="form-control">
                    <label for="date">Pick a Date</label>
                    <input data-date-format="d-m-Y" name="date" type="date" id="date" placeholder="Select DateTime" required>
                </div>
                <div class="form-control">
                    <label for="date">Appointment Time</label>
                    <input data-date-format="d-m-Y" name="date" type="time" id="time" placeholder="Select Time" min="08:00" max="20:00" required>
                </div>
                
                <div class="form-control chose">
                    <label for="date">Service</label>
                    <select name="service-book" id="service_choice" placeholder="Select Services" class="form-control" required>
                    </select>
                </div>
                <div class="form-button">
                    <button type="submit">Book</button>
                </div>
                <div class="close">
                    +
                </div>
            </form>
        </div>
      </div>
      
<script>
        
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.min.js" integrity="sha512-zuZ5wVszlsRbRF/vwXD0QS/tHzBYHFzCD/BT0lI3yrWhNZFWDkkF3KPEY//WTanqxwPdZkskQ+xZo0rnfHBc5A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let d = new Date().toJSON().slice(0, 10); // create date object and slice it
    const date = document.querySelector('#date'); // hold element with date id
    date.min = d; // set minimum date for booking appointment today
    const user = "<?php echo $username?>"; // store username

    //
    window.addEventListener('load',()=>{ // window loaded
        getContactInfo(); // invoke function to get details about contact
        getServices(); // invoke function to get services info
        getReviews(); // invoke function to get revies details
        getEmployeeInfo(); // invoke function to get details about employee
    })
    //
    const feedbackForm = document.querySelector('.feedback form'); // hold feedback form element
    feedbackForm.addEventListener('submit',(e)=>{ // listens form submit
        e.preventDefault(); // prevent page refresh on form submit
        submitReview(user); // submit review of a user
    })

</script>
<script>
// this is for a image slide of the employees image
    window.setTimeout(()=>{
        var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    },1000)
    
</script>
</body>
</html>