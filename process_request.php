<?php
// Include your database connection file
@include 'config.php';

// Get the ID and action from the URL
$id = $_GET['id'];
$action = $_GET['action'];

// Fetch the email address associated with the event (assuming you have it in your database)
$query = "SELECT email FROM upcoming_events WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $email = $row['email']; // Assuming you have an email field

    // Set the email subject and message based on the action
    if ($action == 'approve') {
        $subject = "Your request Has Been Approved!";
        $message = "Congratulations! Your visit request has been approved.";
    } elseif ($action == 'decline') {
        $subject = "Your request Has Been Declined.";
        $message = "We are sorry, but your visit request has been declined.";
    }

    // Send the email
    $headers = "From: napastaa@gmail.com"; // Replace with your sender email
    if (mail($email, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Event not found.";
}

// Close the connection
mysqli_close($conn);
?>