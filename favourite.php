<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";
?>
<?php
include "include/postDB.php";
?>
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
                    <div id="mypopup" class="popup">
                        <div class="popup-content">
                            <span id="close">
                                &times;
                            </span>
                            <br>
                            <div>
                            <h4>Are you sure you want to remove?</h4>
                                <p>This action cannot be undone</p>
                            </div>
                            <div class="popup-footer">
                                <button id="proceed" class="btn btn-primary">Proceed</button>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(checkFav_wopostid())
                        {
                            echo '<div class="row mar">';
                                echo'<div class="col-md-12 col-sm-6">';
                                    echo '<ul class="popup-button fr">';
                                        echo '<li><button id="favpost-delete" class="btn btn-danger delete-button"><i class="material-icons edit">delete</i> Remove</button></li>';
                                        echo '<li><button id="favpost-done" class="btn btn-success delete-button"><i class="material-icons edit">done</i> Done</button></li>';
                                        echo '<li><button id="favpost-cancel" class="btn btn-danger"><i class="material-icons edit">clear</i>Cancel</button></li>';
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                      
                    ?>
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
        <?php include "footer.php"; ?>
    </body>

</html>