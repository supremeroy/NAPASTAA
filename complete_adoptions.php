<?php

@include 'config.php';
session_start();
if(!isset($_SESSION['email'])){
   header('location:login_form.php');
}


$query = "SELECT * FROM adoption_applications";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error fetching data: " . mysqli_error($conn);
    exit;
}

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
            <li><a href="adoption_form.php"> Adoption</a></li>
            <li><a class="active" href="complete_adoptions.php">PROCESSED ADOPTIONS</a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>


    <div class="dashboard">
        <div class="sidebar">
            <ul>

                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a href="donations_data.php">Donations</a></li>
                <li><a href="upcoming_events_admin.php"> Events</a></li>
                <li><a href="visitors.php">Visitors</a></li>
                <li><a class="active" href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">


            <br>
            <div class="main-content">
                <h2 class="h2title">Adoption Applications</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Child's Name</th>
                            <th>Child's Age</th>
                            <th>Child's Gender</th>
                            <th>Creation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            // Loop through the results and output each row in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>"; // Assuming 'id' is a column in your table
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['child_name'] . "</td>";
                echo "<td>" . $row['child_age'] . "</td>";
                echo "<td>" . $row['child_gender'] . "</td>";
                echo "<td>" . $row['creation_date'] . "</td>"; // Assuming 'creation_date' is a column
                echo "</tr>";
            }
            ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>