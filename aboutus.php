<!DOCTYPE html>
<html lang="en">
<?php
include "include/postDB.php";
?>
    
    <?php
    include "head.php";
    ?>
    <head>
    <title>About Wandervel</title>
        <link rel="stylesheet" href="css/aboutus.css">
    </head>
    
    <body>
        <main>
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

          
        <section class="blog-posts grid-system">
            <div class="container">
            <div id="pictures">
            <img src="homeimages/aboutus2.jpg" style="width:100%;">
            <div class="content">
    <h1>About Wandervel</h1>
  </div>
</div>
</div>
                <div class="sub-container">
                    <br>
                    <br>
                    <h3>
                    How did it all started? Ever wonder how it would be to exhibit all your <br>
                    fondest memories while travelling?

                    </h3>
                <h3>
    The name "Wandervel" came from "wander" and "travel".<br>
    Wandervel is a collective travel blog for travel writers. <br>
    We hope you get to wander around through these blogs. <br>
    Explore your favourite travel blogs now!<br>
    
    
    </h3>
</div>


</body>


<?php
include "footer.php";
?>

        </html>