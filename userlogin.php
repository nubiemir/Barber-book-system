<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" type="image/x-icon" href="images/barber.png" />
    <link rel="stylesheet" href="user.css" />
    <script defer src="script/request.js" type="text/javascript"></script>
    <script defer src="script/formValidation.js" type="text/javascript"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
      integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Barbershop</title>
  </head>
  <body>
    <main>
        <div class="container">
          <form id="form" class="form">
            <h2 id="register">Log In</h2>
            <div class="form-control">
              <label for="username">Username</label>
              <input type="text" id="username" placeholder="Enter username" />
              <small>Error message</small>
            </div>
            <div class="form-control">
              <label for="password">Password</label>
              <input type="password" id="password" placeholder="Enter password" />
              <small>Error message</small>
            </div>
            <button type="submit">Login</button>
            <div class="form-control register-link">
                <p>Not a Member yet ? <a href="register.php">Sign Up</a></p>
            </div>
            <div id="invalid" style="color: red;text-align: center;margin: 1rem;">

            </div>
          </form>
      </div>
      
    </main>
    <script>

      const form = document.getElementById("form");
      const username = document.getElementById("username");
      const email = document.getElementById("email");
      const password = document.getElementById("password");


      form.addEventListener("submit", (e) => {
        e.preventDefault();
       
        requiredCheck([username,password]);
        lengthCheck(username, 4);
        lengthCheck(password, 6);


        const formControl = document.querySelectorAll('.success').length;

        if (!formControl === 2) {
          //
          return;
        }
        $(document).ready(function () {
          login();
        });
        
      });
    </script>
  </body>
</html>
