<?php

$e = $_POST['email'];
$p = $_POST['password'];

session_start();
// if user isn't logged in, will redirect them back to login page
if(!isset($_SESSION['email']))
{
    header("Location: login.php");
}

$res=mysqli_query("SELECT * FROM users WHERE email=".$_SESSION['email']);
$userRow=mysql_fetch_array($res);

if(isset($_POST['name']) )
{
    $name= $_POST['name'];
    $e  = $_SESSION['email'];
    $sql  = "UPDATE users SET name='$name' WHERE email=$e";
    $res    = mysql_query($sql) 
                                or die("Could not update".mysql_error());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['gender']) )
{
    $gender= $_POST['gender'];
    $e  = $_SESSION['email'];
    $sql  = "UPDATE users SET gender='$gender' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_error());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['dob']) )
{
    $dob= $_POST['dob'];
    $e  = $_SESSION['email'];
    $sql = "UPDATE users SET dob='$dob' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_affected_rows());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['nationality']) )
{
    $dob= $_POST['nationality'];
    $e  = $_SESSION['email'];
    $sql = "UPDATE users SET nationality='$nationality' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_affected_rows());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['bio']) )
{
    $bio= $_POST['bio'];
    $e  = $_SESSION['email'];
    $sql = "UPDATE users SET bio='$bio' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_affected_rows());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}
?>

<!DOCTYPE html>
<html lang="en">

    <?php
    include "head.php";
    ?>

    <body>
        <header>
            <?php
            include "navbar.php";
            ?>
        </header> 
        <section>
            <main class="container">   
                <form action="userProfile.php" method="POST">
                    <div>
                        <label for="name"><a>Name:</a></label>
                        <input type="text" name="name"  value="<?php echo $userRow['name']; ?>"/>
                    </div>

                    <div>
                        <label for="gender"><a>Gender:</a></label>
                        <input type="text" name="gender"  value="<?php echo $userRow['gender']; ?>"/>
                    </div>
                    <div>
                        <label for="dob"><a>Date of Birth:</a></label>
                        <input name="dob" value="<?php echo $userRow['dob']; ?>"/>
                    </div>
                    <div>
                        <label for="nationality"><a>Nationality:</a></label>
                        <input name="nationality" value="<?php echo $userRow['dob']; ?>"/>
                    </div>
                    <div>
                        <label for="bio"><a>About Yourself:</a></label>
                        <input name="bio" value="<?php echo $userRow['bio']; ?>"/>
                    </div>

                    <input type="submit"  value="Update">
                    <div>
                    </div>

                </form>
            </main>
        </section>
    </body>
    <?php
    include "footer.php";
    ?>
</html>
