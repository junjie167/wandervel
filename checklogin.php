<?php 

$e = $_POST['email'];
$p = $_POST['password'];
$userfound = 0;

$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if($conn->connect_error){
    echo "<p>Welp cant even connect</p>";
}else{

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $e);
    $stmt->execute();
    $result = $stmt->get_result();
    $userfound = mysqli_num_rows($result);

}

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
        //for when it is user logging in 
        session_start();
        $_SESSION["email"]=$e;
        $_SESSION["role"]=$role;
        header("Location:index.php");
    }
} else {
        
        // user record is not FOUND in the user table
        header("Location:login.php?fail=1"); // go back to login page
 }


?>