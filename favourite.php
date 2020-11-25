<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<?php
include "include/postDB.php";
?>
<head>
    <link rel="stylesheet" href="css/viewpost.css">
    <script defer src="js/viewpost.js"></script>
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
                        <h1 class="header-title">My Favourites</h1>                   
                    </div>
                    <div class="row">
                    <?php
                    display_fav_post();
                    ?>
                    <div class="paging-wrapper">
                        <div class="paging">
                            <?php 
                                if($_GET["page"] != 1)
                                {
                                 echo '<a class="addressClick"  href="post.php?page='. ($_GET["page"] - 1) .'">&laquo;</a>';
                                }
                                for($page = 1 ; $page <= $total_no_ofpages ; $page++)
                                {
                                    echo '<a class="addressClick" href="post.php?page='. $page.'" data-id="'.$page.'">'. $page . '</a>';
                                }
                                if($_GET["page"] < $total_no_ofpages)
                                {
                                    echo '<a class="addressClick" href="post.php?page='. ($_GET["page"] + 1) .'">&raquo;</a>';
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
                </div>
            </section>
        </main>
    </body>
</html>