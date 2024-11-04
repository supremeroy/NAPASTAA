<?php

@include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:login_form.php');
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = isset($_POST['event_title']) ? trim($_POST['event_title']) : '';
    $eventDate = isset($_POST['event_date']) ? $_POST['event_date'] : ''; 
    $eventDescription = isset($_POST['event_description']) ? trim($_POST['event_description']) : ''; 
    $eventImage = $_FILES['event_image']; 
}// Use $_FILES to get the uploaded file

    // Check if event description is empty
    if (empty($eventDescription)) {
        echo "";
    } else {
        // Check if the image was uploaded without errors
        if ($eventImage['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/'; // Directory where images will be uploaded
            $uploadFile = $uploadDir . basename($eventImage['name']);
        }
            // Move the uploaded file to the designated directory
            if (move_uploaded_file($eventImage['tmp_name'], $uploadFile)) {
            }

    // Check if event description is empty
    if (empty($eventDescription)) {
        echo "Event description cannot be empty.";
    } else {
        // Prepare the SQL statement
        $stmt = $mysqli->prepare("INSERT INTO upcoming_events (event_title, event_date, event_description, event_image) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }

        // Correctly bind the parameters
        $stmt->bind_param("ssss", $eventName, $eventDate, $eventDescription, $eventImage);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New event created successfully.";
        } else {
            echo "Error: " . $stmt->error; 
        }

        // Close the statement
        $stmt->close();
    }
}

// Retrieve events from the database
$result = $mysqli->query("SELECT * FROM upcoming_events");

if (!$result) {
    die("Query failed: " . $mysqli->error);
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
            <li><a class="active" href="upcoming_events_admin.php">UPCOMING EVENTS</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a href="donations_data.php">Donations</a></li>
                <li><a class="active" href="upcoming_events_admin.php">Events</a></li>
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
                <input type="text" id="event_description" name="event_description" required><br><br>

                <label for="event_image">Event Image:</label>
                <input type="file" id="event_image" name="event_image" required><br><br>

                <input type="submit" value="post event" name="posted_event" id="post_event">
                <br>

                <div class="successful"
                    style="<?php if (isset($_POST['posted_event'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Event posted successfully!
                    </div>

                </div>
        </div>
        </form>
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>Event Title</th>
                <th>Event Date</th>
                <th>Event Description</th>
                <th>Event Image</th>
                <th>Actions</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['event_title']; ?></td>
                <td><?php echo $row['event_date']; ?></td>
                <td><?php echo $row['event_description']; ?></td>
                <td>
                    <?php
    $imageSrc = $row['event_image'];
    echo "<img src='$imageSrc' width='150' height='100' style='border-radius: 5px;'>";
    echo "<p>$imageSrc</p>"; // Debugging line to print the image URL
    ?>
                </td>

                <td>
                    <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="edit-link">Edit</a>
                    |
                    <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="delete-link">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
    </div>
</bodybody
</html>