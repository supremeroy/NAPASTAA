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

<nav>
    <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
    <ul>
        <li><a href="admin_page.php"> Admin HOME</a></li>
        <li><a class="active" href="#"> VISITORS</a></li>
        <li> <a href="logout.php" class="btn">logout</a></li>
    </ul>
</nav>


<div class="dashboard">
    <div class="sidebar">
        <ul>
            <li><a href="donations_data.php">Donations</a></li>
            <li><a href="upcoming_events_admin.php">Upcoming Events</a></li>
            <li><a href="visitors.php">Visitors</a></li>
            <li><a href="adoption_form.php">Adoption Form</a></li>
            <li><a href="childrens_data.php">Children's Data</a></li>
            <li><a class="active" href="staff_info.php">Staff Information</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2 class="h2title">STAFF INFORMATION</h2>
        <?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'napastaa_db';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from staff_info table
$sql = "SELECT * FROM staff_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display data in a table format
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>ID Number</th>";
    echo "<th>Date of Birth</th>";
    echo "<th>Gender</th>";
    echo "<th>Phone</th>";
    echo "<th>Email</th>";
    echo "<th>Job Title</th>";
    echo "<th>Department</th>";
    echo "<th>Supervisor</th>";
    echo "<th>Employment Date</th>";
    echo "<th>Employment Status</th>";
    echo "<th>Work Shift</th>";
    echo "<th>Education Level</th>";
    echo "<th>Certifications</th>";
    echo "<th>Skills</th>";
    echo "</tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td>";
        echo "<td>" . $row["name"]. "</td>";
        echo "<td>" . $row["id_number"]. "</td>";
        echo "<td>" . $row["dob"]. "</td>";
        echo "<td>" . $row["gender"]. "</td>";
        echo "<td>" . $row["phone"]. "</td>";
        echo "<td>" . $row["email"]. "</td>";
        echo "<td>" . $row["job_title"]. "</td>";
        echo "<td>" . $row["department"]. "</td>";
        echo "<td>" . $row["supervisor"]. "</td>";
        echo "<td>" . $row["employment_date"]. "</td>";
        echo "<td>" . $row["employment_status"]. "</td>";
        echo "<td>" . $row["work_shift"]. "</td>";
        echo "<td>" . $row["education_level"]. "</td>";
        echo "<td>" . $row["certifications"]. "</td>";
        echo "<td>" . $row["skills"]. "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
    </div>

</html>
</body>