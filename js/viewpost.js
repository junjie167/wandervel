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
            }
        });
    })


    $(document).on("click", "#facebook", function(){
        var id = $(this).attr("data-id");
        window.location.href = "https://www.facebook.com/sharer/sharer.php?u=http://34.200.74.4/wandervel/viewpost.php?id="+id;
    })
})