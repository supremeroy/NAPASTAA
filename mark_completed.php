<?php
session_start();

@include 'config.php';

if(isset($_SESSION['admin_name'])){
   // admin is logged in, allow access to the page
} else {
   header('location:login_form.php');
   exit;
}

if(isset($_POST['completed'])) {
    $ids = $_POST['completed'];
    foreach($ids as $id) {
        $query = "UPDATE upcoming_events SET completed = 1 WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
    }
    header('location:upcoming_events_admin.php');
} else {
    echo "No events selected";
}
?>