<?php 

$e = $_POST['email'];
$p = $_POST['password'];

$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

$sql = "SELECT * FROM 1004proj.user WHERE email = '$e' and password = '$p' " ;
$search_result = mysqli_query($conn, $sql); //to search table
$id = mysqli_fetch_assoc($search_result);
$role=$id['role'];

// return the number of rows in search result
$userfound = mysqli_num_rows($search_result);

if ($userfound == 1)
{
    if($role=="Admin") //when it is admin logging in
    {
        session_start();
        $_SESSION["email"]=$e;
        $_SESSION["role"]=$role;
        header("Location:index.php");
    }
    else { 
        // for when it is user logging in 
        session_start();
        $_SESSION["email"]=$e;
        $_SESSION["role"]=$role;
        header("Location:userProfile.php");
    }
}

    else {
        
        // user record is not FOUND in the user table
        header("Location:login.php?fail=1"); // go back to login page
    }


?>