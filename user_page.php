<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
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
            <li><a class="active" href="user_page.php">Donor Home</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
            <li><a href="logout.php">LOGOUT</a></li>

        </ul>
    </nav>

<div class="container">
   <div class="content">
      <h3>hello, <span>DONOR</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>" Your generosity helps shape brighter futures for our children. <br> Thank you for being part of our mission to uplift and empower the next generation."</p>
      <a href="donation.php" class="btn">Donate</a>
      <a href="upcoming_events.php" class="btn">UPCOMING EVENTS</a>
      <a href="visit.php" class="btn">VISIT</a>
   </div>

</div>

</body>
</html>