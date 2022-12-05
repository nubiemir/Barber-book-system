<?php 

require_once "db.php"; // include connection file

if (isset($_GET['em']) && isset($_GET['key'])){ // check if the value of email & key are set in the link (if user clicked on the link provided in the email for verification)
    $key = $_GET['key']; // retrieve the value of verification key 

    
    $query = "SELECT * FROM customer WHERE ver_key ='{$key}'"; // sql query to make sure the verification key exists in the db for the user
    $result = mysqli_query($connection,$query); // send query to the db server

    if(!$result) die('QUERY FAILED' . mysqli_connect_error()); // if query failed send error message

    // 
    $num_row = mysqli_num_rows($result); // get the number of row for the query (it should be 1 for successful verification)

    $row = mysqli_fetch_assoc($result); // fetch the result of the query
    $verified = $row['verified']; // store the value of verified column (it is either yes or not, yes is verified by default it is set null)

    if($verified){ // check if value of verified column is not null
        return;  // value is not null, user is already verified 
    }

    if($num_row == 1){ // we have only one user with the given key
        $query = "UPDATE customer SET verified='yes' WHERE ver_key='$key'"; // query to update the value of verified to yes
        $result = mysqli_query($connection,$query); // send query to db server

        if(!$result) die('QUERY FAILED' . mysqli_connect_error()); // if query failed send error message
        header("location:../userlogin.php"); // user verified successfuly and redirect user to login page
    }


}






?>

