<?php
$tipsTopic = $tipsCat = $tipsCountry = $tipsContent = $errorMsg = "";
$success = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["tipsTopic"])) {
        $errorMsg .= "Topic is required.<br>";
        $success = false;
    } else {
        $tipsTopic = sanitize_input($_POST["tipsTopic"]);
        
    }

    if (empty($_POST["tipsCat"])) {
        $errorMsg .= "Category is required.<br>";
        $success = false;
    } else {
        $tipsCat = sanitize_input($_POST["tipsCat"]);
    }
    
    if (!empty($_POST["tipsCountry"])) {
        
        $tipsCountry = sanitize_input($_POST["tipsCountry"]);
    } 

    if (empty($_POST["tipsContent"])) {
        $errorMsg .= "Content is required.<br>";
        $success = false;
    } else {
        $tipsContent = sanitize_input($_POST["tipsContent"]);
    }

    
    if ($success) {
        saveTipstoDB();
     


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

function saveTipstoDB() {
    global $tipsTopic, $tipsCat, $tipsCountry, $tipsContent , $errorMsg, $errorMsg, $success;
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

        $stmt = $conn->prepare("INSERT INTO tips (topic, category, country, content) VALUES (?, ?, ?, ?)");
        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $tipsTopic, $tipsCat, $tipsCountry, $tipsContent);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<html>
    <?php include 'head.php'; ?>

    <body>
        <header>
            <?php
            include "navbar.php";
            ?>
        </header>

        <section>
            <div class="container">

                <hr>
                <?php
                if ($success) {
                    
                    echo "<h4>Tips added successfully</h4>";
                    echo "<a href='tips.php' class='btn btn-primary'>Return to Tips</a>";
                    
                    
                } else {

                    echo "<h1>OOPS!</h1>";
                    echo "<h4>The following input errors were detected:</h4>";
                    echo "<p>" . $errorMsg . "</p>";
                    echo "<a href='createTips.php' class='btn btn-danger'>Return to Create Tips</a>";
                }
                ?>
            </div>
        </section>
        <br>

    </body>
    <?php
    include 'footer.php';
    ?>
</html>
