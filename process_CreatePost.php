<?php
  
//function PostToDB()
//{
//  global $user_id,$author,$title,$content,$publish_date,$errorMsg,$success,$last_id;
//
//    // Create database connection.    
//    $config = parse_ini_file('../../private/db-config.ini');    
//    $conn = new mysqli($config['servername'], $config['username'],            
//            $config['password'], $config['dbname']);
//    if ($conn->connect_error)    
//    {        
//        $errorMsg = "Connection failed: " . $conn->connect_error;        
//        $success = false;    
//        
//    }else{  
//        
//    // Prepare the statement:       
//      
//       $stmt = $conn->prepare("INSERT INTO post (user_id,author,title,content,publish_date) VALUES (?, ?, ?, ?, ?)");   
//       // Bind & execute the query statement:        
//       $stmt->bind_param("sssss", $user_id, $author, $title, $content, $publish_date);        
//       if (!$stmt->execute())        
//       {            
//           $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;           
//           $success = false;        
//           
//       } 
//   
//         $last_id = $conn->insert_id;
//       $stmt->close();    
//       
//       }    
//       $conn->close();
//
//}
//function saveimgToDB()
//{
// 
//   $filename=$_FILES["uploadfile"]["name"];
//   $tempname=$_FILES["uploadfile"]["tmp_name"];
//   $folder="image/".$filename;  
//    $config = parse_ini_file('../../private/db-config.ini');    
//    $conn = new mysqli($config['servername'], $config['username'],            
//            $config['password'], $config['dbname']);
//    if ($conn->connect_error)    
//    {        
//        $errorMsg = "Connection failed: " . $conn->connect_error;        
//        $success = false;    
//        
//    }else{  
//        
//    // Prepare the statement:      
//       
//       $stmt = $conn->prepare("INSERT INTO image (image) VALUES (?)");   
//       // Bind & execute the query statement:        
//       $stmt->bind_param("s", $filename);        
//       move_uploaded_file($tempname, $folder);
//    //  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
//       if (!$stmt->execute())        
//       {            
//           $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;           
//           $success = false;        
//           
//       }           
//       $stmt->close();           
//       }    
//       $conn->close();
//   
//}
function sendDB(){
    global $user_id,$author,$title,$content,$publish_date,$errorMsg,$success,$last_id,$path;    
    $filename=$_FILES["uploadfile"]["name"];
    $tempname=$_FILES["uploadfile"]["tmp_name"];
    $folder="image/".$filename; 
    $id=69;
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
$user_id=5;
$author= "Dominic";
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
    
    // Password
    
//    postToDB();
//    saveimgToDB();
    sendDB();
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
        <?php
        if ($success)
        { 
       
        echo "<h4>Post successfully created by " . $author . ".</h4>";
        echo "<h4>Title of post is  " . $title .".</h4>";
        echo "<h4>Content of post is  " . $content .".</h4>";
        echo "<h4>Filepath of image is  " . $path .".</h4>";
  
        }
        else 
        {
            echo "<h2>Oops!</h2>";
            echo "<h4>The following errors were detected:</h4>";
            echo "<p>" . $errorMsg . "</p>";
      
        }
        ?>
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>
