<?php

$errorMsg='';
$success=True;


getPost();
/*  * Helper function to authenticate the login. */  
function getPost()
{ 
global $author,$title,$content,$post_id;

$post_id=$_GET["id"];
session_start();
$_SESSION['post_id'] = $post_id;
// Create database connection.   
   $config = parse_ini_file('../../private/db-config.ini');   
   $conn = new mysqli($config['servername'], $config['username'],           
           $config['password'], $config['dbname']);    
// Check connection    
  if ($conn->connect_error)     
  {        
      $errorMsg = "Connection failed: " . $conn->connect_error;      
      $success = false;   
      }    
      else    
      {        
// Prepare the statement:        
   $stmt = $conn->prepare("SELECT * FROM post WHERE post_id=?");   
   // Bind & execute the query statement:        
   $stmt->bind_param("i", $post_id);        
   $stmt->execute();        
   $result = $stmt->get_result();        
   if ($result->num_rows > 0)        
   {           
       // Note that email field is unique, so should only have            
        // one row in the result set.           
          $row = $result->fetch_assoc();          
          $author = $row["author"];    
          $title = $row["title"];   
          $content = $row["content"];        
  
                      }    
                      else   
                      {           
                          $errorMsg = "User has not created any posts";         
                          $success = false;        
                          
                      }       
                      $stmt->close();   
      }
      $conn->close();
}?>
<html>
 <head>
        <title>Registration Results</title>
        <?php include"head.php"?>
    </head>
    <body>  
        <?php
        include "navbar.php";
        ?>
        <main class="container">
        <hr>
        <h1>hi<?php echo $post_id?></h1>  
          <form action="process_UpdatePost.php" method="post">   
        <div class="form-group">   
            <label for="title">Title:</label>  
            <input class="form-control" type="text" id="title"          
                   name="title" value=<?php echo $title?>>    
        </div>   
        <div class="form-group">   
            <label for="content">Share your post with everyone!</label>  
            <textarea rows="10"class="form-control" id="content"          
                      name="content"> <?php echo $content?>  </textarea>   
        </div>  
        <div class="form-group">  
            <button class="btn btn-primary" type="submit">Submit</button> 
        </div>
    </form> 
            
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>

  
 