<?php

@include 'config.php';

session_start();

if(isset($_SESSION['email'])){
} else {
   header('location:login_form.php');
   exit;
}


$sql = "SELECT * FROM donations"; 
$result = mysqli_query($conn, $sql);



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
            <li><a href="admin_page.php"> Admin HOME</a></li>
            <li><a class="active" href="#"> Donations Data</a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>
    <br>


    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a class="active" href="donations_data.php">Donations</a></li>
                <li><a href="upcoming_events_admin.php">Upcoming Events</a></li>
                <li><a href="visitors.php">Visitors</a></li>
                <li><a href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title"> Donations</h2>

            <?php 
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
    <th>ID</th>
    <th>Donor Name</th>
    <th>Donation type</th>
    <th>Donation amount</th>
    <th>payment method</th>
    <th>Mpesa Phone No</th>
    <th>dedication</th>
    </tr>"; 
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>"; 
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["donation_type"] . "</td>";
        echo "<td>" . $row["donation_amount"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["mpesa_phone_number"] ."</td>";
        echo "<td>" . $row["dedication"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No donations found.";
}
    ?>


        </div>
    </div>





    <h2 class="h2title">Processed Donations</h2>
</body>

</html>