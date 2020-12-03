$(document).ready(function(){

    $(document).on('click', '#bookmark', function(){

        var id = $(this).attr("data-id");
        
        $.ajax({
            url: "include/postDB.php",
            type: "POST",
            data: {id: id, action: "add_fav_post"},
            success: function (response) {
                console.log(response);
                $("#bookmark-text").text("Added to favourites successfully");
                $("#fav-modal").css("display","block");
                $("#bookmark").css("display", "none");
                if ($('#unbookmark').length == 0)
                {
                    $("#unbookmark2").css("display", "block");
                }
                $("#unbookmark").css("display", "block");              
                setTimeout(function(){
                    $("#fav-modal").css("display","none");
                }, 8000);
            },
            error: function(response){
                $("#bookmark-text").text("Failed to add to favourite. PLease try again");
                console.log("Failed to add post");
                setTimeout(function(){
                    $("#fav-modal").css("background-color", "red");
                    $("#fav-modal").css("display","none");
                }, 8000);
            }
        });
    })

    $(document).on('click', '#unbookmark', function(){

        var id = $(this).attr("data-id");
        $.ajax({
            url: "include/postDB.php",
            type: "POST",
            data: {id: id, action: "remove_fav_post"},
            dataType: "text",
            success: function (response) {
                console.log(response);
                $("#bookmark-text").text("Removed from favourites successfully");
                $("#fav-modal").css("display","block");
                $("#bookmark").css("display", "block");
                if ($('#bookmark').length == 0)
                {
                    $("#bookmark2").css("display", "block");
                }               
                $("#unbookmark").css("display", "none");
                $("#unbookmark2").css("display", "none");
                setTimeout(function(){
                    $("#fav-modal").css("display","none");
                }, 8000);
            },
            error: function(response){
                $("#bookmark-text").text("Failed to remove from favourite. PLease try again");
                console.log("Failed to remove post");
                setTimeout(function(){
                    $("#fav-modal").css("background-color", "red");
                    $("#fav-modal").css("display","none");
                }, 8000);
            }
        });
    })


    $(document).on("click", "#bookmark2", function(){

        var id = $(this).attr("data-id");
        
        $.ajax({
            url: "include/postDB.php",
            type: "POST",
            data: {id: id, action: "add_fav_post"},
            success: function (response) {
                console.log(response);
                $("#bookmark-text").text("Added to favourites successfully");
                $("#fav-modal").css("display","block");
                $("#bookmark").css("display", "none");
                $("#bookmark2").css("display", "none");
                if ($('#unbookmark').length == 0)
                {
                    $("#unbookmark2").css("display", "none");
                }
                $("#unbookmark").css("display", "block");  
                setTimeout(function(){
                    $("#fav-modal").css("display","none");
                }, 8000);
            },
            error: function(response){
                $("#bookmark-text").text("Failed to add to favourite. PLease try again");
                console.log("Failed to add post");
                setTimeout(function(){
                    $("#fav-modal").css("background-color", "red");
                    $("#fav-modal").css("display","none");
                }, 8000);
            }
        });
    })

    $(document).on('click', '#unbookmark2', function(){

        var id = $(this).attr("data-id");
        $.ajax({
            url: "include/postDB.php",
            type: "POST",
            data: {id: id, action: "remove_fav_post"},
            dataType: "text",
            success: function (response) {
                console.log(response);
                $("#bookmark-text").text("Removed from favourites successfully");
                $("#fav-modal").css("display","block");
                $("#bookmark").css("display", "block");
                if ($('#bookmark').length == 0)
                {
                    $("#bookmark2").css("display", "block");
                }
                if ($('#unbookmark').length == 0)
                {
                    $("#unbookmark2").css("display", "none");
                }
                $("#unbookmark").css("display", "none");                                     
                setTimeout(function(){
                    $("#fav-modal").css("display","none");
                }, 8000);
            },
            error: function(response){
                $("#bookmark-text").text("Failed to remove from favourite. PLease try again");
                console.log("Failed to remove post");
                setTimeout(function(){
                    $("#fav-modal").css("background-color", "red");
                    $("#fav-modal").css("display","none");
                }, 8000);
            }
        });
    })

    $(document).on("click", "#close", function(){
        $("#mypopup").css("display", "none");
    })

    var delid;
    $(document).on("click", "#viewpost-delete", function(){
        delid =  $(this).attr("data-id");
        $("#mypopup").css("display", "block");
    })

    $(document).on("click", "#viewpost-edit", function(){
        
        var id = $(this).attr("data-id");

        window.location.href = "updatePost.php?id="+id;
    })

    $(document).on("click", "#viewproceed", function(){

        $.ajax({
            url: "process_deletePost.php",
            type: "POST",
            data: {id: delid, action: "del"},
            success: function (response) {
                var deleted = {"deleted":"true"};
                localStorage.setItem('success', JSON.stringify(deleted));
                window.location.href = "post.php?page=1";
            },
            error: function(response){
                console.log("failed to redirect");
            }
        });
    })


    $(document).on("click", "#facebook", function(){
        var id = $(this).attr("data-id");
        window.location.href = "https://www.facebook.com/sharer/sharer.php?u=http://34.200.74.4/wandervel/viewpost.php?id="+id;
    })
})