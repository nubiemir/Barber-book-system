const deleteId = document.querySelector("#delete_id"); // holds the service item to be deleted
const editId = document.querySelector("#edit_id"); // holds the item to be edited


function getAppointments() { 
  // a function to get all appointments booked by users
  // then it creates a table of appointments
  // it has also sort and order data send to the server

  const order = document.querySelector("#order").value;
  const sort = document.querySelector("#sort").value;

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getAppointments", order: order, sort: sort }, // request :function name,order:Asc/Desc,sort:Date
    success: function (response) {
      //   generate_tasks_table(response);
      generateAppointmentTable(response);
    },
  });
}

function getServices() {
  // a function to get all services offered
  // then upon response from the server it creates a services table based on the response
  // it also sends data with regard to order and sort 

  const order = document.querySelector("#order").value;
  const sort = document.querySelector("#sort").value;

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getServices", order: order, sort: sort }, 
    success: function (response) {
      generateServiceTable(response); // generate services
    },
  });
}

function addService() {
  // a function to add a servcie based on a certain input
  // it sends the name, duration and price of a service to the server
  // waits for message of success or failure
  // upon the response it displays either error message or success message
  // it will be failure if there is already another service with the same name (service name should be unique)

  const serviceName = $("#name").val();
  const serviceDuration = $("#duration").val();
  const servicePrice = $("#price").val();

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "addService",
      servname: serviceName,
      servduration: serviceDuration,
      servprice: servicePrice,
    },
    success: function (response) { // response recieved
      if (!response["success"]) { // adding service unsuccessful due to name duplication
        // display error message to admin
        document.querySelector("#alert").classList.add("alert-danger");
        $("#alert").text(response["message"]);
        window.setTimeout(() => {
          $("#alert").text("");
          document.querySelector("#alert").classList.remove("alert-danger");
        }, 2500);
      } else { // adding service successful 
        // display success message to admin
        $("#success").text("A new service successfully added");
        document.querySelector("#success").classList.add("alert-success");
        $("#close").click(); // close pop up
        clearInput(); // clear the pop input values
        getServices(); // invoke to get services with the new service included
        window.setTimeout(() => { // disappear the success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 3500);
      }
    },
  });
}

function getClients() {
  // a function to get all the clients registered
  // sends request to the server to retrieve clients and also sends order and sort data
  // it also sends search value (name of customer), which by default (if not input) is empty string

  const order = document.querySelector("#order").value;
  const sort = document.querySelector("#sort").value;
  const search = document.querySelector("#search").value;

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getClients", order: order, sort: sort,search:search },
    success: function (response) {
      generateClientTable(response); // generate table
    },
  });
}

function getEmployees() {
  // a function to get all employees information
  // sends request to the server, along with order, sort and search value
  // when response is recieved table is generated

  const order = document.querySelector("#order").value;
  const sort = document.querySelector("#sort").value;
  const search = document.querySelector("#search").value;


  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getEmployees", order: order, sort: sort,search:search },
    success: function (response) {
      generateEmployeeTable(response); // generate table
    },
  });
}

function generateAppointmentTable(response) { 
  // a function that loops through response and generate table of appointments
  // para: response

  let html = ""; // initialize emtyp html
  for (let i in response) { // loop through the response and fetch data
    const id = response[i]["appointment_id"];
    const date = response[i]["appointment_date"];
    const time = response[i]["appointment_time"];
    const customer = response[i]["customer_name"];
    const service = response[i]["service_name"];
    const price = response[i]["price"];
    const status = response[i]["status"];

    
    let badge; // to hold class that responds to the value of status
    if (status == "Pending") { // status is pending
      badge = "badge bg-warning"; // badge is bg-warning (yellow)
    } else if (status == "Rejected") { //status is rejected
      badge = "badge bg-danger"; // badge is bg-danger (red)
    } else {// status is approved
      badge = "badge bg-success"; // badge is bg-success (green)
    }

    html += `<tr class="align-middle"><td>${id}</td><td>${date}</td><td>${time}</td><td>${customer}</td><td>${service}</td><td>${price}</td><td><span class="${badge} action">${status}</span></td><td><select name="action" id="action" class="p-2" data-id="${id}">
                          <option value="">--take action</option>
                          <option value="Approved">Accept</option>
                          <option value="Rejected">Reject</option>
                    </select>  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editApptModal" onClick="getAppointmentInfo(${id})">Edit</button>  <button class="btn btn-danger" onclick="deleteAppointment(${id})">Delete</button></td></tr>`;
  }; // update html with row for each response data
  $("#appointment_table").html(html); // display html table

  const takeAction = document.querySelectorAll("#action"); // holds the select element of either accepting or rejecting appointment
  takeAction.forEach((action) => { // loop through the options 
    action.addEventListener("change", (e) => { // event listerner if option is changed
      const id = e.srcElement.dataset["id"]; // holds id of the appointment
      const actionValue = e.target.value; // holds the action value (approve, reject)
      appointmentApproval(actionValue, id); // invoke function to take action 
    });
  });
}

function generateServiceTable(response) {
  // a function to generate services table based on response from server
  // para: response

  let html = ""; // initialize html empty 
  for (let i in response) { // loop through each response and fetch data
    const id = response[i]["service_id"];
    const name = response[i]["service_name"];
    const duration = response[i]["service_duration"];
    const price = response[i]["service_price"];

    html += `<tr class="align-middle" ><td>${id}</td><td>${name}</td><td>${duration} min</td><td>${price} AED</td><td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal" onClick="getServiceInfo(${id})">Edit</button> <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onClick="deletePop(${id})">Delete</button></td></tr>`; // update html with a table row that holds data from the response
  }
  $("#service_table").html(html); // display services table
}

function generateClientTable(response) {
  // function to generate table of clients based on the response from the server
  // para: response

  let html = ""; // initialize empty html to store table row
  for (let i in response) { // loop through the response and fetch data
    const id = response[i]["client_id"];
    const name = response[i]["client_name"];
    const username = response[i]["client_username"];
    const phone = response[i]["client_phone"];
    const email = response[i]["client_email"];
    const date = response[i]["client_date"];

    html += `<tr class="align-middle" ><td>${id}</td><td>${name}</td><td>${username}</td><td>${phone}</td><td>${email}</td><td>${date}</td></tr>`; // update the html with a table row using the fetched data
  }
  $("#client_table").html(html); // display the clients table
}

function generateEmployeeTable(response) {
  // a function to generate table of employees based on the response from the server
  // para: response 

  let html = ""; // initialize empty html
  for (let i in response) { // loop through the response and fetch data
    const id = response[i]["id"];
    const name = response[i]["name"];
    const city = response[i]["city"];
    const phone = response[i]["phone"];
    const gender = response[i]["gender"];
    const salary = response[i]["salary"];
    const img = response[i]["img"];

    html += `<tr class="align-middle" ><td>${id}</td><td>${name}</td><td>${gender}</td><td>${city}</td><td>${phone}</td><td>${salary}AED</td><td><img width="100" height="140" src="../images/employee/${img}" alt=""></td><td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editemployeeModal" onClick="getEmpInfo(${id})">Edit</button> <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#deleteModal" onClick="getDeleteId(${id})" >Delete</button></td></tr>`; // update html with table row using data from the response
  }
  $("#employee_table").html(html); // display html
}

function getDeleteId(id){
  // a function to get the id of employee
  // invoked when user clicks on the delete button 
  // then the value of the id is store in a hidden input
  const deleteId = document.querySelector('#secret_delete_id');
  deleteId.value = id;
}

function deleteEmployee(){
  // function to delete a ceratain employee
  // retrieve the id of the employee to be deleted 
  // then sends request to server to delete it
  // deletion successful: message is displayed
  const deleteId = document.querySelector('#secret_delete_id');

  $.ajax({
    method:"POST",
    url:"server/controller.php",
    dataType:"json",
    data:{
      request:"deleteEmployee",
      id:deleteId.value
    },
    success:function(response){ // response recieved
      if (response["success"]) { // successful response
        $('#cancel').click(); // close pop up
        // display successful deletion message
        $("#success").text("Employee deleted successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getEmployees(); // get all employees (most recent)
        window.setTimeout(() => { // disappear the success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    }
  })
}

function getEmpInfo(id){
  // function to get employee id
  // para: id
  // it uses the id to send request to retrieve information about an employee
  // then the info of the employee replaces the value of the edit input values

  const city = document.querySelector("#empcity");
  const phone = document.querySelector("#empphone");
  const salary = document.querySelector("#empsalary");
  const secret = document.querySelector('#secret');
  secret.value = id; // upon clicking of edit button the value of id is stored in a hidden input element

  $.ajax({
    method:"POST",
    url:"server/controller.php",
    dataType:"json",
    data:{
      request:"getEmpInfo",
      id:id
    },
    success:function(response){ // response recieved and update input value
      city.value = response['city'];
      phone.value = response['phone'];
      salary.value = response['salary'];
    }
  })
  
}

function updateEmployee(){
  // function to update information about employee
  // sends city, phone and salary value to be updated
  // and id to specify which employee
  // editing is successful: success message is displayed

  const id = document.querySelector('#secret').value;
  const city = document.querySelector("#empcity").value;
  const phone = document.querySelector("#empphone").value;
  const salary = document.querySelector("#empsalary").value;

  $.ajax({
    method:"POST",
    url:"server/controller.php",
    dataType:"json",
    data:{
      request:"updateEmployee",
      id:id,
      city:city,
      phone:phone,
      salary:salary
    },
    success:function (response){ // response is recieved
      if (response["success"]) { // successful update of employee info
        $("#editclose").click(); // close pop up
        // display message, then get table with updated information, and then disappear the success message
        $("#success").text("Changes made successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getEmployees();
        window.setTimeout(() => {
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    }
  })


}

function deletePop(id) {
  // a function to hold the id of service to be deleted
  // para:id
  // when delete button is clicked the value of the id of the service is stored
  deleteId.value = id;
}

function deleteService() {
  // function to delete a service
  // it uses the id that was stored in the function deleteopop
  // sends the delete request and waits for response
  // response arrive: for a successful deletion appropriate message is displayed
  const serviceId = deleteId.value;

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "deleteService", id: serviceId },
    success: function (response) { // response 
      if (response["success"]) { // deletion successful
        // display succes message, then get new table with updated information, and disappear success message
        $("#success").text("Service deleted successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getServices();
        window.setTimeout(() => {
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}
function deleteAppointment(id) {
  // function to delete a appointment
  // it uses the id that was stored in the function deleteopop
  // sends the delete request and waits for response
  // response arrive: for a successful deletion appropriate message is displayed

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "deleteAppointment", id: id },
    success: function (response) { // response 
      if (response["success"]) { // deletion successful
        // display succes message, then get new table with updated information, and disappear success message
        $("#success").text("Service deleted successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getAppointments();
        window.setTimeout(() => {
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}

function getServiceInfo(id) {
  // a function to retrieve information about a service
  // para:id (service code)
  // then the information of the service is used for the input value of the service to be updated

  const name = document.querySelector("#edit_name");
  const duration = document.querySelector("#edit_duration");
  const price = document.querySelector("#edit_price");

  editId.value = id; // edit button clicked then service code is stored

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getServiceInfo", serviceId: id },
    success: function (response) {
      name.value = response["service_name"];
      duration.value = response["service_duration"];
      price.value = response["service_price"];
    },
  });
}

function editService() { 
  // a function to edit service details
  // uses the service code and details such as service name, duration and price
  // sends data to server and upon response shows appropriate message of success
  const serviceId = editId.value;
  const servname = $("#edit_name").val();
  const servduration = $("#edit_duration").val();
  const servprice = $("#edit_price").val();

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "editService",
      serviceId: serviceId,
      name: servname,
      duration: servduration,
      price: servprice,
    },
    success: function (response) { // response from server
      if (response["success"]) { // edit service successful
        // show success message
        $("#success").text("Changes made successfuly");
        document.querySelector("#success").classList.add("alert-success");
        $("#edit_close").click(); // close pop up
        getServices(); // get services with new info from server and generate update table
        window.setTimeout(() => { // disappear message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}

function getAppointmentInfo(id) {
  // a function that retrieves info about a specific appointment based on the id of the appointment
  // para : id
  // the information is used in the edit modal input values

  const date = document.querySelector("#edit_date");
  const time = document.querySelector("#edit_time");
  const editId = document.querySelector("#edit_appt_id");

  editId.value = id; // holds the value of appo id
  let d = new Date().toJSON().slice(0, 10); // creates date object

  date.min = d; // set minimum date to today

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getAppointmentInfo", apptId: id },
    success: function (response) { // response and update value of the input values
      date.value = response["date"];
      time.value = response["time"];
    },
  });
}

function getAboutInfo() {
  // a function to get details from the about table
  // retrieves info such as title , image name and description
  // upon response arrival the info is displayed in the respective input elements

  const title = document.querySelector("#about_title");
  const image = document.querySelector("#view_img");
  const description = document.querySelector("#description");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getAboutInfo" },
    success: function (response) { // 
      title.value = response["title"];
      image.src = `../images/${response["image"]}`;
      description.value = response["description"];
    },
  });
}

function getContactInfo() {
  // a function to get info about contact from server 
  // sends request to get address,phone and email from server
  // display the info recieved inthe input values
  const street = document.querySelector("#street");
  const phone = document.querySelector("#phone");
  const email = document.querySelector("#email");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getContactInfo" },
    success: function (response) {
      // update values of the input using data from response
      street.value = response["street"];
      phone.value = response["phone"];
      email.value = response["email"];
    },
  });
}

function updateAboutInfo() {
  // a function to update the about table
  // sends requesto to server with values such as title, image name and description
  // upon successful update appropriate message is displayed

  const title = $("#about_title").val();
  const description = document.querySelector("#description").value;

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "updateAboutInfo",
      img: imgName,
      title: title,
      description: description,
    },
    success: function (response) {
      if (response["success"]) { // successful update of about table
        // display success message
        $("#success").text("Changes made successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getAboutInfo(); // get the update information 
        window.setTimeout(() => { // disappear the success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}

function updateContactInfo() {
  // a function to update the values of the contact table
  // sends the new data of address, phone and email to server
  // upon successful updation appropritate message is displayed

  const street = $("#street").val();
  const phone = $("#phone").val();
  const email = $("#email").val();

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "updateContactInfo",
      street: street,
      phone: phone,
      email: email,
    },
    success: function (response) { // response recieved
      if (response["success"]) { // successful update
        // display success message
        $("#success").text("Changes made successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getContactInfo(); // get new info regarding contact
        window.setTimeout(() => { // disappear the success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}

function clearInput() {
  // a function to clear input values of service upon form submission afer add service function is succussful
  
  const serviceName = document.querySelector("#name").value;
  const serviceDuration = document.querySelector("#duration").value;
  const servicePrice = document.querySelector("#price").value="";
}

function getNotificationCount() {
  // a function to get the number of appointments that are not read (new)
  // sends request to server and upon response update the notification bell number with the reponse value
  const notificationCount = document.querySelector("#notification");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getNotificationCount" },
    success: function (response) { // response recieved
      notificationCount.innerText = response["count"]; // update the notification count in the html
      if (response["count"] > 0) { // if the notification count is greater than zero
        $("#notification-msg").text(`${response["count"]} new appointments`); // update the notification drop down message with the number of new appointments
      } else { // else the message should read that there are no new appointments
        $("#notification-msg").text("no new appointments");
      }
    },
  });
}

function updateAppointmentRead() {
  // a function to update the status of read of appointments
  // this function sends request to update the notification count
  // it is invoked when user clicks on the notification count 
  // upon successful response user is redirected to the appointments table
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "updateAppointmentRead" },
    success: function (response) { // response recieved
      if (response["success"]) { // successful response
        getNotificationCount(); // get the recent notification count
        location.href = "appointments.php"; // redirect user to appointments page
      }
    },
  });
}

function appointmentApproval(actionValue, id) {
  // a function to update the status of appointment based on the id of the appointment and the action 
  // para: actionvalue,id
  // action value is either reject or approve
  // for a succussful response appropriate message is displayed

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "appointementApproval", action: actionValue, id: id },
    success: function (response) {
      if (response["success"]) { // successful apporoval
        // display success message
        $("#success").text("Action made successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getAppointments(); // get a new table with the latest information
        window.setTimeout(() => { // disappear success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}

function getEntitiesCount() {
  // a function to get the number of row of 4 tables
  // the tables are employee, customer, services,and appointments
  // the value is then displayed in the dashboard cards
  // upon response from server the value of the request is displayed in html

  const employees = document.querySelector("#employees");
  const customers = document.querySelector("#clients");
  const services = document.querySelector("#services");
  const appointments = document.querySelector("#appointments");

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "getEntitiesCount" },
    success: function (response) {
      employees.innerText = response["empCount"];
      services.innerText = response["servCount"];
      customers.innerText = response["custCount"];
      appointments.innerText = response["apptCount"];
    },
  });
}

function getReviews() {
  // a function to get all the reviews from the server
  // sends also order and sort data
  // when response is recieved a reviews table is generated

  const order = document.querySelector("#order").value;
  const sort = document.querySelector("#sort").value;

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "getReviews",
      order: order,
      sort: sort,
    },
    success: function (response) {
      generateReviewsTable(response); // generate table
    },
  });
}

function generateReviewsTable(response) {
  // a function to generate reviews table based on response from server
  let html = ""; // initialize the html 
  for (let i in response) { // loop through each data in the response and fetch it
    const id = response[i]["id"];
    const reviewer = response[i]["name"];
    const review = response[i]["review"];
    const status = response[i]["status"];

    let badge; // badge to show status of the review
    if (status == "Pending") {
      badge = "badge bg-warning"; // yellow
    } else if (status == "Rejected") {
      badge = "badge bg-danger"; // red
    } else {
      badge = "badge bg-success"; // green
    }

    html += `<tr class="align-middle"><td>${id}</td><td>${reviewer}</td><td>${review}</td><td><span class="${badge} action">${status}</span></td><td><select name="action" id="action" class="p-2" data-id="${id}">
                          <option value="">--take action</option>
                          <option value="Approved">Accept</option>
                          <option value="Rejected">Reject</option> </select>
                          <button class="btn btn-danger" onClick={deleteReview(${id})}>Delete</button></td></tr>`;
  }; // update the html with a table row using the data from response
  $("#review_table").html(html); // display html

  const takeAction = document.querySelectorAll("#action"); // select element options
  takeAction.forEach((action) => { // loop through each option
    action.addEventListener("change", (e) => { // listens for a change in option
      const id = e.srcElement.dataset["id"]; // get the id of the review
      const actionValue = e.target.value; // get the action to be taken(approve,reject)
      reviewApproval(actionValue, id); // update the status of the review
    });
  });
}

function reviewApproval(actionValue, id) {
  // a function to update the status of a specific review
  // para: actionvalue,id
  // sends request to server to update stats
  // successful update: appropriate message displayed
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: { request: "reviewApproval", action: actionValue, id: id },
    success: function (response) {
      if (response["success"]) { // successful approval
        // display success message
        $("#success").text("Action made successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getReviews(); // get latest info regardin the reviews and new table
        window.setTimeout(() => { // disappear success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}

function deleteReview(id) {
  // a function to delete a review
  // para:id
  // this function is triggered by the click of delete button in a row of review
  // sends request alongside with review id for review deletion
  // successful deletion: appropriate message is displayed
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "deleteReview",
      id: id,
    },
    success: function (response) {
      if (response["success"]) { // successful delete
        // display appropriate message
        $("#success").text("Review deleted successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getReviews(); // get latest review info
        window.setTimeout(() => { // disappear success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}


function getCustomersInfo() {
  // a function to retrieve the names and id of customers
  // the it creates a drop down with all the registered users in the appointment table for adding appointment
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "getClients",
      order: "",
      sort: "",
      search:""
    },
    success: function (response) { // response
      let html = ""; // initialize empty html
      response.forEach((data) => { // loop through each data in response
        html += `<option value="${data["client_id"]}">${data["client_name"]}</option>`; // create option for each customer
      });
      $("#customer_select").html(html); // display the dropdown
    },
  });
}

function getServiceNameInfo() {
  // a function to get name all services
   // the it creates a drop down with all the service names in the appointment table for adding appointment 
  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "getServices",
      order: "",
      sort: "",
    },
    success: function (response) { // response
      let html = ""; // initialize empty html
      response.forEach((data) => { // loop through each data in the response
        html += `<option value="${data["service_id"]}">${data["service_name"]}</option>`; // create drop down option for each service
      });
      $("#service_select").html(html); // display service dropdown
    },
  });
}

function addAppointment() {
  // a function to add a n appointment for a user
  // send requesto with data of customer id, service code,date and time
  // upon succesful booking appropriate message is displayed

  const customer = $("#customer_select").val();
  const service = $("#service_select").val();
  const date = $("#add_date").val();
  const time = $("#add_time").val();

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "addAppointment",
      customer: customer,
      service: service,
      date: date,
      time: time,
    },
    success: function (response) {
      if (response["success"]) { // booking successful
        // display appropriate message
        $("#success").text("Appointment Added Successfuly");
        document.querySelector("#success").classList.add("alert-success");
        $("#close-add").click(); // close pop up
        getAppointments(); // get latest appointment inro with the new appointments
        window.setTimeout(() => { // disappear the success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    },
  });
}

function editAppointment() {
  // a function to edit an appointment
  // sends request with new data and time
  // succesful edit results in success message

  const editId = $("#edit_appt_id").val();
  const date = $("#edit_date").val();
  const time = $("#edit_time").val();

  $.ajax({
    method: "POST",
    url: "server/controller.php",
    dataType: "json",
    data: {
      request: "editAppointment",
      id:editId,
      date: date,
      time: time,
    },
    success: function (response) {
      if (response["success"]) { // edit successful
        // display success message
        $("#alert").text("Changes made successfuly");
        document.querySelector("#alert").classList.add("alert-success");
        getAppointments(); // display all the latest appointments along with the edited ones
        window.setTimeout(() => { // disappear the success message
          $("#alert").text("");
          document.querySelector("#alert").classList.remove("alert-success");
          $("#close").click();
        }, 2000);
       
      }
    },
  });
}

function addEmployee(){
  // a function to add a new employee
  // sends data from the input values
  // on a succesful adding of employee success message is displayed

  const fname = $('#fname').val();
  const lname = $('#lname').val();
  const city = $('#city').val();
  const phone = $('#phone').val();
  const salary = $('#salary').val();
  const gender = $('#gender').val();

  $.ajax({
    method:"POST",
    url:"server/controller.php",
    dataType:"json",
    data:{
      request:"addEmployee",
      fname:fname,
      lname:lname,
      img:img,
      city:city,
      phone:phone,
      salary:salary,
      gender:gender
    },
    success:function(response){
      if (response["success"]) { // employee added successfuly
        $('#close').click(); // close pop up
        // display success message
        $("#success").text("Employee Record Added successfuly");
        document.querySelector("#success").classList.add("alert-success");
        getEmployees(); // get employee latest info
        window.setTimeout(() => { // disappear success message
          $("#success").text("");
          document.querySelector("#success").classList.remove("alert-success");
        }, 2500);
      }
    }
  })


}

function login(){
  // a function for an admin to login
  // sends username and password\
  // successful login result in redirecting of user to the admin home page

  const username = $("#username").val();
  const password = $("#password").val();

  $.ajax({
    method:"POST",
    url:"server/login.php",
    dataType:"json",
    data:{
      username:username,
      password:password
    },
    success: function (response) {
      if (!response["success"]) { // unsuccessful login
        $("#invalid").text(response["message"]); // display error message
      } else { // login successful
        location.href = "index.php"; // redirect user
      }
    },
  })
}

function logout(){
  // a function to logout an admin user
  // successful logout redirects user to login page
  $.ajax({
    method:"POST",
    url:"server/adminlogout.php",
    dataType:"json",
    success:function(response){
      if (response['success']){
        location.href="adminLogin.php"
      }
    }
  })
}


