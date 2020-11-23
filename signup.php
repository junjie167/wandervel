<!DOCTYPE html>
<html>

    <meta charset="utf-8"/>
    <title>Registration</title>
    <?php include "head.php";
    ?>


    <body>
        <header>
            <?php include "navbar.php"; ?>
        </header>

        <main>

            <section>
                <div class="container"> 
                    <h1>Sign Up</h1>
                    <form id="registerform" name="registerform" action="registerProcess.php" method="post" enctype="multipart/form-data">
                        <p>
                            <input type="email" name="email" placeholder="Email" required/>
                        </p>
                        <p>
                            <input type="text" name="name" placeholder="Name" required/>
                        </p>
                         <p>
                            <input type="text" name="nationality" placeholder="Nationality" required/>
                        </p>
                        <p>
                            <input type="password" name="password" placeholder="Password" required/>
                        </p>
                        <p>
                            <input type="password" name="confirmPassword" placeholder="Confirm Password" required/>
                        </p>
                        <p>
                            <input type="radio" name="gender" value="Male"><label>Male</label> 
                            <input type="radio" name="gender" value="Female"><label>Female</label>  

                        </p>
                        <p>
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob">
                            
                        
                        </p>

                        <p>
                            <input type="submit" value="Sign Up">
                        </p>
                    </form>
                </div> 
            </section>
        </main>


    </body>
</html>