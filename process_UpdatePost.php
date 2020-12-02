<!DOCTYPE html>
<html lang="en">
<?php include"head.php"?>
<?php
function img(){
   global $image_src,$image;
   $image_id=4;
   session_start();
$post_id=$_SESSION['post_id']; 
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
        
   $stmt = $conn->prepare("SELECT * FROM image WHERE post_id=?");   
   // Bind & execute the query statement:        
   $stmt->bind_param("i", $post_id);        
   $stmt->execute();        
   $result = $stmt->get_result();        
   if ($result->num_rows > 0)        
   {           
       // Note that email field is unique, so should only have            
        // one row in the result set.           
          $row = $result->fetch_assoc();          
          $image = $row["image"];      
          $image_src = "image/".$image;
                      $stmt->close();   
      }
      $conn->close();
}}
function saveMemberToDB()
{
   global $author,$title,$content;
    session_start();
    $post_id=$_SESSION['post_id']; 
    
    // Create database connection.    
    $config = parse_ini_file('../../private/db-config.ini');    
    $conn = new mysqli($config['servername'], $config['username'],            
            $config['password'], $config['dbname']);
    if ($conn->connect_error)    
    {        
        $errorMsg = "Connection failed: " . $conn->connect_error;        
        $success = false;    
        
    }else{  
        
    // Prepare the statement:        
       $stmt = $conn->prepare("UPDATE post SET title=? ,content=? WHERE post_id=?");   
       // Bind & execute the query statement:        
       $stmt->bind_param("ssd",  $title,$content,$post_id);        
       if (!$stmt->execute())        
       {            
           $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;           
           $success = false;        
           
       }        
       $stmt->close();    
       
       }    
       $conn->close();
   
}

$author= "Dominic";

$publish_date=date("d-m-Y h:i:sa");
       
$success = true;

// Only process if the form has been submitted via POST.
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // TITLE
    if (empty($_POST["title"]))
    {
        $errorMsg .= "title is required.<br>";
        $success = false;
    }
    else 
    {
        $title = sanitize_input($_POST["title"]);
    }
    
   // content
    if (empty($_POST["content"]))
    {
        $errorMsg .= "content is required.<br>";
        $success = false;
    }
    else
    {
        $content = sanitize_input($_POST["content"]);

    }
    
    // Password
    img();
    saveMemberToDB();
}
else 
{
    echo "<h2>This page is not meant to be run directly.</h2>";
    
    exit();
}

function sanitize_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}
?>
    <body>
        <header>
            <?php
            include "navbar.php";
            ?>
        </header>
        <main>
            <section class="blog-posts grid-system">
                <div class="container">
                    <?php
                        if ($success)
                        {
                            echo '<div class="icon">';
                                echo '<i class="fa fa-check-circle success"></i>';
                            echo '</div>';
                            echo '<div class="messagetitle">';
                                echo "<h2>Post has been updated successful!</h2>";
                            echo '</div>';
                            echo '<div class="plabel">';
                                echo '<p>Post Preview:</p>';
                            echo '</div>';
                            echo '<div class="pre-wrapper">';
                                echo '<div class="pretitle center">';
                                    echo "<h1>" . $title .".</h1>";
                                echo '</div>';
                                echo '<div class="previmg">';
                                    if (empty($image))
                                    {
                                        echo '<img class="imgdesign" src="image/defaultimg.png" alt="default"';
                                    }else
                                    {
                                        echo '<img class="imgdesign" src="'.$image_src.'" alt="'.$image_src .'"';
                                    }
                                    
                                echo '</div>';
                                echo '<div class="prevcontent">';
                                    echo '<p>'.$content.'</p>';
                                echo '</div>';
                            echo '</div>';
                            
                            //echo "<h4>Author name is : " . $author . ".</h4><br>";
                            //echo "<h4>New title is : " . $title . ".</h4><br>";
                            //echo "<h4>New content is : " . $content . ".</h4>";
                            //echo"<h4>New content is : " . $image_src . ".</h4>";
            
 
                        }
                        else 
                        {
                            echo '<div class="icon">';
                                echo '<i class="fa fa-times-circle failed"></i>';
                            echo '</div>';
                            echo '<div class="messagetitle">';
                                echo "<h2>Oops!</h2>";
                            echo '</div>';
                            echo '<div class="plabel">';
                                echo "<h4>The following errors were detected:</h4>";
                            echo '</div>';
                            echo '<div class="plabel">';
                                echo "<p>" . $errorMsg . "</p>";
                            echo '</div>';
                            echo '<div class="center">';
                                echo '<button id="backcreate" class="btn btn-primary" >Back to post</button>';
                            echo '</div>';
     
                        }
                    ?>
                </div>
            </section>
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>
