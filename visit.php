<?php
@include 'config.php';

// Check if the user is logged in
if (isset($_SESSION['user_name'])) {

  // User is not logged in, redirect to login page
  header("Location: login.php");
  exit;
}
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
      <li><a href="index.php">Home</a></li>
      <li><a href="aboutus.html">ABOUT US</a></li>
      <li><a href="logout.php">logout</a></li>
    </ul>
  </nav>

  <div class="container">
    <div class="content">
      <h1>Visit Form</h1>
      <p>Please fill in the form below to request a visit to Napastaa Heimen.</p>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly><br><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" readonly><br><br>

        <label for="visit_date">Visit Date:</label>
        <input type="date" id="visit_date" name="visit_date" required><br><br>

        <label for="visit_time">Visit Time:</label>
        <select id="visit_time" name="visit_time" required>
          <option value="">Select a time</option>
          <option value="Morning">Morning</option>
          <option value="Afternoon">Afternoon</option>
          <option value="Evening">Evening</option>
        </select><br><br>

        <label for="purpose_of_visit">Purpose of Visit:</label>
        <select id="purpose_of_visit" name="purpose_of_visit" required>
          <option value="">Select a purpose</option>
          <option value="Volunteering">Volunteering</option>
          <option value="Donation">Donation</option>
          <option value="Tour of the Facility">Tour of the Facility</option>
          <option value="Other">Other (Please specify)</option>
        </select><br><br>

        <label for="duration_of_stay">Duration of Stay:</label>
        <input type="text" id="duration_of_stay" name="duration_of_stay"><br><br>

        <label for="special_requirements">Special Requirements or Requests:</label>
        <textarea id="special_requirements" name="special_requirements"></textarea><br><br>

        <input type="submit" value="Request Visit">
      </form>
    </div>
  </div>
</body>
</html>