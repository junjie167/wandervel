<?php
session_start();
?>
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

                if ($_SESSION['role'] == "admin") {
                    echo '<div class="text-right">';
                    echo '<a href="editTips.php?id=' . $row['tip_id'] . ' "><button id="editTips" class="btn btn-outline-secondary create"><i class="material-icons edit">border_color</i>Edit</button></a>';
                    echo '<input name="Delete" pull-right value="Delete" type="button" class="btn btn-outline-danger" onClick="deleteme(' . $row['tip_id'] . ')">';
                    echo '</div>';
                    echo '<script type="text/javascript" src="js/deleteTips.js"></script>';
                }
                echo '<h3 id="tipsTitle">' . $topic . '</h3><br>';

                echo '<p>' . nl2br($content) . '</p>';
            }
        }
    }
    $conn->close();
}
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
if (isset($_SESSION['email'])) {
    include "navbar.php";
} else {
    include "indexnavbar.php";
}
?>
        </header>
        <section>
            <div class="container">

                <!--<h1>TIPS</h1>-->
                <article class="viewTips">
                    <?php
                        viewTips();
                     ?>

                </article>
            </div>
        </section>
        <?php
        include "footer.php";
        ?>
    </body>
</html>
