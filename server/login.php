<?php

use LDAP\Result;

require_once("db.php"); // include db connection file

$error=""; // error message initiated to be empty 

    if (isset($_POST['username']) && isset($_POST['password'])){ // check if username and password are empty
      
        $username = mysqli_real_escape_string($connection,$_POST['username']); // sanitize data
        $password = mysqli_real_escape_string($connection,$_POST['password']); // sanitize data
        

        $query = "SELECT * FROM customer WHERE username ='$username'"; // sql query to check if user with given username & password exist
        $result = mysqli_query($connection,$query); // send query to server db
        
        if (!$result){ // check if query is failed
            die('QUERY FAILED'.mysqli_connect_error($connection)); // query failed, kill it and diplay error message
        }
        $num_rows = mysqli_num_rows($result); // query success, fetch the number of rows of the result (it should return 1 otherwise there is no such user or user is duplicated)
        

        if ($num_rows == 1){ // check if we have only one user with such details
            $row = mysqli_fetch_assoc($result); // fetch query results
            $verified = $row['verified']?true:false; // if user is verified store value of variable as true else as false

            if(password_verify($password,$row['password'])){ // check if password match (cleartext password vs hash)
                if(!$verified) { // check if user is verified or not
                $error= 'Please make sure to verify you account'; // update error message with a message to inform user to verify account
                echo json_encode(array("success"=>false,"message"=>$error)); // send login success with false and error message in json format
                }
                else{ // verification successful (user is verified)
                    
                    session_start(); // start session to start login details 
                    $_SESSION['login'] = true; // store to indicate login is true
                    $_SESSION['type'] = 'user'; // store type of user to differentiate between admin and user
                    $_SESSION['user'] = $username; // store username of user
                    echo json_encode(array('success'=>true)); // send login success with 
                }    

            }else{ // password does not match
                $error= 'Password does not match'; // update error message with a message to inform about wrong password
                echo json_encode(array("success"=>false,"message"=>$error)); // send login success with false and error message in json format
            }
        }else{ // authentication unsuccessful
            echo json_encode(array('success'=>false,"message"=>"Invalid Credentials")); // send login failure along with message of invalid credentials in json format
        }
        
    }



    