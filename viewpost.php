<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<?php
include "include/postDB.php";
?>
<?php include "function.php"; ?>
<head>
    <link rel="stylesheet" href="css/viewpost.css">
    <link rel="stylesheet" href="css/favouritepost.css">
    <script defer src="js/viewpost.js"></script>
    <link rel="stylesheet" href="css/comment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <body>
        <header>
            <?php
                 session_start();
                 if(isset($_SESSION['email']))
                 {
                     include "navbar.php";
                 }else
                 {
                     include "indexnavbar.php";
                 }     
            ?>
        </header>
        <main>
            <section class="blog-posts grid-system">
                <div id="fav-modal" class="bookmark-modal">
                    <p id="bookmark-text"></p>
                </div>
                <div class="container">
                <div id="mypopup" class="popup">
                        <div class="popup-content">
                            <span id="close">
                                &times;
                            </span>
                            <br>
                            <div>
                                <h4>Are you sure you want to delete this record?</h4>
                                <p>This action cannot be undone</p>
                            </div>
                            <div class="popup-footer">
                                <button id="viewproceed" class="btn btn-primary">Proceed</button>
                            </div>
                        </div>
                </div>
                    <?php
                        display_post();
                    ?>
                    <h1>Related Posts:</h1>
                    <br>
                    <?php 
                        relatedPost();
                    ?>
                    <div>
                        <h1>Comments</h1>
                            <?php
                            include "comment.php";
                            ?>
                    </div>
                </div>
            </section>
        </main>
    </body>
<?php include "footer.php"; ?>


</html>