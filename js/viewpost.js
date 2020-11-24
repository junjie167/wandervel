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
                $("#unbookmark").css("display", "block");
                setTimeout(function(){
                    $("#fav-modal").css("display","none");
                }, 10000);
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
                $("#unbookmark").css("display", "none");
                setTimeout(function(){
                    $("#fav-modal").css("display","none");
                }, 10000);
            }
        });
    })
})