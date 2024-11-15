<?php
session_start();

@include 'config.php';

if(isset($_SESSION['admin_name'])){
   // admin is logged in, allow access to the page
} else {
   header('location:login_form.php');
   exit;
}

$query = "SELECT * FROM upcoming_events WHERE completed = 1";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Events</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label class="logo">NAPASTAA HEIMEN CHILDRENS CENTER</label>
        <ul>
            <li><a href="admin_page.php">ADMIN HOME</a></li>
            <li><a href="upcoming_events.php">UPCOMING EVENTS</a></li>
            <li><a class="active" href="completed_events.php"></a>