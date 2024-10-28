<?php
@include 'config.php';
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
            <li><a href="user_page.php"> Donor Home</a></li>
            <li><a href="donation.php">Donate</a></li>
            <li> <a class="active" href="upcoming_events.php" class="btn">EVENTS</a></li>
            <li><a href="visit.php">Visit</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
        </ul>
    </nav>
</body>

</html>

<h2 class="h2title">Upcoming events</h1>
    <?php 
// Query to retrieve upcoming events
$query = "SELECT * FROM upcoming_events WHERE completed = 0 ORDER BY event_date ASC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr><th>ID</th><th>Event Title</th><th>Event Date</th><th>Event Description</th><th>Event Image</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    $event_id = $row['id'];
    $event_title = $row['event_title'];
    $event_date = $row['event_date'];
    $event_description = $row['event_description'];
    $event_image = $row['event_image'];
    echo "<tr>";
    echo "<td>$event_id</td>";
    echo "<td>$event_title</td>";
    echo "<td>$event_date</td>";
    echo "<td>$event_description</td>";
    echo "<td><img src='$event_image' alt='$event_title' class='event-image'></td>";   
  
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No upcoming events found.";
}

mysqli_close($conn);


?>



    <script src="script.js"></script>