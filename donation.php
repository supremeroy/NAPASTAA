<?php
@include 'config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

// Connect to database
$conn = mysqli_connect('localhost','root','','napastaa_db');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user name from session
$user_name = $_SESSION['user_name'];

// Get donation amount and type from form
if (isset($_POST['donate'])) {
    $donation_amount = $_POST['donation_amount'];
    $donation_type = $_POST['donation_type'];

    // Insert donation into database
    $sql = "INSERT INTO donations (user_name, donation_amount, donation_type) VALUES ('$user_name', '$donation_amount', '$donation_type')";
    if (mysqli_query($conn, $sql)) {
        echo "Donation successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
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
            <li><a class="active" href="index.html"> Donor Home</a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
        </ul>
    </nav>

    <h2 class="h2donate">Make a Donation</h2>
    <form class="form_donation"action="" method="post" >
        <label for="donation_amount">Donation Amount:</label>
        <input type="number" id="donation_amount" name="donation_amount" required>
        <br><br>
        <label for="donation_type">Donation Type:</label>
        <select id="donation_type" name="donation_type">
            <option value="Cash">Cash</option>
            <option value="Food">Food</option>
            <option value="Clothing">Clothing</option>
            <option value="Other">Other</option>
        </select>
        <br><br>
        <input type="submit" name="donate" value="Donate">
    </form>
</body>
</html>