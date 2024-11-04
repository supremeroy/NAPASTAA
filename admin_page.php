<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['email'])){
   header('location:login_form.php');
}
// Queries to count each category
$donations_query = "SELECT COUNT(*) as count FROM donations"; // Adjust table name as necessary
$processed_donations_query = "SELECT COUNT(*) as count FROM processed_donations"; // Adjust table name as necessary
$visitors_query = "SELECT COUNT(*) as count FROM approved_visitors"; // Adjust table name as necessary
$adoption_forms_query = "SELECT COUNT(*) as count FROM adoption_applications"; // Adjust table name as necessary
$children_query = "SELECT COUNT(*) as count FROM children"; // Adjust table name as necessary
$staff_info_query = "SELECT COUNT(*) as count FROM staff_info"; // Adjust table name as necessary

// Execute queries
$donations_result = mysqli_query($conn, $donations_query);
$processed_donations_result = mysqli_query($conn, $processed_donations_query);
$visitors_result = mysqli_query($conn, $visitors_query);
$adoption_forms_result = mysqli_query($conn, $adoption_forms_query);
$children_result = mysqli_query($conn, $children_query);
$staff_info_result = mysqli_query($conn, $staff_info_query);




// Fetch counts
$donations_count = mysqli_fetch_assoc($donations_result)['count'];
$processed_donations_count = mysqli_fetch_assoc($processed_donations_result)['count'];
$visitors_count = mysqli_fetch_assoc($visitors_result)['count'];
$adoption_forms_count = mysqli_fetch_assoc($adoption_forms_result)['count'];



// Query to get the total amount of donations
$total_donations_query = "SELECT SUM(donation_amount) as total FROM processed_donations";
$total_donations_result = mysqli_query($conn, $total_donations_query);

// Fetch the total amount
$total_donations = mysqli_fetch_assoc($total_donations_result)['total'] ?? 0; // Default to 0 if NULL


$query = "SELECT * FROM adoption_applications";
$result = mysqli_query($conn, $query);
// Fetch approved visitors
$approved_visitors_query = "SELECT * FROM approved_visitors";
$approved_visitors_result = mysqli_query($conn, $approved_visitors_query);
$approved_visitors = mysqli_fetch_all($approved_visitors_result, MYSQLI_ASSOC);

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
            <li><button class="print" onclick="printTables()">
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
                    <h3>Processed donations -> </h3>

                    <p> <?php echo $processed_donations_count; ?></p>
                </div>

                <div class="stat-item">
                    <h3>Total Donations Amount <br></h3>
                    <br>
                    <p> KES<?php echo number_format($total_donations, 2); ?></p>

                </div>
                <div class="stat-item">
                    <h3>Visitors -> </h3>
                    <p><?php echo $visitors_count; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Adoption Forms -> </h3>
                    <p> <?php echo $adoption_forms_count; ?></p>
                </div>

            </div>
            <h2 class="h2title">Complete Adoption Applications</h2>
            <table>
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

            <h2 class="h2title">Approved Visitors</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Visit Date</th>
                        <th>Visit Time</th>
                        <th>Purpose of Visit</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($approved_visitors as $approved_visitor) { ?>
                    <tr>
                        <td><?= $approved_visitor['id'] ?></td>
                        <td><?= $approved_visitor['name'] ?></td>
                        <td><?= $approved_visitor['email'] ?></td>
                        <td><?= $approved_visitor['phone_number'] ?></td>
                        <td><?= $approved_visitor['visit_date'] ?></td>
                        <td><?= $approved_visitor['visit_time'] ?></td>
                        <td><?= $approved_visitor['purpose'] ?></td>
                        <td><?= $approved_visitor['comments'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>




        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <style>
    @media print {
        .sidebar {
            display: none;
            /* Hide the sidebar when printing */
        }

        nav {
            display: none;
            /* Hide the navigation bar when printing */
        }
    }
    </style>
    <script src="script.js">

    </script>
</body>

</html>