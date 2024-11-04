<?php
@include 'config.php';
session_start();
if (isset($_SESSION['email'])) {
} else {
    header('location:login_form.php');
    exit;
}


// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $child_id = (int)$_GET['id'];

    // Fetch the child's current data
    $sql = "SELECT * FROM children WHERE id = $child_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $child = mysqli_fetch_assoc($result);
    } else {
        die("Child not found.");
    }
}

// Check if the form for editing the child has been submitted
if (isset($_POST['update_child'])) {
    $child_name = $_POST['child_name'];
    $child_age = (int)$_POST['child_age'];
    $child_gender = $_POST['child_gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $medical_history = $_POST['medical_history'];
    $admission_date = $_POST['admission_date'];

    // Update the child's data in the database
    $sql = "UPDATE children SET 
            child_name = '$child_name', 
            child_age = $child_age, 
            child_gender = '$child_gender', 
            date_of_birth = '$date_of_birth', 
            medical_history = '$medical_history', 
            admission_date = '$admission_date' 
            WHERE id = $child_id";

if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Child info</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
        <ul>
            <li><a href="admin_page.php">Dashboard</a></li>
            <li><a href="logout.php" class="btn">Logout</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a class="active" href="edit_child.php">Edit Data</a></li>
                <li><a href="childrens_data.php">Childrens data</a></li>
            </ul>
        </div>




        <div class="main-content">
            <form action="" method="post" style="width: 100%;">
                <h2 style="text-align: center;">
                    Edit Child Details
                </h2>
                <label for="child_name">Child Name:</label>
                <input type="text" id="child_name" name="child_name"
                    value="<?php echo htmlspecialchars($child['child_name']); ?>" required><br><br>

                <label for="child_age">Child Age:</label>
                <input type="number" id="child_age" name="child_age"
                    value="<?php echo htmlspecialchars($child['child_age']); ?>" required><br><br>

                <label for="child_gender">Child Gender:</label>
                <select id="child_gender" name="child_gender" required>
                    <option value="Male" <?php echo ($child['child_gender'] == 'Male') ? 'selected' : ''; ?>>Male
                    </option>
                    <option value="Female" <?php echo ($child['child_gender'] == 'Female') ? 'selected' : ''; ?>>Female
                    </option>
                    <option value="Other" <?php echo ($child['child_gender'] == 'Other') ? 'selected' : ''; ?>>Other
                    </option>
                </select><br><br>

                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth"
                    value="<?php echo htmlspecialchars($child['date_of_birth']); ?>" required><br><br <label
                    for="medical_history">Medical History:</label>
                <textarea id="medical_history" name="medical_history"
                    required><?php echo htmlspecialchars($child['medical_history']); ?></textarea><br><br>

                <label for="admission_date">Admission Date:</label>
                <input type="date" id="admission_date" name="admission_date"
                    value="<?php echo htmlspecialchars($child['admission_date']); ?>" required><br><br>

                <input type="submit" name="update_child" value="Update Child">
                <br>
                <div class="successful"
                    style="<?php if (isset($_POST['update_child'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Details have been updated.</div>
                </div>
            </form>
        </div>
</body>

</html>