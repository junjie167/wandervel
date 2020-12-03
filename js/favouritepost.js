$(document).ready(function(){

    $(document).on("click", "#favpost-delete", function(){
        $('.cross').css("display"," block");
        $('#favpost-done').css("display", "block");
        $('#favpost-cancel').css("display", "block");
        $('#favpost-delete').css("display", "none");
        $("#favpost-done").attr("disabled", true);
    })

    $(document).on("click", "#favpost-cancel", function(){

        $.each($("input[name='fav']:checked"), function(){
                $(this).prop("checked", false);
        });
        $('.cross').css("display"," none");
        $('#favpost-done').css("display", "none");
        $('#favpost-cancel').css("display", "none");
        $('#favpost-delete').css("display", "block");
    })

    $(".checkmate").change(function(){
        if (this.checked)
        {
            $("#favpost-done").attr("disabled", false);
        }else
        {
            $("#favpost-done").attr("disabled", true);
        }
    })

    $(document).on("click", "#favpost-done", function(){

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
            },
            error: function(response){
                console.log("Failed to remove post");
            }
        });
    })



})