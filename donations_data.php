<?php 
@include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:login_form.php');
    exit;
}

// Check if the connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch donations and processed donations
$sql = "SELECT * FROM donations";
$result = mysqli_query($conn, $sql);

// Check for errors in the query
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$processed_sql = "SELECT * FROM processed_donations";
$processed_result = mysqli_query($conn, $processed_sql);

// Check for errors in the processed donations query
if (!$processed_result) {
    die("Query failed: " . mysqli_error($conn));
}

// Handle donation processing
if (isset($_POST['process_donation']) && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Fetch donation data
    $sql = "SELECT * FROM donations WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        echo 'Query failed: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        $donation = mysqli_fetch_assoc($result);
        
        // Insert into processed_donations table
        $insert_sql = "INSERT INTO processed_donations (name, phone_number, email, donation_type, donation_amount, payment_method, mpesa_phone_number, bank_name, bank_account_number, bank_branch, paypal_email, dedication) VALUES ('".$donation['name']."', '".$donation['phone_number']."', '".$donation['email']."', '".$donation['donation_type']."', '".$donation['donation_amount']."', '".$donation['payment_method']."', '".$donation['mpesa_phone_number']."', '".$donation['bank_name']."', '".$donation['bank_account_number']."', '".$donation['bank_branch']."', '".$donation['paypal_email']."', '".$donation['dedication']."')";
        
        if (mysqli_query($conn, $insert_sql)) {
            // Delete from donations table
            $delete_sql = "DELETE FROM donations WHERE id = $id";
        }
    }
} // End of the donation processing if statement


//delete donations records
if (isset($_POST['delete_donation']) && $_POST['delete_donation'] == 'true') {
    $id = intval($_POST['id']);
    $delete_sql = "DELETE FROM donations WHERE id = $id";
    
    if (mysqli_query($conn, $delete_sql)) {
        echo "Donation deleted";
    } else {
        echo "Error deleting donation: " . mysqli_error($conn);
    }
}
// Close the connection after all operations
mysqli_close($conn);
?>
<html>

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
        <label class="logo">NAPASTAA HEIMEN CHILDRENS CENTER</label>
        <ul>
            <li><a class="active" href="complete_adoptions.php">Donations</a></li>
            <li><a href="#view">Processed Donations</a></li>
            <li><a href="#"><button class="print" onclick="printTables()">
                        PRINT DONATIONS
                    </button></a></li>
            <li> <a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>


    <div class="dashboard">
        <div class="sidebar">
            <ul>

                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a class="active" href="donations_data.php">Donations</a></li>
                <li><a href="upcoming_events_admin.php"> Events</a></li>
                <li><a href="visitors.php">Visitors</a></li>
                <li><a href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">


            <br>
            <div class="main-content">
                <h2 class="h2title">Donations</h2>
                <?php 
            if (mysqli_num_rows($result) > 0) {
                echo "<table id='donationsTable'>";
                echo "<tr>
                <th>ID</th>
                <th>Donor Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Donation type</th>
                <th>Donation amount</th>
                <th>payment method</th>
                <th>Mpesa Phone No</th>
                <th>bank_name</th>
                <th>bank_account_number</th>
                <th>bank_branch</th>
                <th>paypal_email</th>
                <th>dedication</th>
                <th>Status</th>
                <th>Action</th

                </tr>"; 
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>"; 
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["phone_number"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["donation_type"] . "</td>";
                    echo "<td>" . $row["donation_amount"] . "</td>";
                    echo "<td>" . $row["payment_method"] . "</td>";
                    echo "<td>" . $row["mpesa_phone_number"] ."</td>";
                    echo "<td>" . $row["bank_name"] . "</td>";
                    echo "<td>" . $row["bank_account_number"] . "</td>";
                    echo "<td>" . $row["bank_branch"] . "</td>";
                    echo "<td>" . $row["paypal_email"] ."</td>"; 
                    echo "<td>" . $row["dedication"] . "</td>";
                    echo "<td>
                    <a href=\"#\" class=\"complete-link\" onclick=\"processDonation(" . $row["id"] . "); return false;\">Complete</a>
                  </td>";
                  echo "<td>
                  <a href='#' class='delete-link' onclick='deleteDonation(" . $row["id"] . "); return false;'>Delete</a>
                </td>";
                    echo "</tr>";
                    
                }
                echo "</table>";
            } else {
                echo "No donations found.";
            }
            ?>
            </div>




            <h2 class="h2title" id="view">Processed Donations</h2>
            <br> <br>
            <div class="search-donations">
                <div class="search-conatiner">
                    <input type="text" id="searchInput" placeholder="Search donations..." onkeyup="searchDonations()">
                </div>
            </div>

            <?php 
// Display Processed Donations
if (mysqli_num_rows($processed_result) > 0) {
    echo "<table id='processedTable'>";
    echo "<tr>
    <th>ID</th>
    <th>Donor Name</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Donation type</th>
    <th>Donation amount</th>
    <th>Payment method</th>
    <th>Mpesa Phone No</th>
    <th>Bank Name</th>
    <th>Bank Account Number</th>
    <th>Bank Branch</th>
    <th>Paypal Email</th>
    <th>Dedication</th>
    <th>Action</th
    </tr>"; 
    while($row = mysqli_fetch_assoc($processed_result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>"; 
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phone_number"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["donation_type"] . "</td>";
        echo "<td>" . $row["donation_amount"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["mpesa_phone_number"] . "</td>";
        echo "<td>" . $row["bank_name"] . "</td>";
        echo "<td>" . $row["bank_account_number"] . "</td>";
        echo "<td>" . $row["bank_branch"] . "</td>";
        echo "<td>" . $row["paypal_email"] . "</td>";
        echo "<td>" . $row["dedication"] . "</td>";
        echo "<td>
        <a class='complete-link' href='mailto:" . $row['email'] . "?subject=Thank You for Your Donation!&body=Dear " . $row['name'] . ",%0A%0AThank you for your generous donation of Ksh " . $row['donation_amount'] . " to our organization. Your support helps us continue our work and make a difference in the lives of those we serve.%0A%0ABest regards,%0ANAPASTAA HEIMEN CHILDRENS HOME'>Email</a>
      </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No processed donations found.";
}
?>

        </div>



    </div>
    </div>
    <script src="script.js"></script>
</body>

</html>