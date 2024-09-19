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
    <form class="form_donation" action="" method="post">
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

    
    <label for="payment_method">Payment Method:</label>
    <select id="payment_method" name="payment_method">
        <option value="paypal">PayPal</option>
        <option value="mpesa">M-Pesa</option>
        <option value="bank_transfer">Bank Transfer</option>
    </select>
    <br><br>


     <!-- M-Pesa payment details fields -->
    <div id="mpesa-payment-details" style="display: none;">
        <label for="mpesa_phone_number">M-Pesa Phone Number:</label>
        <input type="tel" id="mpesa_phone_number" name="mpesa_phone_number">
        <br><br>
    </div>

     

    <label for="dedication">Dedication (optional):</label>
    <textarea id="dedication" name="dedication" rows="4" cols="50"></textarea>
    <br><br>

<!--link to display the terms and conditions -->
<label for="consent">I agree to the <a href="terms.html" id="terms-link">Terms and Conditions</a>:</label>
<input type="checkbox" id="consent" name="consent" required>
<br><br>

<!-- Create a div to display the terms and conditions -->
<div id="terms-conditions" style="display: none;">
  <h3>Terms and Conditions of Donation</h3>
  <p>By making a donation to Napastaa Heimen Children's Home, you acknowledge that you have read, understood, and agree to the following terms and conditions. Your donation is a voluntary contribution to support the charitable activities of Napastaa Heimen Children's Home. All donations are non-refundable and non-transferable. Napastaa Heimen Children's Home reserves the right to use your donation for the purpose of supporting our charitable activities, which may include but are not limited to, providing food, shelter, education, and healthcare to children in need. We will not share your personal information with any third party without your consent, except as required by law. By checking the box below, you confirm that you are at least 18 years old and have the authority to make this donation. You also acknowledge that you have read and understood our refund and cancellation policies, and that you release Napastaa Heimen Children's Home from any liability arising from your donation.</p>
  <button id="close-terms">Close</button>
</div>
<br><br>
    <input type="submit" name="donate" value="Donate">
    <br><br>
</form>
<script></script>
<script src="script.js"></script>
</body>
</html>