<!DOCTYPE html>
<html lang="en">
     
    <?php include "head.php"; ?>
    
    
<?php
$tipsTopic = $tipsCat = $tipsCountry = $tipsContent = $errorMsg = "";
$success = true;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
        
    $tipsTopic = $_POST["tipsTopic"];
    

    //if (!empty($_POST["tipsCat"])) {
        
        //$tipsCat = sanitize_input($_POST["tipsCat"]);
    //}
    
    if (empty($_POST["tipsCat"])) {
        $errorMsg .= "Category is required.<br>";
        $success = false;
    } else {
        $tipsCat = sanitize_input($_POST["tipsCat"]);
    }
    
    if (!empty($_POST["tipsCountry"])) {
        
        $tipsCountry = sanitize_input($_POST["tipsCountry"]);
    } 

    //if (!empty($_POST["tipsContent"])) {
        
      //  $tipsContent = sanitize_input($_POST["tipsContent"]);
    //}
    if (empty($_POST["tipsContent"])) {
        $errorMsg .= "Content is required.<br>";
        $success = false;
    } else {
        $tipsContent = sanitize_input($_POST["tipsContent"]);
    }

    
    if ($success) {
        updateTipstoDB();
     


    }
} else {
    echo "<h2> This page is not meant to be run directly</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='signup.php'>Go to Sign Up page.....</a>";
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
/*
 * Helper function to write the member data to the DB
 */

function updateTipstoDB() {
    global $tipsTopic, $tipsCat, $tipsCountry, $tipsContent , $errorMsg, $success;
  
    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:

        $stmt = $conn->prepare("UPDATE tips SET category=?, country=?, content=? WHERE topic=?");
        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $tipsCat, $tipsCountry, $tipsContent, $tipsTopic);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
//$success = true;
?>

   
    
    <body>
        <header>
            <?php
            include "navbar.php";
            ?>
        </header>
        <main>
        <section>
            <div class="container">

                <hr>
                <?php
                if ($success) {
                    
                    echo "<h4>Tips edited successfully</h4>";
                    echo "<a href='tips.php' class='btn btn-primary'>Return to Tips</a>";
                    
                    
                } else {

                    echo "<h1>OOPS!</h1>";
                    echo "<h4>The following input errors were detected:</h4>";
                    echo "<p>" . $errorMsg . "</p>";
                    echo "<a href='tips.php' class='btn btn-danger'>Return to Tips</a>";
                }
                ?>
            </div>
        </section>
            </main>
        <br>
<?php
    include 'footer.php';
    ?>
    </body>
    
</html>
