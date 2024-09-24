<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "napastaa_db");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
  // User is not logged in, redirect to login page
  header("Location: login.php");
  exit;
}

// Retrieve the user's name, email, and phone from the database
$query = "SELECT name, email, phone FROM user_form WHERE name = '".$_SESSION['user_name']."'";
$result = mysqli_query($conn, $query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$user_data = mysqli_fetch_assoc($result);
$name = $user_data['name'];
$email = $user_data['email'];
$phone = $user_data['phone'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $visit_date = $_POST['visit_date'];
  $visit_time = $_POST['visit_time']; // user manually enters the time
  $purpose_of_visit = $_POST['purpose_of_visit'];
  $duration_of_stay = $_POST['duration_of_stay'];
  $special_requirements = $_POST['special_requirements'];

  // Insert visit request into database
  $query = "INSERT INTO visitors (name, email, phone_number, visit_date, visit_time, purpose, comments) VALUES ('$name', '$email', '$phone', '$visit_date', '$visit_time', '$purpose_of_visit', '$special_requirements')";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }

}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Napastaa Heimen Visit Form">
  <meta name="keywords" content="Napastaa Heimen, Visit Form">
  <meta name="author" content="Roy Macharia">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NAPASTAA HEIMEN VISIT FORM</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
</head>

<body>
  <nav>
    <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
    <ul>
      <li><a href="user_page.php">Donor Home</a></li>
      <li><a href="aboutus.html">ABOUT US</a></li>
      <li><a href="logout.php">logout</a></li>
    </ul>
  </nav>
<div class="background">
  <div class="container">
    <div class="content">
      
      <p>Please fill in the form below to request a visit to Napastaa Heimen childrens center.</p>

      <form class="form-visit" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <h3 style="text-align:center">Visit Form</h3>
  <br>
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly><br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly><br>
  <label for="phone">Phone phone:</label>
  <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" readonly><br>

        <label for="visit_date">Visit Date:</label>
        <input type="date" id="visit_date" name="visit_date" required><br>

        <label for="visit_time">Visit Time:</label>
        <input type="time" id="visit_time" name="visit_time" required><br>

        <label for="purpose_of_visit">Purpose of Visit:</label>
        <select class="purpose" id="purpose_of_visit" name="purpose_of_visit" required>
          <option value="">Select a purpose</option>
          <option value="Volunteering">Volunteering</option>
          <option value="Donation">Donation</option>
          <option value="Tour of the Facility">Tour of the Facility</option>
          <option value="Adopt">Adopt a child</option>
          <option value="Other">Other (Please specify)</option>
        </select><br>

        <label for="duration_of_stay">Duration of Stay:</label>
        <input type="text" id="duration_of_stay" name="duration_of_stay"><br>

        <label for="special_requirements">Special Requirements or Requests:</label>
        <textarea id="special_requirements" name="special_requirements"></textarea><br>

        <input type="submit" value="Request Visit">
<br>
        <div class="successful"><?php
           echo '<div class="successful" style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">"Visit request submitted successfully!"</div>';

    
        ?>
        </div>
      </form>
    </div>
  </div>
  </div>
</body>
</html>