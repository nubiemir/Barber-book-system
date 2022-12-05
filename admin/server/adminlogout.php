<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

unset($_SESSION['adminlogin']);
unset($_SESSION['admintype']);
unset($_SESSION['admin']);


echo json_encode(array('success'=>true))
?>