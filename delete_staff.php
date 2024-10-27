<?php
@include 'config.php';
session_start();

if (isset($_SESSION['email'])) {
    // User is logged in
} else {
    header('location:login_form.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL statement to delete the staff member
    $sql = "DELETE FROM staff_info WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Staff member deleted successfully.'); window.location.href='staff_info.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No staff ID provided.";
}

$conn->close();
?>