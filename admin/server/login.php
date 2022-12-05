<?php 
require_once("db.php"); // include connection file

$error=""; // error message initialized to empty
 

if (isset($_POST['username']) && isset($_POST['password'])){ // check if username and password are submitted

    $username = mysqli_real_escape_string($connection,$_POST['username']);//sanitize data
    $password = mysqli_real_escape_string($connection,$_POST['password']);//sanitize data
    
    
    $query = "SELECT * FROM admin WHERE username ='{$username}' AND password='{$password}'"; // sql query to find user with such credentials
    $result = mysqli_query($connection,$query); // send query to db server
    
    if (!$result){
        die('QUERY FAILED'.mysqli_connect_error($connection)); // kill connection if result failed
    }

    $num_rows = mysqli_num_rows($result); // retrieve number of row for the query
    if ($num_rows!=1){ // we should have only one user with such credentials
        echo json_encode(array('success'=>false,"message"=>"Invalid Credentials")); // send success message and error message in json format
    }else{ // authentication successful
                session_start(); // start session 
                $_SESSION['adminlogin'] = true; // login 
                $_SESSION['admintype'] = 'admin'; // admin is logged in
                $_SESSION['admin'] = $username; // admin username
        echo json_encode(array('success'=>true)); // send success message
    }
}