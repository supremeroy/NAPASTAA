<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
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
    <title>LITTLE ANGLES HOME MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <label class="logo">LITTLE ANGLES HOME MANAGEMENT SYSTEM</label>
        <ul>
            <li><a href="index.html">HOME</a></li>
            <li><a class="active" href="login_form.php">LOGIN</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>

        </ul>
    </nav>

   
<div class="form-container">

   <form action="" method="post">
   <style>

.form-container{
   min-height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   padding:20px;
   padding-bottom: 60px;
   margin-top: 5rem;
}

.form-container form{
   background-color: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(20px);
  width: 50vw;
  position: relative;
  padding: 2rem 1rem;
  border-radius: 10px;
}

.form-container form h3{
   text-align: center;
   text-transform: uppercase;
   color: #e382c5;
   font-size: 1.5rem;
   margin-bottom: 2rem
}

.form-container form input,
.form-container form select{
   background-color: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(20px);
  border: 1px solid #c7b3f5;
   width: 100%;
   padding:10px 15px;
   font-size: 17px;
   margin:8px 0;
   
   border-radius: 5px;
}
.form-container form sup{
   color: red;
}
.form-container form select option{
   background: #fff;
}

.form-container form .form-btn{
   background: #aa4ff3;
   color:#fff;
   text-transform: capitalize;
   font-size: 20px;
   cursor: pointer;
}

.form-container form .form-btn:hover{
   background: #c7b3f5;
   color:#fff;
}

.form-container form p{
   text-transform: capitalize;
   margin-top: 10px;
   font-size: 20px;
   color:#333;
}

.form-container form p a{
   color:#e382c5;
}

.form-container form .error-msg{
   margin:10px 0;
   display: block;
   background: crimson;
   color:#fff;
   border-radius: 5px;
   font-size: 20px;
   padding:10px;
}

</style>
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <p>Your Name<sup>*</sup></p>
      <input type="text" name="name" required placeholder="enter your name">
      <p>Your Email<sup>*</sup></p>
      <input type="email" name="email" required placeholder="enter your email">
      <p>Password<sup>*</sup></p>
      <input type="password" name="password" required placeholder="enter your password">
      <p>Confirm Password<sup>*</sup></p>
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <p>User Type<sup>*</sup></p>
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>