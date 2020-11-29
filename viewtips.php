<?php

function viewTips() {
    $id = $_GET["id"];
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $stmt = $conn->prepare("SELECT * from tips WHERE tip_id = $id");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['tip_id'];
                $category = $row['category'];
                $country = $row['country'];
                $topic = $row['topic'];
                $content = $row['content'];

                
                echo '<h3><a>' . $topic . '</a></h3><br>';
                
                echo  '<p>' . nl2br($content) . '</p>';
                
            }
        }
    }
}

?>
<!DOCTYPE html>
    <html lang="en">

    <?php
    include "head.php";
    ?>
        <head>
            <link rel="stylesheet" href="css/tips.css">
            <script defer src="js/tips.js"></script>


        </head>

        <body>
            <header>
    <?php
    session_start();
    if (isset($_SESSION['email'])) {
        include "navbar.php";
    } else {
        include "indexnavbar.php";
    }
    ?>
            </header>
            <section>
                <div class="container">
                    <h1>TIPS</h1>

    <?php
        viewTips();
    ?>

            </div>
        </section>
    </body>
</html>
