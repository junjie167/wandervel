<!doctype html>
<html>
<head>
      <meta charset="utf-8"/>
    <title>Login</title>
<?php include "head.php";
    ?>
</head>

<body>
<?php include "navbar.php"; ?>

<h1>Login</h1>
    <br><br>

    <form id="loginform" name="loginform" action="loginProcess.php" method="post">
    <p>
    <input type="text" name="email" placeholder="email" required/>
   </p>
   <p>
    <input type="password" name="password" placeholder="Password" required/>
   </p>
   <p>
    <input type="submit" value="Login">
   </p>
   <a href="signup.php"><p id="signup">Sign Up</p></a>
            
            
     
   <?php 
    if(isset($_GET['fail'])) echo "<b>Invalid username or password</b>";
   ?>
  </form>