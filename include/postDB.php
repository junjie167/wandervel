<?php

//Retrieve all the post
function display()
{
    global $page_no, $total_no_ofpages;

    if($_GET["page"] != "")
    {
        $page_no = $_GET["page"];
    }
    $max_records_per_page = 9;
    $offset = ($page_no - 1)*$max_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;


    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $stmt = $conn->prepare("SELECT * FROM post");
        $stmt->execute();
        $result_records = $stmt->get_result();
        $total_post = $result_records->num_rows;
        $total_no_ofpages = ceil($result_records->num_rows/$max_records_per_page);


        $stmt = $conn->prepare("SELECT  p.post_id AS p_post_id, p.user_id AS p_user_id, p.author AS p_author,
        p.title AS p_title, p.content AS p_content, p.publish_date AS p_publish_date,
        picture.image AS picture_image FROM post p LEFT JOIN image AS picture
        ON picture.post_id = p.post_id ORDER BY p.post_id DESC LIMIT " . $offset . "," . $max_records_per_page);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {

                if ($row["picture_image"] == NULL)
                {
                    
                }
                
                $date = date("jS M Y",strtotime($row["p_publish_date"]));
                $content = substr($row["p_content"],0,100);
                echo '<div class="col-md-4 col-sm-6 click" data-id='.$row["p_post_id"].'>';
                echo '<div class="blog post effect">';
                echo '<div class="blog-image">';
                echo '<img src="image/'.$row["picture_image"].'">';
                echo '</div>';
                echo '<div class="blog-title">';
                echo '<h3>' . $row["p_title"] . '</h3>';
                echo '</div>';
                echo '<div class="blog-content">' . $content . ' ... 
                <a href="viewpost.php?id=' .$row["p_post_id"].'">Read more</a></div>';
                echo '<div class="blog-footer">';
                echo '<ul class="post-info">';
                echo '<li><i class="material-icons edit">date_range</i>' . $date . '</li>';
                echo '<li><i class="material-icons edit">create</i>' . $row["p_author"] . '</li>';
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


    //Retrieve function to display post
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
                            echo '<div class="edit_delete">';
                                echo '<ul>';
                                    echo '<li class="pl"><a href="deletePost.php">Delete<a>';
                                    echo '<li class="pl"><a href="updatePost.php">Edit</a>';
                                echo '</ul>';
                                echo '<i class="material-icons fr">bookmark_border</i>';
                            echo '</div>';                              
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="post-img">';
                        echo '<img src="image/'.$row["picture_image"].'" alt="'.$row["picture_image"].'">';                   
                    echo '</div>';
                    echo '<div class="post-content">';
                        echo '<p>'.$row["content"].'</p>';
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

    //Retrieve function for previous and next post
    function relatedPost()
    {
        $postid = $_GET["id"];
        $havePrev = 0;
        $haveNext = 0;
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
                            echo '<a class="link-color" href="viewpost.php?id='.$row["post_id"].'">';
                                echo '<h4>'.$row["title"].'</h4>';
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
                    $haveNext = 1;
                    if ($havePrev)
                    {
                        echo '<div class="col-md-6 col-sm-6 next-post">';
                            echo '<p>Next Post: </p>';
                            echo '<a class="link-color" href="viewpost.php?id='.$row["post_id"].'">';
                                    echo '<h4>'.$row["title"].'</h4>';
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
                                echo '<a class="link-color" href="viewpost.php?id='.$row["post_id"].'">';
                                    echo '<h4>'.$row["title"].'</h4>';
                                echo '</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                        
                }
                $stmt->close();
            }else 
            {
                echo '</div>';
            }

            
        }
        $conn->close();
    }

?>