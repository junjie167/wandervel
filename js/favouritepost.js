$(document).ready(function(){

    $(document).on("click", "#remove", function(){
        $('.cross').css("display"," block");
        $('#delete').css("display", "block");
        $('#remove').css("display", "none");
    })

    $(document).on("click", "#delete", function(){
        
        $("#mypopup").css("display", "block");
    })

    $(document).on("click", "#close", function(){
        $("#mypopup").css("display", "none");
    })

    $(document).on("click", "#proceed", function(){

         var removefav = [];

        $.each($("input[name='fav']:checked"), function(){
            removefav.push($(this).val());
        });

        $.ajax({
            url: "include/postDB.php",
            type: "POST",
            data: {id: removefav, action: "remove_fav_post"},
            success: function (response) {
                console.log(response);
                location.reload(true);
            }
        });
    })



})