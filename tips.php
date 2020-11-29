<?php

function displayTips() {
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {




        $stmt = $conn->prepare("SELECT DISTINCT category from tips ORDER BY category ");
        $stmt->execute();
        $result = $stmt->get_result();
//$cat = $result['category'];
//$stmt2 = $conn->prepare("SELECT * from tips ORDER BY category");
//$stmt2->execute();
//$result2 = $stmt2->get_result();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['tip_id'];
                $category = $row['category'];
                $country = $row['country'];
                $topic = $row['topic'];
                $content = $row['content'];

                echo "<ul>";
                echo "<li>";
                echo $category;

                $stmt2 = $conn->prepare("SELECT * from tips");
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                if ($result2->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result2)) {
                        $id = $row['tip_id'];
                        $category = $row['category'];
                        $country = $row['country'];
                        $topic = $row['topic'];
                        $content = $row['content'];

                        echo "<ul>";
                        echo '<li><a href="viewtips.php?id=' . $row['tip_id'] . ' "> ' . $row['topic'] . '</a></li>';
                        echo "</ul>";
                    }
                }
                echo "</li>";
                echo "</ul>";
            }
        }
    }
}

//if ($result2->num_rows > 0) {
//          while ($row = mysqli_fetch_array($result2)) {
//            echo "<ul>";
//          echo '<li><a href="viewtips.php?id=' . $row['tip_id'] . ' "> ' . $row['topic'] . '</a></li>';
//       echo "</ul>";
//}
//}
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
    displayTips();
    ?>

            </div>
        </section>
    </body>
</html>
