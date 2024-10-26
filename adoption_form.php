<?php
@include 'config.php';

session_start();

if(isset($_SESSION['email'])){
} else {
   header('location:login_form.php');
   exit;
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
            <li><a href="admin_page.php"> Admin HOME</a></li>
            <li><a class="active" href="#"> Adoption</a></li>
            <li><a href="complete_adoptions.php"></a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>


    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="donations_data.php">Donations</a></li>
                <li><a href="upcoming_events_admin.php">Upcoming Events</a></li>
                <li><a href="visitors.php">Visitors</a></li>
                <li><a class="active" href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title">Adoption form </h2>
            <form id="adoption-form">
                <p>Please fill out this form to adopt a child. All fields are required.</p>
                <br>
                <section>
                    <h3>Adopter Information</h3>
                    <br>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required>
                    <br><br>
                    <label for="phone">Phone:</label><br>
                    <input type="tel" id="phone" name="phone" required>
                    <br><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </section>

              
        </div>
</body>

</html>