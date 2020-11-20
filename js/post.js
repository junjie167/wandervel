$(document).ready(function(){
    $('div.click').click(function()
    {
        var id = $(this).attr("data-id");
         window.location.href = "viewpost.php?id="+id;
    })

    $('.addressClick').click(function(){
        var page = $(this).attr("data-id");
        var linktext = $(this).text();
        console.log(page);
        console.log(linktext);
        if (page == linktext)
        {
            $(this).addClass('active');
        }
    })
})