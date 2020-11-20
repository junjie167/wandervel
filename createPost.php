<?php include "head.php";?>
<body>  
<?php include "navbar.php"; ?> 
<main class="container">
    <form action="process_CreatePost.php" method="post" enctype="multipart/form-data">    
        <div class="form-group">   
            <label for="title">Title:</label>  
            <input class="form-control" type="text" id="title"          
                   name="title" placeholder="Enter your title">    
        </div>   
        <div class="form-group">   
            <label for="content">Share your post with everyone!</label>  
            <textarea rows="10"class="form-control" id="content"          
                      name="content">   </textarea>   
        </div>  
        <div>
            <input type="file" name="uploadfile" value="empty"/>
            
        </div>
        <div class="form-group">  
            <button class="btn btn-primary" type="submit">Submit</button> 
        </div>
    </form> 
            
</main>    
    <?php    include "footer.php";    ?></body>