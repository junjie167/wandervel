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
                echo "<a class='text-light bg-dark' href=#>" .$category. "</a>";
             

                $stmt2 = $conn->prepare("SELECT * from tips WHERE category=?");
                $stmt2->bind_param("s", $category);
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
                        echo '<li><a class="text-info" href="viewtips.php?id=' . $row['tip_id'] . ' "> ' . $row['topic'] . '</a></li>';
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
       <!-- <head>
            <link rel="stylesheet" href="css/tips.css">
            <script defer src="js/tips.js"></script>


        </head>-->

        <body class="tipsBody">
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
                <h1 id="headerTips">TIPS</h1>
                
                <div class="bgTips">
                    <div class="text-right">
                    <?php
                    
                    if($_SESSION['role'] == "admin")
                            {
                            echo '<a href="./createTips.php"><button id="createTips" class="btn btn-outline-secondary create"><i class="material-icons edit">border_color</i>Create Tips</button></a>';
                            }
                    ?>
                     </div> 
                    <p id="underTitle"><em>Just a little tips and FYI from us for those wanting to travel ~</em></p>
                    
                    

    <?php
    displayTips();
    ?>

            </div>
        </section>
            <?php
          include "footer.php";
            ?>
    </body>
    
</html>
