<!DOCTYPE html>
<html lang="en">

    <?php
    include "include/postDB.php";
    ?>
    
    <?php
    include "head.php";
    ?>
     
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
            <img src="homeimages/aboutus2.jpg" alt="mainpic" style="width:100%;">
            <div class="content">
                            <br>
                <h1>About Wandervel</h1>
            </div>
            </div>
            </div>
                <div class="sub-container">
                    <br>
                    <br>
                    <h2>
                    How did it all started? Ever wonder how it would be to exhibit all your <br>
                    fondest memories while travelling?<br>
                    The name "Wandervel" came from "wander" and "travel".<br>
                    Wandervel is a collective travel blog for travel writers. <br>
                    We hope you get to wander around through these blogs. <br>
                    Explore your favourite travel blogs now!<br>
                    
    
    </h2>
</div>
        </section>
        </main>

<?php
include "footer.php";
?>


</body>

        </html>