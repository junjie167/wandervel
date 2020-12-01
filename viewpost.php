<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";
?>
<?php
include "include/postDB.php";
?>
<?php include "function.php"; ?>
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
                        $commentcount =  count($comments);
                        display_post($commentcount);
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
        <?php include "footer.php"; ?>
    </body>



</html>