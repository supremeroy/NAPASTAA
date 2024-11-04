<?php
@include 'config.php';
session_start();
if (isset($_SESSION['email'])) {
    // User is logged in
} else {
    header('location:login_form.php');
    exit;
}

// Check if the form for adding a new staff member has been submitted
if (isset($_POST['add_staff'])) {
    // Get the form data
    $name = $_POST['name'];
    $id_number = $_POST['id_number'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $job_title = $_POST['job_title'];
    $department = $_POST['department'];
    $supervisor = $_POST['supervisor'];
    $employment_date = $_POST['employment_date'];
    $employment_status = $_POST['employment_status'];
    $work_shift = $_POST['work_shift'];
    $education_level = $_POST['education_level'];
    $certifications = $_POST['certifications'];
    $skills = $_POST['skills'];

    // Insert the new staff member into the database
    $sql = "INSERT INTO staff_info (name, id_number, dob, gender, phone, email, job_title, department, supervisor, employment_date, employment_status, work_shift, education_level, certifications, skills) 
            VALUES ('$name', '$id_number', '$dob', '$gender', '$phone', '$email', '$job_title', '$department', '$supervisor', '$employment_date', '$employment_status', '$work_shift', '$education_level', '$certifications', '$skills')";


   // Execute the query
   if (mysqli_query($conn, $sql)) {
    echo "<script>alert('New staff member added successfully!');</script>";
} else {
    echo "Error: " . mysqli_error($conn); // Output error if query fails
}
}
// Retrieve data from staff_info table
$sql = "SELECT * FROM staff_info";
$result = $conn->query($sql);
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

<nav>
    <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
    <ul>
        <li><a class="active" href="staff_info.php"> Staff Information</a></li>
        <li> <a href="#view"> Staff Records</a></li>
        <li>
            <a href="#">
                <button class="print" onclick="printDataRecords()">
                    PRINT RECORDS
                </button></a>
        </li>
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
            <li><a href="adoption_form.php">Adoption Form</a></li>
            <li><a href="childrens_data.php">Children's Data</a></li>
            <li><a class="active" href="staff_info.php">Staff Information</a></li>
        </ul>
    </div>
    <div class="main-content">


        <form action="" method="post">
            <h2 class="h2title">Add Staff Member</h2>
            <div class="successful"
                style="<?php if (isset($_POST['add_staff'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                <div
                    style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                    New staff member added successfully.</div>
            </div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="id_number">ID Number:</label>
            <input type="text" id="id_number" name="id_number" required><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" required><br><br>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required><br><br>

            <label for="supervisor">Supervisor:</label>
            <input type="text" id="supervisor" name="supervisor" required><br><br>

            <label for="employment_date">Employment Date:</label>
            <input type="date" id="employment_date" name="employment_date" required><br><br>

            <label for="employment_status">Employment Status:</label>
            <select id="employment_status" name="employment_status" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Terminated">Terminated</option>
            </select><br><br>

            <label for="work_shift">Work Shift:</label>
            <select id="work_shift" name="work_shift" required>
                <option value="Day">Day</option>
                <option value="Night">Night</option>
            </select><br><br>

            <label for="education_level">Education Level:</label>
            <input type="text" id="education_level" name="education_level" required><br><br>

            <label for="certifications">Certifications:</label>
            <input type="text" id="certifications" name="certifications"><br><br>

            <label for="skills">Skills:</label>
            <input type="text" id="skills" name="skills"><br><br>

            <input type="submit" name="add_staff" value="Add Staff">
            <br>
            <div class="successful"
                style="<?php if (isset($_POST['add_staff'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                <div
                    style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                    New staff member added successfully.</div>
            </div>
        </form>

    </div>
    <h2 class="h2title" id="view" style="width: inherit;"> Staff Records</h2>
    <br>
    <div class="search">
        <div class="search-container" style="text-align: center;">
            <input type="text" id="searchInput" placeholder="Search staff records..." onkeyup="searchTable()">
        </div>
    </div>



</div>
<?php
    
       $tableHTML = "<table border='1' font-size='1px' id='staffTable' >
     
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>ID Number</th>
    <th>Date of Birth</th>
    <th>Gender</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Job Title</th>
    <th>Department</th>
    <th>Supervisor</th>
    <th>Employment Date</th>
    <th>Employment Status</th>
    <th>Work Shift</th>
    <th>Education Level</th>
    <th>Certifications</th>
    <th>Skills</th>
    <th>Action</th>
</tr>";

// Fetch rows and append to table HTML
while ($row = $result->fetch_assoc()) {
$tableHTML .= "<tr>
    <td>" . $row["id"] . "</td>
    <td>" . $row["name"] . "</td>
    <td>" . $row["id_number"] . "</td>
    <td>" . $row["dob"] . "</td>
    <td>" . $row["gender"] . "</td>
    <td>" . $row["phone"] . "</td>
    <td>" . $row["email"] . "</td>
    <td>" . $row["job_title"] . "</td>
    <td>" . $row["department"] . "</td>
    <td>" . $row["supervisor"] . "</td>
    <td>" . $row["employment_date"] . "</td>
    <td>" . $row["employment_status"] . "</td>
    <td>" . $row["work_shift"] . "</td>
    <td>" . $row["education_level"] . "</td>
    <td>" . $row["certifications"] . "</td>
    <td>" . $row["skills"] . "</td>
 <td>
    <a href='edit_staff.php?id=" . $row['id'] . "' class='edit-link'>Edit</a> 
    <br><br> <!-- Added an extra <br> for separation -->
    <a href='delete_staff.php?id=" . $row['id'] . "' class='delete-link' onclick=\"return confirm('Are you sure you want to delete this staff?');\">Delete</a>
</td>
</tr>";

}

// Close the table HTML
$tableHTML .= "</table>";

// Output the table
echo $tableHTML;

        // Close connection
        $conn->close();
        ?>
</div>
</div>

<script src="script.js"></script>

</html>
</body>