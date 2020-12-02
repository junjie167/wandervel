<?php

$name = $nationality = $dob = $bio = $errorMsg = "";
$success = true;
global $isempty;
$isempty = 0; 
if ($_FILES['fileToUpload']['name']=='') {
    $isempty = 1;
} 

$allowedType = array("image/gif", "image/jpeg", "image/jpg", "image/png"); //array to check for file type
  if ( in_array ( $_FILES["fileToUpload"]["type"] , $allowedType ) || $isempty == 1) //if the first value part of the member in array, then proceed
  {
     
   // proceed to upload
   if ( $_FILES["fileToUpload"]["size"] < 1000000 || $isempty == 1 ) // larger than 1MB
   { 
       if ($isempty != 1) {
                // proceed to upload
                date_default_timezone_set("Asia/Singapore");

                //Create a target folder called 'profileimages'.
                $target = "profileimages/" . $r . $_FILES["fileToUpload"]["name"] ; 


                //when upload file, it will auto upload to tmp folder. move from tmp folder to target folder. Can only run once per file
                $result = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $target);
       }
  

    if ($result || $isempty == 1) {
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
        saveProfileToDB($isempty);
    }
} 
else {
    echo "<h2>This page is not meant to be run directly.</h2>";

    exit();
}
    }
    else
     {
      echo "Upload FAILED!<br>";
     }
   }
   else
   {
    echo "File is too large<br>";
    exit();
   }
  }  
  else
  {
   echo "Invalid file type<br>";
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
function saveProfileToDB($isempty) { 
    if ($isempty==0) {
        global $name,$email, $dob, $nationality, $bio, $profilepic, $emptymsg, $errorMsg,$success;
        session_start();
        $email = $_SESSION['email'];
        $profilepic=$_FILES["fileToUpload"]["name"];
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
            $stmt = $conn->prepare("UPDATE user SET name=? ,dob=?,nationality=?, bio=?, profile_picture=? WHERE email=?");
            // Bind & execute the query statement:        
            $stmt->bind_param("ssssss", $name, $dob, $nationality, $bio, $profilepic, $email);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $success = false;
            }
            $stmt->close();
        }
        $conn->close();
    }
    else {
        global $name,$email, $dob, $nationality, $bio, $emptymsg, $errorMsg,$success;
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
            $stmt->bind_param("sssss", $name, $dob, $nationality, $bio, $email);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $success = false;
            }
            $stmt->close();
        }
        $conn->close();
    }
    
}
$success = true;


?>

    
<html>
    
    <?php include"head.php"?>

        <title>Edited Profile</title>
        
    
    <body>
        <header>
        <?php
        include "navbar.php";
        ?>
        </header>
        <main class="container">
        <hr>
        <?php
        if ($success)
        {
            global $name, $gender, $email, $dob, $nationality, $bio, $pwd_hashed, $profilepic, $userid;
                // Create database connection
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

                if($conn->connect_error){
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                }else{
                    // Prepare the statement
                    $stmt = $conn->prepare("SELECT profile_picture FROM user WHERE email= '".$_SESSION['email']."'");
                    
                    // Bind and execute
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0){
                        // Note that email field is unique
                        $row = $result->fetch_assoc();
                        $profilepic = $row["profile_picture"];
                    }


                }
                $conn->close();
            echo "<h2>Profile has been updated successfully!</h2>";
            echo "<h4>Name : " . $name . "</h4>";?>
            <img src="profileimages/<?php echo $profilepic?>" width="150" height="150">
            <?php
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
        
    </body>
    <?php
        include "footer.php";
        ?>
</html>