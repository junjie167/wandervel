<!DOCTYPE html>
<html>
<?php
include "head.php";
?>

<head>
    <!-- Post CSS Files -->
    <link rel="stylesheet" href="css/post.css">
    
    <script defer src="js/post.js"></script>
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
                <div class="center">
                    <h1 class="header-title">Post</h1>
                    <button class="create-post">CREATE POST</button>
                </div>
                <div class="row">
                    <?php
                    display();
                    ?>
                    <div class="paging">
                        <?php 
                            if($_GET["page"] > 2)
                            {
                                echo '<a href="post.php?page='. ($_GET["page"] - 1) .'">&laquo;</a>';
                            }
                            for($page = 1 ; $page < $total_no_ofpages ; $page++)
                            {
                                echo '<a href="post.php?page='. $page.'">'. $page . '</a>';
                            }
                            if($_GET["page"] < $total_no_ofpages)
                            {
                                echo '<a href="post.php?page='. ($_GET["page"] + 1) .'">&raquo;</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<?php include "footer.php"; ?>
<?php
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
    $adjacents = "2";

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
        $total_no_ofpages = ceil($total_post/$max_records_per_page);


        $stmt = $conn->prepare("SELECT * FROM post ORDER BY post_id DESC LIMIT " . $offset . "," . $max_records_per_page);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                
                $date = date("jS M Y",strtotime($row["publish_date"]));
                $content = substr($row["content"],0,100);
                echo '<div class="col-md-4 col-sm-6 click" data-id='.$row["post_id"].'>';
                echo '<div class="blog post effect">';
                echo '<div class="blog-image">';
                echo '<img src="image/astronomy-1867616__340.jpg" alt="astronomy">';
                echo '</div>';
                echo '<div class="blog-title">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '</div>';
                echo '<div class="blog-content">' . $content . ' ... 
                <a href="viewpost.php?id=' .$row["post_id"].'">Read more</a></div>';
                echo '<div class="blog-footer">';
                echo '<ul class="post-info">';
                echo '<li><i class="material-icons">date_range</i>' . $date . '</li>';
                echo '<li><i class="material-icons">create</i>' . $row["author"] . '</li>';
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