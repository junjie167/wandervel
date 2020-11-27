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
    <link rel="stylesheet" href="css/favouritepost.css">
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
                                 echo '<a class="addressClick"  href="favourite.php?page='. ($_GET["page"] - 1) .'">&laquo;</a>';
                                }
                                for($fav_page = 1 ; $fav_page <= $fav_total_no_ofpages ; $fav_page++)
                                {
                                    echo '<a class="addressClick" href="favourite.php?page='. $fav_page.'" data-id="'.$fav_page.'">'. $fav_page . '</a>';
                                }
                                if($_GET["page"] < $fav_total_no_ofpages)
                                {
                                    echo '<a class="addressClick" href="favourite.php?page='. ($_GET["page"] + 1) .'">&raquo;</a>';
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
                </div>
            </section>
        </main>
    </body>
    <?php include "footer.php"; ?>
</html>