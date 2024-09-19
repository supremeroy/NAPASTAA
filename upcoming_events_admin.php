<?php
session_start();

@include 'config.php';

if(isset($_SESSION['admin_name'])){
   // admin is logged in, allow access to the page
} else {
   header('location:login_form.php');
   exit;
}

// Check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   $event_title = $_POST['event_title'];
   $event_date = $_POST['event_date'];
   $event_description = $_POST['event_description'];
   $event_image = $_FILES['event_image'];

   // Check if the image has been uploaded
   if($event_image['error'] == 0) {
      $image_name = $event_image['name'];
      $image_tmp_name = $event_image['tmp_name'];
      $image_size = $event_image['size'];
      $image_type = $event_image['type'];

      // Check if the image is valid
      $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
      if(in_array($image_type, $allowed_types)) {
         // Upload the image
         $upload_dir = 'uploads/';
         $image_path = $upload_dir . $image_name;
         move_uploaded_file($image_tmp_name, $image_path);

         // Insert the event into the database
         $query = "INSERT INTO upcoming_events (event_title, event_date, event_description, event_image) VALUES ('$event_title', '$event_date', '$event_description', '$image_path')";
         $result = mysqli_query($conn, $query);

         if($result) {
            echo "Event posted successfully!";
         } else {
            echo "Error posting event: " . mysqli_error($conn);
         }
      } else {
         echo "Invalid image type. Only JPEG, PNG, and GIF are allowed.";
      }
   } else {
      echo "Error uploading image: " . $event_image['error'];
   }
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
            <li><a href="user_page.php">DONOR HOME</a></li>
            <li><a class="active" href="upcoming_events.php">UPCOMING EVENTS</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

    

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <h1 class="h1event">Post Upcoming Event</h1>
        <label for="event_title">Event Title:</label>
        <input type="text" id="event_title" name="event_title" required><br><br>

        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" required><br><br>

        <label for="event_description">Event Description:</label>
        <textarea id="event_description" name="event_description" required></textarea><br><br>

        <label for="event_image">Event Image:</label>
        <input type="file" id="event_image" name="event_image" required><br><br>

        <input type="submit" value="Post Event">
    </form>
</body>
</html>