function getAboutInfo() {
  // a function to retrieve the about info from the db and display it on the website

  const title = document.querySelector("#about-title"); // hold the element with about title id
  const img = document.querySelector("#about-img"); // hold the img element 
  const detail = document.querySelector(".about-details"); // hold the p element with about details class

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getAboutInfo" },
    success: function (response) { 
      title.value = response["title"]; // update the title value from response db
      img.src = `./images/${response["image"]}`; // update the img src from response db
      detail.innerText = response["description"]; // update the value 
    },
  });
}

function getContactInfo() {
  // a function to retreive the information about contact
  // the contact info includes address, phone and email
  // the ajaxt makes request to the server
  // and when the response is recieved the data is displayed in its respective element

  const street = document.querySelector("#street");
  const phone = document.querySelector("#phone");
  const email = document.querySelector("#email");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getContactInfo" },
    success: function (response) {
      street.innerText = response["street"];
      phone.innerText = response["phone"];
      email.innerText = response["email"];
    },
  });
}

function getServices() {
// a function to get information about services
// ajax request is made to the controller to retrieve information about services
// then the information is displayed as options in the booking form

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "getServices",
    },
    success: function (response) {
      //
      let html = "";
      response.forEach((data) => { // loop through each response 
        html += `<option value='${data["name"]}'>${data["name"]}</option> `; // update html with option for each service
      });
      $("#service_choice").html(html); // display html
    },
  });
}

function getPrices() {
  // function to retrieve info about prices of services
  // ajax request is made to the server to get services prices
  // then the data is displayed in the pricing page
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "getServices",
    },
    success: function (response) { // data from server recieved
      //
      let html = ""; // initialte html
      response.forEach((data) => { // loop through each data
        html += `<div class="price"><h5 class="service-name">${data["name"]}</h5><p class="service-price">AED${data["price"]}</p></div>`; // update html with pricing info
      });
      $("#price-list").html(html); // display html in the pricing page
    },
  });
}

function getProfileInfo(user) {
  // function to get information such as name, email and date of registration of a logged in user
  // para: username
  // displays the user information in the profile page

  const username = document.querySelector("#profile_name");
  const email = document.querySelector("#profile_email");
  const date = document.querySelector("#profile_date");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "getProfileInfo",
      username: user,
    },
    success: function (response) { // response recieved
      username.innerText = response["name"]; // update value of username
      email.innerText = response["email"]; // update value of email
      const dt = new Date(response["date"]).toLocaleDateString("en-us", {
        year: "numeric",
        month: "short",
      });
      date.innerText = dt; // update value of date
    },
  });
}

function submitReview(user) {
  // a function to submit a review posted by a logged in user
  // takes username and sends request to the server
  // upon success messae recieval it alerts users about the submission of the post
  // para:username

  const msgAlert = document.querySelector(".alert");
  const msg = document.querySelector("#feed_msg");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "submitReview",
      username: user,
      msg: msg.value,
    },
    success: function (response) { // response recieved
      if (response["success"]) { // if response is success
        msgAlert.innerText = "Thanks for your feedback"; // alert success message
        msgAlert.classList.add("alert-success"); // alert success message
        window.setTimeout(() => { // message will be displayed for 2.5s before disappearing
          msgAlert.innerText = "";
          msgAlert.classList.remove("alert-success");
        }, 2500);
        msg.value = "";
      }
    },
  });
}

function getReviews() {
  // a function to get reviews from the server and display the approved reviews
  // sends ajax request with request name getReviews
  // upon response recieval it inovkes a function to animate the display of the reviews

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "getReviews",
    },
    success: function (response) { // response recieved
      //
      let html = ""; // initialized html for each review
      response.forEach((data) => { // loop through each review data
        html += `<div class="review-item">
        <p class="quote-icon"><i class="fa-solid fa-quote-left"></i></p>
        <p class="review">${data["review"]}</p>
        <p class="author">${data["name"]}</p>
    </div>`; // update html with div element with name and review
      });
      $("#review-container").html(html); // display html
      const reviews = document.querySelectorAll(".review-item"); // holds all reviews
      displayReviews(reviews); // invoke function to create slideshow of reviews 
    },
  });
}

function displayReviews(reviews) {
  // a function to create a carousel of the reviews
  // para: reviews

  let index = 0; // initialize index to zero

  window.setInterval(() => { // each review will move after 3s (review will be displayed for 3 second)
    reviews.forEach((review) => { // loop through each review
      review.style.display = "none"; // make each review invisible
    });
    index++; // increament index
    index = index > reviews.length - 1 ? 0 : index; // if the review is the last one, slideshow should start from the first one

    reviews[index].style.display = "block"; // make the review with current index animate to be displayed
    reviews[index].style.animation = "animate 1s"; // add animation for the display of the review
  }, 3000);
}

function bookAppointment(user, date, time, service) {
  // a function to book an appointment
  // para: username,data,time,service
  // sends request to server with the parameters as data
  // for a successful booking it notifies user 

  const msg = document.querySelector("#alert");
  const appointementForm = document.querySelector(".appointment");
  const wrapper = document.querySelector(".wrapper");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "bookAppointment",
      user: user,
      date: date.value,
      time: time.value,
      service: service.value,
    },
    success: function (response) { // response from server recieved
      if (response["success"]) { // check if response is success
        msg.innerText =
          "Thanks for booking with us, We will send you an email regarding the status of you appointment"; // update success msg
        msg.classList.add("alert-success"); // display the success message
        window.setTimeout(() => { // after 2.5s the success message disappears and the input is emptied
          msg.innerText = "";
          msg.classList.remove("alert-success");
          appointementForm.classList.remove("active");
          wrapper.classList.remove("inactive");
          clearInput([date, time]);
        }, 2500);
      }
    },
  });
}

function getAppointments(user) {
  // a function to get appointments booked by a certain logged in user
  // para:username
  // sends request to server and upon data recieval generates table of appointment for the user

  const apptBody = document.querySelector("#appt_body");
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getAppointments", user: user },
    success: function (response) { // response from server
      generateAppointmentTable(response); // generate the appointment table based on the data from the server
    },
  });
}

function register() { 
  // a function to register a user 
  // sends request to server with the 5 input values
  // request is made to register.php

  const username = $("#username").val();
  const firstname = $("#firstname").val();
  const lastname = $("#lastname").val();
  const email = $("#email").val();
  const password = $("#password").val();

  $.ajax({
    method: "POST",
    url: "server/register.php",
    dataType: "json",
    data: {
      username: username,
      fname: firstname,
      lname: lastname,
      email: email,
      password: password,
    },
    success: function (response) { // response recieved from the server
      if (!response["success"]) { // if registration was not  success
        $("#credential_inuse").text("Sorry, Username or E-mail is already taken"); // display the error message
      } else {
        location.href = "congratulation.php"; // successful registraion, redirect user to congratuilation page
      }
    },
  });
}

function login() {
  // a function to login a user
  // sends request to server with data of username, password
  // upon the response arrival if the procedure was a success user is redirects to another page
  // request is made to login.php
  const username = $("#username").val();
  const password = $("#password").val();

  $.ajax({
    method: "POST",
    url: "server/login.php",
    dataType: "json",
    data: {
      username: username,
      password: password,
    },
    success: function (response) { // response recieved
      if (!response["success"]) { // login failed
        $("#invalid").text(response["message"]); // error message is displayed
      } else { // login success
        location.href = "index.php"; // user is redirected
      }
    },
  });
}

function logout() {
  // a function to logout user
  // request is send to logout.php
  // successful logout: user is redirected to login page
  $.ajax({
    method: "POST",
    url: "server/logout.php",
    dataType: "json",
    success: function (response) {
      if (response["success"]) {
        location.href = "userlogin.php";
      }
    },
  });
}

function clearInput(inputs) {
  // a function to clear input values after form submission
  // para: input element
  inputs.forEach((input) => { // loops through each input 
    input.value = ""; // reset input value
  });
}

function generateAppointmentTable(response) {
  // a function to generate appointment table based on the response recieved from the server
  // para: response
  let html = ""; // initialize html for display
  for (let i in response) { // loop through each data in the response
    //  fetch the data
    const id = response[i]["appointment_id"];
    const date = response[i]["appointment_date"];
    const time = response[i]["appointment_time"];
    const service = response[i]["service_name"];
    const price = response[i]["price"];
    const status = response[i]["status"];

    let badge; // hold class name based on appointment status
    if (status == "Pending") { // status is pending
      badge = "badge bg-warning"; // class bg-warning (yellow)
    } else if (status == "Rejected") { // status is rejected
      badge = "badge bg-danger"; // class bg-danger (red)
    } else { // status is approved
      badge = "badge bg-success"; // class bg-success (green)
    }

    html += `<tr><td>${id}</td><td>${date}</td><td>${time}</td><td>${service}</td><td>${price}</td><td><span class="${badge} action">${status}</span></td></tr>`; // update html with the fetched valus of each appointment
  }
  $("#appt_body").html(html); // display the appointments made by the user in the myappointment page
}

function getEmployeeInfo() {
  // a function to get information such as name and img of each employee
  // sends request to server
  // when data from server is recieved the data is displayed as html
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getEmployeeInfo" },
    success: function (response) { // response recieved
      html = ""; // initialize html for display
      response.forEach((data) => { // loop through each data 
        html += `<div class="team-card swiper-slide">
                  <img src="./images/employee/${data["img"]}" alt="">
                  <p>${data["name"]}</p>
                </div>`; // update html to hold employee name and image
      });
      $(".team-container").html(html); // display employee name and info as html
    },
  });
}

function updateProfile(user){
  // a function to update logged in user profile
  // para: username
  // sends request along side username to update profile
  // if the response message is successful, alert message is displayed

  const username = $('#username').val();
  const password = $('#password').val();
  const email = $('#email').val();

  $.ajax({
    method:"POST",
    url:"server/controller.php",
    dataType:"json",
    data:{
      request:"updateProfile",
      username:username,
      password:password,
      email:email,
      user:user
    },
    success:function(response){ // response recieved
      if(response['success']){ // profile updated succesfuly?
        $("#alert").text("Changes made succesful"); // alert the user with success message
        $("alert").addClass("alet-success");
        window.setTimeout(()=>{ // after 1 second disappear the success message and logout user and redirect to login page
        $("#alert").text("");
        $("alert").removeClass("alet-success");
        $("#close_edit").click();
        logout();
        location.href="userlogin.php";
        },1000)
      }
    }
  })
}

function deleteAccount(user){
  // a function to delet an account of user
  // it requests for account deletion 
  // and upon a successful deletion user is directed to log in page
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "deleteAccount",user:user },
    success: function (response) { // response recieved
      if (response['success']){
        location.href="userlogin.php";
      }
      
    },
  });
}