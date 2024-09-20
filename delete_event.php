<?php
session_start();

@include 'config.php';

if(isset($_SESSION['admin_name'])){
   // admin is logged in, allow access to the page
} else {
   header('location:login_form.php');
   exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM upcoming_events WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if($result) {
        header('location:upcoming_events_admin.php');
    } else {
        echo "Error deleting event: " . mysqli_error($conn);
    }
} else {
    echo "No event ID provided";
}
?>