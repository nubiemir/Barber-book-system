<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        <form id="form" class="form" action="./server/register.php">
          <h2 id="register">Register With Us</h2>
          <div class="form-control">
            <label for="firstname">First Name</label>
            <input
              type="text"
              name="fname"
              id="firstname"
              placeholder="Enter firstname"
            />
            <small>Error message</small>
          </div>
          <div class="form-control">
            <label for="lastname">Last Name</label>
            <input
              type="text"
              name="lname"
              id="lastname"
              placeholder="Enter lastname"
            />
            <small>Error message</small>
          </div>
          <div class="form-control">
            <label for="username">Username</label>
            <input
              type="text"
              name="username"
              id="username"
              placeholder="Enter username"
            />
            <small>Error message</small>
          </div>
          <div class="form-control">
            <label for="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Enter email"
            />
            <small>Error message</small>
          </div>
          <div class="form-control">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter password"
            />
            <small>Error message</small>
          </div>
          <div class="form-control">
            <label for="password2">Confirm Password</label>
            <input
              type="password"
              id="password2"
              placeholder="Enter password again"
            />
            <small>Error message</small>
          </div>
          <button type="submit">Submit</button>
          <div id="credential_inuse" style="color: red;text-align: center;margin: 1rem;">

          </div>
        </form>
      </div>
    </main>
    <script>
      const form = document.getElementById("form"); // holds form element
      const fname = document.getElementById("firstname"); // holds firstname input element
      const lname = document.getElementById("lastname"); // holds lastname input element
      const username = document.getElementById("username"); // holds username input element
      const email = document.getElementById("email"); // holds email input element
      const password = document.getElementById("password"); // holds password input element
      const password2 = document.getElementById("password2"); // holds password2 input element

      

      form.addEventListener("submit", (e) => { // listens for form submission
        e.preventDefault(); // prevent page referesh upon page submission

        if (requiredCheck([username, email, password, password2, fname, lname])) { // check if all input values are not empty
          lengthCheck(username, 4); // invoke function to check for length of username
          lengthCheck(password, 6);// invoke function to check for password lenght 
          passwordMatch(password, password2); // inovoke function to check for password match
          emailCheck(email);// invoke function to check for email validity
        }

        const formControl = document.querySelectorAll(".success").length; // counts input elements with success class

        if (!formControl == 6) { // check if all required inputs are valid
          //
          return; // if any input not valid, form is not submitted
        }
        $(document).ready(function () {
          register(); // if all inputs are valid register function is invoked to register user
        });
      });
    </script>
  </body>
</html>
