<?php
@include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('location:login_form.php');
    exit;
}

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Prepare the SQL statement to delete the child record
    $sql= "DELETE FROM children WHERE id = '$id'";
    
    // Execute the statement
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('child data deleted successfully.'); window.location.href='childrens_data.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    } else {
    echo "No child ID provided.";
}


$conn->close();
?>