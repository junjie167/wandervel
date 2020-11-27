<?php session_start(); ?>
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


<  <main class="container">
            <h1>Member Login</h1>
            <p>
                For existing members, log in here. For new users, please go to the <a href="./signup.php">Sign up page</a>
            </p>
            <form action="checklogin.php" method="POST">
                
              
                
          
                <div class="form-group">  
                <label for="email">Email:</label>
                <input class="form-control" type="email" id="email" required name="email"
                       placeholder="Enter email">
                </div>
                
                <div class="form-group">  
                <label for="password">Password:</label>
                <input class="form-control" type="password" id="pwd" required name="pwd"
                       placeholder="Enter password">
                </div>
                
            
                <div class="form-group">  
                <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </main>
            
     
  </form>