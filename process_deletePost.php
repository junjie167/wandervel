<?php 
global $post_id;
function del(){
      
    $post_id = $_POST["id"];
   $config = parse_ini_file('../../private/db-config.ini');   
   $conn = new mysqli($config['servername'], $config['username'],           
           $config['password'], $config['dbname']);      

    if ($conn->connect_error)    
    {        
        $errorMsg = "Connection failed: " . $conn->connect_error;        
        $success = false;    
        
    }else{  
        
    // Prepare the statement:        
      $stmt = $conn->prepare("Delete FROM post WHERE post_id=?");   
   // Bind & execute the query statement:        
         $stmt->bind_param("i", $post_id);    
       if (!$stmt->execute())        
       {            
           $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;           
           $success = false;        
           
       }        
       $stmt->close();    
       
       }    
       $conn->close();
   
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{   $success = true;
    del();
}
else 
{
    echo "<h2>This page is not meant to be run directly.</h2>";
    
    exit();
}

?>
<html>
    <head>
        <title>Edited post</title>
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
            echo "<h2>Post has been deleted successful!</h2>";     
        }
        else 
        {
            echo "<h2>Oops!</h2>";
            echo "<h4>The following errors were detected:</h4>";
  
            echo "<p>" . $errorMsg . "</p>";
        
     
        }
        ?>
        <a href="index.php">Back to homepage</a>
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>
   

