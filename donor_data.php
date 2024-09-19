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
            <li><a class="active" href="index.html"> Donor data</a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>
    


    <div>
    <h2>Donor Data</h2>
    <?php

   // Connect to the database
   $conn = mysqli_connect("localhost", "root", "", "napastaa_db");
   
   // Check connection
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   
   // Retrieve list of registered donors
   $sql = "SELECT * FROM user_form WHERE user_type = 'user'";
            $result = mysqli_query($conn, $sql);

   
   if (mysqli_num_rows($result) > 0) {
       echo "<table>";
       echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>User_type</th></tr>";
       while($row = mysqli_fetch_assoc($result)) {
           echo "<tr>";
           echo "<td>" . $row["id"] . "</td>";
           echo "<td>" . $row["name"] . "</td>";
           echo "<td>" . $row["email"] . "</td>";
           echo "<td>" . $row["user_type"] . "</td>";
           echo "</tr>";
       }
       echo "</table>";
   } else {
       echo "No donors found.";
   }
   
   // Close connection
   mysqli_close($conn);
   

    ?>
</div>
    </body>
    </html>