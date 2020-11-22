<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<head>
    <link rel="stylesheet" href="css/viewpost.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <?php 
                        relatedPost();
                    ?>
                    <div>
                        <h1>Comments</h1>
                    </div>
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
                    echo '<div class="title-header">';
                        echo '<div class="post-title-box">';
                            echo '<h1>'. $row["title"] .'</h1>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="row mar">';
                        echo '<div class="col-md-9 col-sm-6 middle">';
                            echo '<div class="viewpost-info">';
                                echo '<ul>';
                                    echo '<li>';
                                        echo '<div class="user-profile-image">';
                                            echo  $displayImg;
                                        echo '</div>';
                                    echo '</li>';
                                    echo '<li class="list-border pl">by '.$row["author"].'</li>';
                                    echo '<li class="pl list-border">'.$date.'</li>';
                                    echo '<li class="pl"><i class="material-icons resize">chat_bubble_outline</i>
                                            0 comments</li>';
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-3 col-sm-6 middle">';
                            echo '<i class="material-icons fr">bookmark_border</i>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="post-img">';
                        echo '<img src="image/'.$row["picture_image"].'" alt="'.$row["picture_image"].'">';                   
                    echo '</div>';
                    echo '<div class="post-content">';
                        echo $row["content"];
                    echo '</div>';
                    echo '<div class="row mar border-bottom">';
                        echo '<div class="col-m-6">';
                            echo '<div class="social-info">';
                                echo '<ul>';
                                    echo '<li>Share: </li>';
                                    echo '<li class="icon"><i class="fa fa-facebook-square"></i></li>';
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

<?php
    function relatedPost()
    {
        $postid = $_GET["id"];
        $havePrev = 0;
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        }else
        {
            $stmt = $conn->prepare("SELECT * FROM post AS p WHERE p.post_id > $postid ORDER BY  p.post_id ASC LIMIT 1
            ");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $havePrev = 1;
                    echo '<div class="row mar border-bottom">';
                        echo '<div class="col-md-6 col-sm-6 previous-post">';
                            echo '<p>Previous Post: </p>';
                            echo '<a href="viewpost.php?id='.$row["post_id"].'">';
                                echo '<h1>'.$row["title"].'</h1>';
                            echo '</a>';
                        echo '</div>';
                        
                    
                }
            }

            $stmt = $conn->prepare("SELECT * FROM post AS p WHERE p.post_id < $postid ORDER BY  p.post_id DESC LIMIT 1
            ");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    if ($havePrev)
                    {
                        echo '<div class="col-md-6 col-sm-6 next-post">';
                            echo '<p>Next Post: </p>';
                            echo '<a href="viewpost.php?id='.$row["post_id"].'">';
                                    echo '<h1>'.$row["title"].'</h1>';
                            echo '</a>';
                        echo '</div>';
                        echo '</div>';
                        
                    }else
                    {
                        echo '<div class="row mar border-bottom">';
                        echo '<div class="col-md-6 col-sm-6 previous-post">';
                        echo '</div>';
                        echo '<div class="col-md-6 col-sm-6 next-post">';
                            echo '<p>Next Post: </p>';
                                echo '<a href="viewpost.php?id='.$row["post_id"].'">';
                                    echo '<h1>'.$row["title"].'</h1>';
                                echo '</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                        
                }
                $stmt->close();
            }


        }
        $conn->close();
    }
?>
</html>