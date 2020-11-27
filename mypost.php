<?php session_start();?>
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
    <link rel="stylesheet" href="css/mypost.css">
    <script defer src="js/favouritepost.js"></script>
    <script defer src="js/mypost.js"></script>
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
                                <button id="proceed" class="btn btn-primary">Proceed</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mar">
                        <div class="col-md-12 col-sm-6">
                            <ul class="popup-button fr">
                                <li><button id="mypost-delete" class="btn btn-outline-danger delete-button"><i class="material-icons edit">delete</i> Delete</button></li>
                                <li><button id="mypost-done" class="btn btn-outline-success delete-button"><i class="material-icons edit">done</i> Done</button></li>
                                <li><button id="mypost-edit" class="btn btn-outline-primary"><i class="material-icons edit">edit</i>Edit</button></li>
                                <li><button id="mypost-cancel" class="btn btn-outline-danger"><i class="material-icons edit">clear</i>Cancel</button></li>
                            </ul>
                        </div>
                    </div>   
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
    </body>
    <?php include "footer.php"; ?>
</html>