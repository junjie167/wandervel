<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<head>
    <link rel="stylesheet" href="css/viewpost.css">
</head>
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
                        display_post();
                    ?>
                </div>
            </section>
        </main>
    </body>
<?php include "footer.php"; ?>
<?php 
    function display_post()
    {
        $postid = $_GET["id"];
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else
        {
            $stmt = $conn->prepare("SELECT *, picture.image AS picture_image , user.profile_picture AS user_profile_picture 
            FROM post AS p LEFT JOIN image AS picture ON p.post_id = picture.post_id
            JOIN user AS user ON p.user_id = user.user_id WHERE p.post_id = ". $postid);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $userImg = base64_encode($row["user_profile_picture"]);
                    $displayImg = '<img src="data:image/jpeg;base64,'.$userImg.'"/>';
                    if ($row["user_profile_picture"] == NULL)
                    {
                        
                        $displayImg = '<img src="image/astronomy-1867616__340.jpg"/>';
                    }

                    $date = date("jS M Y",strtotime($row["publish_date"]));
                    echo '<div class="title-header" style="--url: url(../image/'.$row["picture_image"].')">';
                        echo '<div class="post-title-box">';
                            echo '<h1>'. $row["title"] .'</h1>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="row mar">';
                        echo '<div class="col-md-1 col-sm-6">';
                            echo '<div class="user-profile-image">';
                                echo  $displayImg;
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-8 col-sm-6 middle">';
                            echo '<div class="viewpost-info">';
                                echo '<ul>';
                                    echo '<li>'.$date.'</li>';
                                    echo '<li>, '.$row["author"].'</li>';
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-3 col-sm-6 middle">';
                            echo '<i class="material-icons fr">bookmark_border</i>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="post-content">';
                        echo $row["content"];
                    echo '</div>';
                    echo '<div class="row">';
                        echo '<div class="col-m-6">';
                            echo '<div class="social-info">';
                                echo '<ul>';
                                    echo '<li>Share: </li>';
                                    echo '<li>Facebook</li>';
                                    echo '<li>Twitter</li>';
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
?>
</html>