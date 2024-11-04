<?php
@include 'config.php';

session_start();

if (isset($_SESSION['email'])) {
    // User is logged in
} else {
    header('location:login_form.php');
    exit;
}

// Check if the form for adding a new child has been submitted
if (isset($_POST['add_child'])) {
    // Get the form data
    $child_name = $_POST['child_name'];
    $child_age = (int)$_POST['child_age'];
    $child_gender = $_POST['child_gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $medical_history = $_POST['medical_history'];
    $admission_date = $_POST['admission_date'];


    // Insert the new child into the database
    $sql = "INSERT INTO children (child_name, child_age, child_gender, date_of_birth, medical_history, admission_date) 
            VALUES ('$child_name', $child_age, '$child_gender', '$date_of_birth', '$medical_history', '$admission_date')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New child added successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn); // Output error if query fails
    }
}

// Default query to fetch all children
$sql = "SELECT * FROM children";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
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
            <li><a class="active" href="childrens_data.php">Childrens Data</a></li>
            <li><a href="#view">Records</a></li>
            <li> <a href="#">
                    <button class="print" onclick="printChildrensRecords()">
                        PRINT RECORDS
                    </button>
                </a>
            </li>

            <li><a href="logout.php" class="btn">Logout</a></li>
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
                <li><a class="active" href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title">Childrens information</h2>



            <form action="" method="post">

                <h2 style="text-align: center;">Add a New Child</h2>
                <div class="successful"
                    style="<?php if (isset($_POST['add_child'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Details have been added.</div>
                </div>
                <br>

                <label for="child_name">Child Name:</label>
                <input type="text" id="child_name" name="child_name" required><br><br>

                <label for="child_age">Child Age:</label>
                <input type="number" id="child_age" name="child_age" required><br><br>

                <label for="child_gender">Child Gender:</label>
                <select id="child_gender" name="child_gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br><br>

                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>


                <label for="medical_history">Medical History:</label>
                <textarea id="medical_history" name="medical_history" rows="4" cols="50" required></textarea><br><br>

                <label for="admission_date">Admission Date:</label>
                <input type="date" id="admission_date" name="admission_date" required><br><br>

                <input type="submit" name="add_child" value="Add Child">
                <br>
                <div class="successful"
                    style="<?php if (isset($_POST['add_child'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Details have been added.</div>
                </div>
            </form>
            <h2 class="h2title" id="view">Childrens Records</h2>

            <div class="search">
                <div class="search-container" style="text-align: center;">
                    <input type="text" id="childrenssearchInput" placeholder="Search childrens records..."
                        onkeyup="searchchildrensTable()">
                </div>
            </div>


            <table id="childrensTable">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Medical History</th>
                    <th>Admission Date</th>
                    <th>Action</th>
                </tr>
                <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['child_name'] . "</td>
                    <td>" . $row['child_age'] . "</td>
                    <td>" . $row['child_gender'] . "</td>
                    <td>" . $row['date_of_birth'] . "</td>
                    <td>" . $row['medical_history'] . "</td>
                    <td>" . $row['admission_date'] . "</td>
                    <td>
                        <a href='edit_child.php?id=" . $row['id'] . "' class='edit-link'>Edit</a> | 
                        <a href='delete_child.php?id=" . $row['id'] . "' class='delete-link' onclick=\"return confirm('Are you sure you want to delete this child?');\">Delete</a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr>
                <td colspan='7'>No records found</td>
              </tr>";
    }
    ?>
            </table>

            <?php
            // Close database connection
            mysqli_close($conn);
            ?>
        </div>
        <script src="script.js"></script>
</body>

</html>