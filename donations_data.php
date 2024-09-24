<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "napastaa_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data for donations
$sql = "SELECT * FROM donations"; // assume the table name is "donations"
$result = mysqli_query($conn, $sql);


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
             <li><a class="active"href="#"> Donations Data</a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>

    <h2 class="h2title">Complete Donations</h2>


    <?php 



if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Donor Name</th><th>Donation type</th><th>Donation amount</th><th>payment method</th><th>dedication</th><th>user agreement<th/></tr>"; // adjust column names as needed
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>"; // adjust column names as needed
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td>" . $row["donation_type"] . "</td>";
        echo "<td>" . $row["donation_amount"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["dedication"] . "</td>";
        echo "<td>" . $row["user_agreement"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No donations found.";
}
    ?>


    <!-- The table will be displayed here -->
</body>
</html>