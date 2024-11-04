<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['email'])){
   header('location:login_form.php');
}
// Queries to count each category
$donations_query = "SELECT COUNT(*) as count FROM donations"; // Adjust table name as necessary
$events_query = "SELECT COUNT(*) as count FROM upcoming_events"; // Adjust table name as necessary
$visitors_query = "SELECT COUNT(*) as count FROM visitors"; // Adjust table name as necessary
$adoption_forms_query = "SELECT COUNT(*) as count FROM adoption_applications"; // Adjust table name as necessary
$children_query = "SELECT COUNT(*) as count FROM children"; // Adjust table name as necessary
$staff_info_query = "SELECT COUNT(*) as count FROM staff_info"; // Adjust table name as necessary

// Execute queries
$donations_result = mysqli_query($conn, $donations_query);
$events_result = mysqli_query($conn, $events_query);
$visitors_result = mysqli_query($conn, $visitors_query);
$adoption_forms_result = mysqli_query($conn, $adoption_forms_query);
$children_result = mysqli_query($conn, $children_query);
$staff_info_result = mysqli_query($conn, $staff_info_query);

// Fetch counts
$donations_count = mysqli_fetch_assoc($donations_result)['count'];
$events_count = mysqli_fetch_assoc($events_result)['count'];
$visitors_count = mysqli_fetch_assoc($visitors_result)['count'];
$adoption_forms_count = mysqli_fetch_assoc($adoption_forms_result)['count'];
$children_count = mysqli_fetch_assoc($children_result)['count'];
$staff_info_count = mysqli_fetch_assoc($staff_info_result)['count'];

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
            <li><a class="active" href="admin_page.php">Dashboard</a></li>
            <li><button class="print" onclick="printTable()">
                    PRINT REPORT
                </button></li>

            <li><a href="logout.php">logout</a></li>
        </ul>
    </nav>
    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a class="active" href="admin_page.php">Dashboard</a></li>
                <li><a href="donations_data.php">Donations</a></li>
                <li><a href="upcoming_events_admin.php"> Events</a></li>
                <li><a href="visitors.php">Visitors</a></li>
                <li><a href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title">Counts Overview</h2>
            <div class="dashboard-stats">
                <div class="stat-item">
                    <h3>Donations -> </h3>
                    <p><?php echo $donations_count; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Upcoming Events -> </h3>

                    <p> <?php echo $events_count; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Visitors -> </h3>
                    <p><?php echo $visitors_count; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Adoption Forms -> </h3>
                    <p> <?php echo $adoption_forms_count; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Children -> </h3>
                    <p><?php echo $children_count; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Staff -> </h3>
                    <p><?php echo $staff_info_count; ?></p>
                </div>

            </div>
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
    </div>
    </div>


    </div>
    </div>
    <script>
    function printTable() {
        window.print();
    }
    </script>
</body>

</html>