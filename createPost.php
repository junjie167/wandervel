<!DOCTYPE html>
<html lang="en">
<?php include "head.php";?>
<body>
    <header>
    <?php include "navbar.php"; ?> 
    </header>

<main>
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="center">
                <h1 class="header-title">Create Post</h1>                   
            </div>
            <form action="process_CreatePost.php" method="post" enctype="multipart/form-data">    
                <div class="form-group">   
                    <label for="title">Title:</label>  
                    <input class="form-control" type="text" id="title"          
                    name="title" placeholder="Enter your title">    
                </div>   
                <div class="form-group">   
                    <label for="content">Share your post with everyone!</label>  
                    <textarea rows="10" class="form-control" type="text" id="content"          
                    name="content"></textarea>   
                </div>  
                <div>
                    <label for="imgImp">Image upload:</label>
                    <input id="imgImp" type="file" name="uploadfile" value="empty"/>
                </div>
                <div class="prelabel">
                    <label>Image Preview:</label>
                </div>
                <div class="preimg">
                    <img id="preview" src="#" alt="preview"/>
                </div>
                <div class="form-group">  
                    <button  class="btn btn-secondary submitbtn" type="submit">Submit</button> 
                </div>
            </form> 
            <div>
                <button id="cancelbtn" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </section>  
</main>    
    <?php  include "footer.php"; ?>
</body>
</html>

