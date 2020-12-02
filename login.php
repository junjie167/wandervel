<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <!--<head>-->
        <!--<meta charset="utf-8"/>-->
        <!--<title>Login</title>-->
        <!--</head>-->
        <?php include "head.php";
        ?>
    

    <body>
        <header>
            <?php include "indexnavbar.php"; ?>

        </header>
        <main>
        <div class="background-container">
            <section>
            
           
                <div class="container">
                    
                        <div class="login-border">
                            <div class="login-title">
                                <h1>Login</h1>
                            </div>
                            <form action="checklogin.php" method="POST">
                                <div class="form-group">  
                                <label for="email">Email:</label>
                                <input class="form-control" type="email" id="email" required name="email"
                                   placeholder="Enter email">
                                </div>
                                <div class="form-group">  
                                <label for="pwd">Password:</label>
                                <input class="form-control" type="password" id="pwd" required name="pwd"
                                   placeholder="Enter password">
                                </div>
                                <div class="form-group login-button">  
                                    <button class="btn btn-primary login-btn-width" type="submit">Submit</button>
                                </div>
                            </form>
                            <div class="login-or">
                                <p><span>or</span></p>
                            </div>
                            <div>
                                <button id="signup" class="btn btn-outline-danger login-btn-width" >Sign Up</button>
                            </div>
                        </div>
                    </div>
                    
                

            </section>
            </div>
        </main>


</body>
</html>