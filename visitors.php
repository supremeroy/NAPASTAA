<?php
session_start();
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "napastaa_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_SESSION['admin_name'])){
    // admin is logged in, allow access to the page
 } else {
    header('location:login_form.php');
    exit;
 }
 
// Retrieve the upcoming visitors
$query = "SELECT * FROM visitors WHERE visit_date >= CURDATE()";
$result = mysqli_query($conn, $query);

// Create an array to store the visitors
$visitors = array();

// Loop through the results and add to the array
while ($row = mysqli_fetch_assoc($result)) {
    $visitors[] = $row;
}

// Close the database connection
mysqli_close($conn);
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
            <li><a  href="admin_page.php"> Admin HOME</a></li>
             <li><a class="active"href="#"> VISITORS</a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>

    <h2 class="h2title">Upcoming Visitors</h2>

    <table id="visitors-table">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Visit Date</th>
                <th>Visit Time</th>
                <th>Purpose of Visit</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody id="visitors-tbody">
            <?php foreach ($visitors as $visitor) { ?>
            <tr>
                <td><?= $visitor['id'] ?></td>
                <td><?= $visitor['name'] ?></td>
                <td><?= $visitor['email'] ?></td>
                <td><?= $visitor['phone_number'] ?></td>
                <td><?= $visitor['visit_date'] ?></td>
                <td><?= $visitor['visit_time'] ?></td>
                <td><?= $visitor['purpose'] ?></td>
                <td><?= $visitor['comments'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>