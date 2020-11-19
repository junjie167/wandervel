$(document).ready(function(){
    $('div.click').click(function()
    {
        var id = $(this).attr("data-id");
         window.location.href = "viewpost.php?id="+id;
    })
})