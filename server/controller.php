<?php require_once "db.php"; // include the connection with the db server


$request = $_POST['request']; //getting the request from the client side
$result = ""; // holds result that will be echoed

switch($request){  // checking the request value to invoke the correct function 
    case "getAboutInfo":
        $result=getAboutInfo($connection);
        break;
    case "getContactInfo":
        $result=getContactInfo($connection);
        break;
    case "getServices":
        $result=getServices($connection);
        break;
    case "getReviews":
        $result=getReviews($connection);
        break;
    case "getProfileInfo":
        $result=getProfileInfo($connection,$_POST['username']);
        break;
    case "submitReview":
        $result=submitReview($connection,$_POST['username'],$_POST['msg']);
        break;
    case "bookAppointment":
        $result=bookAppointment($connection,$_POST['user'],$_POST['date'],$_POST['time'],$_POST['service']);
        break;
    case "getAppointments":
        $result = getAppointments($connection,$_POST['user']);
        break;
    case "getEmployeeInfo":
        $result = getEmployeeInfo($connection);
        break;
    case "getEmployeeInfo":
        $result = getEmployeeInfo($connection);
        break;
    case "updateProfile":
        $result = updateProfile($connection,$_POST['username'],$_POST['password'],$_POST['email'],$_POST['user']);
        break;
    case "deleteAccount":
        $result = deleteAccount($connection,$_POST['user']);
        break;
}

echo $result; // send result to ajax


function getAboutInfo($connection){
    // function to get the data of the about page from db
    // para: connection
    // return : data 

    $query = "SELECT * FROM about";  // mysqli query of about table
    $result = mysqli_query($connection,$query); // send query to the db server using connection established with the server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection));  // if query invalid exit and print query message and mysqli error number

    $row = mysqli_fetch_assoc($result); // if no error fetch data from db with respect to the query sent
    $title = $row['title']; // about page title (column title of about table)
    $img = $row['image']; // about page img name (column image of about table)
    $detail = $row['description']; // about page description (column description of about table)

    $data = array("title"=>$title,"image"=>$img,"description"=>$detail); // store title, img and detail as array 

    return json_encode($data); // return data in json format
}

function getContactInfo($connection){
    // function to get information about contact page from contact table 
    // para: connection
    // return : data

    $query = "SELECT * FROM contact"; // query of mysqli
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // if query invalid exit and print query message and mysqli error number

    $row = mysqli_fetch_assoc($result); // fetch the data from contact table 
    $street = $row['address']; // access and store address column of table contact
    $phone = $row['phone']; // access and store phone column of table contact
    $email = $row['email']; // access and store email column of table contact

    $data = array("street"=>$street,"phone"=>$phone,"email"=>$email); // store street, phone, and email as array

    return json_encode($data); // return data as json 
}

function getServices($connection){
    // function to get information about services provided
    // para: connection
    // return : services data

    $query = "SELECT * FROM service"; // mysqli query to get every data of services table
    $result = mysqli_query($connection,$query); // send query to db server using connection

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // if query invalid exit and print query message and mysqli error number

    $data = array(); // array to store data of each row
    while($row = mysqli_fetch_assoc($result)){ // loop through each row in the table and fetch data
        $name = $row['servname'];  // service name
        $price = $row['servprice']; // service price
        $datarow = array('name'=>$name,'price'=>$price); // store service name and price in array for each row
        $data[]=$datarow; // append data of each row to the data array
    }
    
    return json_encode($data); // return data of all rows in json format
}

function getReviews($connection){
    // function to ger reviews that are approved from review table
    // para: connection
    // return : data

    $query = "SELECT customer.fname, review.feedback FROM customer INNER JOIN review ON review.user=customer.id WHERE review.status='Approved'"; // sql query with table join to get customer name his/her review that are approved
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // if query invalid exit and print query message and mysqli error number

    $data = array(); // array to store data from each row of the table
    while($row = mysqli_fetch_assoc($result)){ // loop through data of each row and fetch it
        $name = $row['fname']; // firstname of reviewer
        $review = $row['feedback']; // review
        $datarow = array('name'=>$name,'review'=>$review); // row data
        $data[]=$datarow; // store data of each row in the data array
    }
    
    return json_encode($data); // return data in json format
}

function getProfileInfo($connection,$username){
    // a function to get profile info of a user that is logged in
    // para: connection, username
    // return : data

    $query = "SELECT username,email,date_creation FROM customer WHERE username='$username'"; // sql query to get user with specific username
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // if query invalid exit and print query message and mysqli error number

    $row = mysqli_fetch_assoc($result); // fetch the data of the user
    $name = $row['username']; // store username
    $email = $row['email']; // store email
    $date = $row['date_creation']; // store date of registration

    $data = array('name'=>$name,'email'=>$email,'date'=>$date); // store details of the user in data array
    return json_encode($data); // return data in json format
}

function submitReview($connection,$user,$msg){
    // a function to submit a review posted by a user that is logged in
    // para: connection,username,msg
    // return: success 

    $user = findUserID($connection,$user); // invoke a function to find user id based on username
    $msg = mysqli_real_escape_string($connection,$msg); // santize the review message data
    $query = "INSERT INTO review (user,feedback,date) VALUES ('$user','$msg',now())"; // sql query to insert new review
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // if query invalid exit and print query message and mysqli error number

    return json_encode(array("success"=>true)); // return array of success if no error in json format

}

function findUserID($connection,$user){
    // a function that queries the customer table and return user id based on username
    // para: connection,username
    // return: id

    $query = "SELECT id FROM customer WHERE username='$user' "; // sql query to find id based on username
    $result = mysqli_query($connection,$query); // send query to db server 

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // if query invalid exit and print query message and mysqli error number

    $row = mysqli_fetch_assoc($result); // fetch the data returned from db server
    $id = $row['id']; // store id
    return $id; // returns id
    
}

function findServiceCode($connection,$service){
    // a function that queries the service table and return service code based on service name
    // para: connection,service
    // return: id

    $query = "SELECT service_code FROM service WHERE servname='$service' "; // sql query to find service code based on service name
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // if query invalid exit and print query message and mysqli error number

    $row = mysqli_fetch_assoc($result); // fetch the data returned from db server
    $id = $row['service_code']; // store service code
    return $id;  // return service code
    
}

function bookAppointment($connection,$user,$date,$time,$service){
    // a function to book appointment for a logged user
    // para: connection,user,data,time,service
    // return : success

    // sanitize data
    $user = mysqli_real_escape_string($connection,$user);
    $date = mysqli_real_escape_string($connection,$date);
    $time = mysqli_real_escape_string($connection,$time);
    $service = mysqli_real_escape_string($connection,$service);


    $userId = findUserID($connection,$user); // invoke function to find user id (because the input from the session is username we need to find id)
    $serviceCode = findServiceCode($connection,$service); // invoke function to find service code (because the input from is service name we need to find service code)

    $query = "INSERT INTO appointment (appodate,appotime,cid,service_code) VALUES ('$date','$time','$userId','$serviceCode')"; // sql queryt to book appointment
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_errno($connection)); // if query invalid exit and print query message and mysqli error number

    return json_encode(array('success'=>true)); // no error send success array in json format


}

function getAppointments($connection,$user){
    // a function to get appointments booked by a certain user
    // para: connection,username
    // return: success

    $query = "SELECT service.servname,
     appointment.appoid,appointment.appodate,appointment.appotime,appointment.status,service.servprice
     FROM customer INNER JOIN appointment ON appointment.cid=customer.id
     INNER JOIN service ON appointment.service_code=service.service_code where customer.username='$user'"; // sql query that join three tables
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result) die("QUERY FAILED: " . mysqli_errno($connection)); // if query invalid exit and print query message and mysqli error number
    
        $data = array(); // initialize array to store data

        while($row=mysqli_fetch_assoc($result)){ // loop through each result of the query and fethc data 
            $id = $row['appoid']; // appointment id
            $date = $row['appodate']; // appointment date
            $time = $row['appotime']; // appointment time
            $service = $row['servname']; // service name
            $price = $row['servprice']; // service price
            $status = $row['status']; // appointment status 
            $dataRow=array("appointment_id"=>$id,"appointment_date"=>$date,"appointment_time"=>$time,"service_name"=>$service,"price"=>$price,"status"=>$status); // store info of a row in array
            $data[]=$dataRow; // append data of each row
        }
        return json_encode($data); // if no error return data in json format
}

function getEmployeeInfo($connection){
    // a function to retrieve information about employees
    // para: connection
    // return: data

    $query = "SELECT * FROM Employee"; // sql query to get all row from employee table
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result) die("QUERY FAILED" . mysqli_connect_errno($connection)); // if query invalid exit and print query message and mysqli error number

    $data = array(); // initialize array to store all rows
    while($row=mysqli_fetch_assoc($result)){ // loop through each row of the result and fetch the data
        $name = $row['firstname'].' '.$row['lastname']; // name (firstname + lastname)
        $img = $row['img']; // image name
        $dataRow = array('name'=>$name,"img"=>$img); // store info of a row as array
        $data[] = $dataRow; // append info of row to data array
    }
    return json_encode($data); // return data in json format
}

function updateProfile($connection,$username,$password,$email,$user){
    // a function to update profile of a user with new info
    // para: connection,new username,password,email,username
    // return : success array

    $username = mysqli_real_escape_string($connection,$username); // sanitize data
    $password = mysqli_real_escape_string($connection,$password); // sanitize data
    $email = mysqli_real_escape_string($connection,$email); // sanitize data

    $salt = "$2y$10$4bb929c2f01469b5597bf021a33bd3a1822c85149ac9"; // salting password to increase level of security
	$encrypted = crypt($password,$salt); // encrypt password with the salt

    $query = "UPDATE customer SET username='$username',password='$encrypted',email='$email' WHERE username='$user' "; // sql query to update user information of a certain user
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_errno()); // if query invalid exit and print query message and mysqli error number

    return json_encode(array('success'=>true)); // return array in json format

}

function deleteAccount($connection,$username){
    // a function to delete an account
    // para: username
    // return json success

    $query = "DELETE FROM customer WHERE username='$username'"; // sql query to delete user
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result) die("QUERY FAILED" . mysqli_connect_errno()); // kill connection if error occurs

    return json_encode(array('success'=>true)); // return json success message for a successful deletion
}