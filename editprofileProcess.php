<?php 
$e = $_SESSION['email'];

$res=mysqli_query("SELECT * FROM user WHERE email=".$_SESSION['email']);
$userRow=mysql_fetch_array($res);

if(isset($_POST['name']) )
{
    $name= $_POST['name'];
    $e  = $_SESSION['email'];
    $sql  = "UPDATE user SET name='$name' WHERE email=$e";
    $res    = mysql_query($sql) 
                                or die("Could not update".mysql_error());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['gender']) )
{
    $gender= $_POST['gender'];
    $e  = $_SESSION['email'];
    $sql  = "UPDATE user SET gender='$gender' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_error());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['dob']) )
{
    $dob= $_POST['dob'];
    $e  = $_SESSION['email'];
    $sql = "UPDATE user SET dob='$dob' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_affected_rows());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['nationality']) )
{
    $dob= $_POST['nationality'];
    $e  = $_SESSION['email'];
    $sql = "UPDATE user SET nationality='$nationality' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_affected_rows());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}

if( isset($_POST['bio']) )
{
    $bio= $_POST['bio'];
    $e  = $_SESSION['email'];
    $sql = "UPDATE user SET bio='$bio' WHERE email=$e";
    $res = mysql_query($sql) 
                                or die("Could not update".mysql_affected_rows());
    echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}
?>