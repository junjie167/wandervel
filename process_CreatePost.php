<!DOCTYPE html>
<html lang="en">
<?php include "head.php"?>
<?php
  session_start();

function sendDB(){
    global $user_id,$author,$title,$content,$publish_date,$errorMsg,$success,$last_id,$path,$filename;    
    $filename=$_FILES["uploadfile"]["name"];
    $tempname=$_FILES["uploadfile"]["tmp_name"];
    $folder="image/".$filename; 
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
      
       $stmt1 = $conn->prepare("INSERT INTO post (user_id,author,title,content,publish_date) VALUES (?, ?, ?, ?, ?)");         
       $stmt1->bind_param("sssss", $user_id, $author, $title, $content, $publish_date);  
       $last_id = $conn->insert_id;
     
       $stmt2 = $conn->prepare("INSERT INTO image (post_id,image) VALUES (?,?)");      
       $stmt2->bind_param("ss",$last_id,$filename); 
       move_uploaded_file($tempname, $folder);
       $path = "image/".$filename;

       if (!$stmt1->execute())        
       {            
           $errorMsg = "Post Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;           
           $success = false;         
       }  
              $last_id = $conn->insert_id;
 if (!$stmt2->execute())        
       {            
           $errorMsg = "Image Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;           
           $success = false;         
       }  
      
       $stmt1->close();   
       $stmt2->close();    
       
       }    
       $conn->close();


}
$user_id=$_SESSION['user_id'];
$author= $_SESSION['name'];
$title= $content= "";

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

    if (!empty($filename))
    {
        $file_extension = pathinfo($_FILES["uploadfile"]["name"], PATHINFO_EXTENSION);
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
        if (!in_array($file_extension, $allowed_image_extension))
        {
            $errorMsg .= "Upload valiid images. Only PNG and JPEG are allowed.<br>";
            $success = false;
        }
    }
    
    
    // Password
    
//    postToDB();
//    saveimgToDB();
    if ($success)
    {
        sendDB();
    }
    
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
                                echo "<h4>Post successfully created by " . $author . ".</h4>";
                            echo '</div>';
                            echo '<div class="plabel">';
                                echo '<p>Post Preview:</p>';
                            echo '</div>';
                            echo '<div class="pre-wrapper">';
                                echo '<div class="pretitle center">';
                                    echo "<h1>" . $title .".</h1>";
                                echo '</div>';
                                echo '<div class="previmg">';
                                    if (empty($filename))
                                    {
                                        echo '<img class="imgdesign" src="image/defaultimg.png" alt="default"';
                                    }else
                                    {
                                        echo '<img class="imgdesign" src="'.$path.'" alt="'.$path.'"';
                                    }
                                    
                                echo '</div>';
                                echo '<div class="prevcontent">';
                                    echo '<p>'.$content.'</p>';
                                echo '</div>';
                            echo '</div>';
                            //echo "<h4>Title of post is  " . $title .".</h4>";
                            //echo "<h4>Content of post is  " . $content .".</h4>";
                            //echo "<h4>Filepath of image is  " . $path .".</h4>";
                            //echo "<h4>userid: " .$_SESSION['user_id'] .".</h4>";
       

  
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
