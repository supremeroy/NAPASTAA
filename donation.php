<?php
 @include 'config.php' ; // Connect to database
  $conn=mysqli_connect('localhost', 'root' , '' , 'napastaa_db' );
    // Check connection 
    if (!$conn) { die("Connection failed: " . mysqli_connect_error());
}
// Insert donation into database
if (isset($_POST['donate'])) {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $donation_type = $_POST['donation_type'];
    $donation_amount = $_POST['donation_amount'];
    $payment_method = $_POST['payment_method'];
    $dedication = $_POST['dedication'];
    $mpesa_phone_number = $_POST['mpesa_phone_number'];
    $bank_name = $_POST['bank_name'];
    $bank_account_number = $_POST['bank_account_number'];
    $bank_branch = $_POST['bank_branch'];
    $paypal_email = $_POST['paypal_email'];

    $sql = " INSERT INTO donations (name, phone_number, email, donation_type, donation_amount, payment_method,
    dedication, mpesa_phone_number, bank_name, bank_account_number, bank_branch, paypal_email) VALUES
    ('$name', '$phone_number' , '$email' , '$donation_type' , '$donation_amount' , '$payment_method' , '$dedication'
    , '$mpesa_phone_number' , '$bank_name' , '$bank_account_number' , '$bank_branch' , '$paypal_email' )"; if
    (!mysqli_query($conn, $sql)) { echo "Error: " . $sql . "<br>" . mysqli_error($conn); } } ?>

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
        <label class="logo">NAPASTAA HEIMEN CHILDRENS CENTER</label>
        <ul>
            <li><a href="user_page.php">Donor Home</a></li>
            <li><a class="active" href="donatio.php"> Donate</a></li>
            <li><a href="#anonymous">Anonymous Donation</a></li>
            <li><a href="upcoming_events.php">Upcoming Events</a></li>
            <li><a href="visit.php">Visit</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
        </ul>
    </nav>
    <br>
    <br>
    <h2 class="h2title">Make a Donation</h2>
    <div class="img-back">
        <div class="imgd">
            <img class="imgd1" style="border-radius:10px;" src="images/mchild.jpg"
                alt="children smiling while posing for a photo">
            <div class="PD">
                <p style="margin-top: 20px;
  color: rgb(0, 0, 0);
  text-decoration: solid;
  text-transform: capitalize;
  text-align: center;
  font-size: larger;
  padding: 10px;
  margin:10px;
  background-color: rgb(255, 255, 255);
  text-transform: uppercase;
  font-weight: bold;">Thank you for your contribution to the well being of Children in our center
                </p>
            </div>
        </div>
        <form class="form_donation" action="" method="post">
            <div class="successful"
                style="<?php if (isset($_POST['donate'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                <div
                    style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                    Donation is being processed. Thank you for your contribution!</div>
            </div>
            <h2>Make a Donation</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="donation_amount">Donation Amount:</label>
            <input type="number" id="donation_amount" name="donation_amount" required>
            <br>
            <label for="donation_type">Donation Type:</label>
            <select id="donation_type" name="donation_type">
                <option value="Cash">Cash</option>
                <option value="Food">Food</option>
                <option value="Clothing">Clothing</option>
                <option value="Other">Other</option>
            </select>
            <br>

            <!-- Payment Method -->
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method">
                <option value="Other">Other</option>
                <option value="paypal">PayPal</option>
                <option value="mpesa">M-Pesa</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
            <br>

            <!-- PayPal payment details fields -->
            <div id="paypal-payment-details" style="display: none;">
                <label for="paypal_email">PayPal Email:</label>
                <input type="email" id="paypal_email" name="paypal_email">
                <br>
            </div>

            <!-- M-Pesa payment details fields -->
            <div id="mpesa-payment-details" style="display: none;">
                <label for="mpesa_phone_number">M-Pesa Phone Number:</label>
                <input type="tel" id="mpesa_phone_number" name="mpesa_phone_number">
                <br>

                <button type="button" class="prompt" onclick="promptForMpesa()">Prompt</button>

            </div>

            <!-- Bank Transfer payment details fields -->
            <div id="bank-transfer-payment-details" style="display: none;">
                <label for="bank_name">Bank Name:</label>
                <input type="text" id="bank_name" name="bank_name">
                <br>
                <label for="bank_account_number">Bank Account Number:</label>
                <input type="text" id="bank_account_number" name="bank_account_number">
                <br><br>
                <label for="bank_branch">Bank Branch:</label>
                <input type="text" id="bank_branch" name="bank_branch">
                <br>
            </div>

            <label for="dedication">Dedication (optional):</label>
            <textarea id="dedication" name="dedication" rows="4" cols="50"></textarea>
            <br>

            <!--link to display the terms and conditions -->
            <label for="user_agreement"><input type="checkbox" name="user_agreement" value="1" required
                    style="width:auto;"> I agree to the
                <a href="#" id="terms-link" onclick="showTerms()">Terms and Conditions</a>:</label>
            <br>

            <div id="terms" style="display: none;">
                <p>By making a donation to Napastaa Heimen Children's Home, you acknowledge that you have read,
                    understood,
                    and agree to the following terms and conditions. Your donation is a voluntary contribution to
                    support
                    the charitable activities of Napastaa Heimen Children's Home. All donations are non-refundable
                    and
                    non-transferable. Napastaa Heimen Children's Home reserves the right to use your donation for
                    the
                    purpose of supporting our charitable activities, which may include but are not limited to,
                    providing
                    food, shelter, education, and healthcare to children in need. We will not share your personal
                    information with any third party without your consent, except as required by law. By checking
                    the
                    box
                    below, you confirm that you are at least 18 years old and have the authority to make this
                    donation.
                    You
                    also acknowledge that you have read and understood our refund and cancellation policies, and
                    that
                    you
                    release Napastaa Heimen Children's Home from any liability arising from your donation.</p>
            </div>

            <br>
            <input type="submit" name="donate" value="donate">
            <br><br>
            <div class="successful"
                style="<?php if (isset($_POST['donate'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                <div
                    style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                    Donation is being processed. Thank you for your contribution!</div>
            </div>
        </form>
    </div>

    <div class="anonymous">

        <h3 class="h2title">Make an anonymous Donations. Your details wont be saved</h3>
        <a href="https://www.paypal.com/donate/?hosted_button_id=PEBXQXXSKQLJY">
            <h2 class="h2title" id="anonymous">PAYPAL</h2>
        </a>

        <h2 class="h2title">Mpesa
            <br>
            Paybill - 85747
            <br>
            Account - NAPASTAA
        </h2>
    </div>




    <script src="script.js"></script>

    <div class="footer">
        <footer>
            <div class="footer-content">
                <p>&copy; 2024 Napastaa Heimen Children's Home. All rights reserved.</p>
                <p>Contact us: <a href="mailto:machariaroy268@gmail.com">info@napastaheimen.com</a></p>

                <p>Follow us on:
                    <a href="https://www.facebook.com/napastaheimen" target="_blank">Facebook</a> |
                    <a href="https://twitter.com/napastaheimen" target="_blank">Twitter</a> |
                    <a href="https://www.instagram.com/napastaheimen" target="_blank">Instagram</a>
                </p>
            </div>
        </footer>
    </div>
</body>

</html>