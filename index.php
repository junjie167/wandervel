<!DOCTYPE html>
<html lang="en">

    
    <?php
    include "head.php";
    ?>
    <head>
        <link rel="stylesheet" href="css/index.css">
    </head>
    
    <body>
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
                    <h2 class="text-center">Blog</h2>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="assets/images/blog-4-720x480.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <a href="blog-details.html"><h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4></a>

                                    <p>Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>

                                    <ul class="post-info">
                                        <li><a href="#">John Doe</a></li>
                                        <li><a href="#">10.07.2020 10:20</a></li>
                                        <li><a href="#"><i class="fa fa-comments" title="Comments"></i> 12</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="assets/images/blog-5-720x480.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <a href="blog-details.html"><h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4></a>

                                    <p>Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>

                                    <ul class="post-info">
                                        <li><a href="#">John Doe</a></li>
                                        <li><a href="#">10.07.2020 10:20</a></li>
                                        <li><a href="#"><i class="fa fa-comments" title="Comments"></i> 12</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="assets/images/blog-6-720x480.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <a href="blog-details.html"><h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4></a>

                                    <p>Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>

                                    <ul class="post-info">
                                        <li><a href="#">John Doe</a></li>
                                        <li><a href="#">10.07.2020 10:20</a></li>
                                        <li><a href="#"><i class="fa fa-comments" title="Comments"></i> 12</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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