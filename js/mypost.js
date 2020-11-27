$(document).ready(function(){

    var status;

    $(document).on("click", "#mypost-delete", function(){
        $('.del').css("display"," block");
        $('#mypost-done').css("display", "block");
        $('#mypost-cancel').css("display", "block");
        $('#mypost-edit').css("display", "none");
        $('#mypost-delete').css("display", "none");
        $("#mypost-done").attr("disabled", true);
        status = "delete";
    })

    $(document).on("click", "#mypost-cancel", function(){

        $.each($("input[name='delete']:checked"), function(){
                $(this).prop("checked", false);
        });
        $.each($("input[name='edit']:checked"), function(){
            $(this).prop("checked", false);
        });
        $('.del').css("display"," none");
        $('.cross').css("display"," none");
        $('#mypost-done').css("display", "none");
        $('#mypost-cancel').css("display", "none");
        $('#mypost-edit').css("display", "block");
        $('#mypost-delete').css("display", "block");
        status = "cancel";
    })

    $(document).on("click", "#mypost-edit", function(){
        $('.cross').css("display"," block");
        $('#mypost-done').css("display", "block");
        $('#mypost-cancel').css("display", "block");
        $('#mypost-edit').css("display", "none");
        $('#mypost-delete').css("display", "none");
        $("#mypost-done").attr("disabled", true);
        status = "edit";
    })

    $(document).on("click", "#mypost-done", function(){

        var id;
        if (status == "edit")
        {
            $.each($("input[name='edit']:checked"), function(){
                id = $(this).val();
            });

            window.location.href = "updatePost.php?id="+id;

        }else if (status == "delete")
        {
            $("#mypopup").css("display", "block");
        }
    })

    $(document).on("click", "#proceed", function(){

        var removepost = [];

        $.each($("input[name='delete']:checked"), function(){
            removepost.push($(this).val());
        });

        $.ajax({
            url: "process_deletePost.php",
            type: "POST",
            data: {id: removepost, action: "del"},
            success: function (response) {
                console.log(response);
                location.reload(true);
            }
        });
    })


    $(".checkmate").change(function(){
        if (this.checked)
        {
            $("#mypost-done").attr("disabled", false);
        }else
        {
            $("#mypost-done").attr("disabled", true);
        }
    })

    $(".radio").change(function(){
        if (this.checked)
        {
            $("#mypost-done").attr("disabled", false);
        }else
        {
            $("#mypost-done").attr("disabled", true);
        }
    })
})