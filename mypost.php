<?php session_start();?>
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
                        <h1 class="header-title">My Post</h1>                   
                    </div>
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
                                <button id="myproceed" class="btn btn-primary">Proceed</button>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(checkmypost())
                        {
                            echo '<div class="row mar">';
                                echo '<div class="col-md-12 col-sm-6">';
                                    echo '<ul class="popup-button fr">';
                                        echo '<li><button id="mypost-delete" class="btn btn-danger delete-button"><i class="material-icons edit">delete</i> Delete</button></li>';
                                        echo '<li><button id="mypost-done" class="btn btn-success delete-button"><i class="material-icons edit">done</i> Done</button></li>';
                                        echo '<li><button id="mypost-edit" class="btn btn-secondary"><i class="material-icons edit">edit</i>Edit</button></li>';
                                        echo '<li><button id="mypost-cancel" class="btn btn-danger"><i class="material-icons edit">clear</i>Cancel</button></li>';
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                   
                    ?>   
                    <div class="row">
                        <?php
                            display_mypost();
                        ?>
                        <div class="paging-wrapper">
                            <div class="paging">
                                <?php 
                                    if($_GET["page"] != 1)
                                    {
                                    echo '<a class="addressClick"  href="mypost.php?page='. ($_GET["page"] - 1) .'">&laquo;</a>';
                                    }
                                    for($page = 1 ; $page <= $total_no_ofpages ; $page++)
                                    {
                                        echo '<a class="addressClick" href="mypost.php?page='. $page.'" data-id="'.$page.'">'. $page . '</a>';
                                    }
                                    if($_GET["page"] < $total_no_ofpages)
                                    {
                                        echo '<a class="addressClick" href="mypost.php?page='. ($_GET["page"] + 1) .'">&raquo;</a>';
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