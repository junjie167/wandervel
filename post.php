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
            <div class="container">
                <div class="center">
                    <h1 class="header-title">Blog Posts</h1>                   
                </div>
                <div id="mypopup" class="popup">
                        <div class="popup-content">
                            <span id="close">
                                &times;
                            </span>
                            <br>
                            <div>
                                <p>Your post has been deleted successfully</p>
                            </div>
                            <div class="popup-footer">
                                <button id="postproceed" class="btn btn-primary">Close</button>
                            </div>
                        </div>
                </div>
                <div class="row mar">
                    <div class="col-md-12 col-sm-6">
                    <?php
                            if(isset($_SESSION['email']))
                            {
                                if (checkpost())
                                {
                                    echo '<button id="createPost" class="btn btn-secondary create"><i class="material-icons edit">border_color</i>Create</button>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="row flex-border">
                    <?php
                    display();
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
<?php include "footer.php"; ?>
</body>
</html>