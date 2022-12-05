<?php 
session_start();

if(!$_SESSION['adminlogin'] && $_SESSION['admin']!=="admin"){ // checks if user is logged in and is admin
    header("location:adminLogin.php"); // login not approved redirected to admin login
}

?>
<!-- this is the header that is included in every page acros the admin folder, hence it is included in every page. Changes made here reflect everywhere -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="js/script.js"></script>
    <link rel="stylesheet" href="adminStyle.css" />
    <link rel="shortcut icon" type="image/x-icon" href=".././images/barber.png">
    <title>Barber Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">

