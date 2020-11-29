<!DOCTYPE html>
<html lang="en">
<?php
include "include/postDB.php";
?>
    
    <?php
    include "head.php";
    ?>
    <head>
        <link rel="stylesheet" href="css/index.css">
    </head>
    
    <body>
        <main>
        <header>
        <?php
        include "indexnavbar.php";
        ?>
        </header>
      
        <section class="blog-posts grid-system">
            <div class="container">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="indeximages/travel1.jpg" alt="First slide">
                            <div class="carousel-caption">
                                <h2>Welcome to Wandervel!</h2>
                                <p>A travel blog for you to share your own travel experience with everyone who loves to travel!</p>
                            </div>
                        </div>
                        <!--<div class="carousel-item">
                            <img class="d-block w-100" src="indeximages/travel2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="indeximages/travel3.jpg" alt="Third slide">
                        </div>-->
                    </div>
                </div>
               
                <div class="all-blog-posts">
                    <h1 class="text-center">Latest Blog</h1>
                    <br>
                    <div class="row">
                        <?php latestPost();?>
                    </div>
                </div>
            </div>
        </section>

        <section class="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-content">
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>Lorem ipsum dolor sit amet.</span>
                                    <h4>Sed doloribus accusantium reiciendis et officiis.</h4>
                                </div>
                                <div class="col-lg-4">
                                    <div class="main-button">
                                        <a href="contact.html">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

</body>

<?php
include "footer.php";
?>

</html>