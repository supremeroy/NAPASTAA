<?php
@include 'config.php';

session_start();

if(isset($_SESSION['email'])){
} else {
   header('location:login_form.php');
   exit;
}

// Add a new child to the database
if (isset($_POST['add_child'])) {
    $child_name = $_POST['child_name'];
    $child_age = $_POST['child_age'];
    $child_gender = $_POST['child_gender'];

    $sql = "INSERT INTO children (child_name, child_age, child_gender) VALUES ('$child_name', '$child_age', '$child_gender')";
    if (mysqli_query($conn, $sql)) {
        echo "Child added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAPASTAA HEIMEN CHILDRENS HOME</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
        <ul>
            <li><a href="user_page.php">Donor Home</a></li>
            <li><a href="donation.php">Donate</a></li>
            <li><a href="logout.php" class="btn">Logout</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="donations_data.php">Donations</a></li>
                <li><a href="upcoming_events_admin.php">Upcoming Events</a></li>
                <li><a href="visitors.php">Visitors</a></li>
                <li><a href="adoption_form.php">Adoption Form</a></li>
                <li><a class="active" href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title">Childrens information</h2>

            <!-- Create a form to add a new child -->

            <form action="" method="post">
                <h2>Add a New Child</h2>
                <br>
                <label for="child_name">Child Name:</label>
                <input type="text" id="child_name" name="child_name" required><br><br>
                <label for="child_age">Child Age:</label>
                <input type="number" id="child_age" name="child_age" required><br><br>
                <label for="child_gender">Child Gender:</label>
                <select id="child_gender" name="child_gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br><br>
                <input type="submit" name="add_child" value="Add Child">
            </form>



            <!-- Display a table of children in the children's home -->
            <h2>Children in the Children's Home</h2>
            <table border='1'>
                <tr>
                    <th>Child Name</th>
                    <th>Child Age</th>
                    <th>Child Gender</th>
                </tr>

                <?php
        $sql = "SELECT * FROM children";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['child_name'] . "</td>";
                echo "<td>" . $row['child_age'] . "</td>";
                echo "<td>" . $row['child_gender'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No children found.</td></tr>";
        }
        ?>

            </table>

            <?php
    // Close database connection
    mysqli_close($conn);
    ?>
        </div>
</body>

</html>