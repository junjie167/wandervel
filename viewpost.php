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
                <div id="fav-modal" class="bookmark-modal">
                    <p id="bookmark-text"></p>
                </div>
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


</html>