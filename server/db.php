<?php 
// database details

define('HOSTNAME',"localhost"); // constant for the name of host of db
define('DATABASE',"barber_management_system"); // constant of db name
define('USERNAME',"root"); // constant of username of phpmyadmin
define('PASSWORD',''); // constant of password


$connection = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE); // connect to db server

if (!$connection){ // check if connection failed
    die( "Invalid Connection to databse" . mysqli_connect_error($connection)); // if connection failed display error message and sql error number
}
