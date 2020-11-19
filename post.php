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
                </div>
                <div class="row">
                    <?php
                    display();
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>
<?php include "footer.php"; ?>
<?php
function display()
{
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $stmt = $conn->prepare("SELECT * FROM post");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="col-md-4 col-sm-6 click" data-id='.$row["post_id"].'>';
                echo '<div class="blog post">';
                echo '<div class="blog-image">';
                echo '<img src="image/astronomy-1867616__340.jpg" alt="astronomy">';
                echo '</div>';
                echo '<div class="blog-title">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '</div>';
                echo '<div class="blog-content">' . $row["content"] . '</div>';
                echo '<div class="blog-footer">';
                echo '<ul class="post-info">';
                echo '<li><<i class="material-icons">date_range</i>' . $row["publish_date"] . '</li>';
                echo '<li><<i class="material-icons">create</i>' . $row["author"] . '</li>';
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