<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "napastaa_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the event ID from the URL parameter
$event_id = $_GET['id'];

// Query to retrieve the event details
$query = "SELECT * FROM upcoming_events WHERE id = '$event_id'";
$result = mysqli_query($conn, $query);

// Check if the event exists
if (mysqli_num_rows($result) > 0) {
  $event = mysqli_fetch_assoc($result);
} else {
  echo "Event not found.";
  exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
  $event_title = $_POST['event_title'];
  $event_date = $_POST['event_date'];
  $event_description = $_POST['event_description'];
  $event_image = $_FILES['event_image'];

  // Update the event details
  $query = "UPDATE upcoming_events SET 
              event_title = '$event_title', 
              event_date = '$event_date', 
              event_description = '$event_description' 
              WHERE id = '$event_id'";
  $result = mysqli_query($conn, $query);

  // Upload the new event image
  if ($event_image['name'] != '') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($event_image['name']);
    move_uploaded_file($event_image['tmp_name'], $target_file);
    $query = "UPDATE upcoming_events SET event_image = '$target_file' WHERE id = '$event_id'";
    $result = mysqli_query($conn, $query);
  }

  echo "Event updated successfully.";
  header("Location: upcoming_events_admin.php");
  exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Upcoming Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
        <ul>
            <li><a href="admin_page.php">ADMIN HOME</a></li>
            <li><a class="active" href="edit_events.php">EDIT EVENTS</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

  
<form action="edit_event.php?id=<?php echo $event_id; ?>" method="post" enctype="multipart/form-data">
  <label>Event Title:</label>
  <input type="text" name="event_title" value="<?php echo $event['event_title']; ?>"><br><br>
  <label>Event Date:</label>
  <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>"><br><br>
  <label>Event Description:</label>
  <textarea name="event_description"><?php echo $event['event_description']; ?></textarea><br><br>
  <label>Event Image:</label>
  <input type="file" name="event_image"><br><br>
  <input type="submit" name="submit" value="Update Event">
</form>
</body>
</html>

<script src="script.js"></script>
<!-- Edit event form -->

