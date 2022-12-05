<?php
// Initialize the session.
session_start();

// unset session values for user
// will not destroy session as it might interfere with session of admin
// hence will unset session values that corresponds with user
unset($_SESSION['login']);
unset($_SESSION['type']);
unset($_SESSION['user']);

echo json_encode(array('success'=>true)) // send succesful logout data in json format
?>