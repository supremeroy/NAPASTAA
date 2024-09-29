<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['email'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Online charity/donation system ">
    <meta name="keywords" content="Donation,Charity,Childrens home">
    <meta name="author" content="Roy Macharia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAPASTAA HEIMEN CHILDRENS HOME DONATION MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    
    
</head>

<body>
    <nav>
        <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
        <ul>
            <li><a class="active" href="admin_page.php">Admin Home</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </nav>

   
<div class="container">

   <div class="content">
       <style>
       </style>
      <h3>hello <span>admin</span></h3>
      <h1>welcome</h1>
      <p>this is an admin page</p>
      <a href="donor_data.php" class="btn">DONOR DETAILS</a>
      <a href="donations_data.php" class="btn">DONATION DETAILS</a>
      <a href="upcoming_events_admin.php" class="btn">UPCOMING EVENTS</a>
      <a href="adoption_form.php" class="btn">ADOPTION</a>
      <a href="visitors.php" class="btn"> VISITORS</a>
    </div>

</div>

</body>
</html>