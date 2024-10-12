<?php
@include 'config.php';

session_start();

if(isset($_SESSION['email'])){
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

  $uploads_dir = dirname(__FILE__) . '/uploads/';
      if (!file_exists($uploads_dir)) {
          mkdir($uploads_dir, 0777, true);
      }
         $upload_dir = 'uploads/';
         $image_path = $upload_dir . $image_name;
         move_uploaded_file($_FILES['event_image']['tmp_name'], $uploads_dir . $_FILES['event_image']['name']);
         // Insert the event into the database
         $query = "INSERT INTO upcoming_events (event_title, event_date, event_description, event_image) VALUES ('$event_title', '$event_date', '$event_description', '$image_path')";
         $result = mysqli_query($conn, $query);

         if($result) {
            $posted = true; // Set a flag to indicate that the event has been posted
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



// Display events
$query = "SELECT * FROM upcoming_events WHERE completed = 0";
$result = mysqli_query($conn, $query);

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
            <li><a class="active" href="upcoming_events_admin.php">UPCOMING EVENTS</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="donations_data.php">Donations</a></li>
                <li><a class="active" href="upcoming_events_admin.php">Upcoming Events</a></li>
                <li><a href="visitors.php">Visitors</a></li>
                <li><a href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h2 class="h2title">Upcoming events</h2>

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
                <br>
                <?php
if(isset($posted)) {
   echo '<div class="successful" style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">Event posted Successful!</div>';
}
?>



            </form>

            <h2 style="text-align: center;">Upcoming Events</h2>
            <table>
                <tr>
                    <th>id</th>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Event Description</th>
                    <th>Event Image</th>
                    <th>Completed</th>
                    <th>Actions</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['event_title']; ?></td>
                    <td><?php echo $row['event_date']; ?></td>
                    <td><?php echo $row['event_description']; ?></td>
                    <td><img src="<?php echo $row['event_image']; ?>" width="150" height="100"
                            style="border-radius: 5px;"></td>
                    <td>
                        <input type="checkbox" name="completed" value="<?php echo $row['id']; ?>"
                            <?php if($row['completed'] == 1) echo "checked"; ?>>
                    </td>
                    <td>
                        <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="edit-link">Edit</a>
                        <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="delete-link">Delete</a>
                    </td>
                </tr>
                <?php } ?>

            </table>







            <?php
// Check if the user has clicked the "Attend Event" button
if (isset($_GET['id'])) {
  $event_id = $_GET['id'];
  
  // Query the database to retrieve the list of attendees for the specified event
  $query = "SELECT d.donor_id, d.donor_name, e.event_title 
            FROM donors d 
            JOIN event_attendees ea ON id = id 
            JOIN upcoming_events e ON id = e.id 
            WHERE e.id = $event_id";
  $result = mysqli_query($conn, $query);
  
  // Display the table of attendees
  echo "<h2>Attendees for Event: $event_id</h2>";
  echo "<table>";
  echo "<tr><th>Donor ID</th><th>Donor Name</th></tr>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['user_name'] . "</td>";
    echo "</tr>";
  }
  
  echo "</table>";
}
?>
        </div>

</body>

</html>