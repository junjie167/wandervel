$(document).ready(function(){
    $('div.click').click(function()
    {
        var id = $(this).attr("data-id");
         window.location.href = "viewpost.php?id="+id;
    })

    $(document).on('click','#createPost',function(){
        window.location.href = "createPost.php";
    })

    activePage();
  
})

function activePage()
{
    var current_page_URL = location.href;

    $('.addressClick').each(function(){
        var target = $(this).prop("href");
        if (target == current_page_URL)
        {
            $(this).addClass('active');
            return false;
        }
    })
}

