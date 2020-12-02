<?php
 session_start(); 
?>

<?php


$e = $_SESSION["email"];
$id = $_SESSION["user_id"];
$role = $_SESSION["role"];



// if user isn't logged in, will redirect them back to login page
if(!isset($_SESSION["user_id"]))
{
    header("Location:login.php");
}



  $id = $_GET["id"];
  // Create database connection
  $config = parse_ini_file('../../private/db-config.ini');
  $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

  if($conn->connect_error){
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}else{
    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM tips WHERE tip_id= $id");
    
    // Bind and execute
     $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        
            $row = $result->fetch_assoc();
            $id = $row['tip_id'];
            $category = $row['category'];
            $country = $row['country'];
            $topic = $row['topic'];
            $content = $row['content'];
        }


}
$conn->close();

?>
    
<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8"/>
    <title>Edit Tips</title>
    <?php include "head.php";
    ?>
     <!--<head>
        <link rel="stylesheet" href="css/tips.css">
        <script defer src="js/tips.js"></script>


    </head>-->

    <body class="tipsBody">
        <header>
            <?php include "navbar.php"; ?>
        </header>

        <main>

            <section>
                <div class="container"> 
                    <h1 id="headerTips"">Edit Tip</h1>
                    <form id="tipsform" name="edittipsform" action="edittipsProcess.php" method="POST">
                        <div class="form-group">
                            <label style="font-size: 20px;" for="tipsTopic">Topic:</label>                       
                            <input class="form-control" id="tipsTopic" type="text" name="tipsTopic" value="<?php echo $topic ?>" readonly/>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 20px;" for="tipsCat">Category:</label>
                            <input class="form-control" id="tipsCat" type="text" name="tipsCat" value="<?php echo $category ?>"/>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 20px;" for="tipsCountry">Country(Optional):</label>
                            <input class="form-control" id="tipsCountry" type="text" name="tipsCountry" value="<?php echo $country ?>"/>
                           
                        </div>
                        <div class="form-group">
                        <label for="tipsContent"><a>Tips Content:</a></label>
                        <textarea class="form-control" rows="10" name="tipsContent" type="text" id="tipsContent" value="<?php echo $content ?>"><?php echo $content ?></textarea>
                        </div>
                        



                        <div class="form-group">  
                            <button class="btn btn-primary" type="submit">Edit Tip</button>
                        </div>
                    </form>
                </div> 
            </section>
        </main>

<?php
include "footer.php";
?>
    </body>
</html>
