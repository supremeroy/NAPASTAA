<?php
@include 'config.php';
session_start();

if (isset($_SESSION['email'])) {
    // User is logged in
} else {
    header('location:login_form.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the current staff data
    $sql = "SELECT * FROM staff_info WHERE id = '$id'";
    $result = $conn->query($sql);
    $staff = $result->fetch_assoc();

    if (!$staff) {
        echo "Staff member not found.";
        exit;
    }
}

if (isset($_POST['edit_staff'])) {
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

    $sql = "UPDATE staff_info SET 
        name = '$name', 
        id_number = '$id_number', 
        dob = '$dob', 
        gender = '$gender', 
        phone = '$phone', 
        email = '$email', 
        job_title = '$job_title', 
        department = '$department', 
        supervisor = '$supervisor', 
        employment_date = '$employment_date', 
        employment_status = '$employment_status', 
        work_shift = '$work_shift', 
        education_level = '$education_level', 
        certifications = '$certifications', 
        skills = '$skills' 
        WHERE id = '$id'";

}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Information</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
        <ul>
            <li><a href="admin_page.php"> Admin HOME</a></li>
            <li><a href="visitors.php"> VISITORS</a></li>
            <li><a href="logout.php" class="btn">logout</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a class="active" href="edit_staff.php">Edit staff</a></li>
                <li><a href="staff_info.php">Staff info</a></li>
            </ul>
        </div>

        <div class="main-content">
            <form action="" method="post">
                <h2>Edit Staff Information</h2>
                <div class="successful"
                    style="<?php if (isset($_POST['update_staff'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Details have been added.</div>
                </div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $staff['name']; ?>" required><br><br>

                <label for="id_number">ID Number:</label>
                <input type="text" id="id_number" name="id_number" value="<?php echo $staff['id_number']; ?>"
                    required><br><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $staff['dob']; ?>" required><br><br>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?php if ($staff['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($staff['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($staff['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select><br><br>

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $staff['phone']; ?>" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $staff['email']; ?>" required><br><br>

                <label for="job_title">Job Title:</label>
                <input type="text" id="job_title" name="job_title" value="<?php echo $staff['job_title']; ?>"
                    required><br><br>

                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $staff['department']; ?>"
                    required><br><br>

                <label for="supervisor">Supervisor:</label>
                <input type="text" id="supervisor" name="supervisor" value="<?php echo $staff['supervisor']; ?>"
                    required><br><br>

                <label for="employment_date">Employment Date:</label>
                <input type="date" id="employment_date" name="employment_date"
                    value="<?php echo $staff['employment_date']; ?>" required><br><br>

                <label for="employment_status">Employment Status:</label>
                <select id="employment_status" name="employment_status" required>
                    <option value="Active" <?php if ($staff['employment_status'] == 'Active') echo 'selected'; ?>>Active
                    </option>
                    <option value="Inactive" <?php if ($staff['employment_status'] == 'Inactive') echo 'selected'; ?>>
                        Inactive</option>
                    <option value="Terminated"
                        <?php if ($staff['employment_status'] == 'Terminated') echo 'selected'; ?>>Terminated</option>
                </select><br><br>

                <label for="work_shift">Work Shift:</label>
                <select id="work_shift" name="work_shift" required>
                    <option value="Day" <?php if ($staff['work_shift'] == 'Day') echo 'selected'; ?>>Day</option>
                    <option value="Night" <?php if ($staff['work_shift'] == 'Night') echo 'selected'; ?>>Night</option>
                </select><br><br>

                <label for="education_level">Education Level:</label>
                <input type="text" id="education_level" name="education_level"
                    value="<?php echo $staff['education_level']; ?>" required><br><br>

                <label for="certifications">Certifications:</label>
                <input type="text" id="certifications" name="certifications"
                    value="<?php echo $staff['certifications']; ?>"><br><br>

                <label for="skills">Skills:</label>
                <input type="text" id="skills" name="skills" value="<?php echo $staff['skills']; ?>"><br><br>

                <input type="submit" name="update_staff" value="Update Staff">
                <div class="successful"
                    style="<?php if (isset($_POST['update_staff'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Details have been added.</div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>