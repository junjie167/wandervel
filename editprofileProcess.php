<?php

$name = $nationality = $dob = $bio = $errorMsg = "";
$success = true;

// Only process if the form has been submitted via POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // name
    if (!empty($_POST["name"]))
    {
        $name = sanitize_input($_POST["name"]);
    }
    
   // dob
    if (!empty($_POST["dob"]))
    {
        $dob = sanitize_input($_POST["dob"]);

    }
    //nationality
    if (!empty($_POST["nationality"]))
    {
        $nationality = sanitize_input($_POST["nationality"]);

    }
    //bio
    if (!empty($_POST["bio"]))
    {
        $bio = sanitize_input($_POST["bio"]);

    }
    //if success 
    if ($success)
    {
        saveProfileToDB();
    }
} 
else {
    echo "<h2>This page is not meant to be run directly.</h2>";

    exit();
}
//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<?php
function saveProfileToDB() {
    
    global $name,$email, $dob, $nationality, $bio, $errorMsg,$success;
    session_start();
    $email = $_SESSION['email'];
    //$id = $_SESSION["user_id"];


// if user isn't logged in, will redirect them back to login page
//if (!isset($_SESSION["user_id"])) {
  //  header("Location:login.php");
//}


    // Create database connection.    
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {

        // Prepare the statement:        
        $stmt = $conn->prepare("UPDATE user SET name=? ,dob=?,nationality=?, bio=? WHERE email=?");
        // Bind & execute the query statement:        
        $stmt->bind_param("sssss", $name, $dob, $nationality, $bio,$email);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
$success = true;


?>

    
<html>
    <head>
        <title>Edited Profile</title>
        <?php include"head.php"?>
    </head>
    <body>
        <?php
        include "navbar.php";
        ?>
        <main class="container">
        <hr>
        <?php
        if ($success)
        {
            echo "<h2>Profile has been updated successfully!</h2>";
            echo "<h4>Name : " . $name . "</h4>";
            echo "<h4>Date Of Birth : " . $dob . "</h4>";
            echo "<h4>Nationality : " . $nationality . "</h4>";
            echo"<h4>About Yourself : " . $bio . "</h4>";
            
 
        }
        else 
        {
            echo "<h2>Oops!</h2>";
            
        
     
        }
        ?>
       
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>