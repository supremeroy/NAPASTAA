<?php
$conn = mysqli_connect("localhost", "root", "", "napastaa_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

$error = array();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select = " SELECT * FROM admin WHERE email = '$email' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($pass == $row['password']){

         $_SESSION['email'] = $row['email'];
         header('location:admin_page.php');

      }else{

         $error[] = 'Incorrect password!';
      }

   }else{
      $error[] = 'Email not found!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Online charity/donation system ">
    <meta name="keywords" content="Donation,Charity,Childrens home">
    <meta name="author" content="Roy Macharia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAPASTAA HEIMEN CHILDRENS HOME</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label class="logo">NAPASTAA HEIMEN CHILDRENS HOME</label>
        <ul>
            <li><a href="index.html">HOME</a></li>
            <li><a class="active" href="login_form.php">LOGIN</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>

        </ul>
    </nav>

    <div class="form-container">

        <form action="" method="post">
            <h3>Admin Login</h3>
            <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };
            ?>
            <p>Enter your email<sup>*</sup></p>
            <input type="email" name="email" required placeholder="email">
            <p>Enter password<sup>*</sup></p>
            <input type="password" name="password" required placeholder="password">
            <input type="submit" name="submit" value="login now" class="form-btn">
        </form>

    </div>

</body>

</html>