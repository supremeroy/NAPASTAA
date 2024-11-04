<?php

@include 'config.php';
session_start();
if(!isset($_SESSION['email'])){
   header('location:login_form.php');
}
if (isset($_POST['adopt'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $child_name = $_POST['child_name'];
    $child_age = $_POST['child_age'];
    $child_gender = $_POST['child_gender'];
    $child_picture = $_POST['child_picture'];
    $household_members = $_POST['household_members'];
    $ages_relationships = $_POST['ages_relationships'];
    $employment_status = $_POST['employment_status'];
    $occupation = $_POST['occupation'];
    $income = $_POST['income'];
    $home_type = $_POST['home_type'];
    $space_for_child = $_POST['space_for_child'];
    $neighborhood_environment = $_POST['neighborhood_environment'];
    $references = $_POST['references'];
    $motivation_statement = $_POST['motivation_statement'];
    $background_check = $_POST['background_check'];
    $child_abuse_clearance = $_POST['child_abuse_clearance'];
    $creation_date = $_POST['creation_date_1'];

    // Move the SQL insert statement inside the if block
    $stmt = "INSERT INTO adoption_applications (name, email, phone, address, child_name, child_age, child_gender, child_picture, household_members, ages_relationships, employment_status, occupation, income, home_type, space_for_child, neighborhood_environment, `references`, motivation_statement, background_check, child_abuse_clearance, creation_date) VALUES ('$name', '$email', '$phone', '$address', '$child_name', '$child_age', '$child_gender', '$child_picture', '$household_members', '$ages_relationships', '$employment_status', '$occupation', '$income', '$home_type', '$space_for_child', '$neighborhood_environment', '$references', '$motivation_statement', '$background_check', '$child_abuse_clearance', '$creation_date')";

    
    if (!mysqli_query($conn, $stmt)) {
        echo "Error: " . $stmt . "<br>" . mysqli_error($conn);
    }
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
            <li><a class="active" href="#"> Adoption</a></li>
            <li><a href="complete_adoptions.php">PROCESSED ADOPTIONS</a></li>
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
                <li><a class="active" href="adoption_form.php">Adoption Form</a></li>
                <li><a href="childrens_data.php">Children's Data</a></li>
                <li><a href="staff_info.php">Staff Information</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title">Adoption form </h2>
            <form id="adoption-form" method="post">
                <p>Please fill out this form to adopt a child. All fields are required.</p>

                <div class="successful"
                    style="<?php if (isset($_POST['adopt'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Details being processed, Thank you.</div>
                </div>


                <section>
                    <h3>Personal Information</h3>
                    <br>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required>
                    <br><br>
                    <label for="phone">Phone:</label><br>
                    <input type="tel" id="phone" name="phone" required>
                    <br><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </section>
                <section>
                    <h3>Child's Information</h3>
                    <br>
                    <label for="child_name">Child's Name:</label>
                    <input type="text" id="child_name" name="child_name" required>
                    <br>
                    <label for="child_age">Child's Age:</label>
                    <input type="number" id="child_age" name="child_age" required>
                    <br>
                    <label for="child_gender">Child's Gender:</label>
                    <select id="child_gender" name="child_gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <br>
                    <label for="child_picture">Upload Child's Picture:</label>
                    <input type="file" id="child_picture" name="child_picture" accept="image/*" required>
                </section>
                <section>
                    <h3>Family Information</h3>
                    <br>
                    <label for="household_members">Household Members:</label>
                    <input type="text" id="household_members" name="household_members" required>
                    <br>
                    <label for="ages_relationships">Ages and Relationships:</label>
                    <input type="text" id="ages_relationships" name="ages_relationships" required>
                </section>

                <section>
                    <h3>Employment and Financial Information</h3>
                    <br>
                    <label for="employment_status">Employment Status:</label>
                    <input type="text" id="employment_status" name="employment_status" required>
                    <br>
                    <label for="occupation">Occupation:</label>
                    <input type="text" id="occupation" name="occupation" required>
                    <br>
                    <label for="income">Income:</label>
                    <input type="text" id="income" name="income" required>
                </section>

                <section>
                    <h3>Living Situation</h3>
                    <br>
                    <label for="home_type">Type of Home:</label>
                    <input type="text" id="home_type" name="home_type" required>
                    <br>
                    <label for="space_for_child">Space for the Child:</label>
                    <input type="text" id="space_for_child" name="space_for_child" required>
                    <br>
                    <label for="neighborhood_environment">Neighborhood Environment:</label>
                    <input type="text" id="neighborhood_environment" name="neighborhood_environment" required>
                </section>

                <section>
                    <h3>References</h3>
                    <br>
                    <label for="references">Contact Information for References:</label>
                    <input type="text" id="references" name="references" required>
                </section>

                <section>
                    <h3>Motivation</h3>
                    <br>
                    <label for="motivation_statement">Why do you want to adopt?</label>
                    <textarea id="motivation_statement" name="motivation_statement" required></textarea>
                </section>

                <section>
                    <h3>Background Information</h3>
                    <br>
                    <label for="background_check">Criminal Background Check:</label>
                    <input type="text" id="background_check" name="background_check" required>
                    <br>
                    <label for="child_abuse_clearance">Child Abuse Clearances:</label>
                    <input type="text" id="child_abuse_clearance" name="child_abuse_clearance" required>
                </section>
                <section>
                    <h3>Creation Date</h3>
                    <label for="creation_date_1">Created at:</label>
                    <input type="date" id="creation_date_1" name="creation_date_1" required>
                </section>

                <input type="submit" name="adopt" value="Adopt Now">
                <br><br>

                <div class="successful"
                    style="<?php if (isset($_POST['adopt'])) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
                    <div
                        style="border-radius: 5px; text-align: center; background-color: yellow; padding: 20px; border: 1px solid black;">
                        Details being processed, Thank you.</div>
                </div>
            </form>
            <br>
            <br>
            <br>


        </div>
</body>

</html>