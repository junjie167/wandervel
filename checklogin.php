<!DOCTYPE html>
<html>
<body>
<main class="container">

<?php

            
     function authenticateUser(){
        global $uname, $email, $pwd_hashed, $errorMsg, $success;
                        
                // Create database connection
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                
                // Check connection
                if($conn->connect_error){
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                }else{
                    // Prepare the statement
                    $stmt = $conn->prepare("SELECT * FROM user WHERE email=?  ");
                    
                    // Bind and execute
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0){
                        // Note that email field is unique
                        $row = $result->fetch_assoc();
                        $uname = $row["name"];
                        $pwd_hashed = $row["password"];                
                        
                        // Check if password matches
                        // $_POST refers to the data collected from form and $pwd_hashed refers to password store in DB. 
                        if(password_verify($_POST["pwd"], $pwd_hashed)){
                            $errorMsg = "Email not found or password doesn't match...";
                            $success = false;
                        }
                    }else{
                         $errorMsg = "Email not found or password doesn't match... ";
                            $success = false;
                    }
                    $stmt->close();
                }
                $conn->close();
            }

$email = $errorMsg = " ";
$success = true;
$uname = $_POST["name"];


if (empty($_POST["email"]))
{
    $errorMsg .= "Email is required.<br>";
    $success = false;
}
else
{
    $email = sanitize_input($_POST["email"]);
    
    // Additional check to make sure email address is well formed. 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errorMsg .= "Invalid email format.";
        $success = false;
    }
}


authenticateUser();

if ($success)
{
    session_start();
    $_SESSION["email"]=$email;
    header("Location:userProfile.php");
}
else
{
    echo "<h1>Oops!</h1>";
    echo "<h2>The following errors were detected:</h2>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<p><a href='./login.php' class='btn btn-danger'>Return to log in</a>";
}

// Helper function that checks input for malicious or unwanted content
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>
        </main>  
        </body>
        </html>
<!-- 

// if ($userfound == 1)
// {
//     if($role=="Admin") //when it is admin logging in
//     {
//         session_start();
//         $_SESSION["email"]=$e;
//         $_SESSION["role"]=$role;
//         header("Location:index.php");
//     }
//     else { 
//         //for when it is user logging in 
//         session_start();
//         $_SESSION["email"]=$e;
//         $_SESSION["role"]=$role;
//         header("Location:index.php");
//     }
// } else {
        
//         // user record is not FOUND in the user table
//         header("Location:login.php?fail=1"); // go back to login page
//  } -->

