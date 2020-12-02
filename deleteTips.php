<?php
 $del_id = $_GET["del_id"];
  // Create database connection
  $config = parse_ini_file('../../private/db-config.ini');
  $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

  if($conn->connect_error){
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}else{
    // Prepare the statement
    $stmt = $conn->prepare("DELETE FROM tips WHERE tip_id= $del_id");
    
    // Bind and execute
     $stmt->bind_param("i", $del_id);
    if (!$stmt->execute())        
       {            
           $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;           
           $success = false;        
           
       }        
       $stmt->close();    
       
       }    
       $conn->close();
       
       
$success=true;
?>
<!DOCTYPE html>
<html lang="en">
   
    <?php include"head.php"?>
        <title>Delete</title>
        
    
    <body>
        <?php
        include "navbar.php";
        ?>
        <main class="container">
        <hr>
        <?php
        if ($success)
        {
            echo "<h2>Tip has been deleted successfully!</h2>";     
        }
        else 
        {
            echo "<h2>Oops!</h2>";
            echo "<h4>The following errors were detected:</h4>";
  
            echo "<p>" . $errorMsg . "</p>";
        
     
        }
        ?>
        <a href="tips.php">Back to tips</a>
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>