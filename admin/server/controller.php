<?php require_once "db.php";

$request = $_POST['request']; //getting the request from the client side
$result = ""; // holds the result of each function
switch ($request) { // // checking the request value to invoke the corresponding function 
    case "getAppointments":
        $result = getAppointments($connection,$_POST['order'],$_POST['sort']);
        break;
    case "getServices":
        $result=getServices($connection,$_POST['order'],$_POST['sort']);
        break;
    case "getClients":
        $result=getClients($connection,$_POST['order'],$_POST['sort'],$_POST['search']);
        break;
    case "getEmployees":
        $result=getEmployees($connection,$_POST['order'],$_POST['sort'],$_POST['search']);
        break;
    case "getChartInfo":
        $result=getChartInfo($connection);
        break;    
    case "addService":
        $result=addService($connection,$_POST['servname'],$_POST['servduration'],$_POST['servprice']);
        break;    
    case "addAppointment":
        $result=addAppointment($connection,$_POST['customer'],$_POST['service'],$_POST['date'],$_POST['time']);
        break;    
    case "editAppointment":
        $result=editAppointment($connection,$_POST['id'],$_POST['date'],$_POST['time']);
        break;    
    case "deleteService":
        $result=deleteService($connection,$_POST['id']);
        break;    
    case "deleteAppointment":
        $result=deleteAppointment($connection,$_POST['id']);
        break;    
    case "editService":
        $result=editService($connection,$_POST['serviceId'],$_POST['name'],$_POST['duration'],$_POST['price']);
        break;    
    case "getServiceInfo":
        $result=getServiceInfo($connection,$_POST['serviceId']);
        break;    
    case "getAppointmentInfo":
        $result=getAppointmentInfo($connection,$_POST['apptId']);
        break;    
    case "getAboutInfo":
        $result=getAboutInfo($connection);
        break;    
    case "getContactInfo":
        $result=getContactInfo($connection);
        break;    
    case "updateAboutInfo":
        $result=updateAboutInfo($connection,$_POST['img'],$_POST['title'],$_POST['description']);
        break;    
    case "updateContactInfo":
        $result=updateContactInfo($connection,$_POST['street'],$_POST['phone'],$_POST['email']);
        break;    
    case "getNotificationCount":
        $result=getNotificationCount($connection);
        break;    
    case "updateAppointmentRead":
        $result=updateAppointmentRead($connection);
        break;    
    case "appointementApproval":
        $result=appointementApproval($connection,$_POST['action'],$_POST['id']);
        break;    
    case "reviewApproval":
        $result=reviewApproval($connection,$_POST['action'],$_POST['id']);
        break;    
    case "getEntitiesCount":
        $result=getEntitiesCount($connection);
        break;    
    case "getReviews":
        $result=getReviews($connection,$_POST['order'],$_POST['sort']);
        break;    
    case "deleteReview":
        $result=deleteReview($connection,$_POST['id']);
        break;    
    case "addEmployee":
        $result=addEmployee($connection,$_POST['fname'],$_POST['lname'],$_POST['city'],$_POST['phone'],$_POST['salary'],$_POST['img'],$_POST['gender']);
        break;    
    case "getEmpInfo":
        $result=getEmpInfo($connection,$_POST['id']);
        break;    
    case "updateEmployee":
        $result=updateEmployee($connection,$_POST['id'],$_POST['city'],$_POST['phone'],$_POST['salary']);
        break;    
    case "deleteEmployee":
        $result=deleteEmployee($connection,$_POST['id']);
        break;    
}

echo $result; // 



function getAppointments($connection,$order,$sort){
    // a function to get all appointments from the db server
    // it also includes order and sort
    // it retrieves the data based on the order and sort requested by the user
    // para:connection,order,sort
    // return: data

    if ($sort!="" && $order!=""){ // user has requested order and sort for the appointment table
        $query = "SELECT CONCAT(CONCAT(customer.fname,' '), customer.lname) AS Name,service.servname,
     appointment.appoid,appointment.appodate,appointment.appotime,appointment.status,service.servprice
     FROM customer INNER JOIN appointment ON appointment.cid=customer.id
     INNER JOIN service ON appointment.service_code=service.service_code ORDER BY $sort $order"; // sql query with joing statment order and sort
    }else if($order=="" && $sort!=""){ // user has requested only sort , order is automated
        $query = "SELECT CONCAT(CONCAT(customer.fname,' '), customer.lname) AS Name,service.servname,
     appointment.appoid,appointment.appodate,appointment.appotime,appointment.status,service.servprice
     FROM customer INNER JOIN appointment ON appointment.cid=customer.id
     INNER JOIN service ON appointment.service_code=service.service_code ORDER BY $sort"; // sql query with join statement and sort
    }
     else{ // user did not request order and sort 
        $query = "SELECT CONCAT(CONCAT(customer.fname,' '), customer.lname) AS Name,service.servname,
     appointment.appoid,appointment.appodate,appointment.appotime,appointment.status,service.servprice
     FROM customer INNER JOIN appointment ON appointment.cid=customer.id
     INNER JOIN service ON appointment.service_code=service.service_code"; // sql query without sort and order
     } 
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result)
        die("QUERY FAILED: " . mysqli_errno($connection)); // kill connection incase of error
    
        $data = array(); // array to store all the data

        while($row=mysqli_fetch_assoc($result)){ // fetch data and loop through it
            $id = $row['appoid'];
            $date = $row['appodate'];
            $time = $row['appotime'];
            $customer = $row['Name'];
            $service = $row['servname'];
            $price = $row['servprice'];
            $status = $row['status'];
            $dataRow=array("appointment_id"=>$id,"appointment_date"=>$date,"appointment_time"=>$time,"customer_name"=>$customer,"service_name"=>$service,"price"=>$price,"status"=>$status); // store data of each row
            $data[]=$dataRow; // append data of each row
        }
        return json_encode($data); // return data in json format
}

function getServices($connection,$order,$sort){ 
    // a function to get all services from the db server
    // it includes sort and order feature
    // sends the data to the client in the order and sort requested 
    // para:connection,order,sort
    // return: data

    if ($sort!="" && $order!=""){ // user has provided sort and order request 
        $query = "SELECT * FROM service ORDER BY $sort $order" ; // sql query with sort and order 
    }else if($order=="" && $sort!=""){ // user has provided only sort choice
        $query = "SELECT * FROM service ORDER BY $sort" ; // sqli query with sort option
    }else{ // user has not requested data to be either sorted or ordered
        $query = "SELECT * FROM service" ; // sql query to get services from db server
    } 

    $result = mysqli_query($connection,$query); // send query to db server
    if (!$result) die("QUERY FAILED: " . mysqli_error($connection)); // kill connection if any error occurred
    
        $data = array(); // store all data in array

        while($row=mysqli_fetch_assoc($result)){ // loop through each row and fetch data
            $id = $row['service_code'];
            $name = $row['servname'];
            $duration = $row['servduration'];
            $price = $row['servprice'];
            $dataRow=array("service_id"=>$id,"service_name"=>$name,"service_duration"=>$duration,"service_price"=>$price); // store data of each row
            $data[]=$dataRow; // appenda data of each row to the array
        }
        return json_encode($data); // returns data in json format
}


function getClients($connection,$order,$sort,$search){
    // a function to get clients data from db server
    // accepts sort,order and search request from user and send data in requested manner
    // para:connection,order,sort,search
    // return: data

    if($search !==""){ // user has search for a certain client
        if ($sort!="" && $order!=""){ // user has requested sorted and ordered data
            $query = "SELECT * FROM customer WHERE fname LIKE '%$search%' or lname LIKE '%$search%'  ORDER BY $sort $order" ; // sql query with search, sort and order feature
        }else if($order=="" && $sort!=""){ // user has requested sorted data
            $query = "SELECT * FROM customer WHERE fname LIKE '%$search%' or lname LIKE '%$search%'  ORDER BY $sort" ; // sql query with search, sort  feature
        }else{ // user has not requested for sorted or ordered data
            $query = "SELECT * FROM customer WHERE fname LIKE '%$search%' or lname LIKE '%$search%' " ; // sql query with search feature (in the firstname or lastname)
        } 
    }else{ // user has not search for a client
        if ($sort!="" && $order!=""){ // user has requested sorted and ordered data
            $query = "SELECT * FROM customer ORDER BY $sort $order" ; // sql query to get clients sorted and ordered
        }else if($order=="" && $sort!=""){ // user has requested sorted data
            $query = "SELECT * FROM customer ORDER BY $sort" ; // sql query to get clients data sorted
        }else{  // user has not requested for sorted or ordered data
            $query = "SELECT * FROM customer" ; // sql query to get clients
    }
        }

    $result = mysqli_query($connection,$query); // send query to db server
    if (!$result)
        die("QUERY FAILED: " . mysqli_error($connection)); // kill connection if error occured
    
        $data = array(); // array to store data of each row

        while($row=mysqli_fetch_assoc($result)){ // loop through each row and fetch the data
            $id = $row['id'];
            $name = $row['fname']." ".$row['lname'];
            $phone = $row['phone'];
            $email = $row['email'];
            $date = $row['date_creation'];
            $username = $row['username'];
            $dataRow=array("client_id"=>$id,"client_name"=>$name,"client_phone"=>$phone,"client_email"=>$email,"client_date"=>$date,"client_username"=>$username); // store data of each row as array
            $data[]=$dataRow; // append data of each row to the data variable
        }
        return json_encode($data); // return data in json format
}

function getEmployees($connection,$order,$sort,$search){
    // a function to get all employees from the db server
    // it has search sort and order feature
    // it return data as per the search, sort and order request made by user
  // para:connection,order,sort,search
  // return: data
    if ($search !==""){ // user has searched for a certain employee name
        if ($sort!="" && $order!=""){ // user has requested sorted and ordered data
            $query = "SELECT * FROM Employee WHERE firstname LIKE '%$search%' or lastname LIKE '%$search%' ORDER BY $sort $order" ; // sql query to get employee in a sorted and ordered manner that corresponds with the search keyword
        }else if($order=="" && $sort!=""){ // user has requested sorted data
            $query = "SELECT * FROM Employee WHERE firstname LIKE '%$search%' or lastname LIKE '%$search%' ORDER BY $sort" ; // sql query to get sorted employee data that corresponds to the search keyword
        }else{ // no sort or order request
            $query = "SELECT * FROM Employee WHERE firstname LIKE '%$search%' or lastname LIKE '%$search%'" ; // sql query with search for keyword
        } 
    }else{ // user has not searched for a certain employee
        if ($sort!="" && $order!=""){ // sorted and ordered data
            $query = "SELECT * FROM Employee ORDER BY $sort $order" ; // sql query for sorted, ordered data
        }else if($order=="" && $sort!=""){ // sorted data
            $query = "SELECT * FROM Employee ORDER BY $sort" ; // sql query for sorted data
        }else{ // no sort or order
            $query = "SELECT * FROM Employee" ; // sql query to get all employees
        } 
    }

    $result = mysqli_query($connection,$query); // send query to db server
    if (!$result) die("QUERY FAILED: " . mysqli_error($connection)); // kill connection if error occurs
    
        $data = array(); // store data of each row 

        while($row=mysqli_fetch_assoc($result)){ // loop though each row & fetch the data
            $id = $row['id'];
            $name = $row['firstname']." ".$row['lastname'];
            $phone = $row['phone'];
            $gender = $row['gender'];
            $city = $row['city'];
            $salary = $row['salary'];
            $img = $row['img'];
            $dataRow=array("id"=>$id,"name"=>$name,"phone"=>$phone,"city"=>$city,"gender"=>$gender,"salary"=>$salary,"img"=>$img); // store data of each row as array
            $data[]=$dataRow; // append data row to the main array
        }
        return json_encode($data); // return data in json format
}


function addService($connection,$servname,$servduration,$servprice){
    // a function to add a new service to the service table in the db
    // para: connection,servicename,serviceduration,serviceprice
    // return : json success

    $query = "SELECT * FROM service WHERE servname='$servname'"; // sql query to check if there aleary exist service with such name (to avoid duplication)
    $result = mysqli_query($connection,$query); // send query to db server
    $num_rows = mysqli_num_rows($result); // fetch number of row for the query

    if ($num_rows!=0){
        return json_encode(array("success"=>false,"message"=>"Servicename can not be duplicated")); // service with such name exist send error message and success fail message in json 
    }
    // no duplicate service name
    $query2 = "INSERT INTO service (servname,servduration,servprice) VALUES ('$servname','$servduration','$servprice')"; // sql query to insert new service
    $result2 = mysqli_query($connection,$query2); // send query to db server

    if(!$result2) die("QUERY FAILED" . mysqli_error($connection)); // kill connection if erro occurs

    return json_encode(array('success'=>true)); // return success message in json format (to confirm successful additon of service)
}

function getEmpInfo($connection,$id){
    // a function to get information about employee with a certain id
    // para: connection, id
    // return : json data

    $query = "SELECT * FROM Employee WHERE id='$id'"; // sql query to find user with the given id
    $result = mysqli_query($connection,$query); // send query to db server
    if (!$result) die("QUERY FAILED: " . mysqli_error($connection)); // kill connection if error occurs
    $row = mysqli_fetch_assoc($result); // fetch data of the employee
    $city = $row['city'];
    $phone = $row['phone'];
    $salary = $row['salary'];
    $data = array("city"=>$city,"phone"=>$phone,"salary"=>$salary); // store data as associative array

    return json_encode($data); // return data in json format
} 

function updateEmployee($connection,$id,$city,$phone,$salary){
    // a function to update information about an employee
    // para: connection,id,city,phone,salary
    // return : json data

    $query = "UPDATE Employee SET city='$city',phone='$phone',salary='$salary' WHERE id='$id'"; // sql query to update info of employee
    $result = mysqli_query($connection,$query); // send query to the db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_errno()); // kill connection if error occurs
    return json_encode(array("success"=>true)); // returns data in json format
}

function getChartInfo($connection){
    // a function to get information from db for the dashboard chart
    // para: connection
    // return : json data
    $data = array(); // data storage
    $data['pendingAppointments'] = pendingAppointmentsCount($connection); // get number of pending appts
    $data['rejectedAppointments'] = rejectedAppointmentsCount($connection); // get number of rejected appts
    $data['acceptedAppointments'] = acceptedAppointmentsCount($connection); // get number of accepted appts
    $data['unverifiedCustomers'] = unverifiedCustomersCount($connection); // get number of unverified users
    $data['newCustomers'] = newCustomersCount($connection); // get number of customers registered today
    $data['services'] = servicesCount($connection); // get number of services provided

    return json_encode($data); // return json data
}

function pendingAppointmentsCount($connection){
    // a function to get appointments with pending status
    // para: connection
    // return : pendingcount

    $query = "SELECT * FROM appointment WHERE status='Pending'"; // sql query to find pending appts
    $result = mysqli_query($connection,$query); // send query to db

    if(!$result) die('QUERY FAILED'. mysqli_connect_error()); // kill connection if error occurs

    $pendingCount = mysqli_num_rows($result); // count the row of the result

    return $pendingCount; // return the number of rows
}


function acceptedAppointmentsCount($connection){
    // a function to get the count of accepted appointments
    // para: connection
    // return : acceptedcount
    $query = "SELECT * FROM appointment WHERE status='Approved'"; // sql query to get approved appointements
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die('QUERY FAILED'. mysqli_connect_error()); // kill connection if error occurs

    $acceptedCount = mysqli_num_rows($result); // get number of row of result

    return $acceptedCount; // return the number of rows
}

function rejectedAppointmentsCount($connection){
    // a function to get the count of rejected appointments
    // para:connection
    // return : rejectedcount
    $query = "SELECT * FROM appointment WHERE status='Rejected'"; // query to get all rejected appointments
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die('QUERY FAILED'. mysqli_connect_error()); // kill connection if error occurs

    $rejectedCount = mysqli_num_rows($result); // get number of rows

    return $rejectedCount; // return number of rows
}

function unverifiedCustomersCount($connection){
    // a function to get the count of unverified customers
    // para:connection
    // return: unverfiedcount

    $query = "SELECT * FROM customer WHERE verified='no'"; // query to find unverified customers
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die('QUERY FAILED'. mysqli_connect_error()); // kill connection if error occurs

    $unverifiedCount = mysqli_num_rows($result); // get number of rows
    return $unverifiedCount; // return number of rows
}

function newCustomersCount($connection){
    // a function to get customers who registered today
    // para: connection
    // return : newcustomers

    $today = date("Y-m-d"); // get date of today
    $query = "SELECT * FROM customer WHERE date_creation='$today'"; // query to get users who registered today
    $result = mysqli_query($connection,$query); // send quety to db server

    if(!$result) die('QUERY FAILED'. mysqli_connect_error()); // kill connection if error occurs

    $newCustomers = mysqli_num_rows($result); // get number of row
    return $newCustomers; // return number of rows
}

function servicesCount($connection){
    // a function to get the count of services provided
    // para: connection
    // return : services

    $query = "SELECT * FROM service"; // query to get all services
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die('QUERY FAILED'. mysqli_connect_error()); // kill connection if error occurs

    $services = mysqli_num_rows($result); // get number of rows
    return $services; // return number of rows
}

function deleteService($connection,$id){
    // a function to delte a certain service with a given id
    // para: id
    // return: json success
    $query = "DELETE FROM service WHERE service_code='$id'"; // query to delete service with given id
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result){
        die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs
    }else{
        return json_encode(array("success"=>true)); // return json success message
    }
}

function deleteAppointment($connection,$id){
    // a function to delte a certain appointment with a given id
    // para: id
    // return: json success
    $query = "DELETE FROM appointment WHERE appoid='$id'"; // query to delete appointment with given id
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result){
        die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs
    }else{
        return json_encode(array("success"=>true)); // return json success message
    }
}

function editService($connection,$id,$name,$duration,$price){
    // a function to edit service with specific service code
    // para: connection,id,name,duration,price
    // return json success

    $query = "UPDATE service SET servname='$name', servduration='$duration', servprice='$price' WHERE service_code='$id'"; // query to update a service using the id
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result)die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs

    return json_encode(array("success"=>true)); // return json success
}

function getServiceInfo($connection,$id){
    // a function to get service info based on id provided
    // para: connection,id
    // return : json data

    $query = "SELECT * FROM service WHERE service_code='$id'"; // sql query to find service using the id
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result){
        die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs
    }

    $row = mysqli_fetch_assoc($result); // fetch data of the service
    $name = $row['servname'];
    $duration = $row['servduration'];
    $price = $row['servprice'];
    $data=array("service_name"=>$name,"service_duration"=>$duration,"service_price"=>$price); // store data in associative array

    return json_encode($data); // return json data
}

function getAppointmentInfo($connection,$id){
    // a function to get info about an appointment based on an id
    // para: connection,id
    // return: json data

    $query = "SELECT * FROM appointment WHERE appoid='$id'"; // sql query to find appointment using id
    $result = mysqli_query($connection,$query); // send query to the db server

    if (!$result){
        die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs
    }

    $row = mysqli_fetch_assoc($result); // fetch the data regading appointment
    $date = $row['appodate'];
    $time = $row['appotime'];
    $data=array("date"=>$date,"time"=>$time); // store data as associative array

    return json_encode($data); // return json data
}

function getAboutInfo($connection){
    // a function to get info regarding the about table
    // para : connection
    // return : json data

    $query = "SELECT * FROM about"; // sql query to get info of about table
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs

    $row = mysqli_fetch_assoc($result); // fetch data 
    $title = $row['title'];
    $image = $row['image'];
    $description = $row['description'];

    $data = array("title"=>$title,"image"=>$image,"description"=>$description); // store data in associative array

    return json_encode($data); // json data
}

function getContactInfo($connection){
    // a function to get info from contact table
    // para:connection
    // return: json data

    $query = "SELECT * FROM contact"; // sql query to get info from contact table
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs

    $row = mysqli_fetch_assoc($result); // fetch data of contact table
    $street = $row['address'];
    $phone = $row['phone'];
    $email = $row['email'];

    $data = array("street"=>$street,"phone"=>$phone,"email"=>$email); // store data in associative array

    return json_encode($data); // return json data
}


function updateAboutInfo($connection,$img,$title,$description){
    // a function to update the about table
    // para: connection,img,title,description
    // return: json success

    // SANITISE DATA
    $img = mysqli_real_escape_string($connection,$img);
    $title = mysqli_real_escape_string($connection,$title);
    $description = mysqli_real_escape_string($connection,$description);


    $query = "UPDATE about SET title='$title', image='$img', description='$description'"; // sql query to update about table
    $result = mysqli_query($connection,$query); // send queryt to db server

    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs
    
    return json_encode(array("success"=>true)); // return json success
}

function updateContactInfo($connection,$street,$phone,$email){
    // a function to update contact table
    // para:connection,street,phone,email
    // return : json success 

    // SANITISE DATA
    $street = mysqli_real_escape_string($connection,$street);
    $phone = mysqli_real_escape_string($connection,$phone);
    $email = mysqli_real_escape_string($connection,$email);


    $query = "UPDATE contact SET address='$street', phone='$phone', email='$email'"; // sql query to update contact table
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs
    
    return json_encode(array("success"=>true)); // return json success
}

function getNotificationCount($connection){
    // a function to get the number of notificaions(appointments) that are not read
    // para: connection
    // return: json count

    $query = "SELECT * FROM appointment WHERE new_read='no'"; // sql queryt to get appointments that are not read
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs

    $num_rows = mysqli_num_rows($result); // ger the number of rows

    return json_encode(array("count"=>$num_rows)); // return json count of rows
}

function updateAppointmentRead($connection){
    // a function to update the read column of appointments
    // para:connection
    // return:json success

    $query = "UPDATE appointment SET new_read='yes'"; // sql query to update the read column of all appointments
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs

    return json_encode(array("success"=>true)); // return json success
}

function appointementApproval($connection,$action,$id){
    // a function to either approve or reject an appointment
    // para: action,id
    // return : json sucess

    $query = "UPDATE appointment SET status='$action' WHERE appoid='$id'"; // sql query to update status of specific appointment
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs

    $email = findEmail($connection,$id); // find email of user who requested the appointment
    if($action=='Approved'){ // if the appointment is approved
        sendApproveEmail($email); // send approval email
    }else if($action=='Rejected'){ // not approved
        sendRejectEmail($email); // send disapproval email
    }

    return json_encode(array("success"=>true)); // return json success

}

function findEmail($connection,$id){
    // a function to find email of a user based on a certain appoid
    // para: connetion,id
    // return: email

    $query  = "SELECT * FROM appointment WHERE appoid='$id'"; // sql query to find the details of the appointment
    $result = mysqli_query($connection,$query); // send qeury to db server
    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs
    $row = mysqli_fetch_assoc($result); // fetch data
    $userid= $row['cid']; // get user id

    $query2 = "SELECT * FROM customer WHERE id='$userid'"; // use user id to find email
    $result2 = mysqli_query($connection,$query2); // send querty to db server
    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs
    $row2 = mysqli_fetch_assoc($result2); // fetch result
    $email= $row2['email']; // get email address
    return $email; // return email address
}

function reviewApproval($connection,$action,$id){
    // a function to approve or reject review so that it appears in the client side
    // para:action,id
    // return: json success

    $query = "UPDATE review SET status='$action' WHERE id='$id'"; // sql query to update the status of a specific review
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED " . mysqli_error($connection)); // kill connection if error occurs

    return json_encode(array("success"=>true)); // return json success
}

function sendRejectEmail($to){
    // a function to send email to user upon appointment disapproval
    $msg= "We are sorry but your booking request is rejected.\n If you want to leave us a message regarding the booking please email us at fetero@barber.com.\n We hope to see you soon ";
    $subject = "ፈጠሮ ባርቤሪ-barber,Booking Rejected"; 
    mail($to,$subject,$msg); //  mail funciton

}

function sendApproveEmail($to){
    // a function to send email to user upon appointment approval
    $msg= " Congratulations\n We are happy to tell your booking has been approved\n Please be on time ";
    $subject = "ፈጠሮ ባርቤሪ-barber,Booking Accepted";
    mail($to,$subject,$msg); // mail function

}

function getEntitiesCount($connection){
    // a function to get the count of row for the tables employee,customer,appointment, and service
    // para : connection
    // return: json data
    $servCount = servicesCount($connection); // get services count
    $apptCount = pendingAppointmentsCount($connection) + acceptedAppointmentsCount($connection) + rejectedAppointmentsCount($connection); // all appointments = pending + rejected + approved
    $empCount = getEmpCount($connection); // get employee count
    $custCount = getCustomerCount($connection); // get customer count

    $data = array('servCount'=>$servCount,"apptCount"=>$apptCount,"custCount"=>$custCount,"empCount"=>$empCount); // store data as associative array
    return json_encode($data); // return data in json format
    
}

function getEmpCount($connection){
    // a function to get employee count
    // para: connection
    // return: numrows

    $query = "SELECT * FROM Employee"; // sql query to find all employees
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_errno($connection));  // kill connection if error occurs

    $num_rows = mysqli_num_rows($result); // get number of rows

    return $num_rows; // return number of rows
}

function getCustomerCount($connection){
    // a function to get customers count
    // para: connection
    // return: numrows

    $query = "SELECT * FROM customer"; // sql query to find all customers
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_errno($connection)); // kill connection if error occurs

    $num_rows = mysqli_num_rows($result); // get number of rows

    return $num_rows; // return number of rows
}

function getReviews($connection,$order,$sort){
    // a function to get all reviews
    // para:connection,sort,order
    // return :json data
    // features to sort and order data

    $sort = $sort=='user'?'customer.fname':$sort; // if value of sort is user change it to customer.fname (becuase the query uses inner join)
    $sort = $sort=='review'?'review.feedback':$sort; // if value of sort is review change it to review.feedback (becuase the query uses inner join)

    if ($sort!="" && $order!=""){ // sorted and ordered
        $query = "SELECT CONCAT(customer.fname,CONCAT(' ',customer.lname)) AS name, review.feedback,review.id,review.status FROM customer INNER JOIN review ON review.user=customer.id ORDER BY $sort $order "; // sql with join and sort, order statmetn to get query review and customer info
    }else if($order=="" && $sort!=""){ // sorted
        $query = "SELECT CONCAT(customer.fname,CONCAT(' ',customer.lname)) AS name, review.feedback,review.id,review.status FROM customer INNER JOIN review ON review.user=customer.id ORDER BY $sort";// sql with join and sort statement to get query review and customer info
    }else{ // random sort and order
        $query = "SELECT CONCAT(customer.fname,CONCAT(' ',customer.lname)) AS name, review.feedback,review.id,review.status FROM customer INNER JOIN review ON review.user=customer.id"; // sql with join statmetn to get query review and customer info
    }

    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs

    $data = array(); // array to store data about review
    while($row = mysqli_fetch_assoc($result)){ // loop through each row of the result and fetch data
        $id = $row['id'];
        $reviewer = $row['name'];
        $review = $row['feedback'];
        $status = $row['status'];
        $datarow = array('id'=>$id,'name'=>$reviewer,'review'=>$review,'status'=>$status); // store data of each row in associative array
        $data[]=$datarow; // append datarow to data
    }
    
    return json_encode($data); // return json data
}

function deleteReview($connection,$id){
    // a function to delete a specific review
    // para: connection,id
    // return:json success

    $query = "DELETE FROM review WHERE id='$id'"; // sql query to delete review using id 
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die('QUERY FAILED' . mysqli_connect_errno($connection)); // kill connection if error occurs

    return json_encode(array('success'=>true)); // return json success

}

function addAppointment($connection,$user,$service,$date,$time){
    // a function to add appointment using required inputs
    // para:connection,user,service,data,time
    // return: json success

    // sanitize data
    $user = mysqli_real_escape_string($connection,$user);
    $date = mysqli_real_escape_string($connection,$date);
    $time = mysqli_real_escape_string($connection,$time);
    $service = mysqli_real_escape_string($connection,$service);
 
    $query = "INSERT INTO appointment (appodate,appotime,cid,service_code) VALUES ('$date','$time','$user','$service')"; // sql query to book appointment
    $result = mysqli_query($connection,$query); // sent query to db server

    if(!$result) die("QUERY FAILED" . mysqli_errno($connection)); // kill connection if error occurs

    return json_encode(array('success'=>true)); // return json success


}

function editAppointment($connection,$id,$date,$time){
    // a function to edit an appointment using appo id
    // para:connection,id,data,time
    // return : json success

    $query = "UPDATE appointment SET appodate='$date', appotime='$time' WHERE appoid='$id'"; // sql query to update specific appointment 
    $result = mysqli_query($connection,$query); // send query to db server

    if (!$result)die("QUERY FAILED" . mysqli_connect_error($connection)); // kill connection if error occurs

    return json_encode(array("success"=>true)); // return json success
}

function addEmployee($connection,$fname,$lname,$city,$phone,$salary,$img,$gender){
    // a function to add new employee with given inputs
    // para :fname,lname,city,phone,salary,img,gender
    // return: json success

    // sanitize date
    $fname = mysqli_real_escape_string($connection,$fname);
    $lname = mysqli_real_escape_string($connection,$lname);
    $city = mysqli_real_escape_string($connection,$city);
    $phone = mysqli_real_escape_string($connection,$phone);


    $query = "INSERT INTO Employee (firstname,lastname,city,phone,salary,img,gender) VALUES ('$fname','$lname','$city','$phone','$salary','$img','$gender')"; // sql to insert new employee
    $result = mysqli_query($connection,$query); // send query to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_errno()); // kill connection if error occurs
    return json_encode(array("success"=>true)); // return json success
}

function deleteEmployee($connection,$id){
    // a function to delete an employee using id
    // para:connection,id
    // return : json success

    $query = "DELETE FROM Employee WHERE id='$id'"; // sql qeury to delete employee using id
    $result = mysqli_query($connection,$query); // send qeury to db server

    if(!$result) die("QUERY FAILED" . mysqli_connect_errno()); // kill connection if error occurs
    return json_encode(array("success"=>true)); // return json success
}
?> 