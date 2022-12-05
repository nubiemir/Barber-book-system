<?php

use LDAP\Result;

require_once("db.php"); // include the connection file


    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['password'])){ // check if required input are set
        // SANTIZE DATA 
        $fname = mysqli_real_escape_string($connection,$_POST['fname']);
        $lname = mysqli_real_escape_string($connection,$_POST['lname']);
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        $salt = "$2y$10$4bb929c2f01469b5597bf021a33bd3a1822c85149ac9"; // salting password to increase level of security
	    $encrypted = crypt($password,$salt); // encrypt password with the salt
        
        
        $query = "SELECT * FROM customer WHERE email = '$email' or username='$username'"; // sql query to check if user exists with given details
        $result = mysqli_query($connection,$query); // send query to db server
        
        if (!$result){ // check if query failed
            die('QUERY FAILED'.mysqli_connect_error($connection)); // if query failed kill it and send error message
        }
        $num_rows = mysqli_num_rows($result); // retrieve the number of rows displayed from the query
        if ($num_rows == 0){ // check if there is only one user with the given inpus
            $key = generateVerificationKey(); // inovoke a function to generate a verification key
            $query2 = "INSERT INTO customer (fname,lname,username,email,password,date_creation,ver_key) VALUES ('$fname','$lname','$username','$email','$encrypted',now(),'$key')"; // sql query to insert user details into db table customer
            $result2 = mysqli_query($connection,$query2); // send query to db server

            if(!$result2) die('QUERY FAILED' . mysqli_connect_errno()); // query failed, kill it and diplay error message

            $url = "localhost/PHP-Project/server/verify.php?key=$key&em=$email"; // url link to be sent in email (for verification)
            $msg= "Thank you for registering\nYour account has now been created and you can log in by using your email address and password by visiting\n our website or at the following URL:\n"; // email message
            $msg .= $url; // email message with link to be sent to user for verification
            $subject = "ፈጠሮ ባርቤሪ-barber,Thanks for registering"; // email subject
            mail($email,$subject,$msg); // send email to user with message and subject

            echo json_encode(array('success'=>true)); // send success array in json format
        }else{
            echo json_encode(array('success'=>false)); // user with given inputs already exists and send failure in json format
        }
        
        
        
    }


    function generateVerificationKey(){
        // a function to generate unique verification key
        return md5(rand(10,70));
    }

