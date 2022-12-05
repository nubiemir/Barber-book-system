<?php session_start(); // start session to check for login

if(!isset($_SESSION['login'])){ // check if user is logged in
    header("location:userlogin.php"); // user not logged in redirect to login page
}
$username = $_SESSION['user']; // if user logged in retrieve username
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/barber.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="script/profile.js"></script>
    <script defer src="script/cursor.js"></script>
    <script defer src="script/formValidation.js"></script>
    <script defer src="script/request.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Barbershop</title>
</head>
<body>
    <header class="profile-wrapper">
    <div class="container-header">
        <nav>
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <ul>
                <li class="nav-link"><a class="nav-link"  href="index.php">Home</a></li>
                <li class="nav-link"><a class="nav-link" href="pricing.php">Pricing</a></li>
                <li class="nav-link"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-link"><a class="nav-link" href="aboutus.php">About Us</a></li>
                <li class="nav-link user"><img src="http://placehold.jp/50x50.png" alt="">
                    <ol>
                        <li><a href="#">Profile</a></li>
                        <li><a href="myappointments.php">Appointments</a></li>
                        <li><a href="#" onclick="logout()">Log Out</a></li>
                    </ol>
                </li>
            </ul>
        </nav>
    </div>
    <div class="profile-container">
        <div class="profile">
            <div class="profile-form">
                <div class="form-group">
                    <label for="">Username</label>
                    <p id="profile_name">username</p>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <p>********</p>
                </div>
                <div class="form-group">
                    <label for="">E-mail</label>
                    <p id="profile_email">E-mail</p>
                </div>
                <div class="form-group bottom">
                    <p>Member since <span id="profile_date">Date</span></p>
                    <div class="btn-profile">
                        <button id="update-profile"><i class="fa-solid fa-pen"></i>  Update Profile</button>
                        <button id="btn-delete-profile"> <i class="fa-solid fa-trash-can"></i>  Delete Profile</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</header>
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
    <div class="modal_edit">
        <div class="edit-profile">
            <form id="profile_form"  action="" method="POST">  
            <div class="alert form-control"></div>
                <div class="form-control">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Enter username"  required  />
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter password"  required />
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="email" required >Email</label>
                    <input
                      type="email"
                      id="email"
                      name="email"
                      placeholder="Enter email"
                    />
                    <small>Error message</small>
                </div>
                <div class="form-control" style="display: flex;justify-content: space-between;">
                    <button id="close_edit"  class="btn-edit-profile" style="background-color: red;">Close</button>
                    <button id="save" type="submit" class="btn-edit-profile" style="background-color: green;">Save Changes</button>
                </div>

                </div> 
            </form>
            
        </div>
    </div>
    <div class="modal-delete">
        <div class="delete-profile">
            <h4>Are you sure you want to delete your profile ?</h4>
            <p>Deleting your profile will result in deleting your appointments.</p>
            <div class="btn-row">
              <button id="cancel-delete" class="btn btn-secondary">Cancel</button>
              <button type="submit" id="delete_user_profile" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
 <script>
    const form = document.getElementById("profile_form"); // hold form element
    const username = document.getElementById("username"); // hold username input element
    const email = document.getElementById("email"); // hold email input element
    const password = document.getElementById("password"); // hold password input element
    const user = "<?php echo $username?>"; // store the username 

    window.addEventListener('load',()=>{ // window loaded
        getProfileInfo(user); // invoke function to get profile info for a user
    })
    form.addEventListener("submit", (e) => { // listens for form submission
      e.preventDefault(); // prevent page refresh upon submit

      if (requiredCheck([username, email, password])) { // check that input values are not empty
        lengthCheck(username, 4); // invoke function to check length of username input
        lengthCheck(password, 6); // invoke function to check lengh of password input
        emailCheck(email); // invoke function to check validity of email
      }

      const formControl = document.querySelectorAll(".success").length; // store the number of input elements with succes class

      if (!formControl == 3) { // check if all inputs are valid
        //
        return; // if not valid form is not submitted
      }
      $(document).ready(function(){
        updateProfile(user); // invoke function to update profile of a certain user
      })
      
    });
    const deleteUser = document.querySelector('#delete_user_profile'); // delete element
    deleteUser.addEventListener('click',()=>{ // delete account requested
        deleteAccount(user); // invoke function
    })
   
        
    
</script> 
</body>
</html>