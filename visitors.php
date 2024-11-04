<?php
session_start();
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "napastaa_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle approval of visitors
if (isset($_POST['approve_id'])) {
    $id = intval($_POST['approve_id']);
    // Get visitor data
    $query = "SELECT * FROM visitors WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $visitor = mysqli_fetch_assoc($result);
        
        // Insert into approved_visitors table
        $insert_sql = "INSERT INTO approved_visitors (name, email, phone_number, visit_date, visit_time, purpose, comments) VALUES ('".$visitor['name']."', '".$visitor['email']."', '".$visitor['phone_number']."', '".$visitor['visit_date']."', '".$visitor['visit_time']."', '".$visitor['purpose']."', '".$visitor['comments']."')";
        
        if (mysqli_query($conn, $insert_sql)) {
            // Delete from visitors table
            $delete_sql = "DELETE FROM visitors WHERE id = $id";
            mysqli_query($conn, $delete_sql);
            
            // Prepare email content
            $subject = 'Your Visit Request Has Been Approved!';
            $body = 'Dear ' . $visitor['name'] . ",\n\nWe are pleased to inform you that your request to visit Napastaa Heimen Children Home has been approved. Please ensure to arrive on the scheduled date and time.\n\nBest regards,\nNapastaa Heimen Team";
            $mailto_link = 'mailto:' . urlencode($visitor['email']) . '?subject=' . urlencode($subject) . '&body=' . urlencode($body);
            
            // Redirect to mailto link
            echo '<script>
                    alert("Visitor approved successfully! Send an email to the visitor.");
                    window.location.href = "' . $mailto_link . '";
                  </script>';
        } else {
            echo '<script>alert("Error inserting approved visitor: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        echo '<script>alert("No visitor found with the given ID.");</script>';
    }

}

// Fetch all visitors
$query = "SELECT * FROM visitors WHERE visit_date >= CURDATE()";
$result = mysqli_query($conn, $query);
$visitors = array();
while ($row = mysqli_fetch_assoc($result)) {
    $visitors[] = $row;
}

// Fetch all approved visitors
$approved_query = "SELECT * FROM approved_visitors";
$approved_result = mysqli_query($conn, $approved_query);
$approved_visitors = array();
while ($row = mysqli_fetch_assoc($approved_result)) {
    $approved_visitors[] = $row;
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
            <li><a class="active" href="#"> VISITORS</a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>


    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a href="donations_data.php">Donations</a></li>
                <li><a href="upcoming_events_admin.php"> Events</a></li>
                <li><a class="active" href="visitors.php">Visitors</a></li>
                <li><a href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>

            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title">requests to visit napastaa heimen</h2>
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
                        <th>Actions</th>
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
                        <td>

                            <form class="form-approve" method="post">
                                <input type="hidden" name="approve_id" value="<?= $visitor['id'] ?>">
                                <button type="submit" class="edit-link" style="font-size:10px">Approve</button>
                            </form>
                            <br>
                            <a href="mailto:<?= htmlspecialchars($visitor['email']); ?>?subject=<?= urlencode('Your Request Has Been Declined.'); ?>&body=<?= urlencode('We regret to inform you that your request to visit Napastaa Heimen Children Home has been declined.'); ?>"
                                class="delete-link">Decline</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h2 class="h2title">Approved Visitors</h2>
            <table id="approved-visitors-table">
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
                        <th>Approval Date</th>
                    </tr>
                </thead>
                <tbody id="approved-visitors-tbody">
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
                        <td><?= $approved_visitor['approval_date'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>